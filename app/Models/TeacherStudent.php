<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherStudent extends Model
{
    use HasFactory, SoftDeletes;

    public function class(){
        return $this->belongsTo(Classes::class , 'class_id');
    }

    public function shcool(){
        return $this->belongsTo(School::class);
    }

    public function students(){
        return $this->belongsTo(User::class,'student_id');
    }

    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id');
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
