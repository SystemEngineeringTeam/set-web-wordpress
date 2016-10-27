var gulp = require('gulp');

gulp.task('buildCSS', function() {

    var css_src = ["./src/main/css/**/*.css", "!./src/main/css/style.css"];
	gulp.src(css_src)
	.pipe(gulp.dest("./dist/css/"));
	
	var css_src = ["./src/main/css/style.css"];
	gulp.src(css_src)
	.pipe(gulp.dest("./dist/"));

});