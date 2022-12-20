<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','phone','major_id','employee_desc','doctor_desc','image','price','date_id'];

    public function dates()
    {
        return $this->hasMany(Date::class, 'doctor_id', 'id');
    }
    /**
     * Get all of the comments for the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function majors()
    {
        return $this->belongsTo(Major::class,'major_id','id');
    }
}
