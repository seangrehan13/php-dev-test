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

		$points = 0;
		$widgetsLength = count($article['widgets']);

		// for loop is faster than foreach
		for ($i = 0; $widgetsLength > $i; $i++) {
			$class = $this->factory->create($article['widgets'][$i]['layout']);
			$points += $class->getPointsValue($article['widgets'][$i]);

			if ($points >= $this::POINTS) {
				// reset points counter
				$points = 0;
				// if points are equal or more than 3.5 then add an ad before the next widget
				array_splice($article['widgets'], $i, 0, $advert);
			}
		}

		return $article;
	}
}
