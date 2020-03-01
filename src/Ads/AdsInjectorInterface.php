<?php

namespace BackendApp\Ads;

interface AdsInjectorInterface
{
	public function inject(array $article, array $advert) : array;
}
