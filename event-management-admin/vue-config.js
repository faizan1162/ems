module.exports = {
    publicPath: (process.env.NODE_ENV === 'production' ?
        '/' :
        '/'),
    devServer: {
        port: 3000,
        proxy: 'https://localhost'
    },
    productionSourceMap: false,
    rules: [{
        test: /.css$/,
        use: [
            'vue-style-loader',
            'css-loader',
        ]
    }]
}