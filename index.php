<?php
use Pagekit\Application;

return [
	'name' => 'mapkit',

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
		'site' => function ($event, $app) {
			$module = $app->module('cmextension/mapkit');
		}
	],

	'resources' => [
		'views:' => 'views'
	]
];
