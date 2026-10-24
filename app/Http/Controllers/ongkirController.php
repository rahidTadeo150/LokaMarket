<?php

namespace App\Http\Controllers;

use App\Services\RajaOngkirService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Kecamatan;
use App\Services\RajaOngkirLocationService;
use Illuminate\Http\JsonResponse;
use RuntimeException;
use Throwable;

class ongkirController extends Controller
{
    public function testConnection()
    {
        $apiKey = config('services.rajaongkir.key');

        $baseUrl = config('services.rajaongkir.base_url');

        if (empty($apiKey)) {
            return response()->json([
                'success' => false,
                'message' => 'API Key RajaOngkir belum diatur di file .env.',
            ], 500);
        }

        try {
            $response = Http::timeout(20)
                ->withHeaders([
                    'key' => $apiKey,
                ])
                ->get(
                    rtrim($baseUrl, '/') .
                    '/destination/domestic-destination',
                    [
                        'search' => 'Jember',
                        'limit' => 5,
                        'offset' => 0,
                    ]
                );

            if ($response->failed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'RajaOngkir menolak permintaan.',
                    'status_api' => $response->status(),
                    'detail' => $response->json(),
                ], 502);
            }

            return response()->json([
                'success' => true,
                'message' => 'Koneksi RajaOngkir berhasil.',
                'data' => $response->json('data', []),
            ]);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat terhubung ke server RajaOngkir.',
            ], 502);
        }
    }

    public function mappingRajaOngkir(Kecamatan $kecamatan, RajaOngkirService $service): JsonResponse 
    {

        try {

            $mapping = $service->resolve($kecamatan->id);

            return response()->json([
                'success' => true,
                'data' => [
                    'kecamatan_id' => $kecamatan->id,
                    'rajaongkir_district_id' =>
                        $mapping->rajaongkir_district_id,
                    'label' => implode(', ', [
                        $mapping->kecamatan_nama,
                        $mapping->kota_nama,
                        $mapping->provinsi_nama,
                    ]),
                ],
            ]);

        } catch (RuntimeException $e) {

            $status = str_contains(
                $e->getMessage(),
                'Batas permintaan'
            ) ? 429 : 422;

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $status);

        } catch (\Throwable $e) {

            Log::error('Pemetaan kecamatan RajaOngkir gagal', [
                'kecamatan_id' => $kecamatan->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memetakan lokasi.',
            ], 500);

        }

    }

}