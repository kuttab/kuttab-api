<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuraanAchievementType extends Model
{
    use HasFactory, SoftDeletes;

    public function quraan(){
        return $this->hasMany(Quraan::class);
    }

    protected $fillable = [
        'name',
    ];
}
