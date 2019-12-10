<?php

namespace App\Http\Controllers\Api\Pendaftaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengguna;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return response()->json(['status' => '200', 'hasil' => 'berhasil']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
	{
		//return "masuk";
		/*
		$attributes = [
        'nama' => "Nama",
		'id_nik' => "NIK",
		'nrp' => "NRP",
		'nohp' => "Nomor HP",
		'alamat' => "Alamat",
		'email' => "Email",
		'password' => "Password",
		'jenis_kelamin' => "Jenis Kelamin"
		];
		$messages = [
			'required' => ':attribute Wajib Diisi',
			'min' => ':attribute harus diisi minimal :min karakter!',
			'max' => ':attribute Wajib Diisi maximal :max karakter!'
		];
		$rules = [
			'id_nik' => 'required|min:16|max:16',
			'nama' => 'required|max:50',
			'jenis_kelamin' => 'required|max:10',
			'nrp' => "required|min:14|max:14",
			'nohp' => "required",
			'alamat' => "required",
			'email' => "required",
			'password' => "required"
		];
		
		$validator = Validator::make($request->all(), $rules, $messages, $attributes);
		if ($validator->fails()) {
            return response()->json(['status' => '200', 'hasil' => 'gagal']);
        }
		*/
		
		$pengguna = new Pengguna();
		
		//return($request->desa);
		
		$upload['password'] = bcrypt($request->password);
		$upload['status'] = 0;
		$upload['nrp'] = $request->id_nik;
		
		
		if($pengguna->create($request->except('password', 'status', nrp) + $upload))
		{
			return response()->json(['status' => '200', 'hasil' => 'berhasil']);
		}
		return response()->json(['status' => '200', 'hasil' => 'gagal']);
		
		
		
		
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
