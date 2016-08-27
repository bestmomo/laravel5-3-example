<?php

class HomeTest extends TestCase
{
    /**
     * Home page test
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
            ->see('Laravel 5')
            ->click('Home')
            ->see('Laravel 5');
    }
}
