<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Ramsey\Collection\Collection;

class UserProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $produit = Product::with(['amazons'=>function($boutique){
            $boutique->with(['users'=>function($users){
                $users->get();
            }]);
        }])->where('created_at','<=',now()->subDays(50))->get();
        $utilisateur = User::with(['amazons'=>function($key){
            $key->with(['products'=>function($produit){
                $produit->where('created_at','<=',now()->subDays(50));
            }]);
        }])->get();
        $data = [];
        foreach($produit as $product){
            $data[]=['name'=>$product->amazons->users->name];
        }
        $var = collect($data)->unique();
       return $var;
    }
}
