<?php

namespace BackendApp\Ads;

use BackendApp\Ads\Widgets\WidgetFactory;

class AdsInjector implements AdsInjectorInterface
{
	const POINTS = 3.5;
	private $factory;

	public function __construct()
	{
		$this->factory = WidgetFactory::getInstance();
	}

	public function inject(array $article) : array
	{
		if (!isset($article['widgets'])) {
			return $article;
		}

		$points = 0;
		// create new empty array
		$widgetsWithAds = [];

		foreach ($article['widgets'] as $widget) {
			$class = $this->factory->create($widget['layout']);
			$points += $class->getPointsValue($widget);

			if ($points >= $this::POINTS) {
				// reset points counter
				$points = 0;
				// if points are equal or more than 3.5 then add an ad before the next widget
				$widgetsWithAds[] = ['layout' => 'ad'];
			}

			// add widget to new array
			$widgetsWithAds[] = $widget;
		}

		// after loop overwrite with new array
		$article['widgets'] = $widgetsWithAds;

		return $article;
	}
}
