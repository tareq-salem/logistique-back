var Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')
    .copyFiles({ from: './assets/images', pattern: /\.(svg|jpg|png|jpeg)$/})
    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    .addEntry('admin_offer', './assets/js/admin/offer.js')

    .addStyleEntry('app', './assets/scss/app.scss')
    .addStyleEntry('template', './assets/scss/template.scss')
    .addStyleEntry('variables', './assets/scss/variables.scss')
    .addStyleEntry('nav', './assets/scss/nav.scss')
    .addStyleEntry('footer', './assets/scss/footer.scss')
    .addStyleEntry('home', './assets/scss/home.scss')
    .addStyleEntry('presentation', './assets/scss/presentation.scss')
    .addStyleEntry('references', './assets/scss/references.scss')
    .addStyleEntry('carrieres', './assets/scss/carrieres.scss')
    //.addStyleEntry('listOffer', './assets/scss/listOffer.scss')
    .addStyleEntry('contact', './assets/scss/contact.scss')
    .addStyleEntry('candidature', './assets/scss/candidature.scss')
    .addStyleEntry('login', './assets/scss/login.scss')
    .addStyleEntry('dashboard', './assets/scss/dashboard.scss')
    .addStyleEntry('admin_offer', './assets/scss/admin_offer.scss')
    .addStyleEntry('detail', './assets/scss/detail.scss')

    //.addEntry('app', './assets/js/app.js')
    //.addEntry('page1', './assets/js/page1.js')
    //.addEntry('page2', './assets/js/page2.js')

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()

    // uncomment if you use API Platform Admin (composer req api-admin)
    //.enableReactPreset()
    //.addEntry('admin', './assets/js/admin.js')

    .splitEntryChunks()
;

module.exports = Encore.getWebpackConfig();
