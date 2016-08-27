<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\BlogRepository;

class BlogController extends Controller
{
    /**
     * The BlogRepository instance.
     *
     * @var \App\Repositories\BlogRepository
     */
    protected $blogRepository;

    /**
     * Create a new BlogController instance.
     *
     * @param  \App\Repositories\BlogRepository $blogRepository
     * @return void
    */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;

        $this->middleware('redac');
    }

    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('blog.order', [
            'name' => 'posts.created_at',
            'sens' => 'asc',
        ]));
    }

    /**
     * Display a listing of the posts.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function indexOrder(Request $request)
    {
        $statut = session('statut');
        $posts = $this->blogRepository->getPostsWithOrder(
            config('app.nbrPages.back.posts'),
            $statut == 'admin' ? null : $request->user()->id,
            $request->name,
            $request->sens
        );
        
        $links = $posts->appends([
            'name' => $request->name,
            'sens' => $request->sens
        ]);

        if ($request->ajax()) {
            return [
                'view' => view('back.blog.table', compact('statut', 'posts'))->render(),
                'links' => e($links->setPath('order')->links()),
            ];
        }

        $links->links();

        $order = new \stdClass;
        $order->name = $request->name;
        $order->sens = 'sort-' . $request->sens;

        return view('back.blog.index', compact('posts', 'links', 'order'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.blog.create');
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \App\Http\Requests\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $this->blogRepository->store($request->all(), $request->user()->id);

        return redirect('blog')->with('ok', trans('back/blog.stored'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->blogRepository->getByIdWithTags($id);

        $this->authorize('change', $post);

        return view('back.blog.edit', $this->blogRepository->getPostWithTags($post));
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \App\Http\Requests\PostUpdateRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = $this->blogRepository->getById($id);

        $this->authorize('change', $post);

        $this->blogRepository->update($request->all(), $post);

        return redirect('blog')->with('ok', trans('back/blog.updated'));
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->blogRepository->getById($id);

        $this->authorize('change', $post);

        $this->blogRepository->destroy($post);

        return redirect('blog')->with('ok', trans('back/blog.destroyed'));
    }
}
