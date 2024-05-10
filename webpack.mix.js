const mix = require("laravel-mix");

mix.js(
    [
        "resources/js/app.js",
        "resources/js/aos.js",
        "resources/js/bootstrap.js",
        "resources/js/jquery.js",
    ],
    "dist/js/app.js"
);

mix.js("resources/js/datatable.js", "dist/js/datatable.js");
mix.js("resources/js/sweetalert.js", "dist/js/sweetalert.js");

mix.sass("resources/sass/app.scss", "dist/css/app.css")
    .sass("resources/sass/bootstrap.scss", "dist/css/bootstrap.css")
    .sass("resources/sass/boxicons.scss", "dist/css/boxicons.css")
    .sass("resources/sass/fontawesome.scss", "dist/css/fontawesome.css");
