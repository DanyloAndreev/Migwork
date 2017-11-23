
 //подключение модулей
const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer'); //выставляет префиксы для разных браузкров
const cleanCSS = require('gulp-clean-css');//минимизируем файл
const browserSync = require('browser-sync').create(); //синхронизация браузера
const sourcemaps = require('gulp-sourcemaps'); //сделает проводник файлов в браузере
const gcmq = require('gulp-group-css-media-queries');
const preproc = require('gulp-less');

var reload      = browserSync.reload;

const config = {
	//это папка в которой лежит индекс html
	src: './src',
		css: {
		watch: '/precss/**/*.less',//следим за всеми
		src: '/precss/styles.less',//обрабатываем основной
		dest: '/css'
	},
	html: {
		src: '/**/*.html',
	},
	php: {
		src: '/**/*.php'
	},
	tpl: {
		src: '/**/*.tpl'
	},
	png: {
		src: '/**/*.png'
	}
};

//pipe изменение потока
gulp.task('sass', function() {
	gulp.src('./project/**/*.scss')
	.pipe(sass().on('error', sass.logError))
	.pipe(gulp.dest('./project'));
});

gulp.task('sass:watch', function() {
	gulp.watch('./project/**/*.scss', ['sass']);
});

//автопрефиксер
gulp.task('build', function() {
	gulp.src(config.src + config.css.src)
	.pipe(sourcemaps.init('.'))
	.pipe(preproc())
	.pipe(gcmq())
	.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
	//минифицируем файл
	.pipe(cleanCSS())
	.pipe(sourcemaps.write())
	.pipe(gulp.dest(config.src + config.css.dest))
	.pipe(browserSync.reload({
		stream: true
	}));
});



//смотрим за изменениями в файле
gulp.task('watch', ['browser-sync'], function() {
	gulp.watch(config.src + config.html.src).on('change', reload);
	gulp.watch(config.src + config.php.src).on('change', reload);
	gulp.watch(config.src + config.tpl.src).on('change', reload);
	gulp.watch(config.src + config.png.src).on('change', reload);
	gulp.watch(config.src + config.css.watch, ['build']); // смотри все файлы в этой папке и запускай команду билд
	
});


//запускает браузер синк
gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "migwork",
        notify: false
    });
});
