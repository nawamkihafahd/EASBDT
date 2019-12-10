<?php

namespace App\Http\Controllers\Website\Tiket;

use App\Models\Tiket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\Pengguna;
use App\Models\Kelaskereta;
use Illuminate\Support\Facades\DB;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$data['models'] = Kota::all();
		return view('tiket.index', $data);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function show(Tiket $tiket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $kelas)
    {
        //
		$tiket = Tiket::find($id);
		$data['model'] = $tiket;
		$nominal = 0;
		$kel = "";
		foreach($tiket->kelas as $kela)
		{
			if($kela->id == $kelas)
			{
				$kel = $kela->nama;
				$nominal = $kela->pivot->nominal;
			}
		}
		$data['nominal'] = $nominal;
		$data['kelas'] =  $kel;
		$data['kelas_id'] =  $kelas;
		//return $data;
		return view('tiket.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
		$pengguna = Pengguna::where('id_nik', '=', $request->id_nik)->first();
		$tiket = Tiket::find($request->tiket_id);
		$kelas = Kelaskereta::find($request->kelas_id);
		$nomor = 12;
		DB::table('pengguna_tiket')->insert([
			['pengguna_id' => $pengguna->id, 'tiket_id' => $request->tiket_id, 'kelaskereta_id' => $request->kelas_id, 'nomor_kursi'  => $nomor]
		]);
		return redirect()->route('tiket.index')->with(['status' => 'success', 'message' => 'Tiket Berhasil Dibeli']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tiket $tiket)
    {
        //
    }
	public function listTiket(Request $request)
	{
		$start = $request->kota_asal;
		$end = $request->kota_tujuan;
		$tanggal = $request->tanggal_berangkat;
		
		$tikets = Tiket::where('kota_asal', '=', $start)->where('kota_tujuan', '=', $end)->whereDate('tanggal_berangkat', '=', $tanggal)->get();
		$data['models'] = $tikets;
		if($tikets->count()>0)
		{
			return view('tiket.list', $data);
		}
		else
		{
		}
		return redirect()->route('tiket.index')->with(['status' => 'danger', 'message' => 'Tidak Ada Tiket Tersedia']);
	}
}
