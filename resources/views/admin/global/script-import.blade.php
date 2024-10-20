<!-- Jquery -->
<script src="{{ env('APP_URL') }}/libraries/jquery/jquery.min.js?version={{ config('cache.js_version') }}"></script>
<!-- Admin Hyper App -->
<script src="{{ env('APP_URL') }}/libraries/hyper/vendor.min.js?version={{ config('cache.js_version') }}"></script>
<script
    src="{{ env('APP_URL') }}/vendor/jquery-toast-plugin/jquery.toast.min.js?version={{ config('cache.js_version') }}">
</script>
<script src="{{ env('APP_URL') }}/libraries/hyper/hyper-syntax.js?version={{ config('cache.js_version') }}"></script>
<script src="{{ env('APP_URL') }}/libraries/select2/select2.min.js?version={{ config('cache.js_version') }}"></script>
<script src="{{ env('APP_URL') }}/libraries/hyper/app.min.js?version={{ config('cache.js_version') }}"></script>
<!-- Datatables -->
<script
    src="{{ env('APP_URL') }}/vendor/datatables.net/js/jquery.dataTables.min.js?version={{ config('cache.js_version') }}">
</script>
<script
    src="{{ env('APP_URL') }}/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js?version={{ config('cache.js_version') }}">
</script>
<script
    src="{{ env('APP_URL') }}/vendor/datatables.net-responsive/js/dataTables.responsive.min.js?version={{ config('cache.js_version') }}">
</script>
<script
    src="{{ env('APP_URL') }}/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js?version={{ config('cache.js_version') }}">
</script>
<!-- Import CKEditor -->
<script src="{{ env('APP_URL') }}/libraries/ckeditor/ckeditor.js?version={{ config('cache.js_version') }}"></script>
<!-- Custom -->
<script src="{{ env('APP_URL') }}/js/admin/config.js?version={{ config('cache.js_version') }}"></script>
{{-- Mapbox --}}
<script src="https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"></script>
