<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends Model
{
    use HasFactory, SoftDeletes;

    public function categories(){
        return $this->belongsToMany(Classes::class,'class_categories' , 'class_id','category_id');
    }

    public function school(){
        return $this->belongsTo(School::class);
    }


    public function teacherStudents(){
        return $this->hasMany(TeacherStudent::class,'class_id');
    }

    protected $fillable = [
        'name',
        'school_id',
    ];
}
