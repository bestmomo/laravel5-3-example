<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CommentRepository;
use App\Http\Requests\CommentRequest;

class CommentAjaxController extends Controller
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

        $this->middleware('admin')->only('updateSeen');
        $this->middleware('auth')->only('update');
        $this->middleware('ajax');
    }

     /**
     * Update "seen" in the specified comment in storage.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(Request $request, $id)
    {
        $this->commentRepository->update($request->input('seen'), $id);

        return response()->json();
    }

    /**
     * Update the specified comment in storage.
     *
     * @param  \App\requests\CommentRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $id)
    {
        $content = $request->input('comments' . $id);
        $this->commentRepository->updateContent($content, $id);

        return ['id' => $id, 'content' => $content];
    }
}
