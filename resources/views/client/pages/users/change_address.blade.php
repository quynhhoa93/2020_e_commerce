@extends('client.layouts.master')
@section('title')
    Đăng nhập
@endsection
@section('content')
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="contact-form-right">
                        <h2>thay đổi địa chỉ</h2>
                        <form id="contactForm registerForm" action="{{url('/change-address')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Điền vào ten của bạn" value="{{$userDetails->name}}" id="name" name="name" required data-error="khong duoc bo trong phan nay">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Điền vào địa chỉ của bạn" value="{{$userDetails->address}}" id="address" name="address" required data-error="khong duoc bo trong phan nay">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="city" id="city" class="form-control">
                                            <option value="1">Lựa chọn thành phố</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->name}}" @if($city->name == $userDetails->city) selected @endif>{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Điền vào sdt của bạn" value="{{$userDetails->mobile}}" id="mobile" name="mobile" required data-error="khong duoc bo trong phan nay">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-button text-center">
                                        <button class="btn hvr-hover" id="submit" type="submit">Đăng ký</button>
                                        <div class="h3 text-center hidden" id="msgSubmit"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
@endsection