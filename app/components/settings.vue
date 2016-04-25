<template>

    <div class="uk-form uk-form-horizontal">
        <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
            <div data-uk-margin>
                <h2 class="uk-margin-remove">{{ 'Mapkit Settings' | trans }}</h2>
            </div>

            <div data-uk-margin>
                <button class="uk-button uk-button-primary" @click="save">{{ 'Save' | trans }}</button>
            </div>
        </div>

        <div class="uk-form-row">
            <label for="form-mail-address" class="uk-form-label">{{ 'Google Maps API Key' | trans }}</label>

            <div class="uk-form-controls">
                <input class="uk-form-width-large" type="text" name="api_key"
                       v-model="package.config.api_key">
            </div>
        </div>
    </div>

</template>

<script>

    module.exports = {

        props: ['package'],

        settings: true,

        methods: {

            save: function () {
                this.$http.post('admin/system/settings/config', {
                    name: 'cmextension/mapkit',
                    config: this.package.config
                }, function () {
                    this.$notify('Settings saved.', '');
                }).error(function (data) {
                    this.$notify(data, 'danger');
                }).always(function () {
                    this.$parent.close();
                });
            }

        }

    };

    window.Extensions.components['settings-mapkit'] = module.exports;

</script>
