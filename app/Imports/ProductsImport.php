<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name'=>$row[0],
            'description'=>$row[1],
            'image'=>$row[2],
            'quantite'=>$row[3],
            'amazon_id'=>Auth::user()->amazons->id,
            // On fait with('nom de la relation') lorsqu'on a pas specifié un utilisateur;
        ]);
    }
}
