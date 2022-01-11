<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sunna extends Model
{
    use HasFactory, SoftDeletes;

    public function dailyRecord(){
        return $this->belongsTo(DailyRecord::class);
    }

    protected $fillable = [
        'daily_record_id',
        'book_name',
        'hadith_number',
    ];
}
