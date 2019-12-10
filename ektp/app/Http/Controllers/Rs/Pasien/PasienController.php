<?php

namespace App\Http\Controllers\Rs\Pasien;

use App\Models\Pasien;
use App\Models\Pengguna;
use App\Models\Setting;
use App\Models\Poli;
use App\Models\Alat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$idalat = Setting::first()->id_alat;
		$alat = Alat::find($idalat);
		$alat->mode = "bpjs";
		$alat->save();
		return view('rs.pasien.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('rs.pasien.create');
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
		return response()->json(['status' => 200, 'hasil' => berhasil]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		$pasien = Pasien::find($id);
		$setting = Setting::first();
		$nomorantrian = $setting->index_antrian_bpjs + 1;
		$setting->index_antrian_bpjs = $nomorantrian;
		$pasien->nomor_antrian = $nomorantrian;
		$pasien->status=1;
		$setting->save();
		$pasien->save();
		
		$data['model'] = $pasien;
		return view('rs.pasien.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function edit(Pasien $pasien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pasien $pasien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pasien $pasien)
    {
        //
    }
	public function loadPasien($id)
	{
		$pasiens = Pasien::where('pengguna_id', '=', $id)->where('status', '=', 0)->get();
		if($pasiens->count() == 1)
		{
			$setting = Setting::first();
			$nomorantrian = $setting->index_antrian_bpjs + 1;
			$setting->index_antrian_bpjs = $nomorantrian;
			$pasien = $pasiens->first();
			$pasien->nomor_antrian = $nomorantrian;
			$pasien->status=1;
			//$pasien->poli = $poli;
			$pasien->save();
			$setting->save();
			$pasien->save();
			
			$data['model'] = $pasien;
			return view('rs.pasien.show', $data);
		}
		else if($pasiens->count() > 1)
		{
			$data['models'] = $pasiens;
			return view('rs.pasien.showoption', $data);
		}
		else
		{
			return redirect()->route('pasien.index')->with(['status' => 'danger', 'message' => 'Kartu Tidak Terdaftar Bpjs']);
		}
	}
	public function notFound()
	{
		return view('rs.pasien.notfound');
	}
	public function showOptions()
	{
		$pasiens = Pasien::where('pengguna_id', '=', $id)->where('status', '=', 0)->get();
		$data['models'] = $pasiens;
		return view('rs.pasien.options', $data);
	}
	public function faskes1Index()
	{
		$idalat = Setting::first()->id_alat;
		$alat = Alat::find($idalat);
		$alat->mode = "faskes1";
		$alat->save();
		$data['polis'] = Poli::all();
		return view('rs.pasien.faskes1.index', $data);
	}
	public function faskes1Show($poli, $id)
	{
		//$pengguna = Pengguna::find($id);
		$pasien = Pasien::where('pengguna_id', '=', $id)->where('status', '=', -1)->orderBy('created_at', 'desc')->first();
		$pasien->poli = $poli;
		$pasien->save();
		$data['model'] = $pasien;
		$data['rekams'] = $pasien = Pasien::where('pengguna_id', '=', $id)->where('diagnosa', 'NOT', 'NULL')->get();
		return view('rs.pasien.faskes1.show', $data);
	}
	public function faskes1Edit()
	{
		$antri = Setting::first()->nomor_antrian;
		//return $antri;
		$data['model'] = Pasien::where('nomor_antrian', '=', $antri)->first();
		//return $data;
		$data['setting'] = Setting::first();
		return view('rs.pasien.faskes1.edit', $data);
	}
	public function faskes1SetAntri(Request $request)
	{
		$antri = $request->antri;
		$setting = Setting::first();
		if($antri > $setting->index_antrian)
		{
			return redirect()->route('pasien.faskes1.formsetantri')->with(['status' => 'danger', 'message' => 'Nomor Antri tidak ditemukan']);
		}
		
		$model = Pasien::where('nomor_antrian', '=', $antri)->first();
		if($model)
		{
			$setting->nomor_antrian = $antri;
			$setting->save();
			$data['model'] = $model;
			return redirect()->route('pasien.faskes1.formsetantri')->with(['status' => 'success', 'message' => 'Nomor Antri Aktif Berhasil Diganti']);
		}
		else
		{
			return redirect()->route('pasien.faskes1.formsetantri')->with(['status' => 'danger', 'message' => 'Nomor Antri tidak ditemukan']);
		}
	}
	public function faskes1Update(Request $request, $id)
	{
		
		
		$pasien = Pasien::find($id);
		
		//return $pasien;
		$pasien->diagnosa = $request->diagnosa;
		$pasien->rs_rujukan = $request->rs_rujukan;
		$pasien->status = 0;
		$pasien->save();
		$setting = Setting::first();
		$pasiennew = Pasien::where('status', '=', -1)->orderBy('nomor_antrian', 'asc')->first();
		//return $pasiennew;
		if($pasiennew)
		{
			//return "im here";
			$setting->nomor_antrian = $pasiennew->nomor_antrian;
			$setting->save();
		}
		return redirect()->route('pasien.faskes1.periksa')->with(['status' => 'success', 'message' => 'Rujukan Berhasil Disimpan']);
	}
	public function faskes1FormSetAntri()
	{
		$setting = Setting::first();
		$noantri = $setting->nomor_antrian;
		$data['setting'] = Setting::first();
		$pasien = Pasien::where('nomor_antrian', '=', $noantri)->first();
		$data['model'] =  $pasien;
		if($pasien)
		{
			$data['model'] = $pasien;
		}
		else
		{
			$newpasien = Pasien::where('status', '=', -1)->first();
			$data['model'] = $newpasien;
			$setting->nomor_antrian = $newpasien->nomor_antrian;
			$setting->save();
		}
		return view('rs.pasien.faskes1.formsetantri', $data);
	}
	public function getAntrian()
	{
		$setting = Setting::first();

		return response()->json(['status' => 200, 'nomor' => Setting::first()->nomor_antrian]);
	}
	
}
