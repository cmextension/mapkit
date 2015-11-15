<template>

    <div class="uk-grid pk-grid-large" data-uk-grid-margin>
        <div class="uk-flex-item-1 uk-form-horizontal">

            <div class="uk-form-row">
                <label for="form-title" class="uk-form-label">{{ 'Title' | trans }}</label>
                <div class="uk-form-controls">
                    <input id="form-title" class="uk-form-width-large" type="text" name="title" v-model="widget.title" v-validate="required">
                    <p class="uk-form-help-block uk-text-danger" v-show="form.title.invalid">{{ 'Title cannot be blank.' | trans }}</p>
                </div>
            </div>

            <div class="uk-form-row">
                <label for="form-location" class="uk-form-label">{{ 'Location' | trans }}</label>
                <div class="uk-form-controls">
                    <div id="mapCanvas" style="width: 100%; height: 300px"></div>
                </div>
            </div>

            <div class="uk-form-row">
                <label for="form-address" class="uk-form-label">{{ 'Search for location by address' | trans }}</label>
                <div class="uk-form-controls">
                    <input type="text" id="form-address" name="address" placeholder="{{ 'Address' | trans }}" class="uk-form-width-large" v-model="widget.data.address">
                    <span id="search-button" class="uk-button" v-on="click:getCoordinates">{{ 'Search' | trans }}</span>
                </div>
            </div>

            <div class="uk-form-row">
                <label for="form-width" class="uk-form-label">{{ "Map's width" | trans }}</label>
                <div class="uk-form-controls">
                    <input type="text" id="form-width" name="width" placeholder="{{ '500px, 100%' | trans }}" v-model="widget.data.width">
                </div>
            </div>

            <div class="uk-form-row">
                <label for="form-height" class="uk-form-label">{{ "Map's height" | trans }}</label>
                <div class="uk-form-controls">
                    <input type="text" id="form-height" name="height" placeholder="{{ '500px, 100%' | trans }}" v-model="widget.data.height">
                </div>
            </div>

            <div class="uk-form-row">
                <div class="uk-form-controls uk-form-controls-text">
                    <label><input id="form-get-direction" type="checkbox" v-model="widget.data.get_direction"> {{ 'Display Get Direction link below the map' | trans }}</label>
                </div>
            </div>

            <input id="form-lat" type="hidden" v-model="widget.data.lat">
            <input id="form-lng" type="hidden" v-model="widget.data.lng">
            <input id="form-zoom" type="hidden" v-model="widget.data.zoom">
 
        </div>
        <div class="pk-width-sidebar pk-width-sidebar-large">

            <partial name="settings"></partial>

        </div>
    </div>

</template>

<script>

    module.exports = {

        section: {
            label: 'Settings'
        },

        data: function() {
            return {
                lat: null,
                lng: null,
                address: null,
                get_direction: null,
                map: null,
                marker: null
            };
        },

        replace: false,

        props: ['widget', 'config', 'form'],

        ready: function() {
            this.lat = this.widget.data.lat || 0;
            this.lng = this.widget.data.lng || 0;
            this.zoom = this.widget.data.zoom || 10;
            this.zoom = parseInt(this.zoom);
            this.initMap();
        },

        methods: {
            initMap: function() {
                var lat = this.lat;
                var lng = this.lng;
                var zoom = this.zoom;
                var latlng = new google.maps.LatLng(lat, lng);

                var mapOptions = {
                    zoom: zoom,
                    center: latlng
                };

                map = new google.maps.Map(
                    document.getElementById('mapCanvas'),
                    mapOptions
                );

                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    draggable: true
                });

                google.maps.event.addListener(marker, 'position_changed', function() {
                    markerTmp = marker.getPosition();
                    jQuery('#form-lat').val(markerTmp.lat()).change();
                    jQuery('#form-lng').val(markerTmp.lng()).change();
                    jQuery('#form-zoom').val(map.getZoom()).change();
                });

                google.maps.event.addListener(map, 'click', function(event) {
                    markerTmp = event.latLng;
                    marker.setPosition(markerTmp);
                });

                google.maps.event.addListener(map, 'zoom_changed', function(event) {
                     jQuery('#form-zoom').val(map.getZoom()).change();
                });
            },
            getCoordinates: function() {
                address = this.widget.data.address;

                if (address != '') {
                    geocoder = new google.maps.Geocoder();
                    address = address.replace(/~/g, '');

                    geocoder.geocode({'address': address}, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            lat = parseFloat(results[0].geometry.location.lat());
                            lng = parseFloat(results[0].geometry.location.lng())
                            point = new google.maps.LatLng(lat, lng);
                            marker.setPosition(point);
                            map.setCenter(point);
                        } else if (status == google.maps.GeocoderStatus.ERROR) {
                            UIkit.modal.alert(this.$trans('There was a problem contacting the Google servers.'));
                        } else if (status == google.maps.GeocoderStatus.INVALID_REQUEST) {
                            UIkit.modal.alert(this.$trans('This request was invalid.'));
                        } else if (status == google.maqps.GeocoderStatus.OVER_QUERY_LIMIT) {
                            UIkit.modal.alert(this.$trans('The webpage has gone over the requests limit in too short a period of time.'));
                        } else if (status == google.maps.GeocoderStatus.REQUEST_DENIED) {
                            UIkit.modal.alert(this.$trans('The webpage is not allowed to use the geocoder.'));
                        } else if (status == google.maps.GeocoderStatus.UNKNOWN_ERROR) {
                            UIkit.modal.alert(this.$trans('A geocoding request could not be processed due to a server error. The request may succeed if you try again.'));
                        } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
                           UIkit.modal.alert(this.$trans('No result was found.'));
                        }
                    });
                } else {
                    UIkit.modal.alert(this.$trans('Please enter an address.'));
                }
            }
        }
    };

    window.Widgets.components['mapkit:settings'] = module.exports;

    var map;
    var marker;
</script>
