@extends('admin.layouts.master')
@section('title')
    Sản Phẩm
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
                <h1>Customer</h1>
                <small>Customer List</small>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                <a href="#">
                                    <h4>Add customer</h4>
                                </a>
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
                                        <th>danh mục sản phẩm</th>
                                        <th>tên sản phẩm</th>
                                        <th>mã sản phẩm</th>
                                        <th>giá sản phẩm</th>
                                        <th>mô tả sản phẩm</th>
                                        <th>ảnh sản phẩm</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $key=>$product)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$product->category_name}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->product_code}}</td>
                                        <td>{{$product->product_price}}</td>
                                        {{--<td><a href="http://thememinister.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="2d4c415f4c57546d5945484048404443445e59485f034e4240">[email&#160;protected]</a></td>--}}
                                        <td>{{$product->product_description}}</td>
                                        <td><img src="{{asset('backend/images/products/small/'.$product->image)}}" class="img-square" alt="User Image" width="50" height="50"> </td>
                                        <td>
                                            <input type="checkbox" class="ProductStatus btn btn-success" rel="{{$product->id}}"
                                            data-toggle="toggle" data-on="Enabled" data-of="Disabled" data-onstyle="success" data-offstyle="danger"
                                            @if($product['status'] == "1") checked @endif>
                                            <div id="myElem" style="display: none;" class="alert alert-success">Status Enabled</div>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.getProductImages',$product->id)}}" class="btn btn-info btn-sm"><i class="fa fa-image"></i></a>
                                            <a href="{{route('admin.getProductAttributes',$product->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-list"></i></a>
                                            <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm"><i
                                                        class="fa fa-trash-o"
                                                        onclick="deleteProduct({{$product->id}})"></i>
                                            </button>
                                            <form id="delete-from-{{$product->id}}"
                                                  action="{{route('admin.product.destroy',$product->id)}}"
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
        function deleteProduct(id) {
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