<?php

use yii\helpers\Url as Url;
use app\tests\fixtures\UserFixture;

class LoginCest
{
    public function _fixtures()
    {
        return ['users' => UserFixture::className()];
    }

    public function ensureThatLoginWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/user/security/login'));
        $I->see('Login', 'h3');
        $I->amGoingTo('login with correct credentials');
        $I->submitForm('#login-form', [
            'login-form[login]' => 'root',
            'login-form[password]' => 'password'
        ]);
        $I->expectTo('see user info');
        $I->see('root', 'a.dropdown-toggle');
    }

    public function ensureJwtTokenWorks(AcceptanceTester $I)
    {
        $I->amYii2JwtAuthenticated('root', 'password');
        $I->amOnPage(Url::toRoute('/api/users'));
        $I->seeResponseCodeIs(200);
    }
}
