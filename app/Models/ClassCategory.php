<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="class_categories";

    protected $fillable = [
        'class_id',
        'category_id',
    ];
}
