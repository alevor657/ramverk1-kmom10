var gulp           = require('gulp'),
    // gutil          = require('gulp-util'),
    browserSync    = require('browser-sync'),
    concat         = require('gulp-concat'),
    // uglify         = require('gulp-uglify'),
    cleanCSS       = require('gulp-clean-css'),
    // rename         = require('gulp-rename'),
    // del            = require('del'),
    // imagemin       = require('gulp-imagemin'),
    // cache          = require('gulp-cache'),
    autoprefixer   = require('gulp-autoprefixer'),
    // ftp            = require('vinyl-ftp'),
    // notify         = require("gulp-notify"),
    sass           = require('gulp-sass');

var static = ['./static-src/**/*.sass', './static-src/**/*.css'];

gulp.task('browser-sync', function() {
    browserSync({
        // server: {
        //     baseDir: 'htdocs'
        // },
        proxy: '127.0.0.1:80/anax/htdocs/comments',
        notify: false,
        // tunnel: true,
        // tunnel: "projectmane", //Demonstration page: http://projectmane.localtunnel.me
    });
});

gulp.task('sass', function () {
    return gulp.src(static)
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(concat('style.css'))
        .pipe(gulp.dest('./htdocs/css'))
        .pipe(browserSync.stream());
});

gulp.task('watch', ['sass', 'browser-sync'], function() {
    gulp.watch(static, ['sass']);
    gulp.watch('src/**/*.php', browserSync.reload);
});

gulp.task('default', ['watch']);
