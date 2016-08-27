<?php

class BlogTest extends TestCase
{
    /**
     * Test visit
     *
     * @return void
     */
    public function testVisit()
    {
        $this->visit('/articles')
            ->see('Read more')
            ->click('Blog')
            ->see('Read more');
    }

    /**
     * Test open blog
     *
     * @return void
     */
    public function testOpenBlog()
    {
        $this->visit('/articles')
            ->click('Read more')
            ->see('Comments');
    }
}
