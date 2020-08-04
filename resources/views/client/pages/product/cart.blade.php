@extends('client.layouts.master')
@section('title')
    trang chủ
@endsection
@section('content')

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total_amount=0; ?>
                            @foreach($userCart as $cart)
                            <tr>
                                <td class="thumbnail-img">
                                    <a href="#">
                                        <img class="img-fluid" src="{{asset('backend/images/products/medium/'.$cart->image)}}" alt="" />
                                    </a>
                                </td>
                                <td class="name-pr">
                                        {{$cart->product_name}}
                                    <p> {{$cart->product_code}} | {{$cart->size}}</p>
                                </td>
                                <td class="price-pr">
                                    <p>{{$cart->price}}</p>
                                </td>
                                <td class="quantity-box">
                                    <a href="{{url('/cart/update-quantity/'.$cart->id.'/1')}}" style="font-size: 25px">+</a>
                                    <input type="text" size="4" value="{{$cart->quantity}}" min="0" step="1" class="c-input-text qty text" style="width: 80%">
                                    @if($cart->quantity>1)
                                    <a href="{{url('/cart/update-quantity/'.$cart->id.'/-1')}}" style="font-size: 25px">-</a>
                                    @endif
                                </td>
                                <td class="total-pr">
                                    <p>{{$cart->price*$cart->quantity}}</p>
                                </td>
                                <td class="remove-pr">
                                    <a href="{{route('client.deleteCart',$cart->id)}}">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                                <?php $total_amount = $total_amount + $cart->price * $cart->quantity?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-6 col-sm-6">
                    <div class="coupon-box">
                        <form action="{{route('client.applyCoupon')}}" method="post">
                            @csrf
                        <div class="input-group input-group-sm">
                            <input class="form-control" placeholder="Enter your coupon code" name="coupon_code" aria-label="Coupon code" type="text">
                            <div class="input-group-append">
                                <button class="btn btn-theme" type="submit">Apply Coupon</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="update-box">
                        <input value="Update Cart" type="submit">
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        @if(!empty(\Illuminate\Support\Facades\Session::get('CouponAmount')))
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold"> <?php echo $total_amount; ?> VND</div>
                        </div>
                        <hr class="my-1">
                        <div class="d-flex">
                            <h4>Discount</h4>
                            <div class="ml-auto font-weight-bold"> <?php echo \Illuminate\Support\Facades\Session::get('CouponAmount')?> VND</div>
                        </div>
                        <hr>

                        <div class="d-flex gr-total">
                             <h4>Grand Total</h4>
                             <div class="ml-auto font-weight-bold"> <?php echo $total_amount-\Illuminate\Support\Facades\Session::get('CouponAmount')?> VND</div>
                        </div>
                        <hr>

                        @else
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> <?php echo $total_amount;?> </div>
                        </div>
                        <hr>
                        @endif
                    </div>
                </div>
                <div class="col-12 d-flex shopping-box"><a href="checkout.html" class="ml-auto btn hvr-hover">Checkout</a> </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->


@endsection