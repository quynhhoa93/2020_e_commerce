<!-- =============================================== -->
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- sidebar menu -->
        <ul class="sidebar-menu">
            <li class="active">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-tachometer"></i><span>Tổng quan</span>
                    <span class="pull-right-container">
                     </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-product-hunt"></i><span>sản phẩm</span>
                    <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.product.create')}}">Thêm Sản Phẩm</a></li>
                    <li><a href="{{route('admin.product.index')}}">Tất Cả Sản Phẩm</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i><span>Danh Mục sản phẩm</span>
                    <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.categories.create')}}">Thêm danh mục Sản Phẩm</a></li>
                    <li><a href="{{route('admin.categories.index')}}">Tất Cả danh mục Sản Phẩm</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-image"></i><span>Banner</span>
                    <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.banners.create')}}">Thêm banner</a></li>
                    <li><a href="{{route('admin.banners.index')}}">Tất Cả banner</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gift"></i><span>Coupons</span>
                    <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.coupons.create')}}">Thêm Coupon</a></li>
                    <li><a href="{{route('admin.coupons.index')}}">Tất Cả Coupon</a></li>
                </ul>
            </li>

            <li class="active">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Đăng xuất
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>


        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
<!-- =============================================== -->