<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    use HasFactory;

    public function user(){
        $this->belongsTo(User::class);
    }

    protected $fillable = [
        'status',
        'message',
        'data',
        'by'
    ];
}
