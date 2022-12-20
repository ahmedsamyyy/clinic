<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detection extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['discount','payment','patient_id','doctor_id','branch_id','roshet','analysis','rays','detection','consultation'];


    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    public function branch()
    {
        return $this->belongsTo(Branches::class, 'branch_id', 'id');
    }
}
