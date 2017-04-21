<?php 

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use App\Repositories\CommentRepository;
use App\Repositories\BlogRepository;
use App\Notifications\Commented;
use Carbon\Carbon;

class CommentController extends Controller
{
    /**
     * The CommentRepository instance.
     *
     * @var \App\Repositories\CommentRepository
     */
    protected $commentRepository;

    /**
     * Create a new CommentController instance.
     *
     * @param  \App\Repositories\CommentRepository $commentRepository
     * @return void
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;

        $this->middleware('admin')->only('index');
        $this->middleware('auth')->only('store', 'destroy');
    }

    /**
     * Display a listing of the comments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = $this->commentRepository->getCommentsWithPostsAndUsers(config('app.nbrPages.back.comments'));

        return view('back.comments.index', compact('comments'));
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param  \App\requests\CommentRequest $request
     * @param  \App\Repositories\BlogRepository $blogRepository
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, BlogRepository $blogRepository)
    {
        $this->commentRepository->store($request->all(), $request->user()->id);

        $blog = $blogRepository->getById($request->post_id);
        
        $blog->user->notify(new Commented($blog, $request->user()->id));
        
        if (!$request->user()->valid) {
            $request->session()->flash('warning', trans('front/blog.warning'));
        }

        return back();
    }

    /**
     * Remove the specified comment from storage.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->commentRepository->destroy($id);

        if ($request->ajax()) {
            return ['id' => $id];
        }

        return redirect('comment');
    }
}
