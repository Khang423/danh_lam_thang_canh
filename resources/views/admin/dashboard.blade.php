@extends('admin.main')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Tổng lượt đặt
                                        Tour
                                        <h3 class="my-2 py-1"> {{ $sumBooking }}</h3>
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
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">Tours </h5>
                                    <h3 class="my-2 py-1">{{ $sumTour }}</h3>
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
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Deals">Danh lam thang canh
                                    </h5>
                                    <h3 class="my-2 py-1">{{ $sumLocation }}</h3>
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
                                    <h3 class="py-1">{{ $totalAmount }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pt-0">
                            <h3 class="py-1">Tìm Kiếm </h3>
                            <form id="form-search">
                                @csrf
                                <div class="row ">
                                    <div class="col-2">
                                        <label for="datepicker" class="col-form-label"> Từ Ngày</label>
                                        <input type="text" class="form-control" name="fromday" id="from_datepicker">
                                    </div>
                                    <div class="col-2">
                                        <label for="datepicker" class="col-form-label"> Đến Ngày </label>
                                        <input type="text" class="form-control" name="today" id="to_datepicker">
                                    </div>
                                    <div class="col-2">
                                        <button id="submit" type="button" class="btn btn-success mt-4">
                                            <i class="uil uil-search"></i> Tìm Kiếm
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pt-0">
                            <h3 class="py-1">Thống kê </h3>
                            <figure class="highcharts-figure">
                                <div id="container"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(() => {
            $.datepicker.regional['vi'] = {
                closeText: 'Đóng',
                prevText: 'Trước',
                nextText: 'Sau',
                currentText: 'Hôm nay',
                monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                    'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                ],
                monthNamesShort: ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6',
                    'Th7', 'Th8', 'Th9', 'Th10', 'Th11', 'Th12'
                ],
                dayNames: ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'],
                dayNamesShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                weekHeader: 'Tu',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };

            $.datepicker.setDefaults($.datepicker.regional['vi']);
            $("#from_datepicker").datepicker();
            $("#to_datepicker").datepicker();
        });
        
        const chart = () => {
            $.ajax({
                url: `{{ route('admin.detail_bill.getDataForChart') }}`,
                type: 'GET',
                dataType: 'json',
                success: (data) => {
                    // Tạo các mảng để chứa các ngày và tổng số tiền
                    let dates = [];
                    let totals = [];

                    // Duyệt qua từng item và thêm dữ liệu vào mảng
                    data.forEach(item => {
                        dates.push(item.date); // Lưu các ngày vào mảng
                        totals.push(item.total); // Lưu tổng tiền vào mảng
                    });
                    $('.highcharts-credits').addClass('d-none');
                    // Vẽ biểu đồ với dữ liệu đã thu thập
                    Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Biểu đồ lượt đặt tour du lịch',
                            align: 'center'
                        },
                        xAxis: {
                            categories: dates, // Sử dụng mảng dates để hiển thị trên trục X
                        },
                        yAxis: {
                            title: {
                                text: 'Tổng tiền (VNĐ)'
                            }
                        },
                        tooltip: {
                            valueSuffix: ' VNĐ'
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'Tổng tiền',
                            data: totals // Sử dụng mảng totals để hiển thị trên biểu đồ
                        }]
                    });
                },
                error: (error) => {
                    console.error('Error:', error);
                },
            });
        };
        chart();

        $('#submit').on('click', (e) => {
            e.preventDefault();
            let formData = new FormData($('#form-search')[0]);

            $.ajax({
                url: `{{ route('admin.detail_bill.searchChart') }}`,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                },
                processData: false,
                contentType: false,
                success: (result) => {
                    console.log('data :', result);
                    let dates = [];
                    let totals = [];

                    // Duyệt qua từng item và thêm dữ liệu vào mảng
                    result.forEach(item => {
                        dates.push(item.name); // Lưu các ngày vào mảng
                        totals.push(item.total); // Lưu tổng tiền vào mảng
                    });

                    // Vẽ biểu đồ với dữ liệu đã thu thập
                    Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Biểu đồ lượt đặt tour du lịch',
                            align: 'center'
                        },
                        xAxis: {
                            categories: dates, // Sử dụng mảng dates để hiển thị trên trục X
                        },
                        yAxis: {
                            title: {
                                text: 'Tổng tiền (VNĐ)'
                            }
                        },
                        tooltip: {
                            valueSuffix: ' VNĐ'
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'Tổng tiền',
                            data: totals // Sử dụng mảng totals để hiển thị trên biểu đồ
                        }]
                    });
                },
                error: (error) => {

                },
            });

        });
    </script>
@endsection
