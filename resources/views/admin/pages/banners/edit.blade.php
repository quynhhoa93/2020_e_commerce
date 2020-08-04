@extends('admin.layouts.master')
@section('title')
    Thêm Banner
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="header-icon">
                <i class="fa fa-users"></i>
            </div>
            <div class="header-title">
                <h1>Thêm Banner</h1>
                <small>Thêm Banner</small>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- Form controls -->
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonlist">
                                <a class="btn btn-add " href="clist.html">
                                    <i class="fa fa-list"></i> Sản Phẩm </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form class="col-sm-6" enctype="multipart/form-data" method="post" action="{{route('admin.banners.update',$banner->id)}}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Tên banner</label>
                                    <input type="text" class="form-control" value="{{$banner->name}}" name="name" id="name">
                                </div>

                                <div class="form-group">
                                    <label>Text style</label>
                                    <input type="text" class="form-control" value="{{$banner->text_style}}" name="text_style" id="text_style">
                                </div>

                                <div class="form-group">
                                    <label>thứ tự sắp xếp</label>
                                    <input type="text" class="form-control" value="{{$banner->sort_order}}" name="sort_order" id="sort_order">
                                </div>

                                <div class="form-group">
                                    <label>content</label>
                                    {{--<input type="text" class="form-control" value="{{$banner->content}}" name="content" id="content">--}}
                                    <textarea class="form-control" name="content" id="summary-ckeditor">{{$banner->content}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>link</label>
                                    <input type="text" class="form-control" value="{{$banner->link}}" name="link" id="link">
                                </div>

                                <div class="form-group">
                                    <label>trạng thái</label>
                                    <select name="status" class="form-control">
                                        <option value="0" @if($banner->status===0)selected @endif >Ẩn</option>
                                        <option value="1" @if($banner->status===1)selected @endif >Hiển thị</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Ảnh banner</label>
                                    <input type="file" name="image" id="image">
                                    <input type="hidden" name="current_image" value="{{$banner->image}}">
                                    <img src="{{asset('backend/images/banners/small/'.$banner->image)}}">
                                </div>


                                <div class="reset-button">
                                    <input type="submit" class="btn btn-success" value="Lưu">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection