@extends('client.layouts.master')
@section('title')
    Đăng nhập
@endsection
@section('content')
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-12">
                    <div class="contact-form-right">
                        <h2>Đăng ký tài khoản mới</h2>
                        <form id="contactForm registerForm" action="{{route('client_register')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Điền vào tên bạn" id="name" name="name" required data-error="khong duoc bo trong phan nay">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Điền vào email của bạn" id="email" name="email" required data-error="khong duoc bo trong phan nay">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Điền vào mật khẩu của bạn" id="password" name="password" required data-error="khong duoc bo trong phan nay">
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
                <div class="col-lg-1 col-sm-12" id="or">
                    Hoặc
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="contact-form-right">
                        <h2>Đăng nhập</h2>
                        <form id="contactForm LoginForm" action="{{route('client_login')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Điền vào email của bạn" id="email" name="email" required data-error="khong duoc bo trong phan nay">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Điền vào mật khẩu của bạn" id="password" name="password" required data-error="khong duoc bo trong phan nay">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-button text-center">
                                        <button class="btn hvr-hover" id="submit" type="submit">Đăng nhập</button>
                                        <div class="h3 text-center hidden" id="msgSubmit"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection