@extends('admin.main')
@section('content')

    <head>
        <style>
            .section-map #show-info .content .list_tour {
                width: 100%;
                height: 100%;
            }

            .section-map #show-info .content .list_tour .tours {
                width: 95%;
                height: 95%;
                margin: 2.5%;
                padding: 2.5%;
                border-radius: 5px;
                box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
                cursor: pointer;
            }

            .section-map #show-info .content .list_tour .tours:hover {
                background-color: rgb(230, 229, 229);
                box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
            }

            .section-map .form-order {
                height: 680px;
                width: 500px;
                background-color: white;
                position: absolute;
                top: 45%;
                left: 50%;
                transform: translate(-50%, -50%);
                border-radius: 10px;
                box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
                padding: 20px;
            }

            .section-map .form-order .btn-handle {
                position: absolute;
                bottom: 20px;
                right: 20px;
            }
        </style>
    </head>
    <div class="content">
        <div class="container-fluid"">
            <section class="section-map">
                <div class="row">
                    <div id="map">
                    </div>
                </div>
                <div class="form-group d-none" id="show-info">
                    <div class="card-body py-0" data-simplebar style="max-height: 600px;">
                        <div class="location_image">
                        </div>
                        <div class="content">
                            <div class="location_name">
                            </div>
                            <hr>
                            <div class="location_address">
                            </div>
                            <hr>
                            <div class="description" style="text-align:justify">
                            </div>
                            <hr>
                            <div class="geographic_coordinates">
                            </div>
                            <hr>
                            <h2>Tour Du Lịch </h2>
                            <div class="list_tour">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search">
                    <form id="form-search">
                        @csrf
                        <input type="text" id="search-input" name="q" placeholder="Tìm kiếm địa điểm...">
                        <i class="uil-search" type="button" id="search-button"></i>
                    </form>
                    <div class="list-search d-none">
                        <div id="search-image"> </div>
                        <div id="search-name"></div>
                        <div id="gc"></div>
                    </div>
                </div>
                <div class="form-order d-none">
                    <h3 style="text-align:center">Đặt Tuor</h3>
                    <form id="form-order">
                        @csrf
                        <div class="row mb-1">
                            <div class="col-7">
                                <label for="cus_name" class="col-form-label"> Họ và tên </label>
                                <input type="text" name="name" id="cus_name" placeholder="Nhập họ tên..."
                                    class="form-control">
                            </div>
                            <div class="col-5">
                                <label for="cus_tel" class="col-form-label"> Số điện thoại </label>
                                <input type="text" name="tel" id="cus_tel" placeholder="Nhập số điện thoại..."
                                    class="form-control">
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="cus_gmail" class="col-form-label">Gmail</label>
                            <input type="email" class="form-control" name="gmail" id="cus_gmail"
                                placeholder="Nhập gmail...">
                        </div>
                        <div class="mb-1">
                            <label for="cus_address" class="col-form-label">Địa chỉ </label>
                            <textarea name="address" id="cus_address" class="form-control" cols="0" rows="2"></textarea>
                        </div>
                        <div class="mb-1">
                            <label for="comment" class="col-form-label">Ghi chú </label>
                            <textarea name="comment" id="comment" class="form-control" cols="0" rows="2"></textarea>
                        </div>
                        <div class="mb-1" >
                            <label for="name_location" class="col-form-label">Địa điểm du lịch</label>
                            <input type="text" hidden name="location_id" value="" id="location_id">
                            <input type="email" class="form-control" id="name_location">
                        </div>
                        <div class="mb-1" >
                            <label for="name_tour" class="col-form-label">Tour du lịch</label>
                            <input type="text" hidden name="tours_id" value="" id="tour_id"">
                            <input type="email" class="form-control" id="name_tour">
                        </div>
                    </form>
                    <div class="btn-handle">
                        <button type="button" class="btn btn-danger" id="btn-close">Đóng</button>
                        <button id="submit-store" class="btn btn-success">
                            <i class="mdi mdi-plus-circle me-2"></i> Thêm
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('script')
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"></script>
    <script>
        mapboxgl.accessToken =
            'pk.eyJ1Ijoidm92eWtoYWc0MjMiLCJhIjoiY20xazJkYTRpMThxajJrczhxdG5paTFraCJ9.XFUSvzMs_ROaCMtUozb2vQ';
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            projection: 'globe',
            zoom: 11,
            center: [105.0690104, 9.9904685],
            doubleClickZoom: false,
            attributionControl: false
        });

        map.scrollZoom.enable();
        map.addControl(new mapboxgl.NavigationControl());

        map.on('style.load', () => {
            map.setFog({});
        });

        const secondsPerRevolution = 240;
        const maxSpinZoom = 5;
        const slowSpinZoom = 3;

        let userInteracting = false;
        const spinEnabled = true;

        function spinGlobe() {
            const zoom = map.getZoom();
            if (spinEnabled && !userInteracting && zoom < maxSpinZoom) {
                let distancePerSecond = 360 / secondsPerRevolution;
                if (zoom > slowSpinZoom) {
                    const zoomDif =
                        (maxSpinZoom - zoom) / (maxSpinZoom - slowSpinZoom);
                    distancePerSecond *= zoomDif;
                }
                const center = map.getCenter();
                center.lng -= distancePerSecond;
                map.easeTo({
                    center,
                    duration: 1000,
                    easing: (n) => n
                });
            }
        }

        map.on('mousedown', () => {
            userInteracting = true;
        });
        map.on('dragstart', () => {
            userInteracting = true;
        });
        map.on('moveend', () => {
            spinGlobe();
        });

        spinGlobe();

        const lat = document.getElementById("lat");
        const lng = document.getElementById("lng");
        const address = document.getElementById("address");

        $('#show-info').on('dblclick', () => {
            $('#show-info').addClass('d-none');
            show_marker();
        });


        // show location from database
        const click_show_marker = (input) => {
            const name = input.name;
            const address = input.address;
            const latitude = input.latitude;
            const longtitude = input.longtitude;
            const image = input.image;
            const description = input.description;
            const id = input.id;

            $('#show-info').removeClass('d-none');
            $('.location_name').html(`<h2> ${name}</h2>`);
            $('.location_address').html(
                `<i class="uil-map-marker"></i> ${address}`);
            $('.geographic_coordinates').html(
                `<i class="uil-globe"></i> ${longtitude} , ${latitude}`
            );
            $('.description').html(
                `<i class="uil-globe"></i> ${description}`
            );
            $('.location_image').html(
                ` <img src="${image}" data-fancybox="gallery" data-caption="${name}"> `
            );
            $('.list_tour').empty();
            $('#tour_id').empty();

            $.ajax({
                url: `{{ route('admin.tour.getAllDataForMap') }}`,
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: (result) => {
                    result.forEach((item) => {

                        const formattedPrice = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(item.price);

                        $(`<div class="tours">
                            <img src="${item.image}" data-fancybox="gallery" style="width:100%;border-radius:5px">
                            <h3>${item.name}</h3>
                            <h4>Thời Gian: ${item.category_name}</h4>
                            <div class="row">
                                <div class="col-7">
                                    <h4>${formattedPrice}</h4>
                                </div>    
                                <div class="col-5">
                                    <div class="btn btn-success" data-id="${item.id}" data-location="${item.location_id}" id="btn-order">Đặt Tour</div>
                                </div>  
                            </div>
                        </div>`).appendTo('.list_tour');
                    });
                },
                error: (error) => {

                }
            });

        };

        const show_marker = (() => {
            $.ajax({
                type: 'GET',
                url: `{{ route('admin.map.getAllLocation') }}`,
                success: (response) => {
                    let locations = response;
                    if (Array.isArray(locations)) {
                        locations.forEach((item) => {

                            let marker = new mapboxgl.Marker()
                                .setLngLat([item.longtitude, item.latitude])
                                .addTo(map);
                            let popup = new mapboxgl.Popup({
                                offset: 25
                            });
                            // show marker
                            marker.getElement().addEventListener('click', () => {
                                click_show_marker(item);
                            });
                            marker.setPopup(popup);
                        });
                    } else {
                        console.error("Dữ liệu trả về không phải là mảng", locations);
                    }
                },
                error: (xhr, status, error) => {
                    console.error("Lỗi khi lấy dữ liệu:", error);
                },
            });

        });
        show_marker();

        // move to location 
        const searchLocation = (e) => {
            let formData = new FormData($('#form-search')[0]);
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: `{{ route('admin.map.search') }}`,
                processData: false,
                contentType: false,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                },
                success: (response) => {

                    const location = response;

                    if (location) {
                        const markers = document.querySelectorAll('.mapboxgl-marker');
                        markers.forEach(marker => marker.remove());
                        const marker = new mapboxgl.Marker()
                            .setLngLat([location.longtitude, location.latitude])
                            .addTo(map);

                        map.flyTo({
                            center: [location.longtitude, location.latitude],
                            zoom: 14
                        });
                        $('#search-input').val('');
                        $('.list-search').addClass('d-none');
                        marker.getElement().addEventListener('click', () => {
                            click_show_marker(location);
                        });

                    } else {
                        alert("Không tìm thấy địa điểm.");
                    }
                },
                error: (xhr, status, error) => {
                    console.error("Lỗi khi lấy dữ liệu:", error);
                }
            });
        };

        // event click search 
        $('#search-input').on('keyup', function() {
            let query = $(this).val();
            let formData = new FormData($('#form-search')[0]);

            if (query.length > 2) {
                $.ajax({
                    type: 'POST',
                    url: `{{ route('admin.map.search') }}`,
                    processData: false,
                    contentType: false,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': `{{ csrf_token() }}`
                    },
                    success: (response) => {

                        const name = response.name;
                        const image = response.image;
                        const lat = response.latitude;
                        const lng = response.longtitude; // Sửa `longtitude` thành `longitude`

                        $('.list-search').removeClass('d-none');
                        $('#search-name').html(`${name}`);
                        $('#search-image').html(
                            `<img src="${image}">`
                        );
                        $('#gc').html(`${lng} , ${lat}`);

                        // Đảm bảo chỉ thêm sự kiện click một lần
                        $('.list-search').off('click').on('click', (e) => {
                            const markers = document.querySelectorAll('.mapboxgl-marker');
                            markers.forEach(marker => marker.remove());

                            const marker = new mapboxgl.Marker()
                                .setLngLat([response.longtitude, response
                                    .latitude
                                ]) // Sửa `longtitude` thành `longitude`
                                .addTo(map);

                            map.flyTo({
                                center: [response.longtitude, response
                                    .latitude
                                ], // Sửa `longtitude` thành `longitude`
                                zoom: 14
                            });

                            marker.getElement().addEventListener('click', () => {
                                click_show_marker(response);
                            });

                            $('.list-search').addClass('d-none');
                            $('#search-input').val('');
                        });

                    },
                    error: (xhr, status, error) => {
                        console.error("Lỗi khi lấy dữ liệu:", error);
                    }
                });
            } else {
                $('.list-search').addClass('d-none');
            }
        });

        $('#search-button').on('click', (e) => {
            searchLocation(e);
        });

        $('#search-input').on('keypress', (e) => {
            if (e.which == 13) {
                searchLocation(e);
            }
        });

        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
        $(document).on('click', '#btn-order', (e) => {
            const tourId = $(e.currentTarget).data('id'); // Hoặc dùng .attr('data-id')
            const location_id = $(e.currentTarget).data('location');
            $('.form-order').removeClass('d-none');
            
            $.ajax({
                type: 'POST',
                url: `{{ route('admin.tour.getDataForId') }}`,
                dataType: 'json',
                data: {
                    id: tourId,location_id,
                    _token: "{{ csrf_token() }}"
                },
                success: (data) => {
                    $('#name_tour').val(`${data[0].name_tour}`);
                    $('#tour_id').val(`${data[0].tour_id}`);
                    $('#name_location').val(`${data[0].name_location}`);
                    $('#location_id').val(`${data[0].location_id}`);
                },
                error: (error) => {
                    console.log('error', error);
                }
            });
        });
        $(document).on('click', '#submit-store', (e) => {
            let formData = new FormData($('#form-order')[0]);

            $.ajax({
                type: 'POST',
                url: `{{ route('admin.bill.store') }}`,
                processData: false,
                contentType: false,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                },
                success: (data) => {
                    console.log('Thêm thành công',data);
                    $('.form-order').addClass('d-none');
                    $('#modal-create').find('form')[0].reset();
                },
                error: (error) => {
                    console.log('error', error);
                }
            });
        });

        $(document).on('click', '#btn-close', (event) => {
            $('.form-order').addClass('d-none');
        });
    </script>
@endsection
