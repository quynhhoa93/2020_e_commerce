@extends('admin.layouts.master')
@section('title')
    ảnh sản phẩm
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
                <h1>ảnh sản phẩm</h1>
                <small>ảnh sản phẩm</small>
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
                            <form class="col-sm-6" enctype="multipart/form-data" method="post" action="{{route('admin.postProductImages')}}">
                                @csrf

                                <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                                <div class="form-group">
                                    <label>Tên Sản Phẩm</label> {{$productDetails->product_name}}
                                </div>

                                <div class="form-group">
                                    <label>Mã Sản Phẩm</label> {{$productDetails->product_code}}
                                </div>

                                <div class="form-group">
                                    <label>Mầu Sản Phẩm</label> {{$productDetails->product_color}}
                                </div>

                                <div class="form-group">
                                    <label>ảnh sản phẩm</label>
                                    <input type="file" name="image[]" id="image" multiple="multiple">
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


        {{--view attributes--}}
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                <a href="#">
                                    <h4>tất cả thuộc tính</h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="btn-group">

                            </div>
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="table-responsive">
                                <form enctype="multipart/form-data"
                                      action="{{route('admin.postProductImages',$productDetails->id)}}" method="post">
                                    @csrf
                                    <table id="table_id" class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr class="info">
                                            <th>id</th>
                                            <th>Product id</th>
                                            <th>image</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($productImages as $productImage)
                                            <tr>
                                                <td>{{$productImage->id}}</td>
                                                <td>{{$productImage->product_id}}</td>
                                                <td><img src="{{url('backend/images/product_image/medium/'.$productImage->image)}}" style="width: 80px"></td>
                                                <td class="center">
                                                    <div class="btn-group">
                                                        <input type="submit" value="update" class="btn btn-success" style="height: 30px;padding-top: 4px">
                                                        <a href="{{route('admin.deleteAltImage',$productImage->id)}}"
                                                           class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('js')

@endpush