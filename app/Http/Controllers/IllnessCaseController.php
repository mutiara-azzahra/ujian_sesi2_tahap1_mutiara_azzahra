<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IllnessCaseController extends Controller
{    
    public function index()
    {
        $illness_case = illnessCase::latest()->paginate(5);
        
        return view('illness-case.index',compact('illness_case'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $rusun = Rusun::all();

        return view('illness-case.create', compact('illness_case'));
    }

    public function store(Request $request)
    {
        $request -> validate([
            'diagnosa'              => 'required',
            'keterangan_penyakit'   => 'required',
        ]);

        illnessCase::create($request->all());
        
        return redirect()->route('illness-case.index')->with('success','Data ditambahkan');
    }

    public function show( $id)
    {
        return view('illness-case.show', [
            'illness_case' => illnessCase::findOrFail($id)]);
    }
    
    public function edit( $id)
    {
        $illness_case = illnessCase::findOrFail($id);

        return view('illness_case.edit',compact('illness_case'));
    }
  
    public function update(Request $request, illnessCase $illness_case)
    {
        $request->validate([
            'diagnosa'              => 'required',
            'keterangan_penyakit'   => 'required',
        ]);
         
        $illness_case->update($request->all());
         
        return redirect()->route('illness-case.index')
            ->with('success','Data diubah');
    }
  
    public function destroy( $id)
    {
        $illness_case = illnessCase::destroy($id);
  
        return redirect()->route('illness-case.index')
            ->with('success','Data dihapus');
    }
    
}
