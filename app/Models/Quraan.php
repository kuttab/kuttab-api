<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quraan extends Model
{
    use HasFactory, SoftDeletes;

    public function dailyRecord(){
        return $this->belongsTo(DailyRecord::class);
    }

    public function quraanAchievementType(){
        return $this->belongsTo(QuraanAchievementType::class);
    }

    protected $fillable = [
        'daily_record_id',
        'from_sura',
        'from_aya',
        'to_sura',
        'to_aya',
        'type_id'
    ];
}
