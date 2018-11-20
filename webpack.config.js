var Encore = require('@symfony/webpack-encore');

Encore
// directory where compiled assets will be stored
    .setOutputPath('web/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')

    .addEntry('app', './assets/js/app.js')
    .addEntry('app_css', './assets/css/global.scss')
    .autoProvidejQuery()
    .enableSassLoader()
    .disableSingleRuntimeChunk()
    //.enableVersioning()


;

module.exports = Encore.getWebpackConfig();

