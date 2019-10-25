const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .autoProvidejQuery()
    .enableSassLoader()
    .enablePostCssLoader()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(false)
    .addEntry('js/app', './assets/js/app.js')
    .addEntry('js/admin', './assets/js/admin.js')
    .addStyleEntry('css/app', './assets/scss/app.scss')
    .addStyleEntry('css/admin', './assets/scss/admin.scss')
    .disableSingleRuntimeChunk()
;

module.exports = Encore.getWebpackConfig();
