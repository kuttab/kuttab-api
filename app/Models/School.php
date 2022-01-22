<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use HasFactory, SoftDeletes;

    public function users(){
        return $this->hasMany(User::class);
    }

    public function classes(){
        return $this->hasMany(Classes::class);
    }

    public function dailyRecords(){
        return $this->hasMany(DailyRecord::class);
    }

    public function admins(){
        return $this->hasMany(Admin::class);
    }

    protected $fillable = [
      'name',
      'description',
      'country',
      'city',
      'address',
      'logo',
      'language',
    ];
}
