<?php

namespace BackendApp\Ads\Widgets;

class Paragraph implements WidgetInterface
{
	public function getPointsValue(array $widget) : float
	{
        $points = 0;
        if (isset($widget['text'])) {
            $points = strlen($widget['text']) / 1000;
        }

		return $points;
	}
}
