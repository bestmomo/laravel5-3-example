<?php

class ResetPasswordTest extends TestCase
{
    /**
     * Test reset password
     *
     * @return void
     */
    public function testResetPassword()
    {
        $this->visit('/password/reset')
            ->submitForm('Send', ['email' => 'walker@la.fr'])
            ->see('We have e-mailed your password reset link');

        $password_reset = DB::table('password_resets')->whereEmail('walker@la.fr')->first();

        $this->visit('/password/reset/' . $password_reset->token)
            ->see('Password creation')
            ->submitForm('Send', [
                'email' => 'walker@la.fr',
                'password' => 'walker',
                'password_confirmation' => 'walker',
            ])
            ->see('Logout');
    }
}
