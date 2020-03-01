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

	public function inject(array $article, array $advert) : array
	{
		if (!isset($article['widgets'])) {
			return $article;
		}

		$points = $adsCounter = 0;

		foreach ($article['widgets'] as $widget) {
			$class = $this->factory->create($widget['layout']);
			$points += $class->getPointsValue($widget);
			// use counter instead of array key incase key is not int
			$adsCounter++;

			if ($points >= $this::POINTS) {
				// reset points counter
				$points = 0;
				// if points are equal or more than 3.5 then add an ad before the next widget
				array_splice($article['widgets'], $adsCounter, 0, $advert);
			}
		}

		return $article;
	}
}
