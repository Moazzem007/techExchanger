<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function index()
    {
        return view('adminDashboard.adminLogin');
    }

    public function adminDashboard(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if($email == "admin@gmail.com"){
            if ($password == 'admin123'){
                return view('adminDashboard.adminDashboard');
            }
        }
    }

    public function allUsers()
    {
        $users = User::all();
        return view('adminDashboard.allUsers', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::where('id', '=', $id)->first();
        return view('adminDashboard.editUser', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['mobile_no'] = $request->mobile_no;
        $data['address'] = $request->address;

        DB::table('users')->where('id', $id)->update($data);
        $users = User::all();
        return view('adminDashboard.allUsers', compact('users'));
    }

    public function allProducts()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('adminDashboard.allProducts', compact('products', 'categories'));
    }


    public function editAdminProducts($id)
    {
        $product = Product::where('id', 'LIKE', $id)->first();
        $categories = Category::all();


        return view('adminDashboard.productEdit', compact('product', 'categories'));
    }

    public function productUpdate(Request $request, $id)
    {

        $data = array();
        $data['category_id'] = $request->category_id;
        $data['condition'] = $request->condition;
        $data['authenticity'] = $request->authenticity;
        $data['brand_name'] = $request->brand_name;
        $data['model'] = $request->model;
        $data['release_date'] = $request->release_date;
        $data['features'] = $request->features;
        $data['description'] = $request->description;
        $data['price'] = $request->price;

        if ($request->image1){
            $image1 = $request->image1;
            if (File::exists($request->old_image_1)){
                File::delete($request->old_image_1);
            }
            $uniqueID = \Illuminate\Support\Str::random(20);
            $photo1name = $uniqueID.'.'.$image1->getClientOriginalExtension();
            $target = public_path('media/'.$photo1name);
            Image::make($image1)->fit(400,600)->save($target);
            $data['image1'] = 'media/'.$photo1name;
        }

        if ($request->image2){
            $image2 = $request->image2;
            if (File::exists($request->old_image_2)){
                File::delete($request->old_image_2);
            }
            $uniqueID = \Illuminate\Support\Str::random(20);
            $photo2name = $uniqueID.'.'.$image2->getClientOriginalExtension();
            $target = public_path('media/'.$photo2name);
            Image::make($image2)->fit(400,600)->save($target);
            $data['image2'] = 'media/'.$photo2name;
        }

        if ($request->image3){
            $image3 = $request->image3;
            if (File::exists($request->old_image_3)){
                File::delete($request->old_image_3);
            }
            $uniqueID = \Illuminate\Support\Str::random(20);
            $photo3name = $uniqueID.'.'.$image3->getClientOriginalExtension();
            $target = public_path('media/'.$photo3name);
            Image::make($image3)->fit(400,600)->save($target);
            $data['image3'] = 'media/'.$photo3name;
        }



        DB::table('products')->where('id', $id)->update($data);
        $products = Product::all();
        $categories = Category::all();
        return view('adminDashboard.allProducts', compact('products', 'categories'));
    }

    public function productDelete($id)
    {
        $product = Product::where('id', '=', $id)->first();
        if ($product->image1){
            if (File::exists($product->image1)){
                File::delete($product->image1);
            }
        }
        if ($product->image2){
            if (File::exists($product->image2)){
                File::delete($product->image2);
            }
        }
        if ($product->image){
            if (File::exists($product->image)){
                File::delete($product->image);
            }
        }

        $product->delete();


        $products = Product::all();
        $categories = Category::all();
        return view('adminDashboard.allProducts', compact('products', 'categories'));
    }
}