<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BkdController extends Controller
{
	public function index()
	{
		$data_identitas = \App\Models\IdentitasBKD::all();
		return view('bkd.index', ['data_identitas' => $data_identitas]);
	}

	public function bidpend()
	{
		$data_rbkd = \App\Models\BKDPendidikan::all();
		return view('bkd.pendidikan', ['data_rbkd' => $data_rbkd]);
	}

	public function create(Request $request)
	{
		\App\Models\BKDPendidikan::create($request->all());
		return redirect('/bkd/pendidikan')->with('sukses', 'Data Berhasil di Input !');

		//return $request->all();

	}

	public function edit($id)
	{
		$dosen = \App\Models\BKDPendidikan::find($id);
		return view('bkd/edit', ['dosen' => $dosen]);
	}

	public function update(Request $request, $id)
	{
		$dosen = \App\Models\BKDPendidikan::find($id);
		$dosen->update($request->all());
		return redirect('/bkd/pendidikan')->with('sukses', 'Data Berhasil di Update !');
	}

	public function delete($id)
	{
		$dosen = \App\Models\BKDPendidikan::find($id);
		$dosen->delete();
		return redirect('/bkd/pendidikan')->with('sukses', 'Data Berhasil di Hapus !');
	}

	public function addHeaderForm()
	{
		$nama = Auth::user()->nama ?? "Dr.Drs.Muhammad Zein,M.Pd";
		$departemen = Auth::user()->biro ?? "Tarbiyah & Ilmu Keguruan";
		$start = date("Y") . "-01-01";
		$end   = date("Y") . "-12-31";
		return \view("bkd/add", [
			"nama" => $nama,
			"departemen" => $departemen,
			"start" => $start,
			"end" => $end
		]);
	}
}
