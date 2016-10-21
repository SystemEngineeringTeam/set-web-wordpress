var gulp = require('gulp');

gulp.task('buildScreenshot', function() {

    var sc_src = ["./src/main/resources/screenshot.png"];
	gulp.src(sc_src)
	.pipe(gulp.dest("./dist/"));

});