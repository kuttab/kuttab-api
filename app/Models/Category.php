<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function classes(){
        return $this->belongsToMany(Category::class,'class_categories','category_id','class_id');
    }

    protected $fillable = [
        'name',
        'school_id',
    ];
}
