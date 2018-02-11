var Encore = require('@symfony/webpack-encore');

// the project directory where compiled assets will be stored
Encore.setOutputPath('public/build/');

// the public path used by the web server to access the previous directory
Encore.setPublicPath('/build');
Encore.cleanupOutputBeforeBuild();
Encore.enableSourceMaps(!Encore.isProduction());

// uncomment to create hashed filenames (e.g. app.abc123.css)
//Encore.enableVersioning(Encore.isProduction());

Encore.addEntry('js/app', './assets/js/app.js');
Encore.addStyleEntry('css/app', './assets/scss/app.scss');
Encore.addEntry('js/admin', './assets/js/admin.js');
Encore.addStyleEntry('css/admin', './assets/scss/admin.scss');

// uncomment if you use Sass/SCSS files
Encore.enableSassLoader();

// uncomment for legacy applications that require $/jQuery as a global variable
//Encore.autoProvidejQuery();

module.exports = Encore.getWebpackConfig();
