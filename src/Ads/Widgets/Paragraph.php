<?php

namespace BackendApp\Ads\Widgets;

class Paragraph implements WidgetInterface
{
	public function getPointsValue(array $widget) : float
	{
        $points = 0;
        if (isset($widget['text'])) {
            $filteredText = strlen(strip_tags($widget['text']));
            // prevent error if strlen = 0
            $points = $filteredText > 0 ? $filteredText / 1000 : 0;
        }

		return $points;
	}
}
