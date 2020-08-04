@extends('admin.layouts.master')
@section('title')
    thuộc tính sản phẩm
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
                <h1>thuộc tính sản phẩm</h1>
                <small>thuộc tính sản phẩm</small>
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
                            <form class="col-sm-6" enctype="multipart/form-data" method="post"
                                  action="{{route('admin.postProductAttributes',$productDetails->id)}}">
                                @csrf


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
                                    <div class="field_wrapper">
                                        <div style="display: flex">
                                            <input type="text" name="sku[]" id="sku" placeholder="SKU"
                                                   class="form-control" style="width: 120px;margin-right: 5px"/>
                                            <input type="text" name="size[]" id="size" placeholder="size"
                                                   class="form-control" style="width: 120px;margin-right: 5px"/>
                                            <input type="text" name="price[]" id="price" placeholder="price"
                                                   class="form-control" style="width: 120px;margin-right: 5px"/>
                                            <input type="text" name="stock[]" id="stock" placeholder="stock"
                                                   class="form-control" style="width: 120px;margin-right: 5px"/>
                                            <a href="javascript:void(0); " class="add_button" title="Add Field">ADD</a>
                                        </div>
                                    </div>
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
                                      action="{{route('admin.editAttribute',$productDetails->id)}}" method="post">
                                    @csrf
                                    <table id="table_id" class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr class="info">
                                            <th>Category id</th>

                                            <th>SKU</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($productDetails['attributes'] as $attribute)
                                            <tr>
                                                <td style="display: none"><input type="hidden" name="attr[]" value="{{$attribute->id}}">{{$attribute->id}}</td>
                                                <td>{{$attribute->id}}</td>
                                                <td><input type="text" name="sku[]" value="{{$attribute->sku}}" style="text-align: center"></td>
                                                <td><input type="text" name="size[]" value="{{$attribute->size}}" style="text-align: center"></td>
                                                <td><input type="text" name="price[]" value="{{$attribute->price}}" style="text-align: center">
                                                </td>
                                                <td><input type="text" name="stock[]" value="{{$attribute->stock}}" style="text-align: center">
                                                </td>
                                                <td class="center">
                                                    <div class="btn-group">
                                                        <input type="submit" value="update" class="btn btn-success" style="height: 30px;padding-top: 4px">
                                                        <a href="{{route('admin.deleteAttribute',$attribute->id)}}"
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