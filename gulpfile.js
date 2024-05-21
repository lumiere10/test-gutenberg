const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const terser = require('gulp-terser');
const rename = require('gulp-rename');

gulp.task('sass', function () {
    return gulp.src('./src/sass/**/*.scss') // Обратите внимание на измененный путь для наблюдения за всеми .scss файлами
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./dist/css')); // Путь для сохранения скомпилированных CSS файлов
});

gulp.task('js', function () {
    return gulp.src('./src/js/**/*.js') // Путь к вашим исходным JS файлам
        .pipe(concat('main.js')) // Объедините все JS файлы в один файл (main.js)
        .pipe(terser()) // Минимизируйте JS
        .pipe(rename({ suffix: '.min' })) // Добавьте суффикс .min к имени файла
        .pipe(gulp.dest('./dist/js')); // Путь для сохранения минимизированного JS
});

gulp.task('watch', function () {
    gulp.watch('./src/sass/**/*.scss', gulp.series('sass'));
    gulp.watch('./src/js/**/*.js', gulp.series('js')); // Наблюдайте за изменениями в JS файле
});

gulp.task('default', gulp.parallel('sass', 'js', 'watch')); // Запустите задачи SCSS и JS параллельно
