var gulp         = require("gulp"),
    render       = require("gulp-nunjucks-render"),
    ext_replace  = require("gulp-ext-replace"),
    baseTemplate = "./template/",
    template     = {
        source: [
            baseTemplate + "partials/",
            baseTemplate + "php/",
            baseTemplate + "main/"
        ],
        pages : baseTemplate + "pages/**/*.twig"
    };

gulp.task("render", function () {
    render.nunjucks.configure(template.source, {watch: false});
    return gulp.src(template.pages)
        .pipe(render())
        .pipe(ext_replace(".php"))
        .pipe(gulp.dest("./"));
});