@extends('admin.main')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item active">CRM</li>
                            </ol>
                        </div>
                        <h4 class="page-title">CRM</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Khách hàng
                                    </h5>
                                    <h3 class="my-2 py-1"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">Giàn Cơ Bản </h5>
                                    <h3 class="my-2 py-1"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Deals"> Giàn Cao Cấp</h5>
                                    <h3 class="my-2 py-1"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Booked Revenue">Doanh số</h5>
                                    <h3 class="py-1"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="header-title">Tỉ lệ bán của giàn</h4>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item">Today</a>
                                    <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                                    <a href="javascript:void(0);" class="dropdown-item">Last Week</a>
                                    <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div id="dash-campaigns-chart" class="apex-charts" data-colors="#ffbc00,#727cf5,#0acf97"></div>
                            <div class="row text-center mt-3">
                                <div class="col-sm-6">
                                    <i class="mdi mdi-send widget-icon rounded-circle bg-warning-lighten text-warning"></i>
                                    <h3 class="fw-normal mt-3">
                                        <span></span>
                                    </h3>
                                    <p class="text-muted mb-0 mb-2"><i
                                            class="mdi mdi-checkbox-blank-circle text-warning"></i> Cơ Bản</p>
                                </div>
                                <div class="col-sm-6">
                                    <i
                                        class="mdi mdi-flag-variant widget-icon rounded-circle bg-primary-lighten text-primary"></i>
                                    <h3 class="fw-normal mt-3">
                                        <span></span>
                                    </h3>
                                    <p class="text-muted mb-0 mb-2"><i
                                            class="mdi mdi-checkbox-blank-circle text-primary"></i> Cao Cấp</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script></script>
@endsection
