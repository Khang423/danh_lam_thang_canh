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
                                <li class="breadcrumb-item active"> Danh sách tour </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Danh sách sách tour</h4>
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
                                        data-bs-target="#modal-create">
                                        <i class="mdi mdi-plus-circle me-2"></i> Thêm tour
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-centered table-borderless table-hover w-100 dt-responsive nowrap"
                                    id="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên</th>
                                            <th>Ảnh</th>
                                            <th>Loại Tour</th>
                                            <th>Giá</th>
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
                        <h5 class="modal-title" id="staticBackdropLabel">Thêm tour </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-create">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="tour_image"
                                            class="btn btn-info select-image-update mb-2 font-weight-normal d-block">
                                            <i class="uil-images"></i>
                                            Chọn ảnh
                                        </label>
                                        <input type="file" hidden name="tour_image" id="tour_image"
                                            onchange="readURL(this);">
                                        <img class="d-none" id="preview" src="http://placehold.it/180"
                                            style="width:100%;height:300px" />
                                    </div>

                                    <div class="mb-1">
                                        <label for="name" class="col-form-label">Tên tour</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Tên điểm du lịch">
                                        <div class="invalid-feedback error-name"></div>
                                    </div>

                                    <div class="mb-1">
                                        <label for="description" class="col-form-label">Mô tả ngắn</label>
                                        <textarea class="form-control" id="description" name="short_description" placeholder="Mô tả ngắn" style="height:100px"></textarea>
                                    </div>

                                    <div class="mb-1">
                                        <label for="description" class="col-form-label">Giá</label>
                                        <input type="text" class="form-control" name="price" id="price"
                                            placeholder="Nhập giá tiền">
                                    </div>

                                    <div class="mb-1">
                                        <label for="category_id" class="col-form-label">Loại Tour</label>
                                        <select class="form-select mb-3" id="category_id" name="category_id">
                                            <option value="" selected> Chọn loại tour</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                        <button id="submit-store" class="btn btn-success">
                            <i class="mdi mdi-plus-circle me-2"></i> Thêm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Model update --}}
    <div class="modal fade" id="modal-update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog">
            <div class="card-body py-0" data-simplebar style="max-height: 600px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Cập nhật tour </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-update">
                            @csrf
                            <input type="hidden" name="id">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="tour_img-update"
                                            class="btn btn-info select-image-update mb-2 font-weight-normal d-block">
                                            <i class="uil-images"></i>
                                            Chọn ảnh
                                        </label>
                                        <input type="file" hidden name="tour_image" id="tour_img-update"
                                            onchange="readURLUpdate(this);">
                                        <img class="d-none" id="preview-update" src="http://placehold.it/180"
                                            style="width:100%;height:300px" />
                                    </div>

                                    <div class="mb-1">
                                        <label for="name" class="col-form-label">Tên tour</label>
                                        <input type="text" class="form-control" id="name-update" name="name"
                                            placeholder="Tên điểm du lịch">
                                        <div class="invalid-feedback error-name"></div>
                                    </div>

                                    <div class="mb-1">
                                        <label for="description" class="col-form-label">Mô tả ngắn</label>
                                        <textarea class="form-control" id="description-update" name="short_description" placeholder="Mô tả ngắn"
                                            style="height:100px"></textarea>
                                    </div>

                                    <div class="mb-1">
                                        <label for="description" class="col-form-label">Giá</label>
                                        <input type="text" class="form-control" name="price" id="price-update"
                                            placeholder="Nhập giá tiền">
                                    </div>

                                    <div class="mb-1">
                                        <label for="category_id-update" class="col-form-label">Loại Tour</label>
                                        <select class="form-select mb-3" id="category_id-update" name="category_id">
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                        <button id="submit-update" class="btn btn-success">
                            <i class="mdi mdi-plus-circle me-2"></i> Cập nhật
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
                url: `{{ route('admin.tour.getList') }}`,
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
                    data: 'category_id',
                    name: 'category_id',
                    orderable: true
                },
                {
                    data: 'price',
                    name: 'price',
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
            let routeDelete = `{{ route('admin.tour.delete') }}`
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

        // show select category id
        const categoryIdData = () => {
            $.ajax({
                type: 'GET',
                url: `{{ route('admin.category.getAllData') }}`,
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                },
                success: (data) => {
                    console.log('success');
                    data.forEach((i) => {
                        let option = `<option value ="${i.id}"> ${i.name}</option>`;
                        $('#category_id').append(option);
                    });
                },
                error: (error) => {
                    console.log('error', error);
                }
            });
        };

        const categoryIdData1 = () => {
            $.ajax({
                type: 'GET',
                url: `{{ route('admin.category.getAllData') }}`,
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                },
                success: (data) => {
                    console.log('success');
                    data.forEach((i) => {
                        let option = `<option value ="${i.id}"> ${i.name}</option>`;
                        $('#category_id-update').append(option);
                    });
                },
                error: (error) => {
                    console.log('error', error);
                }
            });
        };
        categoryIdData1();
        categoryIdData();

        // submit store
        $('#submit-store').on('click', (e) => {
            e.preventDefault();
            let formData = new FormData($('#form-create')[0]);

            $.ajax({
                type: 'POST',
                url: `{{ route('admin.tour.store') }}`,
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

        // show data modal update
        $(document).on('click', '.btn-update', (e) => {
            let id = $(e.currentTarget).data('id');

            $('#modal-update').on('shown.bs.modal', function() {
                let name = document.getElementById('name-update');
                let description = document.getElementById('description-update');
                let price = document.getElementById('price-update');
                let category_id = document.getElementById('category_id-update');
                let image = $('#preview-update');

                $.ajax({
                    url: "{{ route('admin.tour.getDataForUpdate') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: (result) => {
                        name.value = result.data[0].name;
                        description.value = result.data[0].short_description;
                        price.value = result.data[0].price;
                        category_id.append(
                            `<option selected value ="${result.data[0].id}"> ${result.data[0].name}</option>`
                        );
                        image.attr('src', result.data[0].image).removeClass('d-none');
                        // map.resize();
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

        $('#submit-update').on('click', (e) => {
            e.preventDefault();
            let formData = new FormData($('#form-update')[0]);

            $.ajax({
                type: 'POST',
                url: `{{ route('admin.tour.update') }}`,
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
