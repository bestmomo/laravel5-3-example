<?php

class RoleTest extends TestCase
{
    /**
     * Test user role.
     *
     * @return void
     */
    public function testUserRole()
    {
        $this->visit('/login')
            ->type('walker@la.fr', 'log')
            ->type('walker', 'password')
            ->press('Send')
            ->seePageIs('/')
            ->dontSee('Administration')
            ->dontSee('Redaction')
            ->visit('/user/sort')
            ->seePageIs('/')
            ->visit('/admin')
            ->seePageIs('/')
            ->visit('/comment')
            ->seePageIs('/')
            ->visit('/blog')
            ->seePageIs('/')
            ->visit('/contact')
            ->see('/');
    }

    /**
     * Test user role.
     *
     * @return void
     */
    public function testAdminRole()
    {
        $this->visit('/login')
            ->type('admin@la.fr', 'log')
            ->type('admin', 'password')
            ->press('Send')
            ->seePageIs('/')
            ->See('Administration')
            ->visit('/admin')
            ->seePageIs('/admin')
            ->visit('/user/sort')
            ->see('Users gestion')
            ->visit('/comment')
            ->see('Comments gestion')
            ->visit('/contact')
            ->see('Messages gestion');
    }

    /**
     * Test user role.
     *
     * @return void
     */
    public function testRedacRole()
    {
        $this->visit('/login')
            ->type('redac@la.fr', 'log')
            ->type('redac', 'password')
            ->press('Send')
            ->seePageIs('/')
            ->See('Redaction')
            ->visit('/user/sort')
            ->seePageIs('/')
            ->visit('/admin')
            ->seePageIs('/')
            ->visit('/comment')
            ->seePageIs('/')
            ->visit('/contact')
            ->see('/')
            ->visit('/blog')
            ->see('Posts gestion');
    }
}
