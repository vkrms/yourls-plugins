import { series, parallel, src, dest } from 'gulp'
import autoprefixer from 'autoprefixer'
import postcss from 'gulp-postcss'

function javascript(cb) {
	return src('./src/js/*.js')
    .pipe(dest('output/'))
  cb();
}

function css(cb) {
  return src('./src/css/*.css')
		.pipe(postcss([autoprefixer()]))
		.pipe(dest('dist'))
  cb();
}

// gulp.task('default', () =>
//     gulp.src('src/app.css')
//         .pipe(autoprefixer({
//             browsers: ['last 2 versions'],
//             cascade: false
//         }))
//         .pipe(gulp.dest('dist'))
// );

exports.default = parallel(css);
