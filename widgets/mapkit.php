<?php
return [
	'name' => 'mapkit',

	'label' => 'Mapkit',

	'events' => [
		'view.scripts' => function ($event, $scripts) use ($app) {
			$scripts->register('widget-mapkit-api', '//maps.googleapis.com/maps/api/js', ['~widgets']);
			$scripts->register('widget-mapkit', 'mapkit:app/bundle/widget-mapkit.js', ['~widgets']);
		}
	],

	'render' => function ($widget) use ($app) {
		$data = $widget->data;
		$map_id = 'mapkit' . $widget->id;
		$lat = $data['lat'];
		$lng = $data['lng'];
		$width = $data['width'];
		$height = $data['height'];
		$zoom = $data['zoom'];
		$get_direction = $data['get_direction'];

		if ((strpos($width, 'px') !== false) && (strpos($width, '%') !== false))
		{
			$width = $width . 'px';
		}

		if ((strpos($height, 'px') !== false) && (strpos($height, '%') !== false))
		{
			$height = $height . 'px';
		}


		return $app['view']('mapkit/widget-mapkit.php',
			compact('widget', 'map_id', 'lat', 'lng', 'width', 'height', 'zoom', 'get_direction'))
		;
	}
];