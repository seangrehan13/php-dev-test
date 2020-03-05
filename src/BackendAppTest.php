<?php
declare(strict_types = 1);

namespace PHPUnit\Framework;

use PHPUnit\Framework\TestCase;

/**
 * Test for BackendApp class
 */
final class BackendAppTest extends TestCase
{
	// public function testCanCreatedFromValid

    public function __construct(RepositoryInterface $repository, AdsInjectorInterface $adsInjector)
    {
        $this->repository = $repository;
        $this->adsInjector = $adsInjector;
    }

    public function start()
    {
        //go to my database of choice get an article
        $article = $this->repository->getArticle(1);
        $advert  = [['layout' => 'ad']];

        //now the fun starts, injecting ads into this article
        $article = $this->adsInjector->inject($article, $advert);

        //this article should contain some ads widgets in it
        header('Content-Type: application/json');
        echo json_encode($article);
    }
}
