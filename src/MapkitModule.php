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
}