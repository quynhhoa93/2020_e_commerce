@extends('admin.layouts.master')
@section('title')
    Thêm Sản Phẩm
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
                <h1>Thêm Sản Phẩm</h1>
                <small>Thêm Sản Phẩm</small>
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
                            <form class="col-sm-6" enctype="multipart/form-data" method="post" action="{{route('admin.product.store')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Tên danh mục</label>
                                    <select name="category_id" class="form-control">
                                        <?php echo $categories_dropdown; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Tên Sản Phẩm</label>
                                    <input type="text" class="form-control" placeholder="Tên Sản Phẩm" name="product_name" id="product_name">
                                </div>

                                <div class="form-group">
                                    <label>Mã Sản Phẩm</label>
                                    <input type="text" class="form-control" placeholder="Mã Sản Phẩm" name="product_code" id="product_code">
                                </div>

                                <div class="form-group">
                                    <label>Mầu Sản Phẩm</label>
                                    <input type="text" class="form-control" placeholder="Mầu Sản Phẩm" name="product_color" id="product_color">
                                </div>

                                <div class="form-group">
                                    <label>Miêu Tả Sản Phẩm</label>
                                    <textarea class="form-control" placeholder="Thêm Miêu Tả Sản Phẩm" name="product_description" id="product_description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Giá Sản Phẩm</label>
                                    <input type="text" class="form-control" placeholder="Giá Sản Phẩm" name="product_price" id="product_price">
                                </div>

                                <div class="form-group">
                                    <label>trạng thái</label>
                                    <select name="status" class="form-control">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Ảnh Sản Phẩm</label>
                                    <input type="file" name="image" id="image">
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