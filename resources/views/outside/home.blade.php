@include('admin.global.style-import')
@include('admin.global.script-import')
<style>
    body {
        margin: 0px;
    }

    .section-map .row #map {
        margin-top: 0px;
    }

    .section-map #show-info {
        width: 400px;
        height: 809px;
        background-color: white;
        position: absolute;
        top: 0px;
        left: 0px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }

    .section-map #show-info input[type="text"] {
        width: 100%;
        height: 30px;
        outline: none;
    }

    .section-map #show-info textarea {
        width: 100%;
        border-radius: 5px;
        border: none;
    }

    .section-map #show-info h2 {
        font-weight: 200;
        text-align: center;
    }

    .mapboxgl-canvas {
        width: 100%;
    }

    modal-dialog {
        width: 700px;
    }

    .section-map #show-info .location_image img {
        height: 250px;
        width: 100%;
        border-bottom: 1px solid black;
    }

    .section-map #show-info .location_address,
    .geographic_coordinates {
        font-size: 16px;
    }

    .section-map #show-info h2 {
        font-size: 22px;
        color: black;
        text-align: start;
    }

    .section-map #show-info .content {
        width: 100%;
        height: 100%;
        padding: 15px 25px;
    }

    .section-map .search {
        position: absolute;
        top: 20px;
        height: 50px;
        left: 20px;
        width: 350px;
    }

    .section-map .search input {
        width: 100%;
        height: 100%;
        border-radius: 25px;
        border: none;
        outline: none;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        padding-left: 20px;
        font-size: 16px;
    }

    .section-map .search #search-button {
        position: absolute;
        top: 17px;
        left: 315px;
        font-size: 20;
    }

</style>
<div class="content">
    <div class="container-fluid"">
        <section class="section-map">
            <div class="row">
                <div id="map" style="height: 800px;width:100%">
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
                        <div class="location_description"></div>
                    </div>
                </div>
            </div>
            <div class="search">
                <form id="form-search">
                    @csrf
                    <input type="text" id="search-input" name="q" placeholder="Tìm kiếm địa điểm...">
                    <i class="uil-search" type="button" id="search-button"></i>
                </form>
            </div>
        </section>
    </div>
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

        map.on('click', () => {
            $('#show-info').addClass('d-none');
            showLocation();

        });
        // even doubleclick to map
        // map.on('dblclick', (event) => {
        //     const coordinates = event.lngLat;
        //     const longitude = coordinates.lng;
        //     const latitude = coordinates.lat;

        //     // point
        //     const markers = document.querySelectorAll('.mapboxgl-marker');
        //     markers.forEach(marker => marker.remove());
        //     new mapboxgl.Marker()
        //         .setLngLat([coordinates.lng, coordinates.lat])
        //         .addTo(map);

        //     $('#show-info').removeClass('d-none');
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
        const showLocation = (() => {
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
                            marker.getElement().addEventListener('dblclick', () => {
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
                                $('.location_image').html(` <img src="${image}"> `);
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

        // function search location
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
                    console.log(location);
                    console.log(location[0].longtitude);
                    if (location) {
                        const markers = document.querySelectorAll('.mapboxgl-marker');
                        markers.forEach(marker => marker.remove());

                        const marker = new mapboxgl.Marker()
                            .setLngLat([location[0].longtitude, location[0].latitude])
                            .addTo(map);

                        map.flyTo({
                            center: [location[0].longtitude, location[0].latitude],
                            zoom: 14
                        });

                        const name = location[0].name;
                        const address = location[0].address;
                        const latitude = location[0].latitude;
                        const longtitude = location[0].longtitude;
                        const image = location[0].image;
                        const description = location[0].description;

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
                        $('.location_image').html(` <img src="${image}"> `);
                    } else {
                        alert("Không tìm thấy địa điểm.");
                    }
                },
                error: (xhr, status, error) => {
                    console.error("Lỗi khi lấy dữ liệu:", error);
                }
            });
        };

        $('#search-button').on('click', (e) => {
            searchLocation(e);
        });
        $('#search-input').on('keypress', (e) => {
            if (e.which == 13) {
                searchLocation(e);
            }
        });
    </script>
