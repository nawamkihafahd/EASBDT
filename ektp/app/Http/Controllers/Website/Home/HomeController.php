<?php

namespace App\Http\Controllers\Website\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengguna;
//use App\Models\Provinsi;
//use App\Models\Desa;
//use App\Models\Kecamatan;
//use App\Models\Kota;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
class HomeController extends Controller
{
    //
	
	protected $pengguna;
	
	public function __construct()
	{
		$this->pengguna = new Pengguna();
	}
	
	public function index()
    {
        //
		return view('website.home.index');
    }
	public function daftar()
    {
        //
		return view('website.home.daftar');
    }
	public function about()
    {
        //
		return view('website.home.about');
    }
	public function tatacara()
    {
        //
		return view('website.home.tatacara');
    }
	
	public function store(Request $request)
	{
		//return "masuk";
		$attributes = [
        'name' => "Nama",
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
			'name' => 'required|max:50',
			'jenis_kelamin' => 'required|max:10',
			'nrp' => "required|min:14|max:14",
			'nohp' => "required",
			'alamat' => "required",
			'email' => "required",
			'password' => "required"
		];
		$client = new Client();
		$result = $client->post('etc.if.its.ac.id/api/gotap/register',
		['form_params' => 
			['uid' => 'lol', 
			'password' => $request->password, 
			'telp' => $request->nohp, 
			'email' => $request->email, 
			'name' => $request->name, 
			'idUser' => $request->id_nik]]);
		$validator = Validator::make($request->all(), $rules, $messages, $attributes);
		if ($validator->fails()) {
            return redirect()->route('landing.daftar')
                        ->withErrors($validator)
                        ->withInput();
        }
		
		
		
		//return($request->desa);
		
		$upload['password'] = bcrypt($request->password);
		$upload['status'] = 0;
		$upload['nrp'] = $request->id_nik;
		
		
		if($this->pengguna->create($request->except('password', 'status', 'nrp') + $upload))
		{
			return redirect()->route('landing.index')->with(['status' => 'success', 'message' => 'Pendaftaran Biodata Berhasil']);
		}
		return redirect()->route('landing.daftar')->with(['status' => 'danger', 'message' => 'Pendaftaran Biodata Gagal, cek lagi NRP dan NIK']);
		
		
		
		
	}
	/*
	public function getCities(Request $request)
	{
		$cities = Kota::where('id_provinsi', $request->id)->get();
		if($cities)
		{
			return response()->json(['success' => true, 'data' => $cities]);
		}
		return response()->json(['success' => false]);
	}
	public function getDistricts(Request $request)
	{
		$districts = Kecamatan::where('id_kota', $request->id)->get();
		if($districts)
		{
			return response()->json(['success' => true, 'data' => $districts]);
		}
		return response()->json(['success' => false]);
	}
	public function getSubDistricts(Request $request)
	{
		$subDistricts = Desa::where('id_kecamatan', $request->id)->get();
		if($subDistricts)
		{
			return response()->json(['success' => true, 'data' => $subDistricts]);
		}
		return response()->json(['success' => false]);
	}
	*/
	
}
