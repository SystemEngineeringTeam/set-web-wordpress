var requireDir = require('require-dir');
var tasks = requireDir('./gulp/tasks');
var gulp = require('gulp');

gulp.task('default', function() {
	console.log("################################");
	console.log("     SystemEngineeringTeam    ");
	console.log("  http://set1.ie.aitech.ac.jp/ ");
	console.log("################################");
	console.log("  Powered by Gulp  ");
	console.log("  by: Kamiya  ");
	console.log("################################");
	console.log("  Commands ");
	console.log("  npm install");
	console.log("  npm run build");
	console.log("################################");
});