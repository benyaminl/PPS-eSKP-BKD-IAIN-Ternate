<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\LabelAlignment;
use App\Models\DetailSKP;
use App\Models\HeaderSKP;
use App\Models\TugasTambahan;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SKPController extends Controller
{
    public function list(Request $request)
    {
        $start = $request->input("tanggal-start") ?? date("Y") . "-01-01";
        $end   = $request->input("tanggal-end") ?? date("Y") . "-12-31";
        $data  = HeaderSKP::where("tanggal_awal", ">=", $start)->where("tanggal_akhir", "<=", $end)->get();

        return \view("skp/index", [
            "data" => $data,
            "start" => $start,
            "end" => $end
        ]);
    }

    public function addHeaderForm()
    {
        $nama = Auth::user()->nama ?? "Benyamin";
        $departemen = Auth::user()->biro ?? "Sistem Informasi Bisnis";
        $start = date("Y") . "-01-01";
        $end   = date("Y") . "-12-31";
        return \view("skp/add", [
            "nama" => $nama,
            "departemen" => $departemen,
            "start" => $start,
            "end" => $end
        ]);
    }

    public function add(Request $request)
    {
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
            return redirect("/skp/" . $header->id . "/detail")->with("success", "Berhasil membuat SKP Baru");
        else
            return redirect()->back()->with("error", "Gagal membuat SKP Baru");
    }

    public function detailForm($id)
    {
        $header = HeaderSKP::find($id);
        $detail = $header->detail;
        $detailTambahan = $header->TugasTambahan;
        $isValidasi = strpos(url()->current(), "verifikasi");
        $isPengesahan = strpos(url()->current(), "pengesahan");

        $nama = Auth::user()->nama ?? "Benyamin";
        $departemen = Auth::user()->biro ?? "Sistem Informasi Bisnis";
        return \view("skp/detail", [
            "header" => $header,
            "detail" => $detail,
            "detailTambahan" => $detailTambahan,
            "nama" => $nama,
            "departemen" => $departemen,
            "isValidasi" => $isValidasi,
            "isPengesahan" => $isPengesahan
        ]);
    }

    public function addDetailForm($id)
    {
        $header = HeaderSKP::findOrFail($id);
        $nama = Auth::user()->nama ?? "Benyamin";
        $departemen = Auth::user()->biro ?? "Sistem Informasi Bisnis";
        $start = $header->tanggal_awal->format("Y-m-d");
        $end = $header->tanggal_akhir->format("Y-m-d");
        return \view("skp/detail-add", [
            "header" => $header,
            "nama" => $nama,
            "departemen" => $departemen,
            "start" => $start,
            "end" => $end,
        ]);
    }

    public function addDetailTambahanForm($id)
    {
        $header = HeaderSKP::findOrFail($id);
        $nama = Auth::user()->nama ?? "Benyamin";
        $departemen = Auth::user()->biro ?? "Sistem Informasi Bisnis";
        return \view("skp/tugas-tambahan-add", [
            "id"   => $id,
            "nama" => $nama,
            "departemen" => $departemen,
        ]);
    }

    public function addDetail($id, Request $request)
    {
        $valid = $request->validate([
            'tugas_jabatan' => 'required',
            'angka_kredit' => 'integer|required',
            'waktu' => 'integer|required',
            'satuan' => 'required',
            'kual_mutu' => 'required',
            'kuant' => 'required',
            'output' => 'required',
            'biaya' => 'integer|required',
        ]);

        $detail = new DetailSKP();
        $detail->id_header      = $id;
        $detail->tugas_jabatan  = $valid["tugas_jabatan"];
        $detail->angka_kredit   = $valid["angka_kredit"];
        $detail->kual_mutu      = $valid["kual_mutu"];
        $detail->waktu          = $valid["waktu"] . "/" . $valid["satuan"];
        $detail->kuant_output   = $valid["kuant"] . "/" . $valid["output"];
        $detail->biaya          = $valid["biaya"];
        $detail->save();

        return redirect()->back()->with("success", "Berhasil menambah SKP baru");
    }

    public function addDetailTambahan($id, Request $request)
    {
        $valid = $request->validate([
            'tugas-tambahan' => 'required',
            'sk' => 'required',
        ]);

        $detail = new TugasTambahan();
        $detail->id_header       = $id;
        $detail->tugas_tambahan  = $valid["tugas-tambahan"];
        $detail->nomor_sk        = $valid["sk"];
        $detail->save();

        return redirect()->back()->with("success", "Berhasil tambah tugas tambahan!");
    }

    public function deleteDetail(Request $request)
    {
        $valid = $request->validate(["id" => "required"]);
        $text = "";
        if ($request->input("type") == "tugas-tambahan") {
            $detail = TugasTambahan::find($valid["id"]);
            $detail->delete();
            $text = "Tugas Tambahan";
        } else {
            $detail = DetailSKP::find($valid["id"]);
            $detail->delete();
            $text = "Tugas Jabatan";
        }

        return redirect()->back()->with(["success" => "Berhasil hapus detail SKP $text"]);
    }

    public function listValidasiSKP(Request $request)
    {
        $start = $request->input("tanggal-start") ?? date("Y") . "-01-01";
        $end   = $request->input("tanggal-end") ?? date("Y") . "-12-31";
        $data  = HeaderSKP::whereStatusSkp(1)->where("tanggal_awal", ">=", $start)->where("tanggal_akhir", "<=", $end)->get();


        return \view("skp/validasi", [
            "data" => $data,
            "start" => $start,
            "end" => $end
        ]);
    }

    public function listPengesahanSKP(Request $request)
    {
        $start = $request->input("tanggal-start") ?? date("Y") . "-01-01";
        $end   = $request->input("tanggal-end") ?? date("Y") . "-12-31";
        $data  = HeaderSKP::whereStatusSkp(2)
            ->where("tanggal_awal", ">=", $start)
            ->where("tanggal_akhir", "<=", $end)
            ->whereRaw("header_skp.id_pegawai in (select id_bawahan from hubungan_pegawai where id_atasan = ?)", [Auth::id() ?? "2"])
            // ->toSql();
            ->get();
        // dd($data);
        return \view("skp/pengesahan", [
            "data" => $data,
            "start" => $start,
            "end" => $end
        ]);
    }


    public function ajukanValidasi($id)
    {
        $header = HeaderSKP::find($id);

        $header->status_skp = 1;
        $header->divalidasi_oleh = null;
        $header->tanggal_validasi = null;
        $header->tanggal_pengajuan = Carbon::now();
        $header->save();

        return redirect()->back()->with("success", "Berhasil ajukan untuk di validasi!");
    }

    public function validasiSKP($id, Request $request)
    {
        $header = HeaderSKP::find($id);

        $header->status_skp = 2;
        $header->divalidasi_oleh = Auth::id() ?? 3;
        $header->tanggal_validasi = Carbon::now();
        $header->save();

        return redirect()->back()->with("success", "Berhasil divalidasi!");
    }

    public function rejectSKP($id, Request $request)
    {
        $header = HeaderSKP::find($id);

        $header->status_skp = 0;
        $header->divalidasi_oleh = Auth::id() ?? 3;
        $header->tanggal_validasi = Carbon::now();
        $header->save();

        return redirect()->back()->with("success", "Status Kembali menjadi Draf!");
    }

    public function pengesahanSKP($id, Request $request)
    {
        $header = HeaderSKP::find($id);

        $header->status_skp = 3;
        $header->disahkan_oleh = Auth::id() ?? 2;
        $header->tanggal_pengesahan = Carbon::now();
        $header->save();

        return redirect()->back()->with("success", "Anda berhasil mengesahkan SKP! Sekarang bawahan anda dapat melakukan print terhadap formulir SKP.");
    }

    public function printSKP($id)
    {
        $data = HeaderSKP::find($id);
        $detail = $data->detail;
        return \view("skp/print", [
            "header" => $data,
            "detail" => $detail,
            "id" => $id
        ]);
    }


    public function generateQR($id)
    {
        $header = HeaderSKP::find($id);
        // GENERATE QR CODE
        $qr = new QrCode("https://skp.iain-ternate.ac.id/verify?=" . $id);
        $qr->setSize(150);
        // dd(public_path("/vendor/iain/logo.png"));
        // Adding Logo
        $qr->setLogoPath(public_path("/vendor/iain/logo.png"));
        $qr->setLogoSize(80, 80);
        // Adding Label
        $qr->setLabel('Sudah Disahkan oleh ' . $header->Atasan->nama, 8, public_path("/vendor/iain/calibrib.ttf"), LabelAlignment::CENTER());
        // OUTPUT QR CODE
        // DIRECTLY OUTPUT AS IMAGE
        // <img src="1-simple-qr.php"/>
        // header("Content-Type: {$qr->getContentType()}");
        // @see https://laravel.com/docs/8.x/responses#response-objects
        return response($qr->writeString())
            ->header("Content-Disposition", 'filename="qr-' . $id . '.png"')
            ->header("Content-Type", $qr->getContentType());
    }
}
