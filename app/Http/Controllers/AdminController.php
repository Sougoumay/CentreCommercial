<?php

namespace App\Http\Controllers;

use App\Helpers\UploadsFile;
use App\Http\Request\GestionRequest;
use App\Models\Product;
use App\Models\Amazon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    // Debut des fonctions utilisables par l'administrateur
    public function showUser()
    {
        $users = User::withTrashed()->get();
        return view('Admin.showUser',compact('users'));
    }

    public function createUser(Request $request)
    {
        $validation = $request->validate([
            'name'=>'string|required|min:3',
            'boutique'=>'string|required|min:3',
            'description'=>'string|required|min:10|max:100'
        ]);

        /***
         * La transaction permet d'assurer la totalite du processus, au cas d'une erreur dans le processus
         * toutes les donnees precedentes seront de la base de donnees
         */

        DB::transaction(function() use ($request){
            $data = User::create([
                'name'=>$request->get('name'),
                'email'=>$request->get('email'),
                'password'=>Hash::make($request->get('password'))
            ]);

            // TODO:: Il faut envoyer le mail avec le nom de la personne

            $name = $data->name;
            $email = $data->email;
            $body = [];
            $mail_data = array('body',$body);
            Mail::send('mail', $mail_data, function($query) use ($name,$email){
                $query->to($email,$name)->subject('welcome');
                $query->from('elidjaihamid@gmail.com');
            });

            /*$request->user()->amazons()->create($request->all());
            cette simple ligne permet de creer les
            donnees de la boutique a condition que les colonnes de la boutique et de la table user n'aient
            les memes noms, a l'exemple de name de la boutique et de user*/

            $boutique = Amazon::create([
                'name'=>$request->get('boutique'),
                'description'=>$request->get('description'),
                'user_id'=>$data->id,
                'status'=>'pending'
            ]);

            $data->delete();
        });

    }

    public function updateStatusShowPost($id)
    {
        $boutique_id = Amazon::find($id);
        $accepted = $boutique_id->update([
            'status'=>'accepted'
        ]);

        if($accepted){
            //dd(User::withTrashed()->find($boutique_id->user_id));
            // la fonction restore() permet de mettre a jour la valeur de softDeletes
            $admin = User::withTrashed()->find($boutique_id->user_id)->restore();
        }

        $name = $boutique_id->users->name;
        $email = $boutique_id->users->email;
        $body = [];
        $mail_data = array('body',$body);
        Mail::send('mail', $mail_data, function($query) use ($name,$email){
            $query->to($email,$name)->subject('welcome');
            $query->from('elidjaihamid@gmail.com');
        });

        return back();
    }

    public function showUserById($id){
        $users = User::find($id);
        return view('admin.showUserById',compact('users'));
    }

    public function addProductView()
    {
        return view('User.addProduct');
    }

    public function addProduct(Request $request)
    {
        $validation = $request->validate([
            'name'=>'string|required|min:3',
            'description'=>'string|required|min:10|max:100',
            'image'=>'image|required'
        ]);

        $photo = $request->file('image');
        if($photo)
        {
            $photoName = uniqid('produit_').'.'.$photo->getClientOriginalExtension();
            $photo->move(UploadsFile::getUploadsPath('profile_photo'),$photoName);
            $article = Product::create([
                'name'=>$request->get('name'),
                'description'=>$request->get('description'),
                'image'=>$photoName,
                'amazon_id'=>Auth::user()->amazons->id,
            ]);
        }
        return back();
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
        //$products = Product::with('amazons')->get(); Cette commande ameliore la performance de la base
        $products = Product::get();
        return view('Admin.showProduct',compact('products'));
    }



    public function userShowProduct()
    {
        $boutique_id = Auth::user()->amazons->id;
        $produits = Product::where('amazon_id',$boutique_id)->get();
        return view('User.showProduct',compact('produits'));
    }

}
