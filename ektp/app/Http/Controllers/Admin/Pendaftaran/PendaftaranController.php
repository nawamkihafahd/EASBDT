<?php

namespace App\Http\Controllers\Admin\Pendaftaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\Alat;
use App\Models\Pendaftaran;
use App\Models\Ruang;

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
        //
    }
	
	public function buka(Request $request)
    {
        //
		
		
		$antri = Pendaftaran::where('alat_id', '=', $request->alat_id)->first();
		$pengguna = Pengguna::find($request->pengguna_id);
		$pengguna->ruangs()->sync($request->hak_akses);
		if($antri)
		{
			return redirect()->route('admin.pendaftaran.antri')->with(['status' => 'danger', 'message' => 'Pendaftaran Gagal Dibuka, Masih Terdapat Antrian']);
			
		}
		$pendaftaran = new Pendaftaran();
		$pendaftaran->tipe = $request->tipe;
		$pendaftaran->pengguna_id = $request->pengguna_id;
		$pendaftaran->alat_id = $request->alat_id;
		$pendaftaran->save();
		return redirect()->route('admin.index')->with(['status' => 'success', 'message' => 'Pendaftaran Terbuka']);
		//
    }
	

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
		$pengguna = Pengguna::where('id_nik', '=', $request->id_nik)->first();
		$data['model'] = $pengguna;
		$data['alats'] = Alat::all();
		$data['rooms'] = Ruang::all();
		//return $regrooms;
		
		if($data['model'])
		{
			return view('admin.pendaftaran.index', $data);
		}
		else
		{
			return redirect()->route('admin.index')->with(['status' => 'danger', 'message' => 'Data Tidak Ditemukan']);
		}
		//return $data['model'];
		
    }
	
	public function showall(Request $request)
	{

	}
	
	public function antri(Request $request)
    {
        //
		$data['models'] = Pendaftaran::all();
		//return $data['model'];
		return view('admin.pendaftaran.antri', $data);
    }
	
	public function tutup($id)
    {
        //
		//return $data['model'];
		$antri = Pendaftaran::find($id);
		$nama = $antri->pengguna->nama;
		if($antri)
		{
			$antri->delete();
			return redirect()->route('admin.index')->with(['status' => 'success', 'message' => 'Pendaftaran '.$nama.' Berhasil Ditutup']);
			
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
		$data['model'] = Pengguna::where('id_nik', '=', $request->id_nik)->first();
		//return $data['model'];
		return view('admin.pendaftaran.edit', $data);
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
    public function destroy(Request $request)
    {
        //
    }
	public function release(Request $request)
    {
        //
		$released = Pengguna::where('id_nik', '=', $request->id_nik);
		if($released)
		{
			$released->uid_kartu = NULL;
			$released->status = 0;
			$released->save;
			return redirect()->route('admin.index')->with(['status' => 'success', 'message' => 'UID Kartu milik '.$antri->nama.' Berhasil Dihapus']);
			
		}
		else
		{
			return redirect()->route('admin.pendaftaran.show')->with(['status' => 'danger', 'message' => 'Data Tidak Ditemukan']);
		}
    }
}
