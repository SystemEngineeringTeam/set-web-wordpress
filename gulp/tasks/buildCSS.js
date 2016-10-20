var gulp = require('gulp');

gulp.task('buildCSS', function() {

    var css_src = ["./src/main/css/**/*.css"];
	gulp.src(css_src)
	.pipe(gulp.dest("./dist/"));

});