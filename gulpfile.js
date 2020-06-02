const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const sass = require('gulp-sass');
const sourcemap = require('gulp-sourcemaps');

//npm install gulp gulp-sourcemaps gulp-sass browser-sync 



// Compile sass into CSS & auto-inject into browsers
gulp.task('sass_b', function () {
    return gulp.src(['bootstrap.sass/bootstrap.scss'])
        .pipe(sourcemap.init())
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .pipe(sourcemap.write('.'))
        .pipe(gulp.dest('dist/css'))
        .pipe(browserSync.stream());
});

gulp.task('sass_w', function () {
    return gulp.src(['sass/*.scss'])
        .pipe(sourcemap.init())
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .pipe(sourcemap.write('.'))
        .pipe(gulp.dest('.'))
        .pipe(browserSync.stream());
});

// Move the javascript files into our /src/js folder
gulp.task('js', function () {
    return gulp.src(['node_modules/bootstrap/dist/js/bootstrap.min.js', 'node_modules/popper.js/dist/umd/popper.min.js'])
        .pipe(gulp.dest("src/js"))
        .pipe(browserSync.stream());
});

// Static Server + watching scss/html files
gulp.task('serve', gulp.series(['sass_w'], function () {

    browserSync.init({
        proxy: 'http://localhost/wordpress'
    });

    //gulp.watch(['bootstrap.sass/**/*.scss'], gulp.series('sass_b'));
    gulp.watch(['sass/**/*.scss', 'bootstrap.sass/**/*.scss'], gulp.series('sass_w'));
    gulp.watch('**/*.*').on('change', browserSync.reload);
}));

gulp.task('default', gulp.parallel('js', 'serve'));