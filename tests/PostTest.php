<?php

class PostTest extends TestCase
{
    /**
     * Test index posts
     *
     * @return void
     */
    public function testIndexPost()
    {
        $this->loginAdmin();

        $this->visit('/blog')
            ->see('Posts gestion');
    }

    /**
     * Test edit post
     *
     * @return void
     */
    public function testEditPost()
    {
        $this->loginAdmin();

        $this->visit('/blog/1/edit')
            ->type('My summary', 'summary')
            ->type('Tag5', 'tags')
            ->press('Send')
            ->visit('/blog/post-1')
            ->see('My summary')
            ->see('Tag5');
    }

    /**
     * Test create post required
     *
     * @return void
     */
    public function testCreatePostRequired()
    {
        $this->loginAdmin();

        $this->visit('/blog/create')
            ->press('Send')
            ->see('The title field is required')
            ->see('The slug field is required')
            ->see('The summary field is required')
            ->see('The content field is required');
    }

    /**
     * Test create post valid
     *
     * @return void
     */
    public function testCreatePostValid()
    {
        $this->loginAdmin();

        $this->visit('/blog/create')
            ->type(str_repeat('0123456789', 25) . '012345', 'title')
            ->type('post-1', 'slug')
            ->type(str_repeat('0123456789', 6500) . '0', 'summary')
            ->type(str_repeat('0123456789', 6500) . '0', 'content')
            ->type('aa a', 'tags')
            ->press('Send')
            ->see('The title may not be greater than 255 characters')
            ->see('The slug has already been taken')
            ->see('The summary may not be greater than 65000 characters')
            ->see('The content may not be greater than 65000 characters')
            ->see('Tags, separated by commas (no spaces), should have a maximum of 50 characters');
    }

    /**
     * Test create post
     *
     * @return void
     */
    public function testCreatePost()
    {
        $this->loginAdmin();

        $this->visit('/blog/create')
            ->type('My summary', 'summary')
            ->type('My content', 'content')
            ->type('Tag6', 'tags')
            ->press('Send')
            ->see('Posts gestion');
    }
}
