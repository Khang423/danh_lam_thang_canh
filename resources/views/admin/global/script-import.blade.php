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
<script src="{{ asset('js/admin/main.js') }}"></script>
{{-- Mapbox --}}
<script src="{{ asset('libraries/mapbox/mapbox-gl.js') }}"></script>
{{-- Awesome Font --}}
<script src="{{ asset('libraries/font_awesome/all.min.css') }}"></script>
{{-- Fancybox --}}
<script src="{{ asset('libraries/fancybox/fancybox.min.js') }}"></script>
{{-- Datepicker Jquery UI --}}
<script src="{{ asset('libraries/jqueyui/jquery-ui.js') }}"></script>
{{-- Highchart --}}
<script src="{{ asset('libraries/highchart/highcharts.js') }}"></script>
<script src="{{ asset('libraries/highchart/export-data.js') }}"></script>
<script src="{{ asset('libraries/highchart/exporting.js') }}"></script>
<script src="{{ asset('libraries/highchart/accessibility.js') }}"></script>