@extends('admin.main')
@section('content')
    <div class="row">
        <div class="col-sm-6 col-xxl-3 col-lg-6">
            <div class="b-b-primary border-5 border-0 card o-hidden">
                <div class="custome-1-bg b-r-4 card-body">
                    <div class="media align-items-center static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Total Earnings</span>
                            <h4 class="mb-0 counter">
                                6659
                                <span class="badge badge-light-primary grow"><i data-feather="trending-up">
                                    </i>8.5%</span>
                            </h4>
                        </div>
                        <div class="align-self-center text-center">
                            <i class="fa-solid fa-database"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xxl-3 col-lg-6">
            <div class="b-b-danger border-5 border-0 card o-hidden">
                <div class="custome-2-bg b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Total Booking</span>
                            <h4 class="mb-0 counter">
                                9856
                                <span class="badge badge-light-danger grow"><i data-feather="trending-down">
                                    </i>8.5%</span>
                            </h4>
                        </div>
                        <div class="align-self-center text-center">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xxl-3 col-lg-6">
            <div class="b-b-secondary border-5 border-0 card o-hidden">
                <div class="custome-3-bg b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Reviews</span>
                            <h4 class="mb-0 counter">
                                893
                                <span class="badge badge-light-secondary grow"><i data-feather="trending-up">
                                    </i>8.5%</span>
                            </h4>
                        </div>
                        <div class="align-self-center text-center">
                            <i class="fa-regular fa-comment"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xxl-3 col-lg-6">
            <div class="b-b-success border-5 border-0 card o-hidden">
                <div class="custome-4-bg b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Total User</span>
                            <h4 class="mb-0 counter">
                                45631
                                <span class="badge badge-light-success grow"><i data-feather="trending-down">
                                    </i>8.5%</span>
                            </h4>
                        </div>
                        <div class="align-self-center text-center">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- datepicker start -->
        <div class="col-lg-6 col-xxl-4">
            <div class="datepicker-dashboard">
                <div class="datepicker-here" data-language="en"></div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header-title card-header">
                    <h5>Tours</h5>
                </div>
                <div class="card-body">
                    <div class="dashboard-tours ratio3_2">
                        <div class="w-100 dashboard-slider">
                            <div class="category-box">
                                <div class="img-category">
                                    <div class="img-category-box">
                                        <img src="{{ asset('assets/systems/3.jpg') }}" alt=""
                                            class="img-fluid bg-img" />
                                    </div>
                                    <div class="top-bar">
                                        <span class="offer">offer</span>
                                        <h5>
                                            <del>$320</del>
                                            $210
                                        </h5>
                                    </div>
                                    <div class="like-cls">
                                        <i class="fa fa-heart"><span class="effect"></span></i>
                                    </div>
                                </div>
                                <div class="content-category">
                                    <div class="top">
                                        <h3>
                                            hot air balloon
                                        </h3>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor
                                        sit amet,
                                        consectetur est.
                                    </p>
                                    <h6>
                                        5 days | 6 nights
                                        <span>
                                            2 person</span>
                                    </h6>
                                </div>
                            </div>

                            <div class="category-box">
                                <div class="img-category">
                                    <div class="img-category-box">
                                        <img src="{{ asset('assets/systems/3.jpg') }}" alt=""
                                            class="img-fluid bg-img" />
                                    </div>
                                    <div class="top-bar">
                                        <span class="offer">offer</span>
                                        <h5>
                                            <del>$320</del>
                                            $210
                                        </h5>
                                    </div>
                                    <div class="like-cls">
                                        <i class="fa fa-heart"><span class="effect"></span></i>
                                    </div>
                                </div>
                                <div class="content-category">
                                    <div class="top">
                                        <h3>
                                            hot air balloon
                                        </h3>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor
                                        sit amet,
                                        consectetur est.
                                    </p>
                                    <h6>
                                        5 days | 6 nights
                                        <span>
                                            2 person</span>
                                    </h6>
                                </div>
                            </div>

                            <div class="category-box">
                                <div class="img-category">
                                    <div class="img-category-box">
                                        <img src="{{ asset('assets/systems/3.jpg') }}" alt=""
                                            class="img-fluid bg-img" />
                                    </div>
                                    <div class="top-bar">
                                        <span class="offer">offer</span>
                                        <h5>
                                            <del>$320</del>
                                            $210
                                        </h5>
                                    </div>
                                    <div class="like-cls">
                                        <i class="fa fa-heart"><span class="effect"></span></i>
                                    </div>
                                </div>
                                <div class="content-category">
                                    <div class="top">
                                        <h3>
                                            hot air balloon
                                        </h3>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor
                                        sit amet,
                                        consectetur est.
                                    </p>
                                    <h6>
                                        5 days | 6 nights
                                        <span>
                                            2 person</span>
                                    </h6>
                                </div>
                            </div>
                            <div class="category-box">
                                <div class="img-category">
                                    <div class="img-category-box">
                                        <img src="{{ asset('assets/systems/3.jpg') }}" alt=""
                                            class="img-fluid bg-img" />
                                    </div>
                                    <div class="top-bar">
                                        <span class="offer">offer</span>
                                        <h5>
                                            <del>$320</del>
                                            $210
                                        </h5>
                                    </div>
                                    <div class="like-cls">
                                        <i class="fa fa-heart"><span class="effect"></span></i>
                                    </div>
                                </div>
                                <div class="content-category">
                                    <div class="top">
                                        <h3>
                                            hot air balloon
                                        </h3>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor
                                        sit amet,
                                        consectetur est.
                                    </p>
                                    <h6>
                                        5 days | 6 nights
                                        <span>
                                            2 person</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
