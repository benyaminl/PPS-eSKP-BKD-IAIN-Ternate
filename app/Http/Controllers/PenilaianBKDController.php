<?php

namespace App\Http\Controllers;

use App\Models\DetailBKD;
use App\Models\HeaderBKD;
use App\Models\PenilaianBKD;

use Carbon\Carbon as CarbonCarbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class PenilaianBKDController extends Controller
{
    //
    public function listBKD(Request $request)
    {
        $start = $request->input("tanggal-start") ?? date("Y") . "-01-01";
        $end   = $request->input("tanggal-end") ?? date("Y") . "-12-31";
        $data  = HeaderBKD::where("tanggal_awal", ">=", $start)->where("tanggal_akhir", "<=", $end)
            ->whereRaw("header_bkd.id_pegawai in (select id_bawahan from hubungan_pegawai where id_atasan = ?)", [Auth::id() ?? "2"])
            // ->toSql();
            ->get();

        return \view("bkd/penilaian/index", [
            "data" => $data,
            "start" => $start,
            "end" => $end
        ]);
    }

    public function realisasiForm($id)
    {
        $header = HeaderBKD::find($id);
        $detail = $header->detail;

        $isValidasi = strpos(url()->current(), "verifikasi");
        $isPengesahan = strpos(url()->current(), "pengesahan");

        // Penilaian

        $nilaiJabatan = PenilaianBKD::whereIdHeader($id)->orderBy("id_detail")->get();
        $nama = Auth::user()->nama ?? "Benyamin";
        // $departemen = Auth::user()->biro ?? "Sistem Informasi Bisnis";
        return \view("bkd/penilaian/detail", [
            "header" => $header,
            "detail" => $detail,
            "detailTambahan" => $detailTambahan,
            "nama" => $nama,
            "nilaiJabatan" => $nilaiJabatan,
            //   "departemen" => $departemen,

            "isValidasi" => $isValidasi,
            "isPengesahan" => $isPengesahan
        ]);
    }

    public function simpanNilai($id, Request $request)
    {
        $header = HeaderBKD::findOrFail($id);
        // dd($request->input("id"));
        for ($i = 0; $i < count($request->input("id")); $i++) {
            if (PenilaianBKD::whereIdDetail($request->input("id")[$i])->whereIdHeader($id)->count() <= 0)
                $nilai = new PenilaianBKD();
            else
                $nilai = PenilaianBKD::whereIdDetail($request->input("id")[$i])->first();
            $nilai->id_header      = $id;
            $nilai->id_detail      = $request->input("id")[$i];
            $nilai->angka_kredit   = $request->input("Masa_Penugasan")[$i];
            $nilai->kual_mutu      = $request->input("Bukti_Dokumen")[$i];
            $nilai->waktu          = $request->input("SKS_LKD")[$i];

            $nilai->save();
        }

        return redirect()->back()->with("success", "laporan Kinerja Dosen sudah disimpan!");
    }
}
