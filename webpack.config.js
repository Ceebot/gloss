const path = require('path');
const {VueLoaderPlugin} = require('vue-loader');

module.exports = {
    mode: 'development',
    entry: './js/index.js',
    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: 'index_bundle.js'
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /(\.css|\.less)$/,
                use: [
                    'vue-style-loader',
                    'css-loader',
                    'less-loader',
                ]
            },
            {
                test: /\.js$/,
                loader: 'babel-loader'
            },
        ]
    },

    plugins: [
        new VueLoaderPlugin()
    ]
}
