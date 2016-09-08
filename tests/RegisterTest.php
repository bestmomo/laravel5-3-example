<?php

use App\Models\User;

class RegisterTest extends TestCase
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
            ->click('I subscribe')
            ->seePageIs('/register')
            ->see('Inscription');
    }

    /**
     * Test required
     *
     * @return void
     */
    public function testRequired()
    {
        $this->visit('/register')
            ->press('Send')
            ->see('The username field is required')
            ->see('The email field is required')
            ->see('The password field is required');
    }

    /**
     * Test valid
     *
     * @return void
     */
    public function testValid()
    {
        $this->visit('/register')
            ->type('My name', 'username')
            ->type('email@s', 'email')
            ->type('01', 'password')
            ->press('Send')
            ->see('The username may only contain letters')
            ->see('The email must be a valid email address')
            ->see('The password must be at least 6 characters')
            ->visit('/register')
            ->type(str_repeat('0123456789', 3) . '0', 'username')
            ->type('admin@la.fr', 'email')
            ->type('012345678', 'password')
            ->press('Send')
            ->see('The username may not be greater than 30 characters')
            ->see('The email has already been taken')
            ->see('The password confirmation does not match');
    }

    /**
     * Test register
     *
     * @return void
     */
    public function testRegister()
    {
        $user = factory(User::class)->make();

        $this->visit('/')
            ->click('Connection')
            ->click('I subscribe')
            ->submitForm('Send', [
                'username' => $user->username,
                'email' => $user->email,
                'password' => $user->password,
                'password_confirmation' => $user->password,
            ])
            ->see('Thanks for signing up');

        $user = User::whereUsername($user->username)->first();

        $this->visit('/confirm/' . $user->confirmation_code)
            ->see('You have successfully verified your account');
    }
}
