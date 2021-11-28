<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amazon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'user_id', 'status'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'boutique_id','id');
    }
}
