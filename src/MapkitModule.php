<?php
namespace CMExtension\Mapkit;

use Pagekit\Application as App;
use Pagekit\Module\Module;
use CMExtension\Mapkit\Plugin\MapkitPlugin;

class MapkitModule extends Module
{
	public function main(App $app)
	{
		$app->subscribe(new MapkitPlugin());
	}

	public function renderMap(App $app, $data)
	{
		return $app->view('cmextension/mapkit/widget-mapkit.php', compact('data'));
	}
}