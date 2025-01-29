const gulp = require("gulp")
const { series, parallel } = require("gulp")

const sass = require("gulp-sass")(require('sass'))
const concat = require("gulp-concat")
const autoprefixer = require('gulp-autoprefixer')
const rename = require('gulp-rename')
const cleanCSS = require('gulp-clean-css');
const jsValidate = require('gulp-jsvalidate')
const browserSync = require('browser-sync').create();

const uglifyes = require('uglify-es');
const composer = require('gulp-uglify/composer');
const uglify = composer(uglifyes, console);

//Assets path
const cssPath = './assets/css'
const jsPath = './assets/js'

// Scripts
function js(cb) {
    gulp.src(jsPath + '/!(*.min)*.js')
        .pipe(jsValidate())
        .on('error', function (err) {
            console.log(err.toString());

            this.emit('end')
        })
        .pipe(uglify().on('error', function(uglify) {
            console.error(uglify.message)
            this.emit('end')
        }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(jsPath))
    cb()
}

// Compile all js scripts to one
function vendor_js(cb) {
    gulp.src(jsPath + '/vendor/*.js')
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest(jsPath))
        .pipe(uglify().on('error', function(uglify) {
            console.error(uglify.message)
            this.emit('end')
        }))
        .on('error', function (err) {
            console.log(err.toString());

            this.emit('end');
        })
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(jsPath))
    cb()
}

// Compile Sass
function scss(cb) {
    gulp.src(cssPath + '/sass/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(cssPath))
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(autoprefixer({
            browserlist: ['last 3 versions'],
            cascade: false
        }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(cssPath))

    cb()
}

//Compile all vendor css
function vendor_css(cb) {
    gulp.src(cssPath + '/vendor/*.css')
        .pipe(concat('vendor.css'))
        .pipe(gulp.dest(cssPath))
        .pipe(cleanCSS())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(cssPath))
    cb()
}

//Start browser server
function watch_browser() {
    browserSync.init({
        server: "./"
    })
}

// Watch Files
function watch_files() {
    gulp.watch(cssPath + '/sass/**/*.scss', scss).on('change', browserSync.reload)
    gulp.watch(cssPath + '/vendor/**/*.css', vendor_css).on('change', browserSync.reload)
    gulp.watch(jsPath + '/!(*.min)*.js', js).on('change', browserSync.reload)
    gulp.watch(jsPath + '/vendor/**/*.js', vendor_js).on('change', browserSync.reload)
    gulp.watch("*.html").on('change', browserSync.reload)
}

exports.watch = parallel(watch_browser, series(scss, js, watch_files))

exports.default = series(scss, js, watch_files)