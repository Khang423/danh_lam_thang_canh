<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-lg-2 gap-1">
            <div class="logo-topbar">
                <a href="" class="logo-light">
                    <span class="logo-lg">
                        <img src="https://coderthemes.com/hyper/saas/assets/images/logo.png" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="https://coderthemes.com/hyper/saas/assets/images/logo-sm.png}" alt="small logo">
                    </span>
                </a>
                <!-- Logo Dark -->
                <a href="" class="logo-dark">
                    <span class="logo-lg">
                        <img src="https://coderthemes.com/hyper/saas/assets/images/logo-dark.png" alt="dark logo">
                    </span>
                    <span class="logo-sm">
                        <img src="https://coderthemes.com/hyper/saas/assets/images/logo-dark-sm.png" alt="small logo">
                    </span>
                </a>
            </div>
            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>
            <!-- Horizontal Menu Toggle Button -->
            <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <!-- Topbar Search Form -->
        </div>
        <ul class="topbar-menu d-flex align-items-center gap-3">
            <li class="dropdown d-lg-none">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ri-search-line font-22"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                    <form class="p-3">
                        <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                    </form>
                </div>
            </li>
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ri-notification-3-line font-22"></i>
                    <span class="noti-icon-badge"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                    <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 font-16 fw-semibold"> Notification</h6>
                            </div>
                            <div class="col-auto">
                                <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                    <small>Clear All</small>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="px-2" style="max-height: 300px;" data-simplebar>
                        <h5 class="text-muted font-13 fw-normal mt-2">Today</h5>
                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2">
                            <div class="card-body">
                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon bg-primary">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold font-14">Datacorp <small class="fw-normal text-muted ms-1">1 min ago</small></h5>
                                        <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                            <div class="card-body">
                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon bg-info">
                                            <i class="mdi mdi-account-plus"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold font-14">Admin <small class="fw-normal text-muted ms-1">1 hours ago</small></h5>
                                        <small class="noti-item-subtitle text-muted">New user registered</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <h5 class="text-muted font-13 fw-normal mt-0">Yesterday</h5>
                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                            <div class="card-body">
                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon">
                                            <img src="{{ asset('assets/systems/avatar-default.jpg') }}" class="img-fluid rounded-circle" alt="" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold font-14">Cristina Pride <small class="fw-normal text-muted ms-1">1 day ago</small></h5>
                                        <small class="noti-item-subtitle text-muted">Hi, How are you? What about our next meeting</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <h5 class="text-muted font-13 fw-normal mt-0">30 Dec 2021</h5>
                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                            <div class="card-body">
                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon bg-primary">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold font-14">Datacorp</h5>
                                        <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                            <div class="card-body">
                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon">
                                            <img src="{{ asset('assets/systems/avatar-default.jpg') }}" class="img-fluid rounded-circle" alt="" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold font-14">Karen Robinson</h5>
                                        <small class="noti-item-subtitle text-muted">Wow ! this admin looks good and awesome design</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="text-center">
                            <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item border-top py-2">
                        View All
                    </a>
                </div>
            </li>
            
            <li class="d-none d-sm-inline-block">
                <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left" title="Theme Mode">
                    <i class="ri-moon-line font-22"></i>
                </div>
            </li>
            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="user-image" width="32" class="rounded-circle">
                    </span>
                    <span class="d-lg-flex flex-column gap-1 d-none">
                        <h5 class="my-0">{{ Auth::user()->full_name }}</h5>
                        <h6 class="my-0 fw-normal">Founder</h6>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Xin chào !</h6>
                    </div>
                    <a href="" class="dropdown-item">
                        <i class="mdi mdi-account-circle me-1"></i>
                        <span>Tài khoản</span>
                    </a>
                    <a href="{{ route('admin.logout') }}" class="dropdown-item">
                        <i class="mdi mdi-logout me-1"></i>
                        <span>Đăng xuất</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>