<?php

namespace App\Http\Controllers;

use App\Banners;
use App\Category;
use App\Product_attributes;
use App\Product_images;
use App\Products;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $banners = Banners::where('status','1')->orderby('sort_order','asc')->get();
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $products = Products::all();
        return view('client.pages.index',compact('banners','categories','products'));
    }

    public function products($id){
        $productDetails = Products::with('attributes')->where(['id'=>$id])->first();
        $productAltImages = Product_images::where(['product_id'=>$id])->get();
        return view('client.pages.product_details',compact('productDetails','productAltImages'));
    }

    public function categories($category_id){
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $products = Products::where(['category_id'=>$category_id])->get();
//        dd($products);
        $product_name = Products::where(['category_id'=>$category_id])->first();
//        dd($product_name);
        return view('client.pages.category',compact('categories','products','product_name'));
    }

    public function getPrice(Request $request){
        $data = $request->all();
//        echo "<pre>";print_r($data);die;
        $proArr = explode("-",$data['idSize']);
        $proAttr = Product_attributes::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
        echo $proAttr->price;

    }

    public function admin(){
        return view('admin.pages.login');
    }
}
