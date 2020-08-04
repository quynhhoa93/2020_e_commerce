@extends('admin.layouts.master')
@section('title')
    Thêm Coupon
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
                            <form class="col-sm-6" enctype="multipart/form-data" method="post" action="{{route('admin.coupons.store')}}" name="add_coupon" id="add_coupon">
                                @csrf

                                <div class="form-group">
                                    <label>Mã giảm giá</label>
                                    <input type="text" class="form-control" placeholder="Nhập vào mã giảm giá" name="coupon_code" id="coupon_code">
                                </div>

                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" placeholder="amount" name="amount" id="amount">
                                </div>

                                <div class="form-group">
                                    <label>Amount type</label>
                                    <select class="form-control" name="amount_type" id="amount_type">
                                        <option value="Percentage">giảm giá theo phần trăm</option>
                                        <option value="Fixed">giảm giá theo giá tiền</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Ngày hết hạn</label>
                                    <input type="date" class="form-control" name="expiry_date" id="expiry_date">
                                </div>

                                {{--<div class="form-group">--}}
                                    {{--<label>trạng thái</label>--}}
                                    {{--<select name="status" class="form-control">--}}
                                        {{--<option value="0">Ẩn</option>--}}
                                        {{--<option value="1">Hiển thị</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}

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