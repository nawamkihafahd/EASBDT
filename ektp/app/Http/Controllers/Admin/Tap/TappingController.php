<?php

namespace App\Http\Controllers\Admin\Tap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\Logs;

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
	
	public function tapCard($id)
	{
		$pengguna = Pengguna::where('uid_kartu', '=', $id)->first();
		$found = 0;
		$logs = new Logs();
		if($pengguna)
		{
			$logs = new Logs();
			$logdata['hasil'] = 1;
			$logdata['uid_kartu'] = $id;
			$logs->create($logdata->all());
			return response()->json(['hasil' => 'ditemukan', 'data' => $pengguna]);
		}
		else
		{
			$pengguna = Pengguna::where('status', '=', 1)->first();
			if($pengguna)
			{
				$logdata['hasil'] = 2;
				$logdata['uid_kartu'] = $id;
				$logs->create($logdata->all());
				$pengguna->status = 2;
				$pengguna->uid_kartu = $id;
				$pengguna->save();
				return response()->json(['hasil' => 'pendaftaran berhasil', 'data' => $pengguna]);
			}
			else
			{
				$logdata['hasil'] = 0;
				$logdata['uid_kartu'] = $id;
				$logs->create($logdata->all());
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
	
	public function showLogs()
	{
		$data['models'] = Logs::latest()->get();
		return view('admin.logs.index', $data);
	}
}
