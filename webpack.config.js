// webpack.config.js
var Encore = require('@symfony/webpack-encore');

Encore
// directory where all compiled assets will be stored
  .setOutputPath('web/build/')
  
  // what's the public path to this directory (relative to your project's document root dir)
  .setPublicPath('/build')
  
  // empty the outputPath dir before each build
  .cleanupOutputBeforeBuild()
  
  // will output as web/build/app.js
  .addEntry('app', './assets/js/app.js')
  
  // will output as web/build/global.css
  .addStyleEntry('common', './assets/scss/app.scss')
  
  // allow sass/scss files to be processed
  .enableSassLoader(function(sassOptions) {}, {
    resolve_url_loader: false
  })
  
  // allow legacy applications to use $/jQuery as a global variable
  .autoProvidejQuery()
  
  .enableSourceMaps(!Encore.isProduction())
  
  // see ./postcss.config.js
  .enablePostCssLoader()
  // create hashed filenames (e.g. app.abc123.css)
  .enableVersioning()
;

// export the final configuration
module.exports = Encore.getWebpackConfig();