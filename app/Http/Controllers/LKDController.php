<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LKDController extends Controller
{
	public function addlkd()
	{
		$add_lkd = \App\Models\LKDadd::all();
		return view('lkd.add', ['add_lkd' => $add_lkd]);
	}

	public function create(Request $request)
	{
		\App\Models\LKDadd::create($request->all());
		return redirect('/lkd/add')->with('sukses', 'Data Berhasil di Input !');

		//return $request->all();

	}

	public function edit($No)
	{
		$dosen = \App\Models\LKDadd::find($No);
		return view('lkd/edit', ['dosen' => $dosen]);
	}

	public function update(Request $request, $No)
	{
		$dosen = \App\Models\LKDadd::find($No);
		$dosen->update($request->all());
		return redirect('/lkd/add')->with('sukses', 'Data Berhasil di Update !');
	}

	public function delete($No)
	{
		$dosen = \App\Models\LKDadd::find($No);
		$dosen->delete();
		return redirect('/lkd/add')->with('sukses', 'Data Berhasil di Hapus !');
	}
}
