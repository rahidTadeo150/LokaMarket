<?php

namespace App\Services;

use App\Models\Kecamatan;
use App\Models\rajaongkir_lokasi;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RuntimeException;

class RajaOngkirService
{

    private function baseUrl(): string
    {
        return rtrim(
            (string) config('services.rajaongkir.base_url'),
            '/'
        );
    }

    private function fetchDestinations(string $keyword): array
    {
        $apiKey = config('services.rajaongkir.key');
        $baseUrl = $this->baseUrl();

        if (!$apiKey || !$baseUrl) {
            throw new RuntimeException(
                'Konfigurasi API RajaOngkir/Komerce belum lengkap.'
            );
        }

        $cacheKey = 'komerce_destination:' . md5($keyword);

        return Cache::remember(
            $cacheKey,
            now()->addMinutes(30),
            function () use ($apiKey, $baseUrl, $keyword) {
                $response = Http::withHeaders([
                    'key' => $apiKey,
                    'Accept' => 'application/json',
                ])
                    ->timeout(20)
                    ->get(
                        $baseUrl . '/destination/domestic-destination',
                        [
                            'search' => $keyword,
                            'limit' => 100,
                            'offset' => 0,
                        ]
                    );

                if ($response->status() === 429) {
                    throw new RuntimeException(
                        'Batas permintaan RajaOngkir tercapai. Coba lagi nanti.'
                    );
                }

                if ($response->failed()) {
                    throw new RuntimeException(
                        'Gagal mengambil data lokasi dari Komerce. HTTP ' .
                        $response->status()
                    );
                }

                $data = $response->json('data');

                if (!is_array($data)) {
                    throw new RuntimeException(
                        'Format respons API Komerce tidak valid.'
                    );
                }

                return $data;
            }
        );
    }

    private function normalize(string $name): string
    {
        $name = Str::ascii(mb_strtolower(trim($name)));

        $name = preg_replace(
            '/^(kecamatan|kec\.?|kabupaten administrasi|kabupaten|kab\.?|kota administrasi|kota)\s+/u',
            '',
            $name
        );

        return preg_replace('/[^a-z0-9]/', '', $name);
    }

    private function findMatches(Kecamatan $kecamatan): array
    {
        $kecamatan->loadMissing('kota.provinsi');

        $kota = $kecamatan->kota;
        $provinsi = $kota?->provinsi;

        if (!$kota || !$provinsi) {
            throw new RuntimeException(
                'Relasi kecamatan, kota, dan provinsi tidak lengkap.'
            );
        }

        // Pencarian berdasarkan nama kecamatan.
        $results = $this->fetchDestinations($kecamatan->nama);

        $matches = [];

        foreach ($results as $item) {
            $provinceName = (string) ($item['province_name'] ?? '');
            $cityName = (string) ($item['city_name'] ?? '');
            $districtName = (string) ($item['district_name'] ?? '');

            $destinationId = $item['id'] ?? null;

            if (
                !$destinationId ||
                $provinceName === '' ||
                $cityName === '' ||
                $districtName === ''
            ) {
                continue;
            }

            if (
                $this->normalize($provinceName) !==
                    $this->normalize($provinsi->nama) ||
                $this->normalize($cityName) !==
                    $this->normalize($kota->nama) ||
                $this->normalize($districtName) !==
                    $this->normalize($kecamatan->nama)
            ) {
                continue;
            }

            $matches[] = $item;
        }

        if (empty($matches)) {
            throw new RuntimeException(
                'Wilayah kecamatan tidak ditemukan atau tidak cocok di Komerce. ' .
                'Periksa nama kecamatan, kota, dan provinsi.'
            );
        }

        return $matches;
    }

    public function resolve(int $kecamatanId): rajaongkir_lokasi
    {
        $kecamatan = Kecamatan::with('kota.provinsi')
            ->findOrFail($kecamatanId);

        $existing = rajaongkir_lokasi::where(
            'kecamatan_id',
            $kecamatan->id
        )->first();

        if ($existing) {
            return $existing;
        }

        $matches = $this->findMatches($kecamatan);
        $item = $matches[0];

        $kota = $kecamatan->kota;
        $provinsi = $kota->provinsi;

        /*
         * Kode pos hanya disimpan jika hasil yang cocok
         * memiliki satu kode pos unik.
         *
         * Satu kecamatan bisa memiliki beberapa kode pos.
         */
        $postalCodes = collect($matches)
            ->pluck('zip_code')
            ->filter(fn ($code) => trim((string) $code) !== '')
            ->map(fn ($code) => (string) $code)
            ->unique()
            ->values();

        $kodePos = $postalCodes->count() === 1
            ? $postalCodes->first()
            : null;

        /*
         * Gunakan ID dari respons API jika tersedia.
         * Jangan menganggap destination ID sama dengan district ID.
         */
        $provinceId = $item['province_id'] ?? null;
        $cityId = $item['city_id'] ?? null;
        $districtId = $item['district_id'] ?? null;

        if (!$provinceId || !$cityId || !$districtId) {
            throw new RuntimeException(
                'Respons Komerce tidak menyediakan province_id, city_id, ' .
                'atau district_id yang diperlukan. Periksa struktur respons API.'
            );
        }

        return rajaongkir_lokasi::updateOrCreate(
            ['kecamatan_id' => $kecamatan->id],
            [
                'rajaongkir_province_id' => $provinceId,
                'rajaongkir_city_id' => $cityId,
                'rajaongkir_district_id' => $districtId,

                'provinsi_nama' => $provinsi->nama,
                'kota_nama' => $kota->nama,
                'kecamatan_nama' => $kecamatan->nama,

                'kode_pos' => $kodePos,
            ]
        );
    }

    public function search(Kecamatan $kecamatan): array
    {
        $matches = $this->findMatches($kecamatan);

        $results = [];

        foreach ($matches as $item) {
            $postalCode = (string) ($item['zip_code'] ?? '');

            $labelParts = array_filter([
                $item['subdistrict_name'] ?? null,
                $item['district_name'] ?? null,
                $item['city_name'] ?? null,
                $item['province_name'] ?? null,
                $postalCode ?: null,
            ]);

            $results[] = [
                'destination_id' => $item['id'],
                'label' => $item['label'] ?? implode(', ', $labelParts),
                'postal_code' => $postalCode ?: null,
                'subdistrict_name' => $item['subdistrict_name'] ?? null,
            ];
        }

        return $results;
    }
}
