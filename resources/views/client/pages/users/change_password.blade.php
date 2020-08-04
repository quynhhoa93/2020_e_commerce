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
                        <h2>đổi mật khẩu</h2>
                        <form id="contactForm registerForm" action="{{url('/change-password')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Điền vào mật khẩu cũ của bạn" id="old_pwd" name="old_pwd" required data-error="khong duoc bo trong phan nay">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Điền vào mật khẩu mới của bạn" id="new_pwd" name="new_pwd" required data-error="khong duoc bo trong phan nay">
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