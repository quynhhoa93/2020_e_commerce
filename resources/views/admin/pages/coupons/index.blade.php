@extends('admin.layouts.master')
@section('title')
    Banner
@endsection
@push('css')
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="header-icon">
                <i class="fa fa-product-hunt"></i>
            </div>
            <div class="header-title">
                <h1>Banner</h1>
                <small>Banner List</small>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                            </div>
                        </div>
                        <div class="panel-body">
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="btn-group">

                            </div>
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr class="info">
                                        <th></th>
                                        <th>code giảm giá</th>
                                        <th>Amount</th>
                                        <th>Amount type</th>
                                        <th>Ngày hết hạn</th>
                                        <th>trạng thái</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coupons as $key=>$coupon)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$coupon->coupon_code}}</td>
                                            <td>
                                                {{$coupon->amount}} @if($coupon->amount_type == 'Fixed') VND @else % @endif
                                            </td>
                                            <td>@if($coupon->amount_type == 'Fixed') giảm giá theo giá tiền @else giảm giá theo phần trăm @endif</td>
                                            <td>{{$coupon->expiry_date}}</td>
                                            @if($coupon->status == 0)
                                                <td><span class="label-custom label label-danger">Ẩn</span></td>
                                            @elseif($coupon->status == 1)
                                                <td><span class="label-custom label label-default">Hiện</span></td>
                                            @endif
                                            <td>
                                                <a href="{{route('admin.coupons.edit',$coupon->id)}}" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash-o"
                                                            onclick="deleteCoupon({{$coupon->id}})"></i>
                                                </button>
                                                <form id="delete-from-{{$coupon->id}}"
                                                      action="{{route('admin.coupons.destroy',$coupon->id)}}"
                                                      method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript">
        function deleteCoupon(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-from-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>


@endpush