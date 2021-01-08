<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\LabelAlignment;
use App\Models\DetailBKD;
use App\Models\HeaderBKD;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BKDController extends Controller
{
    public function list(Request $request)
    {
        $start = $request->input("tanggal-start") ?? date("Y") . "-01-01";
        $end   = $request->input("tanggal-end") ?? date("Y") . "-12-31";
        $data  = HeaderBKD::where("tanggal_awal", ">=", $start)->where("tanggal_akhir", "<=", $end)->get();

        return \view("bkd/index", [
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
        return \view("bkd/add", [
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

        $header = new HeaderBKD();
        $header->tanggal_draft = Carbon::now();
        $header->id_pegawai = Auth::id() ?? 1;
        $header->tanggal_awal = $valid["tanggal-mulai"];
        $header->tanggal_akhir = $valid["tanggal-selesai"];
        if ($header->save())
            return redirect("/bkd/" . $header->id . "/detail")->with("success", "Berhasil membuat RBKD Baru");
        else
            return redirect()->back()->with("error", "Gagal membuat RBKD Baru");
    }

    public function detailForm($id)
    {
        $header = HeaderBKD::find($id);
        $detail = $header->detail;
        $isValidasi = strpos(url()->current(), "verifikasi");
        $isPengesahan = strpos(url()->current(), "pengesahan");

        $nama = Auth::user()->nama ?? "Benyamin";
        $departemen = Auth::user()->biro ?? "Sistem Informasi Bisnis";
        return \view("skp/detail", [
            "header" => $header,
            "detail" => $detail,

            "nama" => $nama,
            "departemen" => $departemen,
            "isValidasi" => $isValidasi,
            "isPengesahan" => $isPengesahan
        ]);
    }

    public function addDetailForm($id)
    {
        $header = HeaderBKD::findOrFail($id);
        $nama = Auth::user()->nama ?? "Benyamin";
        $departemen = Auth::user()->biro ?? "Sistem Informasi Bisnis";
        $start = $header->tanggal_awal;
        $end = $header->tanggal_akhir;
        return \view("bkd/detail-add", [
            "header" => $header,
            "nama" => $nama,
            "departemen" => $departemen,
            "start" => $start,
            "end" => $end,
        ]);
    }



    public function addDetail($id, Request $request)
    {
        $valid = $request->validate([
            'bidang' => 'required',
            'jenis_kegiatan' => 'required',
            'bukti_penugasan' => 'required',
            'SKS_RBKD' => 'required',
        ]);

        $detail = new DetailBKD();
        $detail->id_header      = $id;
        $detail->bidang  = $valid["bidang"];
        $detail->jenis_kegiatan   = $valid["jenis_kegiatan"];
        $detail->bukti_penugasan      = $valid["bukti_penugasan"];
        $detail->SKS_RBKD          = $valid["waktu"];
        $detail->save();

        return redirect()->back()->with("success", "Berhasil menambah BKD baru");
    }

    public function deleteDetail(Request $request)
    {
        $valid = $request->validate(["id" => "required"]);
        $text = "";
        $detail = DetailBKD::find($valid["id"]);
        $detail->delete();
        $text = "bidang";


        return redirect()->back()->with(["success" => "Berhasil hapus detail BKD $text"]);
    }

    public function listValidasiBKD(Request $request)
    {
        $start = $request->input("tanggal-start") ?? date("Y") . "-01-01";
        $end   = $request->input("tanggal-end") ?? date("Y") . "-12-31";
        $data  = HeaderBKD::whereStatusBKD(1)->where("tanggal_awal", ">=", $start)->where("tanggal_akhir", "<=", $end)->get();


        return \view("bkd/validasi", [
            "data" => $data,
            "start" => $start,
            "end" => $end
        ]);
    }

    public function listPengesahanBKD(Request $request)
    {
        $start = $request->input("tanggal-start") ?? date("Y") . "-01-01";
        $end   = $request->input("tanggal-end") ?? date("Y") . "-12-31";
        $data  = HeaderBKD::whereStatusBKD(2)
            ->where("tanggal_awal", ">=", $start)
            ->where("tanggal_akhir", "<=", $end)
            ->whereRaw("header_bkd.id_pegawai in (select id_bawahan from hubungan_pegawai where id_atasan = ?)", [Auth::id() ?? "2"])
            // ->toSql();
            ->get();
        // dd($data);
        return \view("bkd/pengesahan", [
            "data" => $data,
            "start" => $start,
            "end" => $end
        ]);
    }


    public function ajukanValidasi($id)
    {
        $header = HeaderBKD::find($id);

        $header->status_bkd = 1;
        $header->divalidasi_oleh = null;
        $header->tanggal_validasi = null;
        $header->tanggal_pengajuan = Carbon::now();
        $header->save();

        return redirect()->back()->with("success", "Berhasil ajukan untuk di validasi!");
    }

    public function validasiBKD($id, Request $request)
    {
        $header = HeaderBKD::find($id);

        $header->status_bkd = 2;
        $header->divalidasi_oleh = Auth::id() ?? 3;
        $header->tanggal_validasi = Carbon::now();
        $header->save();

        return redirect()->back()->with("success", "Berhasil divalidasi!");
    }

    public function rejectBKD($id, Request $request)
    {
        $header = HeaderBKD::find($id);

        $header->status_bkd = 0;
        $header->divalidasi_oleh = Auth::id() ?? 3;
        $header->tanggal_validasi = Carbon::now();
        $header->save();

        return redirect()->back()->with("success", "Status Kembali menjadi Draf!");
    }

    public function pengesahanBKD($id, Request $request)
    {
        $header = HeaderBKD::find($id);

        $header->status_bkd = 3;
        $header->disahkan_oleh = Auth::id() ?? 2;
        $header->tanggal_pengesahan = Carbon::now();
        $header->save();

        return redirect()->back()->with("success", "Anda berhasil mengesahkan SKP! Sekarang bawahan anda dapat melakukan print terhadap formulir RBKD.");
    }

    public function printBKD($id)
    {
        $data = HeaderBKD::find($id);
        $detail = $data->detail;
        return \view("bkd/print", [
            "header" => $data,
            "detail" => $detail,
            "id" => $id
        ]);
    }


    public function generateQR($id)
    {
        $header = HeaderBKD::find($id);
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
