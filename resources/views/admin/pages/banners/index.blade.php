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
                                        <th>tên banner</th>
                                        <th>text style</th>
                                        <th>thứ tự sắp xếp</th>
                                        <th>content</th>
                                        <th>ảnh banner</th>
                                        <th>trạng thái</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($banners as $key=>$banner)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$banner->name}}</td>
                                            <td>{{$banner->text_style}}</td>
                                            <td>{{$banner->sort_order}}</td>
                                            <td>{!! $banner->content !!}</td>
                                            <td><img src="{{asset('backend/images/banners/small/'.$banner->image)}}" class="img-square" alt="User Image" width="50" height="50"> </td>
                                            @if($banner->status == 0)
                                                <td><span class="label-custom label label-danger">Ẩn</span></td>
                                            @elseif($banner->status == 1)
                                                <td><span class="label-custom label label-default">Hiện</span></td>
                                            @endif
                                            <td>
                                                <a href="{{route('admin.banners.edit',$banner->id)}}" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash-o"
                                                            onclick="deleteProduct({{$banner->id}})"></i>
                                                </button>
                                                <form id="delete-from-{{$banner->id}}"
                                                      action="{{route('admin.banners.destroy',$banner->id)}}"
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