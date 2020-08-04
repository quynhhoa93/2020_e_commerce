@extends('admin.layouts.master')
@section('title')
    Thêm danh mục Sản Phẩm
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
                <h1>Thêm danh mục Sản Phẩm</h1>
                <small>Thêm danh mục Sản Phẩm</small>
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
                                    <i class="fa fa-list"></i> Danh Mục Sản Phẩm </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form class="col-sm-6" method="post" action="{{route('admin.categories.store')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Tên danh mục</label>
                                    <input type="text" class="form-control" placeholder="Tên danh mục" name="name" id="name">
                                </div>

                                <div class="form-group">
                                    <label>Tên danh mục gốc (nếu có)</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
{{--<!--                                        --><?php //echo $categories_dropdown; ?>--}}
                                            <option value="0">danh mục gốc</option>
                                        @foreach($levels as $level)
                                            <option value="{{$level->id}}">{{$level->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>trạng thái</label>
                                    <select name="status" class="form-control">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    </select>
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