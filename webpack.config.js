module.exports = [

    {
        entry: {
            "widget-mapkit": "./app/components/widget-mapkit.vue"
        },
        output: {
            filename: "./app/bundle/[name].js"
        },
        module: {
            loaders: [
                { test: /\.vue$/, loader: "vue" }
            ]
        }
    }

];