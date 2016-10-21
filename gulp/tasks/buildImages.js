var gulp = require('gulp');

gulp.task('buildImage', function() {

    var css_src = ["./src/main/resources/images/**/*.png","./src/main/resources/images/**/*.jpg"];
	gulp.src(css_src)
	.pipe(gulp.dest("./dist/images"));

});