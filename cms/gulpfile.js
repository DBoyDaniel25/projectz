var gulp         = require("gulp"),
    render       = require("gulp-nunjucks-render"),
    ext_replace  = require("gulp-ext-replace"),
    minify_js = require("gulp-uglify"),
    csso = require("gulp-csso"),
    baseTemplate = "./template/",
    template     = {
        source: [
            baseTemplate + "partials/",
            baseTemplate + "php/",
            baseTemplate + "main/"
        ],
        pages : baseTemplate + "pages/**/*.twig"
    },
    js = {
        myscripts : "./js/scripts/**/*.*",
        vendor : "./js/*.js"
    },
    css = {
        vendor : "./css/**/*.css"
    };

gulp.task("render", function () {
    render.nunjucks.configure(template.source, {watch: false});
    return gulp.src(template.pages)
        .pipe(render())
        .pipe(ext_replace(".php"))
        .pipe(gulp.dest("./"));
});


gulp.task("minify-vendor-js", function(){
    return gulp.src(js.vendor)
        .pipe(minify_js())
        .pipe(gulp.dest('./js/'))
});

gulp.task("minify-vendor-css", function(){
    return gulp.src(css.vendor)
        .pipe(csso())
        .pipe(gulp.dest('./css/'))
});

gulp.task("minify-my-js", function(){
    return gulp.src(js.myscripts)
        .pipe(minify_js())
        .pipe(gulp.dest('./js/scripts/'));
});