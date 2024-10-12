const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .browserSync({
        proxy: 'localhost:8000',  // Địa chỉ trang bạn đang chạy
        files: [
            'app/**/*.php',
            'resources/views/**/*.php',
            'public/js/**/*.js',
            'public/css/**/*.css'
        ]
    });