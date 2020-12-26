<?php

namespace App\Http\Controllers;

use App\Models\HeaderSKP;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SKPController extends Controller
{
    public function list() {
        $data = HeaderSKP::get();
        return \view("skp/index", [
            "data" => $data
        ]);
    }

    public function addHeaderForm() {
        return \view("skp/add");
    }

    public function add(Request $request) {
        $valid = $request->validate([
            "tanggal-awal" => "required|date_format:d-m-Y",
            "tanggal-akhir" => "required|date_format:d-m-Y"
        ]);

        $header = new HeaderSKP();
        $header->tanggal_draft = Carbon::now();
        $header->id_pegawai = Auth::id();
        $header->tanggal_awal = $valid["tanggal-awal"];
        $header->tanggal_akhir = $valid["tanggal-akhir"];
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
        $valid = $request->validate([]);

        return redirect()->back();
    }
}
