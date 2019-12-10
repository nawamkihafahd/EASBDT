<?php

namespace App\Http\Controllers\Logs\Logs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\Logs;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view('logs.content.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function parking()
    {
        //
		$data['models'] = Logs::where('mode', '=', 'parkir')->orderBy('created_at', 'desc')->get();
		return view('logs.content.parking', $data);
    }
	public function ticket()
    {
        //
		$data['models'] = Logs::where('mode', '=', 'checkin')->orderBy('created_at', 'desc')->get();
		return view('logs.content.ticket', $data);
    }
	public function bpjs()
    {
        //
		$data['models'] = Logs::where('mode', '=', 'bpjs')->orWhere('mode', '=', 'faskes1')->orderBy('created_at', 'desc')->get();
		//return $data;
		return view('logs.content.bpjs', $data);
    }
	public function presence()
	{
		$data['models'] = Logs::where('mode', '=', 'absensi')->orderBy('created_at', 'desc')->get();
		
		return view('logs.content.presence', $data);
	}
	public function paymentindex()
    {
        //
		
		return view('logs.content.paymentindex');
    }
	public function paymentusaha()
    {
        //
		
		return view('logs.content.paymentusaha');
    }
	public function search()
	{
		return view('logs.content.search');
	}
	public function find(Request $request)
	{
		$nama = $request->nama;
		$data['models'] = Pengguna::where('id_nik', 'LIKE', '%'.$nama.'%')->orWhere('name', 'LIKE', '%'.$nama.'%')->get();
		return view('logs.content.find', $data);
	}
	
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
		$data['pengguna'] = Pengguna::find($id);
		$data['models'] = Logs::where('id_nik', '=', $data['pengguna']->id_nik)->where('mode', '!=', 'gembok')->orderBy('created_at', 'desc')->get();
		return view('logs.content.show', $data);
    }
	
	public function block($id)
	{
		$pengguna = Pengguna::find($id);
		$pengguna->active = 0;
		$pengguna->save();
		return redirect()->route('logs.show', $id);
	}
	public function unblock($id)
	{
		$pengguna = Pengguna::find($id);
		$pengguna->active = 1;
		$pengguna->save();
		return redirect()->route('logs.show', $id);
	}
	public function merchant()
	{
	}
	public function paymentall()
	{
		$data['models'] = Logs::where('mode', '=', 'transaksi')->get();
		return view('logs.content.paymentall', $data);
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
