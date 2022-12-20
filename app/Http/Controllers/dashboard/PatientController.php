<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\patientRequest;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patints=Patient::paginate(20);
        return view('dashboard.patient.index',compact('patints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.patient.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(patientRequest $request)
    {
        $patint=Patient::create([
            'name'=>$request->name,
            'age'=>$request->age,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'birth_day'=>$request->birth_day,
            'address'=>$request->address,

        ]);
        return redirect()->route('patient.index');

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
    public function edit(Patient $patient)
    {
        return view('dashboard.patient.edit',compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(patientRequest $request, $id)
    {
        $patient=Patient::find($id);
        $patient->update([
            'name'=>$request->name,
            'age'=>$request->age,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'birth_day'=>$request->birth_day,
            'address'=>$request->address,

        ]);
        return redirect()->route('patient.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
    
        $patient->delete();
        return redirect()->route('patient.index');

    }
    public function trash()
    {
        $patints=Patient::onlyTrashed()->paginate(20);
        return view('dashboard.patient.trash',compact('patints'));

    }
    public function restore($id)
    {
        $patient=Patient::withTrashed()->find($id);
        $patient->restore();
        return redirect()->route('patient.index');

    }
    public function hard_delete($id)
    {
        $patient=Patient::withTrashed()->find($id);
        $patient->forceDelete();
        return redirect()->route('patient.index');

    }
}
