<?php

class CommentTest extends TestCase
{
    /**
     * Test add comment
     *
     * @return void
     */
    public function testAddComment()
    {
        $this->visit('/login')
            ->type('redac@la.fr', 'log')
            ->type('redac', 'password')
            ->press('Send')
            ->visit('blog/post-1')
            ->see('A comment ?')
            ->type('My comment', 'comments')
            ->press('Send')
            ->see('My comment');
    }
}
