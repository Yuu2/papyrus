# 웹팩 (Webpack)
Updated 2019.12.17.Tue
- 설치하기
```
npm init

npm install @symfony/webpack-encore --save-dev
```
- 설정파일 샘플
```javascript
// webpack.config.js

var Encore = require('@symfony/webpack-encore')

Encore 
    .setOutputPath('public/build/')

    .setPublicPath('/build')

    .addEntry('app', './assets/js/app.js')

    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()

    .enableSourceMaps(!Encore.isProduction())

    .enableVersioning(Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();
```
- 명령어로 실행하기!
```
node_modules/.bin/encore production

node_modules/.bin/encore dev --watch
```
: --watch는 파일이 변경되면 명령어 실행 없이 알아서 축소화(Minimize) 시킨다.