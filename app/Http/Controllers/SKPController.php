<?php

namespace App\Http\Controllers;

use App\Models\DetailSKP;
use App\Models\HeaderSKP;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SKPController extends Controller
{
    public function list(Request $request) {
        $start = $request->input("tanggal-start") ?? date("Y")."-01-01";
        $end   = $request->input("tanggal-end") ?? date("Y")."-12-31";
        $data  = HeaderSKP::where("tanggal_awal", ">=", $start)->where("tanggal_akhir", ">=", $end)->get();

        return \view("skp/index", [
            "data" => $data,
            "start" => $start,
            "end" => $end
        ]);
    }

    public function addHeaderForm() {
        $nama = Auth::user()->nama ?? "Benyamin";
        $departemen = Auth::user()->biro ?? "Sistem Informasi Bisnis";
        $start = date("Y")."-01-01";
        $end   = date("Y")."-12-31";
        return \view("skp/add", [
            "nama" => $nama,
            "departemen" => $departemen,
            "start" => $start,
            "end" => $end
        ]);
    }

    public function add(Request $request) {
        $valid = $request->validate([
            "tanggal-mulai" => "required|date_format:Y-m-d",
            "tanggal-selesai" => "required|date_format:Y-m-d"
        ]);

        $header = new HeaderSKP();
        $header->tanggal_draft = Carbon::now();
        $header->id_pegawai = Auth::id() ?? 1;
        $header->tanggal_awal = $valid["tanggal-mulai"];
        $header->tanggal_akhir = $valid["tanggal-selesai"];
        if ($header->save())
            return redirect("/skp/".$header->id."/detail")->with("success", "Berhasil membuat SKP Baru");
        else 
            return redirect()->back()->with("error", "Gagal membuat SKP Baru");
    }

    public function detailForm($id) {
        $header = HeaderSKP::find($id);
        $detail = $header->detail;

        return \view("skp/detail", [
            "header" => $header,
            "detail" => $detail
        ]);
    }

    public function addDetail(Request $request) {
        $valid = $request->validate([
            'tugas_jabatan'
        ]);
        
        $detail = new DetailSKP();
        $detail->tugas_jabatan = $valid["tugas_jabatan"];
        return redirect()->back();
    }
}
