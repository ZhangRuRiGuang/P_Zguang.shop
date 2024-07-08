
@if (Auth::guard('admin')->user()->role == 0)
    <li class="nav-item {{ Route::is('shop.list') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('shop.list') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Cửa hàng</span></a>
    </li>
    <li class="nav-item {{ Route::is('customer.list') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('customer.list') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Người dùng</span></a>
    </li>
    <li class="nav-item {{ Route::is('category.list') || Route::is('category.add.form') || Route::is('category.edit.form') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            <i class="fas fa-fw fa-table"></i>
            <span>Danh mục sản phẩm</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('category.list') }}">Danh sách</a>
                <a class="collapse-item" href="{{ route('category.add.form') }}">Thêm mới</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ Route::is('setting') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('setting') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Thiết lập trang web</span></a>
    </li>
@elseif (Auth::guard('admin')->user()->role == 1)
    <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Thống kê</span></a>
    </li>
    <li class="nav-item {{ Route::is('brand.list') || Route::is('brand.add.form') || Route::is('brand.edit.form') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            <i class="fas fa-fw fa-table"></i>
            <span>Hãng sản phẩm</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('brand.list') }}">Danh sách</a>
                <a class="collapse-item" href="{{ route('brand.add.form') }}">Thêm mới</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ Route::is('supplier.list') || Route::is('supplier.add.form') || Route::is('supplier.edit.form') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-table"></i>
            <span>Nhà cung cấp</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('supplier.list') }}">Danh sách</a>
                <a class="collapse-item" href="{{ route('supplier.add.form') }}">Thêm mới</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ Route::is('product.list') || Route::is('product.add.form') || Route::is('product.edit.form') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
            aria-controls="collapseThree">
            <i class="fas fa-fw fa-table"></i>
            <span>Sản phẩm</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('product.list') }}">Danh sách</a>
                <a class="collapse-item" href="{{ route('product.add.form') }}">Thêm mới</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ Route::is('rating.list') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('rating.list') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Đánh giá</span></a>
    </li>
    <li class="nav-item {{ Route::is('voucher.list') || Route::is('voucher.add.form') || Route::is('voucher.edit.form') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
            aria-controls="collapseFour">
            <i class="fas fa-fw fa-table"></i>
            <span>Voucher</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('voucher.list') }}">Danh sách</a>
                <a class="collapse-item" href="{{ route('voucher.add.form') }}">Thêm mới</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ Route::is('staff.list') || Route::is('staff.add.form') || Route::is('staff.edit.form') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
            aria-controls="collapseFive">
            <i class="fas fa-fw fa-table"></i>
            <span>Nhân viên</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('staff.list') }}">Danh sách</a>
                <a class="collapse-item" href="{{ route('staff.add.form') }}">Thêm mới</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ Route::is('order.list') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('order.list') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Đơn hàng</span></a>
    </li>
    <li class="nav-item {{ Route::is('setting.shop') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('setting.shop') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Thiết lập cửa hàng</span></a>
    </li>
@else
    <li class="nav-item {{ Route::is('rating.list') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('rating.list') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Đánh giá</span></a>
    </li>
@endif