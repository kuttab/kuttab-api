<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory,SoftDeletes;

    public function userInfo(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'is_attended',
        'reason',
        'date',
    ];
}
