<?php

namespace App\Http\Controllers\Admin\Ruang;

use App\Models\Ruang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	protected $ruang; 
	
	public function __construct()
    {
        $this->ruang = new Ruang();
    }
	
    public function index()
    {
        //
		$data['models'] = Ruang::all();
		return view('admin.ruang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('admin.ruang.create');
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
            'nama' => 'required|max:50'
        ]);
		if($this->ruang->create($request->all())){
			return redirect()->route('admin.ruang.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
		}
		return redirect()->route('admin.ruang.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function show(Ruang $ruang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruang $ruang)
    {
        //
		$data['model'] = $ruang;
		return view('admin.ruang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruang $ruang)
    {
        //
		$request->validate([
            'nama' => 'required|max:50'
        ]);
		if ($ruang->update($request->all())) {
			return redirect()->route('admin.ruang.index')->with(['status' => 'success', 'message' => 'Updated Successfully']);
		}
		return redirect()->route('admin.ruang.edit', $ruang->id)->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruang $ruang)
    {
        //
		if ($ruang->delete()) {
            return redirect()->route('admin.ruang.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
    }
}
