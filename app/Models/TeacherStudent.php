<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherStudent extends Model
{
    use HasFactory, SoftDeletes;

    public function shcool(){
        return $this->belongsTo(School::class);
    }

    public function student(){
        return $this->belongsTo(User::class,'student_id');
    }

    protected $fillable = [
        'school_id',
        'teacher_id',
        'student_id',
        'class_id',
        'start_date',
        'end_date',
    ];
}
