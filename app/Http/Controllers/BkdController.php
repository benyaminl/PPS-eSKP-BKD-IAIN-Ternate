<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BkdController extends Controller
{
    public function index()
    {
    	$data_identitas = \App\Models\IdentitasBKD::all();
    	return view('bkd.index',['data_identitas' => $data_identitas]);
    }

     public function bidpend()
    {
    	$data_rbkd = \App\Models\BKDPendidikan::all();
    	return view('bkd.pendidikan',['data_rbkd' => $data_rbkd]);
    }

	public function create(Request $request)
	 {
	 		\App\Models\BKDPendidikan::create($request->all());
	 		return redirect('/bkd/pendidikan')->with('sukses','Data Berhasil di Input !');

	 		//return $request->all();

	 }

	 public function edit($No)
	 {
	 		$dosen = \App\Models\BKDPendidikan::find($No);
	 		return view('bkd/edit',['dosen' => $dosen]);

	 }
     
     public function update(Request $request,$No)
	 {
	 		$dosen = \App\Models\BKDPendidikan::find($No);
	 		$dosen->update($request->all());
	 		return redirect('/bkd/pendidikan')->with('sukses','Data Berhasil di Update !');

	 }

	 public function delete($No)
	 {
	 	$dosen = \App\Models\BKDPendidikan::find($No);
	 	$dosen->delete();
	 	return redirect('/bkd/pendidikan')->with('sukses','Data Berhasil di Hapus !');
	 }


}
