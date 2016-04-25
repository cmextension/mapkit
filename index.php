<?php
use Pagekit\Application;

return [
	'name' => 'cmextension/mapkit',

	'type' => 'extension',

	'main' => 'CMExtension\\Mapkit\\MapkitModule',

	'autoload' => [
		'CMExtension\\Mapkit\\' => 'src'
	],

	'permissions' => [
		'mapkit: manage settings' => [
			'title' => 'Manage settings'
		],
	],

	'widgets' => [
		'widgets/mapkit.php'
	],

	'events' => [
		'view.scripts' => function ($event, $scripts) use ($app) {
			$scripts->register('mapkit-settings', 'cmextension/mapkit:app/bundle/settings.js', '~extensions');
		},

		'site' => function ($event, $app) {
			$module = $app->module('cmextension/mapkit');
		}
	],

	'resources' => [
		'views:' => 'views'
	],

	'settings' => 'settings-mapkit',

	'config' => [
		'api_key' => ''
	],
];
