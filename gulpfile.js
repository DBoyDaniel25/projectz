// plugins
var gulp        = require("gulp"),
    render      = require("gulp-nunjucks-render"),
    ext_replace = require('gulp-ext-replace'),
    // locations
    src         = "./cms/",
    cms         = {
        templates: [
            "./templates/cms/nunjucks/",
            "./templates/cms/base/",
            "./templates/cms/forms/",
            "./templates/cms/partials/",
            "./templates/cms/php/"
        ],
        pages    : "./templates/cms/pages/*.nunjucks"
    };


gulp.task("render", function () {
    render.nunjucks.configure(cms.templates, {watch: false});

    return gulp.src(cms.pages)
        .pipe(render())
        .pipe(ext_replace('.php'))
        .pipe(gulp.dest(src));
});

