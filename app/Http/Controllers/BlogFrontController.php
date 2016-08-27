<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Repositories\BlogRepository;

class BlogFrontController extends Controller
{
    /**
     * The BlogFrontController instance.
     *
     * @var \App\Repositories\BlogRepository
     */
    protected $blogRepository;

    /**
     * The pagination number.
     *
     * @var int
     */
    protected $nbrPages;

    /**
     * Create a new BlogController instance.
     *
     * @param  \App\Repositories\BlogRepository $blogRepository
     * @return void
    */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->nbrPages = config('app.nbrPages.front.posts');
    }

    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->blogRepository->getActiveWithUserOrderByDate($this->nbrPages);

        return view('front.blog.index', compact('posts'));
    }

    /**
     * Display the specified post.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $user = $request->user();

        return view('front.blog.show', array_merge($this->blogRepository->getPostBySlug($slug), compact('user')));
    }

    /**
     * Get tagged posts
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function tag(Request $request)
    {
        $tag = $request->input('tag');
        $posts = $this->blogRepository->getActiveWithUserOrderByDateForTag($this->nbrPages, $tag);
        $links = $posts->appends(compact('tag'))->links();
        $info = trans('front/blog.info-tag') . '<strong>' . $this->blogRepository->getTagById($tag) . '</strong>';
        
        return view('front.blog.index', compact('posts', 'links', 'info'));
    }

    /**
     * Find search in blog
     *
     * @param  \App\Http\Requests\SearchRequest $request
     * @return \Illuminate\Http\Response
     */
    public function search(SearchRequest $request)
    {
        $search = $request->input('search');
        $posts = $this->blogRepository->search($this->nbrPages, $search);
        $links = $posts->appends(compact('search'))->links();
        $info = trans('front/blog.info-search') . '<strong>' . $search . '</strong>';
        
        return view('front.blog.index', compact('posts', 'links', 'info'));
    }
}
