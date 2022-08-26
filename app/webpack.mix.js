let mix = require('laravel-mix');

mix.sass('src/scss/main.scss', 'css/').sourceMaps()
    .ts('src/ts/SpaceInvader.ts', 'js/').sourceMaps()
    .copy('src/fonts/Minecraft.ttf', 'dist/fonts/Minecraft.ttf')
    .setPublicPath('dist')
    .options({
        processCssUrls: false
    })
    .browserSync({
        proxy: 'localhost',
        open: true,
    });