<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amazon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'boutique_id','id');
    }
}
