<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponsRequest;
use App\Http\Requests\patientRequest;
use App\Models\Coupons;
use App\Models\Detection;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CouponController extends Controller
{
    public function index()
    {
        $coupons=Coupons::paginate(20);
        return view('dashboard.coupons.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.coupons.add');
    }

    public function store(CouponsRequest $request)
    {
        $coupons=Coupons::create([
            'code'=>$request->code,
            'value'=>$request->value,
        ]);
        return redirect()->route('coupons.index');

    }

    public function show(Patient $patient)
    {
        //
    }

    public function destroy(Coupons $coupons)
    {
        $coupons->delete();
        return redirect()->route('coupons.index');
    }
}
