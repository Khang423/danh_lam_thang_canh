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
                        <div class="location_image">
                        </div>
                        <div class="content">
                            <div class="location_name">
                            </div>
                            <div class="location_address">
                            </div>
                            <div class="geographic_coordinates">
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
            doubleClickZoom: false
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
        // even doubleclick to map
        // map.on('dblclick', (event) => {
        //     const coordinates = event.lngLat;
        //     // point
        //     const markers = document.querySelectorAll('.mapboxgl-marker');
        //     markers.forEach(marker => marker.remove());
        //     new mapboxgl.Marker()
        //         .setLngLat([coordinates.lng, coordinates.lat])
        //         .addTo(map);

        //     lat.value = latitude.toFixed(6);
        //     lng.value = longitude.toFixed(6);
        //     fetch(
        //             `https://api.mapbox.com/geocoding/v5/mapbox.places/${longitude},${latitude}.json?access_token=pk.eyJ1Ijoidm92eWtoYWc0MjMiLCJhIjoiY20xazJkYTRpMThxajJrczhxdG5paTFraCJ9.XFUSvzMs_ROaCMtUozb2vQ`
        //         )
        //         .then(response => response.json())
        //         .then(data => {
        //             if (data.features && data.features.length > 0) {
        //                 const placeName = data.features[0].place_name; // Lấy tên vị trí đầu tiên
        //                 address.value = placeName; // Gán giá trị vào input address
        //             } else {
        //                 alert("Không tìm thấy tên vị trí.");
        //             }
        //         })
        //         .catch(error => {
        //             console.error("Lỗi khi gọi API:", error);
        //         });
        // });

        // show location from database

        const click_show_marker = (input) => {
            const name = input.name;
            const address = input.address;
            const latitude = input.latitude;
            const longtitude = input.longtitude;
            const image = input.image;
            const description = input.description;

            $('#show-info').removeClass('d-none');
            $('.location_name').html(`<h2> ${name}</h2>`);
            $('.location_address').html(
                `<i class="uil-map-marker"></i> ${address}`);
            $('.geographic_coordinates').html(
                `<i class="uil-globe"></i> ${longtitude} , ${latitude}`
            );
            $('.location_description').html(
                `<i class="uil-globe"></i> ${description}`
            );
            $('.location_image').html(
                ` <img src="${image}" data-fancybox="gallery" data-caption="${name}"> `
            );
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
                                const name = item.name;
                                const address = item.address;
                                const latitude = item.latitude;
                                const longtitude = item.longtitude;
                                const image = item.image;
                                const description = item.description;

                                $('#show-info').removeClass('d-none');
                                $('.location_name').html(`<h2> ${name}</h2>`);
                                $('.location_address').html(
                                    `<i class="uil-map-marker"></i> ${address}`);
                                $('.geographic_coordinates').html(
                                    `<i class="uil-globe"></i> ${longtitude} , ${latitude}`
                                );
                                $('.location_description').html(
                                    `<i class="uil-globe"></i> ${description}`
                                );
                                $('.location_image').html(
                                    ` <img src="${image}" data-fancybox="gallery" data-caption="${name}"> `
                                );
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
                        const lng = response.longtitude;

                        $('.list-search').removeClass('d-none');
                        $('#search-name').html(`${name}`);
                        $('#search-image').html(
                            ` <img src="${image}"> `
                        );
                        $('#gc').html(
                            `${lng} , ${lat}`
                        );

                        $('.list-search').on('click', (e) => {
                            const markers = document.querySelectorAll('.mapboxgl-marker');
                            markers.forEach(marker => marker.remove());

                            const marker = new mapboxgl.Marker()
                                .setLngLat([response.longtitude, response.latitude])
                                .addTo(map);

                            map.flyTo({
                                center: [response.longtitude, response.latitude],
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


        // map in form insert
    </script>
@endsection
