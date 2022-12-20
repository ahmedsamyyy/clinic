<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchesRequest;
use App\Http\Requests\DetectionRequest;
use App\Http\Requests\patientRequest;
use App\Models\Branches;
use App\Models\Detection;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BranchesController extends Controller
{

    public function index()
    {
        $branches=Branches::paginate(20);
        return view('dashboard.branches.index',compact('branches'));
    }


    public function create()
    {
        return view('dashboard.branches.add');
    }


    public function store(BranchesRequest $request)
    {
        $branches=Branches::create([
            'name'=>$request->name,
            'address'=>$request->address,
            'phone'=>$request->phone,


        ]);
        return redirect()->route('branches.index');

    }

    public function show(Branches $branches)
    {
        //
    }

    public function edit(Branches $branches)
    {
        return view('dashboard.branches.edit',compact('branches'));
    }

    public function update(Request $request, $id)
    {
        $branches=Branches::find($id);
        $branches->update([
            'name'=>$request->name,
            'address'=>$request->address,
            'phone'=>$request->phone,

        ]);
        return redirect()->route('branches.index');
    }

    public function destroy(Branches $branches)
    {

        $branches->delete();
        return redirect()->route('branches.index');

    }
    public function trash()
    {
        $branches=Branches::onlyTrashed()->paginate(20);
        return view('dashboard.branches.trash',compact('branches'));

    }
    public function restore($id)
    {
        $branches=Branches::withTrashed()->find($id);
        $branches->restore();
        return redirect()->route('branches.index');

    }
    public function hard_delete($id)
    {
        $branches=Branches::withTrashed()->find($id);
        $branches->forceDelete();
        return redirect()->route('branches.index');

    }
}
