var gulp = require('gulp');

gulp.task('buildPHP', function() {

    var php_src = ["./src/main/php/**/*.php"];
	gulp.src(php_src)
	.pipe(gulp.dest("./dist/"));

});