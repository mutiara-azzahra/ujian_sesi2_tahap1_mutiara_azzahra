<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{    
    public function index()
    {
        $medical_record = medicalRecord::latest()->paginate(5);
        
        return view('medical-record.index',compact('medical_record'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $rusun = Rusun::all();

        return view('medical-record.create', compact('medical_record'));
    }

    public function store(Request $request)
    {
        $request -> validate([
            'tanggal_periksa'       => 'required',
            'keluhan'               => 'required',
            'hasil_pemeriksaan'     => 'required',
            'diagnosa'              => 'required',
            'rencana_pengobatan'    => 'required',
        ]);

        medicalRecord::create($request->all());
        
        return redirect()->route('medical-record.index')->with('success','Data ditambahkan');
    }

    public function show( $id)
    {
        return view('medical-record.show', [
            'medical_record' => medicalRecord::findOrFail($id)]);
    }
    
    public function edit( $id)
    {
        $medical_record = medicalRecord::findOrFail($id);

        return view('medical_record.edit',compact('medical_record'));
    }
  
    public function update(Request $request, medicalRecord $medical_record)
    {
        $request->validate([
            'tanggal_periksa'       => 'required',
            'keluhan'               => 'required',
            'hasil_pemeriksaan'     => 'required',
            'diagnosa'              => 'required',
            'rencana_pengobatan'    => 'required',
        ]);
         
        $medical_record->update($request->all());
         
        return redirect()->route('medical-record.index')
            ->with('success','Data diubah');
    }
  
    public function destroy( $id)
    {
        $medical_record = medicalRecord::destroy($id);
  
        return redirect()->route('medical-record.index')
            ->with('success','Data dihapus');
    }
    
}
