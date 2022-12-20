<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','major','phone','employee_desc','doctor_desc','image','price','date_id'];

    public function dates()
    {
        return $this->hasMany(Date::class, 'doctor_id', 'id');
    }
}
