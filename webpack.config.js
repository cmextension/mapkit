module.exports = [

    {
        entry: {
            "settings": "./app/components/settings.vue",
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