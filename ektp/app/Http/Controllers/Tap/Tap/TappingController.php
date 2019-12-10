<?php

namespace App\Http\Controllers\Tap\Tap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\Logs;
use App\Models\Logparkir;
use App\Models\Kartu;
use App\Models\Alat;
use App\Models\Setting;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Transaksi;
use App\Models\Logtransaksi;
use App\Models\Parkir;
use Carbon\Carbon;

class TappingController extends Controller
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
	/*
	public function tapCard($id)
	{
		$pengguna = Pengguna::where('uid_kartu', '=', $id)->first();
		$found = 0;
		$logs = new Logs();
		if($pengguna)
		{
			$logs['hasil'] = 0;
			$logs['uid_kartu'] = $id;
			$logs['nama'] = $pengguna['nama'];
			$logs['tipe_kartu'] = 'detectable';
			$logs['ruangan'] = 'LAB MI';
			$logs->save();
			return response()->json(['hasil' => 'ditemukan', 'data' => $pengguna]);
		}
		else
		{
			$pengguna = Pengguna::where('status', '=', 1)->first();
			if($pengguna)
			{
				$logs['hasil'] = 2;
				$logs['uid_kartu'] = $id;
				$logs['nama'] = $pengguna['nama'];
				$logs['tipe_kartu'] = 'detectable';
				$logs['ruangan'] = 'LAB MI';
				$logs->save();
				$pengguna->status = 2;
				$pengguna->uid_kartu = $id;
				$pengguna->save();
				return response()->json(['hasil' => 'pendaftaran berhasil', 'data' => $pengguna]);
			}
			else
			{
				
				$logs['hasil'] = 0;
				$logs['uid_kartu'] = $id;
				$logs['nama'] = 'Tak Dikenal';
				$logs['tipe_kartu'] = 'detectable';
				$logs['ruangan'] = 'LAB MI';
				$logs->save();
				return response()->json(['hasil' => 'tak dikenal', 'data' => $pengguna]);
			}
		}
		
	}
	public function tapCardPost(Request $request)
	{
		$id = $request->uid;
		$pengguna = Pengguna::where('uid_kartu', '=', $id)->first();
		$found = 0;
		if($pengguna)
		{
			return response()->json(['hasil' => 'ditemukan', 'data' => $pengguna]);
		}
		else
		{
			$pengguna = Pengguna::where('status', '=', 1)->first();
			if($pengguna)
			{
				$pengguna->status = 2;
				$pengguna->uid_kartu = $id;
				$pengguna->save();
				return response()->json(['hasil' => 'pendaftaran berhasil', 'data' => $pengguna]);
			}
			else
			{
				return response()->json(['hasil' => 'tak dikenal', 'data' => $pengguna]);
			}
		}
		
	}
	*/
	public function tapCardMulti($id, $uid)
	{
		$kartu = Kartu::where('uid', '=', $uid)->first();
		$found = 0;
		$logs = new Logs();
		if($kartu && $kartu->pengguna->active==1)
		{
			$alat = Alat::find($id);
			$mode = $alat->mode;
			$logs['hasil'] = 1;
			$logs['uid_kartu'] = $uid;
			$logs['nama'] = $kartu->pengguna->name;
			$logs['tipe_kartu'] = $kartu->tipe;
			$logs['ruangan'] = $alat->ruang->nama;
			$logs['mode'] = $alat->mode;
			$roomid =$alat->ruang->id;
			$found = 0;
			foreach($kartu->pengguna->ruangs as $ruang)
			{
				if($ruang->id == $roomid)
				{
					$found = 1;
				}
			}
			if($found == 1)
			{
				$logs['hasil'] = 1;
				
				if($mode == "gembok" || $mode == "absensi" || $mode == "bpjs" || $mode == "faskes1" || $mode=="checkin")
				{
					$logs->save();
					return response()->json(['hasil' => 'ditemukan', 'data' => $kartu->pengguna, 'mode' => $mode, 'log' => $logs->id, 'uid' => $uid]);
				}
				else if($mode == "parkir")
				{
					$existparkir = Logs::where('ruangan', '=', $alat->ruang->nama)->where('nama','=',$kartu->pengguna->name)->where('hasil', '=', 1)->where('mode', '=', 'parkir')->get();
					//return $existparkir;
					if($existparkir->count() == 0)
					{
						$logs->save();
						$parkir=Parkir::where('alat_id','=',$id)->first();
						$parkir->kapasitas = $parkir->kapasitas -1;
						$parkir->save();
						return response()->json(['hasil' => 'ditemukan', 'data' => $kartu->pengguna, 'mode' => $mode, 'log' => $logs->id, 'uid' => $uid, 'tipe' => 'masuk']);
					}
					else
					{
						$parkiraktif = $existparkir->first();
						//return $parkiraktif;
						$parkiraktif->hasil=5;
						$parkiraktif->save();
						//return $parkiraktif;
						$hours = $parkiraktif->created_at->diffInHours($parkiraktif->updated_at);
						$cost = $hours-2;
						$parkir = Parkir::where('alat_id','=',$id)->first();
						$parkir->kapasitas = $parkir->kapasitas +1;
						$parkir->save();
						if($cost > 2)
						{
							$cost = $parkir->harga_dasar + $parkir->harga_tambahan*$cost;
						}
						else 
						{
							$cost = $parkir->harga_dasar;
						}
						return response()->json(['hasil' => 'ditemukan', 'data' => $kartu->pengguna, 'mode' => $mode, 'cost' => $cost, 'nohp' => $kartu->pengguna->nohp, 'tipe' => 'keluar']);
					}
				}
				else if($mode == "transaksi")
				{
					$logs->save();
					$transaction = Transaksi::where('alat_id', '=', $id)->first();
					if($transaction)
					{
						$transaction->uid = $uid;
					}
					else
					{
						$transaction = new Transaksi();
						$transaction->alat_id = $id;
						$transaction->uid = $uid;
					}
					$transaction->log_id = $logs->id;
					$transaction->save();
					return response()->json(['hasil' => 'ditemukan', 'data' => $kartu->pengguna, 'mode' => $mode, 'log' => $logs->id, 'uid' => $uid]);
				}
				
				
				
			}
			else
			{
				$logs['hasil'] = 0;
				$logs->save();
				return response()->json(['hasil' => 'tak dikenal', 'data' => $kartu, 'log' => $logs->id]);
			}
			
		}
		else
		{
			$pendaftaran = Pendaftaran::where('alat_id', '=', $id)->first();
			if($pendaftaran)
			{
				$kartus = (Pengguna::find($pendaftaran->pengguna->id))->kartus;
				$kartu = new Kartu();
				foreach($kartus as $card)
				{
					if($card->tipe == $pendaftaran->tipe)
					{
						$found = 1;
						$card->uid = $uid;
						$card->save();
						$kartu = $card;
						break;
					}
				}
				if($found == 0)
				{
					
					$kartu->pengguna_id = $pendaftaran->pengguna->id;
					$kartu->uid = $uid;
					$kartu->tipe = $pendaftaran->tipe;
					$kartu->save();
				}
				$logs['hasil'] = 2;
				$logs['uid_kartu'] = $uid;
				$logs['nama'] = $kartu->pengguna->name;
				$logs['tipe_kartu'] = $kartu->tipe;;
				$logs['ruangan'] = Alat::find($id)->ruang->nama;
				$logs->save();
				$pendaftaran->delete();
				return response()->json(['hasil' => 'pendaftaran berhasil', 'data' => $kartu->pengguna, 'log' => $logs->id, 'uid' => $uid]);
			}
			else
			{
				
				$logs['hasil'] = 0;
				$logs['uid_kartu'] = $uid;
				$logs['nama'] = 'Tak Dikenal';
				$logs['tipe_kartu'] = 'Tak Diketahui';
				$logs['ruangan'] = Alat::find($id)->ruang->nama;;
				$logs->save();
				return response()->json(['hasil' => 'tak dikenal', 'data' => $kartu, 'log' => $logs->id, 'uid' => $uid]);
			}
		}
		
	}
	
	public function tapCardMultiPost(Request $request)
	{
		$id = $request->id;
		$uid = $request->uid;
		$kartu = Kartu::where('uid', '=', $uid)->first();
		$found = 0;
		$logs = new Logs();
		if($kartu)
		{
			$alat = Alat::find($id);
			$mode = $alat->mode;
			$logs['hasil'] = 1;
			$logs['uid_kartu'] = $uid;
			$logs['nama'] = $kartu->pengguna->name;
			$logs['tipe_kartu'] = $kartu->tipe;
			$logs['ruangan'] = $alat->ruang->nama;
			$logs['mode'] = $alat->mode;
			$roomid =$alat->ruang->id;
			$found = 0;
			foreach($kartu->pengguna->ruangs as $ruang)
			{
				if($ruang->id == $roomid)
				{
					$found = 1;
				}
			}
			if($found == 1)
			{
				$logs['hasil'] = 1;
				$logs->save();
				if($mode == "gembok" || $mode == "absensi" || $mode == "bpjs" || $mode == "faskes1" || $mode=="checkin")
				{
					return response()->json(['hasil' => 'ditemukan', 'data' => $kartu->pengguna, 'mode' => $mode, 'log' => $logs->id, 'uid' => $uid]);
				}
				else if($mode == "transaksi")
				{
					$transaction = Transaksi::where('alat_id', '=', $id)->first();
					if($transaction)
					{
						$transaction->uid = $uid;
					}
					else
					{
						$transaction = new Transaksi();
						$transaction->alat_id = $id;
						$transaction->uid = $uid;
					}
					$transaction->save();
					return response()->json(['hasil' => 'ditemukan', 'data' => $kartu->pengguna, 'mode' => $mode, 'log' => $logs->id, 'uid' => $uid]);
				}
				
				
				
			}
			else
			{
				$logs['hasil'] = 0;
				$logs->save();
				return response()->json(['hasil' => 'tak dikenal', 'data' => $kartu, 'log' => $logs->id]);
			}
			
		}
		else
		{
			$pendaftaran = Pendaftaran::where('alat_id', '=', $id)->first();
			if($pendaftaran)
			{
				$kartus = (Pengguna::find($pendaftaran->pengguna->id))->kartus;
				$kartu = new Kartu();
				foreach($kartus as $card)
				{
					if($card->tipe == $pendaftaran->tipe)
					{
						$found = 1;
						$card->uid = $uid;
						$card->save();
						$kartu = $card;
						break;
					}
				}
				if($found == 0)
				{
					
					$kartu->pengguna_id = $pendaftaran->pengguna->id;
					$kartu->uid = $uid;
					$kartu->tipe = $pendaftaran->tipe;
					$kartu->save();
				}
				$logs['hasil'] = 2;
				$logs['uid_kartu'] = $uid;
				$logs['nama'] = $kartu->pengguna->name;
				$logs['tipe_kartu'] = $kartu->tipe;;
				$logs['ruangan'] = Alat::find($id)->ruang->nama;
				$logs->save();
				$pendaftaran->delete();
				return response()->json(['hasil' => 'pendaftaran berhasil', 'data' => $kartu->pengguna, 'log' => $logs->id, 'uid' => $uid]);
			}
			else
			{
				
				$logs['hasil'] = 0;
				$logs['uid_kartu'] = $uid;
				$logs['nama'] = 'Tak Dikenal';
				$logs['tipe_kartu'] = 'Tak Diketahui';
				$logs['ruangan'] = Alat::find($id)->ruang->nama;;
				$logs->save();
				return response()->json(['hasil' => 'tak dikenal', 'data' => $kartu, 'log' => $logs->id, 'uid' => $uid]);
			}
		}
		
		
	}
	
	public function showLogs()
	{
		$data['models'] = Logs::where('mode', 'not', 'parkir')->orderBy('created_at', 'desc')->get();
		return view('admin.logs.index', $data);
	}
	public function showAllLogsApi()
	{
		$data['models'] = Logs::latest()->get();
		return response()->json(['hasil' => 'success', 'data' => $data['models']]);
	}
	public function showLogApi(Request $request)
	{
		$uid = $request->uid;
		$kartu = Kartu::where('uid', '=', '$uid')->get();
		$data['models'] = Logs::where('id_nik', '=', $kartu->pengguna->nama)->latest()->get();
		return response()->json(['hasil' => 'success', 'data' => $data['models']]);
	}
	public function sendImages(Request $request)
	{
		//store file
		//return response()->json(['hasil' => $request->uid]);
		$uid = $request->uid;
		$alat = Alat::find($request->id);
		$id = $request->id;
		$kartu = Kartu::where('uid', '=', $uid)->first();
		$mode=$alat->mode;
		$found = 0;
		$img = $request->file('img');
		$str2 = (string)Carbon::now();
		$str1 = (string)($kartu->pengguna->id);
		$str = 'logs/photos/'.$str1;
		$path = $img->store($str);
		$log = Logs::find($request->logid);
		$log->url_gambar = $path;
		$log->id_nik = $kartu->pengguna->id_nik;
		$status = $request->status;
		
		if($kartu->pengguna->active == 0)
		{
			$log->hasil = 1;
			$log->save();
			return response()->json(['hasil' => '0', 'mode' => $mode, 'log' => $log->id, 'string' => 'mismatch']);
		}
		
		if($status == 'ACCEPTED')
		{
			if($mode=='bpjs')
			{
				$transaction = Transaksi::where('alat_id', '=', $id)->first();
				if($transaction)
				{
					$transaction->uid = $uid;
				}
				else
				{
					$transaction = new Transaksi();
					$transaction->alat_id = $id;
					$transaction->uid = $uid;
				}
				$idpengguna = $kartu->pengguna->id;
				$pasiens = Pasien::where('pengguna_id', '=', $idpengguna)->where('status', '=', 0)->get();
				$bpjs = $kartu->pengguna->bpjs->first();
				if($bpjs)
				{
					$nothing = 0;
				}
				else
				{
					$log->hasil = 4;
					$log->save();
					return response()->json(['hasil' => '0', 'string' => 'Tidak Terdaftar BPJS', 'mode' => $mode, 'log' => $log->id]);
				}
					
				//return response()->json(['hasil' => 'ditemukan', 'data' => $bpjs->batas_pembayaran, 'mode' => $mode]);
				$status = 0;
				//$time = Carbon::now();
				//return response()->json(['hasil' => 'ditemukan', 'data' => ($bpjs->batas_pembayaran > Carbon::now()), 'mode' => $mode]);
				if(($bpjs->batas_pembayaran > Carbon::now()))
				{
					$status =1 ;
				}
				else
				{
					$now = Carbon::now();
					$diff = $now->diffinDays($bpjs->batas_pembayaran);	
					//return response()->json(['hasil' => 'ditemukan', 'bpjs' => $diff, 'mode' => $mode]);
					if($diff < 30)
					{
						$status =1 ;
					}
				}
				if($status == 1)
				{
					if($pasiens->count() >= 1)
					{
						$log->hasil = 3;
						$log->save();
						$transaction->save();
						return response()->json(['hasil' => '1', 'string' => 'BPJS Diaktifkan', 'mode' => $mode, 'log' => $log->id]);
					}
					else
					{
						$log->hasil = 4;
						$log->save();
						return response()->json(['hasil' => '0', 'string' => 'Rujukan Tak Ditemukan', 'mode' => $mode, 'log' => $log->id]);
					}
				}
				else
				{
					$log->hasil = 4;
					$log->save();
					return response()->json(['hasil' => '0', 'bpjs' => 'BPJS Belum Dibayar', 'mode' => $mode, 'log' => $log->id]);
				}
			}
			else if($mode=='faskes1')
			{
				$transaction = Transaksi::where('alat_id', '=', $id)->first();
				if($transaction)
				{
					$transaction->uid = $uid;
				}
				else
				{
					$transaction = new Transaksi();
					$transaction->alat_id = $id;
					$transaction->uid = $uid;
				}
				$idpengguna = $kartu->pengguna->id;
				
				
				
				$bpjs = $kartu->pengguna->bpjs->first();
				//return response()->json(['hasil' => 'ditemukan', 'data' => $bpjs->batas_pembayaran, 'mode' => $mode]);
				$status = 0;
				//$time = Carbon::now();
				//return response()->json(['hasil' => 'ditemukan', 'data' => ($bpjs->batas_pembayaran > Carbon::now()), 'mode' => $mode]);
				if(($bpjs->batas_pembayaran > Carbon::now()))
				{
					$status =1 ;
				}
				else
				{
					$now = Carbon::now();
					$diff = $now->diffinDays($bpjs->batas_pembayaran);	
					//return response()->json(['hasil' => 'ditemukan', 'bpjs' => $diff, 'mode' => $mode]);
					if($diff < 30)
					{
						$status =1 ;
					}
				}
				if($status == 1)
				{
					$pasien = new Pasien();
					$pasien->faskes_tingkat1 = "Faskes 1";
					$pasien->pengguna_id = $idpengguna;
					
					$setting = Setting::first();
					$pasien->rs_perujuk = $setting->rs_nama;
					$pasien->faskes_tingkat1 = $setting->rs_nama;
					$noantri = $setting->index_antrian;
					$setting->index_antrian = $noantri + 1;
					$pasien->nomor_antrian = $noantri + 1;
					$pasien->status = -1;
					$setting->save();
					$pasien->save();
					$transaction->save();
					$log->hasil = 3;
					$log->save();
					return response()->json(['hasil' => '1', 'string' => 'Pendaftaran Bpjs Berhasil', 'mode' => $mode, 'log' => $log->id, 'antri' => $pasien->nomor_antrian]);
				}
				else
				{
					$log->hasil = 4;
					$log->save();
					return response()->json(['hasil' => '0', 'string' => 'BPJS Belum Dibayar', 'mode' => $mode, 'log' => $log->id]);
					//return response()->json(['hasil' => 'ditemukan', 'bpjs' => 'BPJS Belum Dibayar', 'mode' => $mode, 'log' => $log->id]);
				}
			}
			else if($mode == "checkin")
			{
				$pengguna = $kartu->pengguna;
				$tikets = $pengguna->tikets;
				if($tikets->count()>0)
				{
					foreach($tikets as $tiket)
					{
						$date = Carbon::parse($tiket->tanggal_berangkat);
						
						if(Carbon::now() <= $date)
						{
							
							if(Carbon::now()->diffinDays($tiket->tanggal_berangakat) == 0)
							{
								//return response()->json(['hasil' => $date,'checkin' => Carbon::now(), 'string' => $tiket->tanggal_berangkat, 'mode' => $mode, 'log' => $log->id, 'uid' => $uid]);
								if($tiket->pivot->check_in == 0)
								{
									//return response()->json(['hasil' => '1','checkin' => $tiket->pivot->check_in, 'string' => 'Check In Berhasil', 'mode' => $mode, 'log' => $log->id, 'uid' => $uid]);
									$tiket->pivot->check_in = 1;
									$tiket->pivot->save();
									$log->hasil = 3;
									$log->ruangan = $tiket->asal->nama.' - '.$tiket->tujuan->nama;
									$log->save();
									return response()->json(['hasil' => '1','checkin' => $tiket->pivot->check_in, 'string' => 'Check In Berhasil', 'mode' => $mode, 'log' => $log->id, 'uid' => $uid]);
								}
							}
						}
					}
					$log->hasil = 4;
					$log->save();
					return response()->json(['hasil' => '0', 'string' => 'Tiket Tidak Ditemukan', 'mode' => $mode, 'log' => $log->id, 'uid' => $uid]);
				}
				else
				{
					$log->hasil = 4;
					$log->save();
					return response()->json(['hasil' => '0', 'string' => 'Tiket Tidak Ditemukan', 'mode' => $mode, 'log' => $log->id, 'uid' => $uid]);
				}
			}
			else if($mode=='gembok')
			{
				$log->hasil = 3;
				$log->save();
				return response()->json(['hasil' => '1', 'string' => 'sukses', 'mode' => $mode, 'log' => $log->id]);
			}
			else if($mode=='absensi')
			{
				$log->hasil = 3;
				$log->save();
				return response()->json(['hasil' => '1', 'string' => 'Absensi Berhasil', 'mode' => $mode, 'log' => $log->id]);
			}
						
		}
		else
		{
			$log->hasil = 1;
			$log->save();
			return response()->json(['hasil' => '0', 'mode' => $mode, 'log' => $log->id, 'string' => 'mismatch']);
		}
				
	}
	public function testurl()
	{
		return asset('storage/logs/photos/4');
	}
	public function getMode(Request $request)
	{
		$alat = Alat::find($request->id);
		if($alat->mode == "parkir")
		{
			$parkir = Parkir::where('alat_id', '=', $request->id)->first();
			return response()->json(['hasil' => '1', 'mode' => $alat->mode, 'kapasitas' => $parkir->kapasitas]);
		}
		else
		{
			return response()->json(['hasil' => '1', 'mode' => $alat->mode]);
		}
		
	}
	public function submitTransaction(Request $request)
	{
		$log_id = $request->log_id;
		$nominal = $request->nominal;
		$usaha_id = $request->usaha_id;
		$logtransaksi = new Logtransaksi();
		$logtransaksi->log_id = $log_id;
		$logtransaksi->nominal = $nominal;
		$logtransaksi->usaha_id = $usaha_id;
		$logtransaksi->save();
		return response()->json(['hasil' => '1', 'text' => 'saved']);
		
	}
}
