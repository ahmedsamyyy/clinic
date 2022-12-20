<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetectionRequest;
use App\Http\Requests\patientRequest;
use App\Models\Branches;
use App\Models\Detection;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DetectionController extends Controller
{

    public function index()
    {

        $detetion=Detection::paginate(20);
        return view('dashboard.detetion.index',compact('detetion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctor=Doctor::get();
        $branch=Branches::get();
        $patient=Patient::get();
        return view('dashboard.detetion.add',compact('doctor','branch','patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detetion=Detection::create([
            'name'=>$request->name,
            'discount'=>$request->discount,
            'payment'=>$request->payment,
            'roshet'=>$request->roshet,
            'analysis'=>$request->analysis,
            'rays'=>$request->rays,
            'patient_id'=>$request->patient_id,
            'doctor_id'=>$request->doctor_id,
            'branch_id'=>$request->branch_id,
            'detection'=>$request->detection,
            'consultation'=>$request->consultation,

        ]);
        return redirect()->route('detetion.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Detection $detetion)
    {
        return view('dashboard.detetion.edit',compact('detetion'));
    }

    public function update(Request $request, $id)
    {
        $detetion=Detection::find($id);
        $detetion->update([
            'name'=>$request->name,
            'discount'=>$request->discount,
            'payment'=>$request->payment,
            'roshet'=>$request->roshet,
            'analysis'=>$request->analysis,
            'rays'=>$request->rays,
            'detection'=>$request->detection,
            'consultation'=>$request->consultation,


        ]);
        return redirect()->route('detetion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detection $detetion)
    {

        $detetion->delete();
        return redirect()->route('detetion.index');

    }
    public function trash()
    {
        $detetion=Detection::onlyTrashed()->paginate(20);
        return view('dashboard.detetion.trash',compact('detetion'));

    }
    public function restore($id)
    {
        $detetion=Detection::withTrashed()->find($id);
        $detetion->restore();
        return redirect()->route('detetion.index');

    }
    public function hard_delete($id)
    {
        $detetion=Detection::withTrashed()->find($id);
        $detetion->forceDelete();
        return redirect()->route('detetion.index');

    }
}
