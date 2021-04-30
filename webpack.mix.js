const mix = require('laravel-mix');
const path =require('path');
const exec = require('child_process').exec
const chokidar = require('chokidar')

class LaravelZiggyGenerator {
    constructor() {
        this.isWatchingForChanges = false
        this.firstCompile = true
    }

    apply(compiler) {
        compiler.plugin('before-compile', (_, cb) => {
            if (this.firstCompile) {
                this.generate()
                this.firstCompile = false
            }
            cb()
        })

        if (this.isWatching()) {
            this.watchFiles()
        }
    }

    generate() {
        exec('php artisan ziggy:generate "resources/spa/src/ziggy.js"')
    }

    watchFiles() {
        if (this.isWatchingForChanges) return

        chokidar.watch('routes/**/*', {
            persistent: true
        }).on('change', this.generate)

        this.isWatchingForChanges = true
    }

    isWatching() {
        return process.argv.includes('--watch')
    }
}
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
let plugins = [];

plugins.push(new LaravelZiggyGenerator());

mix.webpackConfig({
    plugins,
    resolve:{
        alias:{
            '@': path.resolve(__dirname, 'resources/spa/src/'),
            ziggy: path.resolve('vendor/tightenco/ziggy/dist'),
        }
    }
})

mix.js('resources/spa/src/main.js', 'public/static/dashboard/js/index.js')
mix.sass('resources/scss/dashboard.scss','public/static/dashboard/css/index.css')

mix.copy('resources/spa/public/index.html', 'resources/views/dashboard/index.blade.php');

