<?php

class ConnectionTest extends TestCase
{
    /**
     * Test Visit
     *
     * @return void
     */
    public function testVisit()
    {
        $this->visit('/')
            ->click('Connection')
            ->seePageIs('/login')
            ->see('Connection');
    }

    /**
     * Test required
     *
     * @return void
     */
    public function testRequired()
    {
        $this->visit('/login')
            ->press('Send')
            ->see('The log field is required')
            ->see('The password field is required');
    }

    /**
     * Test login by name
     *
     * @return void
     */
    public function testLoginByName()
    {
        $this->visit('/login')
            ->type('GreatAdmin', 'log')
            ->type('admin', 'password')
            ->press('Send')
            ->seePageIs('/')
            ->see('Logout');
    }

    /**
     * Test login by email
     *
     * @return void
     */
    public function testLoginByEmail()
    {
        $this->visit('/login')
            ->type('redac@la.fr', 'log')
            ->type('redac', 'password')
            ->press('Send')
            ->seePageIs('/')
            ->see('Logout');

        auth()->user()->setRememberToken('');
    }

    /**
     * Test login with remember
     *
     * @return void
     */
    public function testLoginWithRemember()
    {
        $this->visit('/login')
            ->type('redac@la.fr', 'log')
            ->type('redac', 'password')
            ->check('memory')
            ->press('Send')
            ->assertTrue(auth()->user()->getRememberToken() != '');
    }

    /**
     * Test logout
     *
     * @return void
     */
    public function testLogout()
    {
        $this->loginAdmin();
        
        $form = $this->visit('/')->getForm();
        
        $this->visit('/')
            ->makeRequestUsingForm($form)
            ->see('Login');
    }
}
