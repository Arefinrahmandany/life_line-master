const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

// // frontend
// mix.styles([
//     'public/assets/frontend/bootstrap_v4/css/bootstrap.min.css',
//     'public/assets/frontend/bootstrap_v4/css/mdb.min.css',
//     'public/assets/mscdnxpress/css/msx.css',
// ], 'public/css/app_f.css');
// // frontend
// mix.scripts([
//     'public/assets/frontend/bootstrap_v4/js/popper.min.js',
//     'public/assets/frontend/bootstrap_v4/js/bootstrap.min.js',
//     'public/assets/frontend/bootstrap_v4/js/mdb.min.js',
//     'public/assets/mscdnxpress/sweetalert2/sweetalert2.all.min.js',
// ], 'public/js/app_f.js');

// // backend
// mix.styles([
//     'public/assets/backend/vendors/css/vendor.bundle.base.css',
//     'public/assets/backend/css/style.css',
//     'public/assets/mscdnxpress/toastr/toastr.min.css',
//     // 'public/assets/mscdnxpress/ms-waves-effect/ms-waves-effect.css',
//     'public/assets/mscdnxpress/material-form/material-form.css',
//     'public/assets/mscdnxpress/css/m-toggle-switch.css',
// ], 'public/css/app_b.css');
// // backend
// mix.scripts([
//     'public/assets/backend/vendors/js/vendor.bundle.base.js',
//     'public/assets/backend/js/off-canvas.js',
//     'public/assets/backend/js/hoverable-collapse.js',
//     'public/assets/backend/js/misc.js',
//     'public/assets/mscdnxpress/sweetalert2/sweetalert2.all.min.js',
//     'public/assets/mscdnxpress/toastr/toastr.min.js',
//     // 'public/assets/mscdnxpress/ms-waves-effect/ms-waves-effect.js',
//     'public/assets/mscdnxpress/material-form/material-form.js',
//     'public/assets/backend/js/main.js',
// ], 'public/js/app_b.js');
//
// // backend DataTables scripts
// mix.scripts([
//     'public/assets/backend/dataTable/jquery.dataTables.js',
//     'public/assets/backend/dataTable/dataTables.bootstrap4.js',
//     'public/assets/backend/dataTable/datatable.js',
// ], 'public/js/app_b_dataTable.js');
//
//
// mix.js('resources/js/app.js', 'public/js/app.js');
// // .version();
