<?php
return [
	'name' => 'cmextension/mapkit',

	'label' => 'Mapkit',

	'events' => [
		'view.scripts' => function ($event, $scripts) use ($app) {
			$apiKey = $app->config('cmextension/mapkit')->get('api_key');
			$apiUrl = '//maps.googleapis.com/maps/api/js?key=' . $apiKey;

			$scripts->register('widget-mapkit-api', $apiUrl, ['~widgets']);
			$scripts->register('widget-mapkit', 'cmextension/mapkit:app/bundle/widget-mapkit.js', '~widgets');
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


		return $app['view']('views:/widget-mapkit.php',
			compact('widget', 'map_id', 'lat', 'lng', 'width', 'height', 'zoom', 'get_direction'))
		;
	}
];