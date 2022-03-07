<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static find(int $id)
 * @method static create(array $array)
 */
class Admin extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes;

    public function createdUsers()
    {
        return $this->hasMany(User::class,'created_by');
    }

    public function updatedUsers()
    {
        return $this->hasMany(User::class,'updated_by');
    }

    public function school(){
        return $this->belongsTo(School::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'school_id',
    ];
}
