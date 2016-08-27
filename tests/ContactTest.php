<?php

class ContactTest extends TestCase
{
    /**
     * Test visit
     *
     * @return void
     */
    public function testVisit()
    {
        $this->visit('/contact/create')
            ->see('Contact form')
            ->click('Contact')
            ->seePageIs('/contact/create');
    }

    /**
     * Test contact OK
     *
     * @return void
     */
    public function testOk()
    {
        $this->visit('/contact/create')
            ->type('Someone', 'name')
            ->type('someone@somewhere.com', 'email')
            ->type('A message', 'message')
            ->press('Send')
            ->see('Your message has been recorded')
            ->seeInDatabase('contacts', [
                'name' => 'Someone',
                'email' => 'someone@somewhere.com',
                'message' => 'A message'
            ]);
    }

    /**
     * Test required
     *
     * @return void
     */
    public function testRequired()
    {
        $this->visit('/contact/create')
            ->press('Send')
            ->see('The name field is required')
            ->see('The email field is required')
            ->see('The message field is required');
    }

    /**
     * Test valid
     *
     * @return void
     */
    public function testValid()
    {
        $this->visit('/contact/create')
            ->type(str_repeat('0123456789', 5) . '0', 'name')
            ->type('email@s', 'email')
            ->type(str_repeat('0123456789', 100) . '0', 'message')
            ->press('Send')
            ->see('The name may not be greater than 50 characters')
            ->see('The email must be a valid email address')
            ->see('The message may not be greater than 1000 characters');
    }
}
