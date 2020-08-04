<?php

namespace App\Http\Controllers\Admin;

use App\Banners;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banners::all();
        return view('admin.pages.banners.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $banner = new Banners();
        $banner->name = $data['name'];
        $banner->text_style = $data['text_style'];
        $banner->sort_order = $data['sort_order'];
        $banner->content = $data['content'];
        $banner->link = $data['link'];
        $banner->status = $data['status'];

        //upload image
        if ($request->hasFile('image')) {
            $image_tmp = Input::file('image');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = rand(111, 99999) . '.' . $extension;
                $large_image_path = 'backend/images/banners/large/' . $filename;
                $medium_image_path = 'backend/images/banners/medium/' . $filename;
                $small_image_path = 'backend/images/banners/small/' . $filename;

                //resize image
                Image::make($image_tmp)->save($large_image_path);
                Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                //store image name in product table
                $banner->image = $filename;
            }
        }

        $banner->save();

        return redirect()->route('admin.banners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banners::find($id);
        return view('admin.pages.banners.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $banner = Banners::find($id);
        $banner->name = $data['name'];
        $banner->text_style = $data['text_style'];
        $banner->sort_order = $data['sort_order'];
        $banner->content = $data['content'];
        $banner->link = $data['link'];
        $banner->status = $data['status'];

        //upload image
        if ($request->hasFile('image')) {
            $image_tmp = Input::file('image');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = rand(111, 99999) . '.' . $extension;
                $large_image_path = 'backend/images/banners/large/' . $filename;
                $medium_image_path = 'backend/images/banners/medium/' . $filename;
                $small_image_path = 'backend/images/banners/small/' . $filename;

                //resize image
                Image::make($image_tmp)->save($large_image_path);
                Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                //xoa anh cu
                $old_large_image_path = 'backend/images/banners/large/';
                $old_medium_image_path = 'backend/images/banners/medium/' ;
                $old_small_image_path = 'backend/images/banners/small/' ;
                if(file_exists($old_large_image_path.$data['current_image'])) {
                    unlink($old_large_image_path . $data['current_image']);
                    unlink($old_medium_image_path . $data['current_image']);
                    unlink($old_small_image_path . $data['current_image']);
                }
            }
        }else {
            $filename = $data['current_image'];
        }
        $banner->image = $filename;

        $banner->save();
        return redirect()->route('admin.banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banners::find($id);
        $large_image_path = 'backend/images/banners/large/';
        $medium_image_path = 'backend/images/banners/medium/';
        $small_image_path = 'backend/images/banners/small/' ;

        if (file_exists($large_image_path.$banner->image)){
            unlink($large_image_path.$banner->image);
            unlink($medium_image_path.$banner->image);
            unlink($small_image_path.$banner->image);
        }
        $banner->delete();
        return redirect()->back();

    }
}
