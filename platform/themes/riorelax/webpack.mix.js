const mix = require('laravel-mix')
const path = require('path')

const directory = path.basename(path.resolve(__dirname))
const source = `platform/themes/${directory}`
const dist = `public/themes/${directory}`

mix
    .sass(`${source}/assets/sass/theme.scss`, `${dist}/css`)
    .js(source + '/assets/js/review.js', dist + '/js')
    .js(`${source}/assets/js/script.js`, `${dist}/js`)
    .js(`${source}/assets/js/main.js`, `${dist}/js`)
    .js(`${source}/assets/js/checkout.js`, `${dist}/js`)

if (mix.inProduction()) {
    mix
        .copy(`${dist}/css/theme.css`, `${source}/public/css`)
        .copy(`${dist}/js/script.js`, `${source}/public/js`)
        .copy(`${dist}/js/main.js`, `${source}/public/js`)
        .copy(`${dist}/js/checkout.js`, `${source}/public/js`)
        .copy(`${dist}/js/review.js`, `${source}/public/js`)
}
