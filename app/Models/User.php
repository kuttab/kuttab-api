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
        $this->hasMany(SystemLog::class);
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
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
