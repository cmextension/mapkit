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

				$lat = (isset($widget->data['lat']) && !empty($widget->data['lat'])) ? $widget->data['lat'] : 0;

				$lng = (isset($widget->data['lng']) && !empty($widget->data['lng'])) ? $widget->data['lng'] : 0;

				$width = (isset($widget->data['width']) && !empty($widget->data['width'])) ? $widget->data['width'] : '100%';

				$height = (isset($widget->data['height']) && !empty($widget->data['height'])) ? $widget->data['height'] : '300px';

				$zoom = (isset($widget->data['zoom']) && !empty($widget->data['zoom'])) ? $widget->data['zoom'] : 10;

				$get_direction = (isset($widget->data['get_direction']) && !empty($widget->data['get_direction'])) ? $widget->data['get_direction'] : 0;
			}
			else
			{
				$map_id = isset($options['id']) ? $options['id'] : 'mapkit';
				$lat = isset($options['lat']) ? $options['lat'] : 0;
				$lng = isset($options['long']) ? $options['long'] : 0;
				$width = isset($options['width']) ? $options['width'] : '100%';
				$height = isset($options['height']) ? $options['height'] : '300px';
				$zoom = isset($options['zoom']) ? $options['zoom'] : 10;
				$get_direction = isset($options['get_direction']) ? $options['get_direction'] : 0;
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
