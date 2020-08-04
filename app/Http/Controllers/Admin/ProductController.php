<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product_attributes;
use App\Product_images;
use App\Products;
//use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{

    public function index()
    {
        $products = Products::all();
        foreach ($products as $key => $val) {
            $category_name = Category::where(['id' => $val->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        return view('admin.pages.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option selected disabled>select</option>";
        foreach ($categories as $cat) {
            $categories_dropdown .= "<option value='" . $cat->id . "'>" . $cat->name . "</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value='" . $sub_cat->id . "'> &nbsp;--&nbsp;" . $sub_cat->name . "</option>";
            }
        }
        return view('admin.pages.product.create', compact('categories_dropdown'));
    }

    public function store(Request $request)
    {


        $data = $request->all();
//        echo "<pre>";print_r($data);die;
        $product = new Products();
        $product->product_name = $data['product_name'];
        $product->category_id = $data['category_id'];
        $product->product_code = $data['product_code'];
        $product->product_color = $data['product_color'];
        $product->product_price = $data['product_price'];
        $product->status = $data['status'];
        if (!empty($data['product_description'])) {
            $product->product_description = $data['product_description'];
        } else {
            $product->product_description = '';
        }

        //upload image
        if ($request->hasFile('image')) {
            $image_tmp = Input::file('image');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = rand(111, 99999) . '.' . $extension;
                $large_image_path = 'backend/images/products/large/' . $filename;
                $medium_image_path = 'backend/images/products/medium/' . $filename;
                $small_image_path = 'backend/images/products/small/' . $filename;

                //resize image
                Image::make($image_tmp)->save($large_image_path);
                Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                //store image name in product table
                $product->image = $filename;
            }
        }

        $product->save();
        return redirect()->route('admin.product.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $product = Products::find($id);
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option selected disabled>select</option>";
        foreach ($categories as $cat) {
            if ($cat->id == $product->category_id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $categories_dropdown .= "<option value='" . $cat->id . "' ".$selected.">" . $cat->name . "</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                if ($sub_cat->id == $product->category_id){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
                $categories_dropdown .= "<option value='" . $sub_cat->id . "'".$selected."> &nbsp;--&nbsp;" . $sub_cat->name . "</option>";
            }
        }
        return view('admin.pages.product.edit', compact('product','categories_dropdown'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $product = Products::find($id);
        $product->category_id = $data['category_id'];
        $product->product_name = $data['product_name'];
        $product->product_code = $data['product_code'];
        $product->product_color = $data['product_color'];
        $product->product_price = $data['product_price'];
        $product->status = $data['status'];
        if (!empty($data['product_description'])) {
            $product->product_description = $data['product_description'];
        } else {
            $product->product_description = '';
        }

        //upload image
        if ($request->hasFile('image')) {
            $image_tmp = Input::file('image');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = rand(111, 99999) . '.' . $extension;
                $large_image_path = 'backend/images/products/large/' . $filename;
                $medium_image_path = 'backend/images/products/medium/' . $filename;
                $small_image_path = 'backend/images/products/small/' . $filename;

                //resize image
                Image::make($image_tmp)->save($large_image_path);
                Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                //xoa anh cu
                $old_large_image_path = 'backend/images/products/large/';
                $old_medium_image_path = 'backend/images/products/medium/' ;
                $old_small_image_path = 'backend/images/products/small/' ;
                if(file_exists($old_large_image_path.$data['current_image'])){
                    unlink($old_large_image_path.$data['current_image']);
                    unlink($old_medium_image_path.$data['current_image']);
                    unlink($old_small_image_path.$data['current_image']);
                }

            }
        } else {
            $filename = $data['current_image'];
        }

        $product->image = $filename;

        $product->save();
        return redirect()->route('admin.product.index');


    }

    public function destroy($id)
    {
        $product = Products::find($id);
        $large_image_path = 'backend/images/products/large/';
        $medium_image_path = 'backend/images/products/medium/';
        $small_image_path = 'backend/images/products/small/' ;

        if (file_exists($large_image_path.$product->image)){
            unlink($large_image_path.$product->image);
            unlink($medium_image_path.$product->image);
            unlink($small_image_path.$product->image);
        }

        $product->delete();
        return redirect()->back();
    }

    public function updateStatus(Request $request,$id=null){
        $data = $request->all();
        Products::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

    public function getAddAttributes($id){
        $productDetails = Products::with('attributes')->where(['id'=>$id])->first();
        return view('admin.pages.product.add_attributes',compact('productDetails'));
    }

    public function postAddAttributes(Request $request,$id){
        $productDetails = Products::find($id);
        $data = $request->all();
        foreach ($data['sku'] as $key=>$val) {
            //ngăn chặn bản ghi SKU trùng lặp
            $attrCountSKU = Product_attributes::where('sku',$val)->count();
            if($attrCountSKU >0){
                return redirect()->back();
            }

            //ngăn chặn bản ghi size trùng lặp
            $attrCountSize = Product_attributes::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
            if ($attrCountSize>0){
                return redirect()->back();
            }
            $attribute = new Product_attributes();
            $attribute->product_id = $id;
            $attribute->sku = $val;
            $attribute->size = $data['size'][$key];
            $attribute->price = $data['price'][$key];
            $attribute->stock = $data['stock'][$key];
            $attribute->save();
        }
        return redirect()->back();
    }

    public function editAttribute(Request $request,$id){
        if ($request->isMethod('post')){
            $data = $request->all();
            foreach ($data['attr'] as $key=>$attr){
                Product_attributes::where(['id'=>$data['attr'][$key]])->update(['sku'=>$data['sku'][$key],'size'=>$data['size'][$key],'price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
            }
            return redirect()->back();
        }
    }

    public function deleteAttribute($id){
        Product_attributes::where(['id'=>$id])->delete();
        return redirect()->back();
    }

    public function getAddImages($id){
        $productDetails = Products::find($id);
        $productImages = Product_images::where(['product_id'=>$id])->get();
        return view('admin.pages.product.add_images',compact('productDetails','productImages'));
    }

    public function postAddImages(Request $request){
        $data = $request->all();
        if ($request->hasFile('image')){
            $files = $request->file('image');
            foreach ($files as $file){
                $image = new Product_images();
                $extension = $file->getClientOriginalExtension();
                $file_name = rand(111,9999).'.'.$extension;
                $large_image_path = 'backend/images/product_image/large/' . $file_name;
                $medium_image_path = 'backend/images/product_image/medium/' . $file_name;
                $small_image_path = 'backend/images/product_image/small/' . $file_name;

                Image::make($file)->save($large_image_path);
                Image::make($file)->resize(600, 600)->save($medium_image_path);
                Image::make($file)->resize(300, 300)->save($small_image_path);

                $image->image = $file_name;
                $image->product_id = $data['product_id'];
                $image->save();
            }
        }

        return redirect()->back();


    }

    public function deleteAltImage($id){
        $productImage = Product_images::where(['id'=>$id])->first();
        $large_image_path = 'backend/images/product_image/large/';
        $medium_image_path = 'backend/images/product_image/medium/';
        $small_image_path = 'backend/images/product_image/small/' ;

        if (file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
            unlink($medium_image_path.$productImage->image);
            unlink($small_image_path.$productImage->image);
        }

        $productImage->delete();
        return redirect()->back();
    }
}

//
//$nameImage = $this->image_service->moveImage($file, 'img/upload/product');
//
////xoa anh
//$product = Product::find($id);
//$this->image_service->deleteFile($product->image, 'img/upload/product');
//$product->delete();
//
//
//$validator = Validator::make($request->all(),
//    [
//        'name' => 'required|min:2|max:255',
//        'description' => 'required|min:2',
//        'quantity' => 'required|numeric',
//        'price' => 'required|numeric',
//        'promotional' => 'numeric',
//        'image' => 'image',
//    ],
//    [
//        'required' => ':attribute không được bỏ trống',
//        'min' => ':attribute tối thiểu có 2 ký tự',
//        'max' => ':attribute tối đa có 255 ký tự',
//        'numeric' => ':attribute phải là một số ',
//        'image' => ':attribute không là hình ảnh',
//    ],
//    [
//        'name' => 'Tên sản phẩm',
//        'description' => 'Mô tả sản phẩm',
//        'quantity' => 'Số lượng sản phẩm',
//        'price' => 'Đơn giá sản phẩm',
//        'promotional' => 'Giá khuyến mại',
//        'image' => 'Ảnh minh họa',
//    ]
//);