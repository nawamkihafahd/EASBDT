<?php

namespace App\Http\Controllers\Admin\Alat;

use App\Models\Alat;
use App\Models\Ruang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	
	protected $alat;
	
	public function __construct()
    {
        $this->alat = new Alat();
    }
	 
    public function index()
    {
        //
		$data['models'] = Alat::all();
		return view('admin.alat.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$data['ruangs'] = Ruang::all();
		return view('admin.alat.create', $data);
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
		$request->validate([
            'nama' => 'required|max:50',
			'ruang_id' => 'required',
        ]);
		if($this->alat->create($request->all())){
			return redirect()->route('admin.alat.index')->with(['status' => 'success', 'message' => 'Saved Successfully']);
		}
		return redirect()->route('admin.alat.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alat  $alat
     * @return \Illuminate\Http\Response
     */
    public function show(Alat $alat)
    {
        //
		$data['model'] = $alat;
		$data['ruangs'] = Ruang::all();
		return view('admin.alat.show', $data);
    }
	
	public function updateMode(Request $request)
	{
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alat  $alat
     * @return \Illuminate\Http\Response
     */
    public function edit(Alat $alat)
    {
        //
		$data['model'] = $alat;
		$data['ruangs'] = Ruang::all();
		return view('admin.alat.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alat  $alat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alat $alat)
    {
        //
		$request->validate([
            'nama' => 'required|max:50',
			'ruang_id' => 'required',
			'mode' => 'required'
        ]);
		if ($alat->update($request->all())) {
			return redirect()->route('admin.alat.index')->with(['status' => 'success', 'message' => 'Updated Successfully']);
		}
		return redirect()->route('admin.alat.edit', $alat->id)->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alat  $alat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alat $alat)
    {
        //
		if ($alat->delete()) {
            return redirect()->route('admin.alat.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
    }
}
