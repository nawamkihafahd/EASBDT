<?php

namespace App\Http\Controllers\Admin\Pengguna;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenggunaController extends Controller
{
    protected $pengguna;

    public function __construct()
    {
        $this->pengguna = new Pengguna();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['penggunas'] = Pengguna::latest()->get();
		return view('pengguna.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $messages = [
			'required' => ':atrribute Wajib Diisi',
			'min' => ':attribute harus diisi minimal :min karakter!',
			'max' => ':attribute Wajib Diisi maximal :max karakter!'
		];
        //
		$this->validate($request,[
			'id_nik' => 'required|min:16|max:16',
			'nama' => 'required',
			'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
			'rt_rw' => 'required',
			'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
			'desa' => 'required',
			'agama' => 'required',
            'status_perkawinan' => 'required',
            'pekerjaan' => 'required',
			'kewarganegaraan' => 'required',
            'gol_darah' => 'required',
            'password' => 'required',
            'foto_ktp' => 'required',
			'foto_bersamaktp' => 'required'
        ], $messages);

        $newpass = bcrypt($request->pasword);
        
        return redirect()->route('pengguna.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function show(Pengguna $pengguna)
    {
        //
        return view('pengguna.show', ['model' => $pengguna]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengguna $pengguna)
    {
        //
        return view('pengguna.edit', ['model' => $pengguna]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengguna $pengguna)
    {
        //
        $messages = [
			'required' => ':atrribute Wajib Diisi',
			'min' => ':attribute harus diisi minimal :min karakter!',
			'max' => ':attribute Wajib Diisi maximal :max karakter!'
		];
        //
		$this->validate($request,[
			'id_nik' => 'required|min:16|max:16',
			'nama' => 'required',
			'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
			'rt_rw' => 'required',
			'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
			'desa' => 'required',
			'agama' => 'required',
            'status_perkawinan' => 'required',
            'pekerjaan' => 'required',
			'kewarganegaraan' => 'required',
            'gol_darah' => 'required',
            'password' => 'required',
            'foto_ktp' => 'required',
			'foto_bersamaktp' => 'required'
        ], $messages);

        $newpass = bcrypt($request->pasword);
        
        return redirect()->route('pengguna.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengguna $pengguna)
    {
        //
        $pengguna->delete();
		return redirect()->route('pengguna.index');
    }
}
