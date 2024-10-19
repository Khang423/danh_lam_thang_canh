@extends('admin.main')
@section('content')
    <div class="content">
        <div class="container-fluid"">
            <section class="section-map">
                <div class="row">
                    <div id="map">
                    </div>
                </div>
                <div class="form-group d-none" id="show-info">
                    <div class="card-body py-0" data-simplebar style="max-height: 600px;">
                        <div class="image_location">
                            <img src="https://lh5.googleusercontent.com/p/AF1QipMQ305ZrmO2Gl3-uu64u0awwGBw6my0vFyoPd5a=w408-h306-k-no"
                                alt="">
                        </div>
                        <div class="content">
                            <div class="location_name">
                                <h2> Chua Ho Quoc</h2>
                            </div>
                            <div class="location_address">
                                <i class="uil-map-marker"></i> 91100, Vĩnh Hiệp, Rạch Giá, Kiên Giang, Vietnam
                            </div>
                            <div class="geographic_coordinates">
                                <i class="uil-globe"></i> 105.117484 , 9.960230
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-bar">
                    <input type="text">
                </div>  
            </section>
        </div>
    </div>
@endsection
@section('script')
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"></script>
    <!-- plugin js -->
    <script src="assets/vendor/dropzone/min/dropzone.min.js"></script>
    <!-- init js -->
    <script src="assets/js/ui/component.fileupload.js"></script>
    <script>
        mapboxgl.accessToken =
            'pk.eyJ1Ijoidm92eWtoYWc0MjMiLCJhIjoiY20xazJkYTRpMThxajJrczhxdG5paTFraCJ9.XFUSvzMs_ROaCMtUozb2vQ';
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            projection: 'globe',
            zoom: 11,
            center: [105.0690104, 9.9904685]
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
        // even click to map
        map.on('click', () => {
            $('#show-info').addClass('d-none');
            $('.section-map').find('#form-insert').addClass('d-none');
        });
        map.on('dblclick', (event) => {
            const coordinates = event.lngLat;
            const longitude = coordinates.lng;
            const latitude = coordinates.lat;

            // point
            const markers = document.querySelectorAll('.mapboxgl-marker');
            markers.forEach(marker => marker.remove());
            new mapboxgl.Marker()
                .setLngLat([coordinates.lng, coordinates.lat])
                .addTo(map);

            $('#show-info').removeClass('d-none');
            g
            lat.value = latitude.toFixed(6);
            lng.value = longitude.toFixed(6);
            fetch(
                    `https://api.mapbox.com/geocoding/v5/mapbox.places/${longitude},${latitude}.json?access_token=pk.eyJ1Ijoidm92eWtoYWc0MjMiLCJhIjoiY20xazJkYTRpMThxajJrczhxdG5paTFraCJ9.XFUSvzMs_ROaCMtUozb2vQ`
                )
                .then(response => response.json())
                .then(data => {
                    if (data.features && data.features.length > 0) {
                        const placeName = data.features[0].place_name; // Lấy tên vị trí đầu tiên
                        address.value = placeName; // Gán giá trị vào input address
                    } else {
                        alert("Không tìm thấy tên vị trí.");
                    }
                })
                .catch(error => {
                    console.error("Lỗi khi gọi API:", error);
                });
        });
        // hadle event insert data to database
        $('#btn-submit').click((e) => {
            let formData = new FormData($('#form-info')[0]);
            $.ajax({
                type: 'POST',
                url: `{{ route('admin.map.store') }}`,
                data: formData,
                processData: false,
                contentType: false,

                success: (result) => {
                    console.log('success');
                },
                error: () => {
                    console.log('error');
                },
            })
        });
        // show location from database
        const showLocation = (() => {
            $.ajax({
                type: 'GET',
                url: `{{ route('admin.map.getAllLocation') }}`,
                success: (response) => {
                    let locations = response;
                    // Kiểm tra nếu locations là mảng
                    if (Array.isArray(locations)) {
                        locations.forEach((item) => {
                            console.log('item:', item)
                            let marker = new mapboxgl.Marker()
                                .setLngLat([item.longtitude, item.latitude])
                                .addTo(map);
                            let popup = new mapboxgl.Popup({
                                offset: 25
                            });
                            // Hiển thị popup khi di chuột vào marker
                            marker.getElement().addEventListener('mouseenter', () => {
                                popup.addTo(map); // Thêm popup vào bản đồ
                                currentPopup = popup; // Ghi nhớ popup hiện tại
                                lat.value = item.longtitude;
                                lng.value = item.latitude;
                                address.value = item.address;
                                $('#show-info').removeClass('d-none');
                            });
                            marker.getElement().addEventListener('mouseleave', () => {
                                if (currentPopup === popup) {
                                    popup.remove(); // Xóa popup khỏi bản đồ
                                    currentPopup = null; // Đặt lại biến hiện tại
                                }
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
        showLocation();

        $('#model-close').click(() => {
            $('#show-info').addClass('d-none');
            const markers = document.querySelectorAll('.mapboxgl-marker');
            markers.forEach(marker => marker.remove());
            showLocation();
        });

        // click button add data
        $('.btn-plus').on('click', () => {
            $('.section-map').find('#form-insert').removeClass('d-none');
            
        });

        $('#btn-close').on('click', () => {
            $('.section-map').find('#form-insert').addClass('d-none');
        });
        // map in form insert
    </script>
@endsection
