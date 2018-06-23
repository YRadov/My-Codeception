<?php


class FirstCest
{
    public function _before(AcceptanceTester $I)
    {
	    $I->amOnPage('/');
    }

    public function _after(AcceptanceTester $I)
    {
    }


	public function frontpageWorks(AcceptanceTester $I)
	{
		$I->see('Каталог товаров', '.btn-link-i');
	}//frontpageWorks

	public function goToCatalog(AcceptanceTester $I)
	{
		$I->amGoingTo('Check catalog computers-notebooks');
//		$I->amOnPage('/');
		$I->see('Каталог товаров');
		$I->click('Ноутбуки и компьютеры');

		$I->expect('to see catalog computers-notebooks');
		$I->seeInCurrentUrl('/computers-notebooks/');
		$I->canSeeInCurrentUrl('/computers-notebooks/');
		$I->see('Компьютеры и ноутбуки');

		$I->amGoingTo('Check is elements exist');
		$I->seeElement('h1.pab-h1');
		$I->seeElement('.title-page');
		$I->dontSeeElement('.wrong-title-page');

		$I->see('Компьютеры и ноутбуки', '.title-page');
		$I->see('Компьютеры и ноутбуки', 'h1.pab-h1');
		$I->see('Компьютеры и ноутбуки', 'h1');

		$title = $I->grabTextFrom('.pab-h1');
		$I->assertEquals("Компьютеры и ноутбуки", $title);

		$I->amGoingTo('Check title');
		$I->seeInTitle('Компьютеры и ноутбуки - Rozetka.ua');
		$I->dontSeeInTitle('Determine');

		$catalogName = $I->grabFromCurrentUrl();
		$I->assertContains("computers-notebooks", $catalogName);

		//codecept_debug($catalogName); // only with --debug
		//codecept_debug($I->grabTextFrom('#name'));

	}//goToCatalog

	public function checkSearch(AcceptanceTester $I)
	{
		$I->amGoingTo('Go to catalog with computers');
		$I->click('Ноутбуки и компьютеры');
		$I->seeInCurrentUrl('/computers-notebooks/');
		$I->seeElement('a.pab-h3-link:first-child');
		$I->click("a.pab-h3-link:first-child");
//		//$I->click("Ноутбуки");
		$I->seeInCurrentUrl('/notebooks/');
		$I->see('Ноутбуки', '.pab-h1');

		$I->amGoingTo('Grab first commodity name');
		$I->wait(3);
		$I->seeElement('.g-title-link:first-child');
		$firstCommodityName = $I->grabTextFrom(".g-title-link:first-child");
		$firstCommodityPrice = (int)$I->grabTextFrom(".g-price-uah:first-child");
		$I->assertNotEmpty($firstCommodityName);
		$I->assertGreaterThan(0, $firstCommodityPrice);

		$I->amGoingTo('Search first commodity');
		$I->fillField('text', $firstCommodityName);
		$I->click('Найти');

		/**
		 * if there is only one commodity,
		 * go immediately in details view
		 * instead search page
		 */
		$currentUrl = $I->grabFromCurrentUrl();
		if (strpos ($currentUrl, '/search/' !== false)) {
			$I->seeInCurrentUrl('/search/');
			$I->see($firstCommodityName, '#search_result_title_text');
			$I->amGoingTo('See the commodity found in detail');
			$I->click($firstCommodityName);
		}
		$I->see($firstCommodityName, '.detail-title');
		$priceInDetailView = (int)$I->grabTextFrom("#price_label");
		$I->assertEquals($firstCommodityPrice, $priceInDetailView);
	}//checkSearch

}//FirstCest
