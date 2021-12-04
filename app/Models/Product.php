<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','image', 'amazon_id','quantite'];
    public function amazons()
    {
        return $this->belongsTo(Amazon::class,'amazon_id');
    }
}
