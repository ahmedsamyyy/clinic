<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detection extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','discount','payment','roshet','analysis','rumores'];
}
