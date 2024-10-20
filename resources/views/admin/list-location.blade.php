@extends('admin.main')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tour</a></li>
                                <li class="breadcrumb-item active"> Điểm du lịch </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Danh sách điểm du lịch</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal"
                                        onclick="showSuccessToast();" data-bs-target="#modal-create">
                                        <i class="mdi mdi-plus-circle me-2"></i> Thêm điểm du lịch
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-centered table-borderless table-hover w-100 dt-responsive nowrap"
                                    id="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên </th>
                                            <th>Ảnh</th>
                                            <th style="max-width: 100px;">Địa chỉ</th>
                                            <th>Thời gian</th>
                                            <th style="width: 80px;">Hành động</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Model add --}}
    <div class="modal fade" id="modal-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog">
            <div class="card-body py-0" data-simplebar style="max-height: 600px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Thêm địa điểm </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-create">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="loc_img"
                                            class="btn btn-info select-image-update mb-2 font-weight-normal d-block">
                                            <i class="uil-images"></i>
                                            Chọn ảnh địa điểm
                                        </label>
                                        <input type="file" hidden name="location_image" id="loc_img"
                                            onchange="readURL(this);">
                                        <img class="d-none" id="preview" src="http://placehold.it/180"
                                            style="width:100%;height:300px" />
                                    </div>

                                    <div class="mb-1">
                                        <label for="name" class="col-form-label">Tên địa điểm</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Tên điểm du lịch">
                                        <div class="invalid-feedback error-name"></div>
                                    </div>

                                    <div class="mb-1">
                                        <label for="description" class="col-form-label">Mô tả</label>
                                        <textarea class="form-control" id="description" name="description" placeholder="Mô tả ngắn" style="height:100px"></textarea>
                                    </div>

                                    <div class="mb-1">
                                        <label for="description" class="col-form-label">Địa chỉ</label>
                                        <textarea class="form-control" id="address" name="address" placeholder="Địa chỉ" style="height:100px"></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="mb-1 col-6">
                                            <label for="longtitude" class="col-form-label">Kinh độ</label>
                                            <input type="text" class="form-control" id="lng" name="longtitude"
                                                placeholder="Kinh độ">
                                        </div>
                                        <div class="mb-1 col-6">
                                            <label for="latitude" class="col-form-label">Vĩ độ</label>
                                            <input type="text" class="form-control" id="lat" name="latitude"
                                                placeholder="Vĩ độ">
                                        </div>
                                    </div>

                                    <div class="mb-1">
                                        <div id="map" style="width:100%;height:200px"></div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button id="submit-store" class="btn btn-primary">
                            <i class="mdi mdi-plus-circle me-2"></i> Thêm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Model update --}}
    <div class="modal fade" id="modal-update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="card-body py-0" data-simplebar style="max-height: 600px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Cập nhật địa điểm </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-update">
                            @csrf
                            <input type="hidden" name="id">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="loc_img-update"
                                            class="btn btn-info select-image-update mb-2 font-weight-normal d-block">
                                            <i class="uil-images"></i>
                                            Chọn ảnh địa điểm
                                        </label>
                                        <input type="file" hidden name="location_image" id="loc_img-update"
                                            onchange="readURLUpdate(this);">
                                        <img class="d-none" id="preview-update" style="width:100%;height:300px" />
                                    </div>

                                    <div class="mb-1">
                                        <label for="name" class="col-form-label">Tên địa điểm</label>
                                        <input type="text" class="form-control" id="name-update" name="name"
                                            placeholder="Tên điểm du lịch">
                                        <div class="invalid-feedback error-name"></div>
                                    </div>

                                    <div class="mb-1">
                                        <label for="description" class="col-form-label">Mô tả</label>
                                        <textarea class="form-control" id="description-update" name="description" placeholder="Mô tả ngắn"
                                            style="height:100px"></textarea>
                                    </div>

                                    <div class="mb-1">
                                        <label for="description" class="col-form-label">Địa chỉ</label>
                                        <textarea class="form-control" id="address-update" name="address" placeholder="Địa chỉ" style="height:100px"
                                            value=""></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="mb-1 col-6">
                                            <label for="longtitude" class="col-form-label">Kinh độ</label>
                                            <input type="text" class="form-control" id="lng-update" name="longtitude"
                                                placeholder="Kinh độ">
                                        </div>
                                        <div class="mb-1 col-6">
                                            <label for="latitude" class="col-form-label">Vĩ độ</label>
                                            <input type="text" class="form-control" id="lat-update" name="latitude"
                                                placeholder="Vĩ độ">
                                        </div>
                                    </div>

                                    <div class="mb-1">
                                        <div id="map" style="width:100%;height:200px"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button id="submit-update" class="btn btn-primary">
                            <i class="mdi mdi-plus-circle me-2"></i> Thêm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Model delete --}}
    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="model-delete-label" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-sm-down">
            <form id="form-delete">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-content">
                    <div class="modal-header text-bg-danger">
                        <h5 class="modal-title" id="model-delete-label">Xác nhận xoá đơn vị đo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Nội dung sẽ bị xóa vĩnh viễn, bạn có chắc ?
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="btn btn-light" data-bs-dismiss="modal">Huỷ</a>
                        <button type="button" class="btn btn-danger" id="submit-delete">Xoá</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- toast --}}
    <div id="toast"></div>
@endsection
@section('script')
    <script>
        let table = $('#table').DataTable({
            responsive: true,
            ajax: {
                url: `{{ route('admin.list-location.getList') }}`,
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    orderable: true,
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: true,
                },
                {
                    data: 'image',
                    name: 'image',
                },
                {
                    data: 'address',
                    name: 'address',
                    orderable: true
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true
                },
            ],
            pageLength: $('#_pageLength').val(),
        });

        // Delete
        $('body').on('click', '.btn-delete', function() {
            $('#modal-delete').find('input[name="id"]').val($(this).attr('data-id'));
        })
        $('#submit-delete').on('click', function(e) {
            e.preventDefault();
            let _this = $(this);
            let formData = new FormData($('#form-delete')[0]);
            let routeDelete = `{{ route('admin.list-location.delete') }}`
            $.ajax({
                type: 'POST',
                url: routeDelete,
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    _this.prop('disabled', true);
                },
                success: function(result) {
                    _this.prop('disabled', false);
                    $('#modal-delete').modal('hide');
                    $('#modal-delete').find('form')[0].reset();
                    table.ajax.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    _this.prop('disabled', false);
                }
            })
        })

        //map-modal-create
        $('#modal-create').on('shown.bs.modal', () => {
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
        });

        // map modal update
        $('#modal-update').on('shown.bs.modal', () => {
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

            const lat = document.getElementById("lat-update");
            const lng = document.getElementById("lng-update");
            const address = document.getElementById("address-update");
            // even click to map
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
        });
        // select image create
        const readURL = (input) => {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview').attr('src', e.target.result).removeClass('d-none'); // Hiển thị ảnh mới
                };
                reader.readAsDataURL(input.files[0]);
            }
        };
        // select image update
        const readURLUpdate = (input) => {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-update').removeAttr('src');
                    $('#preview-update').attr('src', e.target.result).removeClass('d-none'); // Hiển thị ảnh mới
                };
                reader.readAsDataURL(input.files[0]);
            }
        };

        // submit store
        $('#submit-store').on('click', (e) => {
            e.preventDefault();
            let formData = new FormData($('#form-create')[0]);

            $.ajax({
                type: 'POST',
                url: `{{ route('admin.list-location.store') }}`,
                processData: false,
                contentType: false,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                },
                success: (data) => {
                    console.log('Thêm thành công', data);
                    $('#modal-create').modal('hide'); // Ẩn modal nếu muốn
                    $('#modal-create').find('form')[0].reset();
                    table.ajax.reload();
                },
                error: (error) => {
                    console.log('error', error);
                }
            });
        });
        // show modal update
        $(document).on('click', '.btn-update', (e) => {
            let id = $(e.currentTarget).data('id');

            $('#modal-update').off('shown.bs.modal').on('shown.bs.modal', function() {
                let lng = document.getElementById('lng-update');
                let lat = document.getElementById('lat-update');
                let name = document.getElementById('name-update');
                let description = document.getElementById('description-update');
                let address = document.getElementById('address-update');
                let image = $('#preview-update');

                $.ajax({
                    url: "{{ route('admin.list-location.getDataForUpdate') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: (result) => {
                        lng.value = result.data[0].longtitude;
                        lat.value = result.data[0].latitude;
                        name.value = result.data[0].name;
                        description.value = result.data[0].description;
                        address.value = result.data[0].address;
                        image.attr('src', result.data[0].image).removeClass('d-none');
                    },
                    error: (error) => {
                        console.log(error);
                    }
                });
            });
        });

        $('body').on('click', '.btn-update', function() {
            $('#modal-update').find('input[name="id"]').val($(this).attr('data-id'));
        })
        // submit update
        $('#submit-update').on('click', (e) => {
            e.preventDefault();
            let formData = new FormData($('#form-update')[0]);

            $.ajax({
                type: 'POST',
                url: `{{ route('admin.list-location.update') }}`,
                processData: false,
                contentType: false,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                },
                success: (data) => {
                    console.log('Cập nhật thành công', data);
                    $('#modal-update').modal('hide'); // Ẩn modal sau khi cập nhật
                    $('#modal-update').find('form')[0].reset(); // Reset form sau khi cập nhật
                    table.ajax.reload(); // Tải lại dữ liệu bảng
                },
                error: (error) => {
                    console.log('Lỗi', error);
                }
            });
        });
    </script>
@endsection
