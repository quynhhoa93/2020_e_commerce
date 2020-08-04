<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>@yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{--<link href="toastr.css" rel="stylesheet"/>--}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>

<body>
@include('client.layouts.header')
@yield('content')

@include('client.layouts.footer')


<!-- ALL JS FILES -->
<script src="{{asset('frontend/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('frontend/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<!-- ALL PLUGINS -->
<script src="{{asset('frontend/js/jquery.superslides.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap-select.js')}}"></script>
<script src="{{asset('frontend/js/inewsticker.js')}}"></script>
{{--ben duoi ko biet thieu gi--}}
<script src="{{asset('frontend/js/bootsnav.js')}}"></script>
<script src="{{asset('frontend/js/images-loded.min.js')}}"></script>
<script src="{{asset('frontend/js/isotope.min.js')}}"></script>
<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/js/baguetteBox.min.js')}}"></script>
<script src="{{asset('frontend/js/form-validator.min.js')}}"></script>
<script src="{{asset('frontend/js/contact-form-script.js')}}"></script>
<script src="{{asset('frontend/js/custom.js')}}"></script>

{{--<script src="jquery.min.js"></script>--}}
{{--<script src="toastr.js"></script>--}}
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
@toastr_render

<script>
    $(document).ready(function () {
        $("#selSize").change(function () {
            // alert("test");
            var idSize = $(this).val();
            if(idSize === ""){
                return false;
            }
            $.ajax({
                type : 'get',
                url : '/gia-san-pham',
                data :{idSize:idSize},
                success:function (resp) {
                    // alert(resp);
                    var arr = resp.split('#');
                    $("#getPrice").html("PKR "+arr[0]);
                    $("#price").val(arr[0]);
                },error:function () {
                    alert("error");
                }
            });
        });
    })
</script>

</body>

</html>