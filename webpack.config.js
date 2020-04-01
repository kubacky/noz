const path = require('path');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const glob = require('glob');

const PATHS = {
    source: path.join(__dirname, 'src'),
    build: path.join(__dirname, 'web')
};

module.exports = (env, argv) => {
    let config = {
        production: argv.mode === 'production'
    };
    return {
        mode: (argv.mode) ? argv.mode : 'development',
        plugins: [
            new ImageminPlugin({
                externalImages: {
                    context: 'web/assets/img',
                    sources: glob.sync('src/img/**/*.png'),
                    destination: 'web/assets/img',
                    fileName: '[path][name].[ext]'
                }
            })
        ],
        entry: [
            PATHS.source + '/index.js'
        ],
        output: {
            path: PATHS.build,
            filename: config.production ? 'app.min.js' : 'app.js'
        }
    }
};