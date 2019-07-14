const gulp = require('gulp')
const rollup = require('gulp-better-rollup')
const autoprefixer = require('autoprefixer')
const postcss = require('gulp-postcss')
const babel = require('rollup-plugin-babel')
const concat = require('gulp-concat')
const uglify = require('gulp-uglify')
const resolve = require('rollup-plugin-node-resolve')
const commonjs = require('rollup-plugin-commonjs')

const src = {
    js: './src/js/*.js',
    css: './src/css/*.css'
}

function jsProd() {
    return gulp.src(src.css)
        .pipe(babel())
        // .pipe(concat('app.js'))
        .pipe(uglify())
        .pipe(gulp.dest('dist'))
}

function js() {
    return gulp.src(src.js)
        .pipe(babel())
        .pipe(gulp.dest('dist'))
}

function css() {
    return gulp.src(src.css)
        .pipe(postcss([autoprefixer()]))
        .pipe(gulp.dest('dist'))
}

function watch() {
    return gulp.watch([src.js], (cb) => {
        return rollupTask()
    })
}

function rollupTask() {
    return gulp.src(src.js)
        .pipe(rollup({ plugins: [babel(), resolve(), commonjs()] }, 'umd'))
        .pipe(gulp.dest('dist'))
}

exports.js = js
exports.jsProd = jsProd
exports.watch = watch
exports.rollup = rollupTask

exports.default = gulp.parallel(css)
