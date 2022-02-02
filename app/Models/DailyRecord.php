<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyRecord extends Model
{
    use HasFactory, SoftDeletes;

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function teacher(){
        return $this->belongsTo(User::class);
    }

    public function student(){
        return $this->belongsTo(User::class);
    }

    public function quraan(){
        return $this->hasOne(Quraan::class);
    }

    public function sunna(){
        return $this->hasMany(Sunna::class);
    }

    public function child(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'type',
        'school_id',
        'teacher_id',
        'student_id',
        'date',
        'review',
        'score',
    ];
}
