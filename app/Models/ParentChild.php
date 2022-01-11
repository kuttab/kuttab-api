<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentChild extends Model
{
    use HasFactory, SoftDeletes;

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function parent(){
        return $this->belongsTo(User::class);
    }

    public function child(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'school_id',
        'parent_id',
        'child_id',
    ];
}
