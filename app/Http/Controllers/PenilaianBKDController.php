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
            ->where("status_bkd", ">", "2")
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
            "nama" => $nama,
            "nilaiJabatan" => $nilaiJabatan,
            // "departemen" => $departemen,

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
            $nilai->Masa_Penugasan = $request->input("Masa_Penugasan")[$i];
            $nilai->Bukti_Dokumen  = $request->input("Bukti_Dokumen")[$i];
            $nilai->SKS_LKD        = $request->input("SKS_LKD")[$i];

            $nilai->save();
        }

        return redirect()->back()->with("success", "laporan Kinerja Dosen sudah disimpan!");
    }

    public function printLKD($id)
    {
        $data = HeaderBKD::find($id);
        $detail = $data->detail;
        $kategori = DetailBKD::query()->select("Bidang")
            ->where("id_header", "=", $id)
            ->groupBy("Bidang")
            ->get();
        // dd($kategori);
        return \view("bkd/penilaian/printLKD", [
            "header"   => $data,
            "detail"   => $detail,
            "kategori" => $kategori,
            "id" => $id
        ]);
    }
}
