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
                                        data-bs-target="#modal-create">
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
                                            <th style="width: 100px;">Địa chỉ</th>
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
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Thêm đơn vị đo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form id="form-create">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="col-form-label">Tên Điểm Du Lịch</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Tên điểm du lịch">
                                    <div class="invalid-feedback error-name"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="col-form-label">Mô tả</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Mô tả đơn vị đo"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="longtitude" class="col-form-label">Kinh độ</label>
                                    <input type="text" class="form-control" id="longtitude" name="longtitude"
                                        placeholder="Kinh độ">
                                </div>
                                <div class="mb-3">
                                    <label for="latitude" class="col-form-label">Vĩ độ</label>
                                    <input type="text" class="form-control" id="longtitude" name="longtitude"
                                        placeholder="Vĩ độ">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="blog-image"
                                        class="btn btn-info select-image-update mb-2 font-weight-normal">Chọn ảnh <i
                                            class="fal fa-image"></i></label>
                                    <div class="wrap-preview-blog-image w-200px mh-200px wrap-fixed-image">
                                        <img src="" class="preview d-none" alt="">
                                    </div>
                                    <input type="file" class="d-none" name="image" id="image">
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
    {{-- Model update --}}
    <div class="modal fade" id="modal-update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cập nhật đơn vị đo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form id="form-update">
                        @csrf
                        <input type="hidden" name="id" id="id_update">
                        <div class="mb-3">
                            <label for="name_update" class="col-form-label">Tên đơn vị đo</label>
                            <input type="text" class="form-control" id="name_update" name="name"
                                placeholder="Tên đơn vị đo">
                            <div class="invalid-feedback error-name"></div>
                        </div>
                        <div class="mb-3">
                            <label for="icon_update" class="col-form-label">Biểu tượng</label>
                            <input type="text" class="form-control" id="icon_update" name="icon"
                                placeholder="Biểu tượng">
                        </div>
                        <div class="mb-3">
                            <label for="description_update" class="col-form-label">Mô tả</label>
                            <textarea class="form-control" id="description_update" name="description" placeholder="Mô tả đơn vị đo"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Trở lại</button>
                    <button type="button" id="submit-update" class="btn btn-primary">
                        <i class="mdi mdi-content-save"></i> Cập nhật
                    </button>
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
                    data: 'image_id',
                    name: 'image_id',
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
    </script>
@endsection
