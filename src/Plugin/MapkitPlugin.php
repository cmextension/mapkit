<?php
namespace CMExtension\Mapkit\Plugin;

use Pagekit\Application as App;
use Pagekit\Content\Event\ContentEvent;
use Pagekit\Event\EventSubscriberInterface;
use Pagekit\Widget\Model\Widget;

class MapkitPlugin implements EventSubscriberInterface
{
	public function onContentPlugins(ContentEvent $event)
	{
		$event->addPlugin('mapkit', [$this, 'applyPlugin']);
	}

	public function applyPlugin(array $options)
	{
		if ((isset($options['widget_id']))
			|| (isset($options['lat']) && isset($options['long'])))
		{
			if (isset($options['widget_id']))
			{
				$widgetId = (int) $options['widget_id'];
				$widget = Widget::find($widgetId);

				if (!isset($widget->id))
				{
					return;
				}

				$map_id = 'mapkit' . $widget->id;
				$lat = $widget->data['lat'];
				$lng = $widget->data['lng'];
				$width = $widget->data['width'];
				$height = $widget->data['height'];
				$zoom = $widget->data['zoom'];
				$get_direction = $widget->data['get_direction'];
			}
			else
			{
				$map_id = isset($options['id']) ? $options['id'] : 'mapkit';
				$lat = $options['lat'];
				$lng = $options['long'];
				$width = isset($options['width']) ? $options['width'] : '100%';
				$height = isset($options['height']) ? $options['height'] : '300px';
				$zoom = isset($options['zoom']) ? $options['zoom'] : '10';
				$get_direction = isset($options['get_direction']) ? $options['get_direction'] : '0';
			}

			if ((strpos($width, 'px') === false) && (strpos($width, '%') === false))
			{
				$width = $width . 'px';
			}

			if ((strpos($height, 'px') === false) && (strpos($height, '%') === false))
			{
				$height = $height . 'px';
			}

			$app = App::getInstance();

			return $app->view('views:widget-mapkit.php',
				compact('widget', 'map_id', 'lat', 'lng', 'width', 'height', 'zoom', 'get_direction')
			);
		}
	}

	public function subscribe()
	{
		return [
			'content.plugins' => ['onContentPlugins', 25],
		];
	}
}
