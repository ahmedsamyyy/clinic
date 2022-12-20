<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\patientRequest;
use App\Models\Major;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $majors=Major::paginate(20);
        return view('dashboard.major.index',compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.major.add');
    }


    public function store(Request $request)
    {
        $major=Major::create([
            'name'=>$request->name,

        ]);
        return redirect()->route('majors.index');

    }


    public function show(Major $majors)
    {
        //
    }


    public function edit(Major $majors)
    {
        return view('dashboard.major.edit',compact('majors'));
    }

    public function update(Request $request, $major)
    {
        $major->update([
            'name'=>$request->name,
        ]);
        return redirect()->route('majors.index');
    }

    public function destroy(Major $major)
    {

        $major->delete();
        return redirect()->route('majors.index');

    }
}
