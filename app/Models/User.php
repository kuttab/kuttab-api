<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function assistants(){
        return $this->hasMany(Assistant::class,'assistant_id');
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }

    public function systemLog(){
        return $this->hasMany(SystemLog::class);
    }

    public function lastDailyRecord(){
       return $this->hasMany(DailyRecord::class,'student_id')->orderBy('id','DESC')->take(1);
    }

    public function teacherClass(){
        return $this->hasOne(TeacherStudent::class,'teacher_id');
    }

    public function studentsClass(){
        return $this->hasOne(TeacherStudent::class,'student');
    }

    public function teacher(){
        return $this->hasOne(TeacherStudent::class,'student_id');
    }

    public function parent(){
        return $this->hasOne(ParentChild::class,'child_id');
    }

    public function students(){
        return $this->hasMany(TeacherStudent::class,'teacher_id');
    }

    public function dailyRecord(){
        return $this->hasMany(DailyRecord::class,'student_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uid',
        'username',
        'email',
        'email_verified_at',
        'password',
        'type',
        'school_id',
        'nationality',
        'country',
        'city',
        'address',
        'birth_date',
        'mobile_number',
        'telephone_number',
        'image',
        'first_name',
        'middle_name',
        'last_name',
        'academic',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
