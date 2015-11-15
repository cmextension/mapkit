# Mapkit - A Pagekit extension to display Google Maps

Mapkit is a simple extension for [Pagekit CMS](http://pagekit.com) to display Google Maps with a marker. The idea of Mapkit is giving companies ability to display maps of their offices in their business sites's contact pages.

## Installation

In your Pagekit back-end, you navigate to System -> Extensions, click Upload button and select the zip package you download from this repository.

## Usage

### Using widget

You can display a Google Maps in a theme's position by creating a widget.

* In your site's admin area, you navigate to Site -> Widgets -> click Add Widget button -> select Mapkit.
* Use the marker in the map to select your location. You can also enter your location's name or address into "Search for location by address" field and click "Search" button to find your location quickly.
* You use "Map's width" option to configure the width of your map. The value can be in pixel or percent. For example if you enter "800px", your map's width is 800px; if you want your map to use full width of your page, you enter "100%".
* "Map's height" option is used to configure the height of your map, it must be in pixel, for example "400px".
* If you want to display a link to Google Maps website to find direction to your location, you check "Display Get Direction link below the map".
* To configure zoom level of your map, you change the zoom of the map in "Location" option, the same zoom level will be used in your front-end map.

### Using shortcode

You can also display maps in a page or a post of Blog extension by using shortcode.

If you have a widget for your location already, you can use this shortcode:

    (mapkit){"widget_id":"XYZ"}

XYZ is the ID of your widget.

You can display a map without creating a widget by using this shortcode:

    (mapkit){"id":"YOUR MAP ID","lat":"LOCATION'S LATITUDE","long":"LOCATION'S LONGITUDE","width":"MAP'S WIDTH","height":"MAP'S HEIGHT","zoom":"ZOOM LEVEL","get_direction":"DISPLAY GET DIRECTION LINK"}

* lat (required): Your location's latitude.
* lng (required): Your location's longitude.
* id (optional): The ID of your map, this setting should be used if you display many maps on the same page, every map should have an unique ID. You can use the strings like "my-map-1", "my-map-2" as map ID.
* width (optional): Your map's width. If there is no width defined, the value "100%" is used.
* height (optional): Your map's height. The default value is "300px".
* zoom (optional): Your map's zoom level. The default level is 10.
* get_direction (optional): Use value "1" if you want to display Get Direction link. The value "0" is default which is for hiding this link.

Below is an example of Eiffel Tower in Paris, France. The zoom level is 15, Get Direction link is not displayed, the map is 100% of page width and 400px high.

```
(mapkit){"id":"eiffel",
"lat":"48.858486",
"long":"2.294475",
"width":"100%",
"height":"400px",
"zoom":"15",
"get_direction":"0"}
```

## Contribution and support

If you want to report bugs or have a question, please create an issue.

If you want to contribute to the development of the extension, please submit your pull requests to "develop" branch.

## License

This Mapkit extension is under the MIT license.