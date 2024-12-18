<div class="leftside-menu">
    <!-- Brand Logo Light -->
    <a href="{{ env('APP_URL') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="https://coderthemes.com/hyper/saas/assets/images/logo.png" alt="Hytertech" style="height: 28px">
        </span>
        <span class="logo-sm">
            <img src="https://coderthemes.com/hyper/saas/assets/images/logo-sm.png" alt="Hytertech"
                style="height:30px;width:30px">
        </span>
    </a>
    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>
    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>
    <!-- Sidebar -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user">
            <a href="">
                <img src="{{ asset('assets/systems/avatar-default.jpg') }}" alt="user-image" height="42"
                    class="rounded-circle shadow-sm">
                <span class="leftbar-user-name mt-2">Dominic Keller</span>
            </a>
        </div>
        <!--- Sidemenu -->
        <ul class="side-nav">
            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <i class="fad fa-home"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-title">Quản lý</li>
            <li class="side-nav-item">
                <a href="{{ route('admin.map') }}" class="side-nav-link">
                    <i class="far fa-map"></i>
                    <span> Bản đồ </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.list-location') }}" class="side-nav-link">
                    <i class="uil-map-marker"></i>
                    <span> Danh Sách Địa Điểm </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false"
                    aria-controls="sidebarEcommerce" class="side-nav-link collapsed">
                    <i class="uil-plane-departure"></i>
                    <span> Quản Lí Tour </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce" style="">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.category') }}">Loại Tuor</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.tuor') }}">Danh sách tuor</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.bill') }}" class="side-nav-link">
                    <i class="uil-file-plus-alt"></i>
                    <span> Danh sách đặt tour </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.customer') }}" class="side-nav-link">
                    <i class="uil-user"></i>
                    <span> Danh Sách Khách Hàng</span>
                </a>
            </li>
        </ul>
        <!--- End Sidemenu -->
        <div class="clearfix"></div>
    </div>
</div>
