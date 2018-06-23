<?php


class FirstCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }


	public function frontpageWorks(AcceptanceTester $I)
	{
		$I->amOnPage('/');
		$I->see('Каталог товаров');
	}//frontpageWorks

	public function goToCatalog(AcceptanceTester $I)
	{
		$I->amGoingTo('Check catalog computers-notebooks');
		$I->amOnPage('/');
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

}//FirstCest
