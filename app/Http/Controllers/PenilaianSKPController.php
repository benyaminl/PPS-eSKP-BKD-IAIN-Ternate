<?php

namespace App\Http\Controllers;

use App\Models\DetailSKP;
use App\Models\HeaderSKP;
use App\Models\TugasTambahan;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class PenilaianSKPController extends Controller
{
    //
    public function listSKP(Request $request) {

    }

    public function realisasiForm($id) {
        $header = HeaderSKP::find($id);
        $detail = $header->detail;
        $detailTambahan = $header->TugasTambahan;
        $isValidasi = strpos(url()->current(), "verifikasi");
        $isPengesahan = strpos(url()->current(), "pengesahan");

        $nama = Auth::user()->nama ?? "Benyamin";
        $departemen = Auth::user()->biro ?? "Sistem Informasi Bisnis";
        return \view("skp/penilaian/detail", [
            "header" => $header,
            "detail" => $detail,
            "detailTambahan" => $detailTambahan,
            "nama" => $nama,
            "departemen" => $departemen,
            "isValidasi" => $isValidasi,
            "isPengesahan" => $isPengesahan
        ]);
    }
}
