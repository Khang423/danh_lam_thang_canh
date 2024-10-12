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
                    <form id="form-info">
                        @csrf
                        <h2> Thông tin</h2>
                        <div class="content-model">
                            <label for="">Kinh Độ</label>
                            <input type="text" name="longtitude" id="lng" class="form-control">
                            <label for="">Vĩ Độ</label>
                            <input type="text" name="latitude" id="lat" class="form-control">
                            <label for="">Địa chỉ</label>
                            <br>
                            <textarea name="address" id="address" rows="4"></textarea>
                        </div>
                        <div class="footer-model">
                            <button class="btn btn-danger" type="button" id="model-close">Đóng</button>
                            <button class="btn btn-success" type="button" id="btn-submit">Thêm</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('script')
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.js"></script>
    <script>
        mapboxgl.accessToken =
            'pk.eyJ1Ijoidm92eWtoYWc0MjMiLCJhIjoiY20xazJkYTRpMThxajJrczhxdG5paTFraCJ9.XFUSvzMs_ROaCMtUozb2vQ';
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v9',
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
        map.on('click', (event) => {
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
    </script>
@endsection
