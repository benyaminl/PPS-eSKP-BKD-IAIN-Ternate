<?php

namespace App\Http\Controllers;

use App\Models\DetailSKP;
use App\Models\HeaderSKP;
use App\Models\PenilaianSKP;
use App\Models\PenilaianPerilakuKerja;
use App\Models\TugasTambahan;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class PenilaianSKPController extends Controller
{
    //
    public function listSKP(Request $request) {
        $start = $request->input("tanggal-start") ?? date("Y")."-01-01";
        $end   = $request->input("tanggal-end") ?? date("Y")."-12-31";
        $data  = HeaderSKP::where("tanggal_awal", ">=", $start)->where("tanggal_akhir", "<=", $end)
                 ->whereRaw("header_skp.id_pegawai in (select id_bawahan from hubungan_pegawai where id_atasan = ?)", [Auth::id() ?? "2"])
                 ->where("status_skp", ">", "2")
                 // ->toSql();
                 ->get();

        return \view("skp/penilaian/index", [
            "data" => $data,
            "start" => $start,
            "end" => $end
        ]);
    }

    public function realisasiForm($id) {
        $header = HeaderSKP::find($id);
        $detail = $header->detail;
        $detailTambahan = $header->TugasTambahan;
        $isValidasi = strpos(url()->current(), "verifikasi");
        $isPengesahan = strpos(url()->current(), "pengesahan");

        // Penilaian
        $nilaiTugasTambahan = $header->getNilaiTugasTambahan();
        $nilaiJabatan = PenilaianSKP::whereIdHeader($id)->orderBy("id_detail")->get();
        $nilaiPerilaku = PenilaianPerilakuKerja::whereIdHeader($id)->first();
        $nama = Auth::user()->nama ?? "Benyamin";
        $departemen = Auth::user()->biro ?? "Sistem Informasi Bisnis";
        return \view("skp/penilaian/detail", [
            "header" => $header,
            "detail" => $detail,
            "detailTambahan" => $detailTambahan,
            "nama" => $nama,
            "nilaiJabatan" => $nilaiJabatan,
            "departemen" => $departemen,
            "nilaiTugasTambahan" => $nilaiTugasTambahan,
            "nilaiPerilaku" => $nilaiPerilaku,
            "isValidasi" => $isValidasi,
            "isPengesahan" => $isPengesahan
        ]);
    }

    public function simpanNilaiJabatan($id, Request $request) {
        $header = HeaderSKP::findOrFail($id);
        // dd($request->input("id"));
        for ($i = 0; $i < count($request->input("id")); $i++) {
            if (PenilaianSKP::whereIdDetail($request->input("id")[$i])->whereIdHeader($id)->count() <= 0)
                $nilai = new PenilaianSKP();
            else 
                $nilai = PenilaianSKP::whereIdDetail($request->input("id")[$i])->first();
            $nilai->id_header      = $id;
            $nilai->id_detail      = $request->input("id")[$i];
            $nilai->angka_kredit   = $request->input("angka_kredit")[$i];
            $nilai->kual_mutu      = $request->input("kual_mutu")[$i];
            $nilai->waktu          = $request->input("waktu")[$i];
            $nilai->kuant_output   = $request->input("kuant_output")[$i];
            $nilai->biaya          = $request->input("biaya")[$i];
            $nilai->save();
        }

        return redirect()->back()->with("success", "Nilai Jabatan sudah disimpan!");
    }

    public function simpanNilaiPerilaku($id, Request $request) {
        $header = HeaderSKP::findOrFail($id);
        // dd($request->all());
        if (PenilaianPerilakuKerja::whereIdHeader($id)->count() <= 0)
            $nilai = new PenilaianPerilakuKerja();
        else 
            $nilai = PenilaianPerilakuKerja::whereIdHeader($id)->first();
        $nilai->id_header   = $id;
        $nilai->pelayanan   = $request->input("pelayanan");
        $nilai->intergritas = $request->input("intergritas");
        $nilai->komitmen    = $request->input("komitmen");
        $nilai->disiplin    = $request->input("disiplin");
        $nilai->kerjasama   = $request->input("kerjasama");
        $nilai->save();

        return redirect()->back()->with("success", "Nilai Jabatan sudah disimpan!");
    }

    public function printRealisasi($id) {
        $data   = HeaderSKP::find($id);
        $detail = $data->detail;
        $tugasTambahan = $data->TugasTambahan;

        return \view("skp/penilaian/print", [
            "header" => $data,
            "detail" => $detail,
            "tugasTambahan" => $tugasTambahan,
            "id" => $id
        ]);
    }
}
