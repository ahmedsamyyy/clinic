<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateRequest;
use App\Http\Requests\DoctorRequest;
use App\Http\Requests\patientRequest;
use App\Models\Date;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors=Doctor::paginate(20);
        return view('dashboard.doctor.index',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.doctor.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image');

        if($request->hasFile('image')){
            $image = $request->file('image');
            $file_name = Time().'-'.$image->getClientOriginalName();
            $file_path = public_path().'/images';
            $image->move($file_path,$file_name);

            $doctor=Doctor::create([
                'name'=>$request->name,
                'major'=>$request->major,
                'phone'=>$request->phone,
                'employee_desc'=>$request->employee_desc,
                'doctor_desc'=>$request->doctor_desc,
                'image'=>$file_name,
                'price'=>$request->price,


            ]);
            return redirect()->route('doctor.index');
        }




    }

public function show(){

}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return view('dashboard.doctor.edit',compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorRequest $request, Doctor $doctor)
    {

            $image = $request->file('image');
            $file_name = Time().'-'.$image->getClientOriginalName();
            $file_path = public_path().'/images';
            $image->move($file_path,$file_name);
        $doctor->update([
            'name'=>$request->name,
            'major'=>$request->major,
            'phone'=>$request->phone,
            'employee_desc'=>$request->employee_desc,
            'doctor_desc'=>$request->doctor_desc,
            'image'=>$file_name,
            'price'=>$request->price,

        ]);
        return redirect()->route('doctor.index');
    }

    public function destroy(Doctor $doctor)
    {
        $admin=auth()->user();
        if($admin->can('softdelete')){
            $doctor->delete();
        return redirect()->route('doctor.index');
        }
        return redirect()->back();
        // $doctor->delete();
        // return redirect()->route('doctor.index');

    }
    public function trash()
    {
        $doctors=Doctor::onlyTrashed()->paginate(20);
        return view('dashboard.doctor.trash',compact('doctors'));

    }
    public function restore($id)
    {
        $doctor=Doctor::withTrashed()->find($id);
        $doctor->restore();
        return redirect()->route('doctor.index');

    }
    public function hard_delete($id)
    {
        $doctor=Doctor::withTrashed()->find($id);
        $doctor->forceDelete();
        return redirect()->route('doctor.index');

    }
    public function doctor_days($id)
    {
        $days=Doctor::find($id)->dates;
        $doctor=Doctor::find($id);
        return view('dashboard.doctor.days',compact('days','doctor'));

    }
    public function create_day( Request $request , $id){

        return view('dashboard.doctor.daycreate',compact('id'));

    }
    public function storeday(DateRequest $request){


        Date::create([
            'day'=>$request->day,
            'from_time'=>$request->from_time,
            'to_time'=>$request->to_time,
            'doctor_id'=>$request->id,

        ]);
        return redirect()->route('doctor.days',$request->id);

    }
    public function destroy_day($id){
        $date=Date::find($id);
        $date->delete();
        return redirect()->back();

    }



}
