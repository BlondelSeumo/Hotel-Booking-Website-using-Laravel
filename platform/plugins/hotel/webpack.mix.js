let mix = require('laravel-mix')

const path = require('path')
let directory = path.basename(path.resolve(__dirname))

const source = 'platform/plugins/' + directory
const dist = 'public/vendor/core/plugins/' + directory

mix

    .js(source + '/resources/assets/js/currencies.js', dist + '/js')
    .copy(dist + '/js/currencies.js', source + '/public/js')

    .js(source + '/resources/assets/js/customer.js', dist + '/js')
    .copy(dist + '/js/customer.js', source + '/public/js')

    .js(source + '/resources/assets/js/avatar.js', dist + '/js')
    .copy(dist + '/js/avatar.js', source + '/public/js')

    .js(source + '/resources/assets/js/utilities.js', dist + '/js')
    .copy(dist + '/js/utilities.js', source + '/public/js')

    .js(source + '/resources/assets/js/room-availability.js', dist + '/js')
    .copy(dist + '/js/room-availability.js', source + '/public/js')

    .js(source + '/resources/assets/js/booking-reports.js', dist + '/js')
    .copy(dist + '/js/booking-reports.js', source + '/public/js')

    .js(source + '/resources/assets/js/coupon.js', dist + '/js')
    .copy(dist + '/js/coupon.js', source + '/public/js')

    .js(source + '/resources/assets/js/report.js', dist + '/js')
    .copy(dist + '/js/report.js', source + '/public/js')

const styles = [
    'hotel.scss',
    'currencies.scss',
    'customer.scss',
    'review.scss',
    'front-auth.scss',
];

styles.forEach(item => {
    mix.sass(source + '/resources/assets/sass/' + item, dist + '/css');
});

if (mix.inProduction()) {
    styles.forEach(item => {
        mix.copy(dist + '/css/' + item.replace('.scss', '.css'), source + '/public/css');
    });
}
