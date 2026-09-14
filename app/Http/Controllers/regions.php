<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\kecamatan;
use App\Models\kota;
use Illuminate\Http\Request;

class regions extends Controller
{
    public function getKota($provinsi_id)
    {
        $kota = kota::where('provinsi_id', $provinsi_id)->orderBy('nama')->get();

        return response()->json($kota);
    }

    public function getKecamatan($kota_id)
    {
        $kecamatan = kecamatan::where('kota_id', $kota_id)->orderBy('nama')->get();

        return response()->json($kecamatan);
    }
}
