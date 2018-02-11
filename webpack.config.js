var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .autoProvidejQuery()
    .enableSassLoader()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(false)
    .createSharedEntry('js/common', ['jquery'])
    .addEntry('js/app', [
        './node_modules/bootstrap/dist/js/bootstrap.min.js',
        './assets/js/app.js'
    ])
    .addEntry('js/admin', [
        './node_modules/datatables.net/js/jquery.dataTables.js',
        './node_modules/datatables.net-bs/js/dataTables.bootstrap.js',
        './node_modules/jquery-slimscroll/jquery.slimscroll.min.js',
        './node_modules/select2/dist/js/select2.min.js',
        './node_modules/admin-lte/dist/js/adminlte.min.js',
        './node_modules/jquery.are-you-sure/jquery.are-you-sure.js',
        './assets/js/admin.js'
    ])
    .addStyleEntry('css/app', './assets/scss/app.scss')
    .addStyleEntry('css/admin', [
        './node_modules/admin-lte/dist/css/AdminLTE.min.css',
        './node_modules/admin-lte/dist/css/skins/_all-skins.min.css',
        './assets/scss/admin.scss'
    ])
;

module.exports = Encore.getWebpackConfig();
