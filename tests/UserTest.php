<?php

use App\Models\User;

class UserTest extends TestCase
{
    /**
     * Test index users
     *
     * @return void
     */
    public function testIndexUser()
    {
        $this->loginAdmin();

        $this->visit('/user/sort')
            ->see('Users gestion')
            ->visit('/user/sort/admin')
            ->see('GreatAdmin')
            ->visit('/user/sort/redac')
            ->see('GreatRedactor')
            ->visit('/user/sort/user')
            ->see('Walker');
    }

    /**
     * Test show/edit user
     *
     * @return void
     */
    public function testShowEditUser()
    {
        $this->loginAdmin();

        $this->visit('/user/3')
            ->see('Walker')
            ->visit('/user/3/edit')
            ->press('Send')
            ->see('User updated');
    }

    /**
     * Test create user required
     *
     * @return void
     */
    public function testCreateUserRequired()
    {
        $this->loginAdmin();

        $this->visit('/user/create')
            ->see('Creation')
            ->press('Send')
            ->see('The username field is required')
            ->see('The email field is required')
            ->see('The password field is required');
    }

    /**
     * Test create user valid
     *
     * @return void
     */
    public function testCreateUserValid()
    {
        $this->loginAdmin();

        $this->visit('/user/create')
            ->see('Creation')
            ->type('My name', 'username')
            ->type('email@s', 'email')
            ->type('01', 'password')
            ->press('Send')
            ->see('The username may only contain letters')
            ->see('The email must be a valid email address')
            ->see('The password must be at least 6 characters')
            ->type(str_repeat('0123456789', 3) . '0', 'username')
            ->type('admin@la.fr', 'email')
            ->type('012345678', 'password')
            ->press('Send')
            ->see('The username may not be greater than 30 characters')
            ->see('The email has already been taken')
            ->see('The password confirmation does not match');
    }

    /**
     * Test create user
     *
     * @return void
     */
    public function testCreateUser()
    {
        $this->loginAdmin();

        $user = factory(User::class)->make();

        $this->visit('/user/create')
            ->submitForm('Send', [
                'username' => $user->username,
                'email' => $user->email,
                'password' => $user->password,
                'password_confirmation' => $user->password,
                'role' => 2
            ])
            ->see('User created');
    }

    /**
     * Test blog reports
     *
     * @return void
     */
    public function testBlogReports()
    {
        $this->loginAdmin();

        $this->visit('/user/blog-report')
            ->see('Blog Report')
            ->see('GreatAdmin')
            ->see('GreatRedactor');
    }
}
