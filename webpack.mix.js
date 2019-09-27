let mix = require('laravel-mix')

mix.setPublicPath('../../../public')
    .js('resources/js/review.js', 'js/review.js')
    //.sass('resources/sass/field.scss', 'css')
