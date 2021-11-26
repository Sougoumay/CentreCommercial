<?php

namespace App\Http\Controllers;

use App\Helpers\UploadsFile;
use App\Http\Request\GestionRequest;
use App\Models\Product;
use App\Models\Amazon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    // Debut des fonctions utilisables par l'administrateur
    public function showUser()
    {
        $users = User::get();
        return view('Admin.showUser',compact('users'));
    }

    public function createUser(Request $request)
    {
        $validation = $request->validate([
            'name'=>'string|required|min:3',
            'boutique'=>'string|required|min:3',
            'description'=>'string|required|min:10|max:100'
        ]);

        $data = User::create([
            'name'=>$request->get('name'),
            'boutique'=>$request->get('boutique'),
            'description'=>$request->get('description'),
            'email'=>$request->get('email'),
            'password'=>$request->get('password')
        ]);

        $name = $data->name;
        $email = $data->email;
        $body = [];
        $mail_data = array('body',$body);
        Mail::send('mail', $mail_data, function($query) use ($name,$email){
           $query->to($name,$email)->subject('welcome');
           $query->from(env('MAIL_FROM_ADRESS','Admin'));
        });

        $data->delete();

        $boutique = Amazon::create([
           'name'=>'boutique',
            'description'=>'description',
            'user_id'=>$data,
            'status'=>'pending'
        ]);
    }

    public function updateStatusShowPost($boutique)
    {
        $boutique_id = Amazon::find($boutique);
        $accepted = $boutique_id->update([
            'status'=>'accepted'
        ]);

        if($accepted){
            User::find($boutique->user_id)->update([
                'deleted_at'=>null
            ]);
        }

        $name = User::user()->name;
        $email = User::user()->email;
        $body = [];
        $mail_data = array('body',$body);
        Mail::send('mail', $mail_data, function($query) use ($name,$email){
            $query->to($name,$email)->subject('welcome');
            $query->from(env('MAIL_FROM_ADRESS','Admin'));
        });

        return view('showUser');
    }

    public function showUserById($id){
        $users = User::find($id);
        return view('showUserById',compact('users'));
    }

    public function addproduct(GestionRequest $gestionRequest)
    {
        $photo = $gestionRequest->file('image');
        if($photo)
        {
            $photoName = uniqid('produit_').'.'.$photo->getClientOriginalExtension();
            $photo->move(UploadsFile::getUploadsPath('profile_photo'),$photoName);
            $article = Product::create([
                'name'=>$gestionRequest->get('name'),
                'description'=>$gestionRequest->get('description'),
                'image'=>$photoName,
                'boutique_id'=>Auth::user()->boutique->id,
            ]);
        }
        return view('User.addProduct');
    }

    public function deleteUser($id)
    {
        $users = User::find($id);
        $users->delete();
        return back();
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return back();
    }

    public function adminShowProduct()
    {
        $products = Product::get();
        return view('Admin.showProduct',compact('products'));
    }



    public function userShowProduct($boutique_id)
    {
        $produits = Product::where('boutique_id',$boutique_id)->first();
        return view('User.showProduit','produits');
    }

}
