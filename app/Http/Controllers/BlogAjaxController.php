<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BlogRepository;

class BlogAjaxController extends Controller
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
        
        $this->middleware('admin')->only('updateSeen');
        $this->middleware('redac')->only('updateActive');
        $this->middleware('ajax');
    }

    /**
     * Update "vu" for the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(Request $request, $id)
    {
        $this->blogRepository->updateSeen($request->all(), $id);

        return response()->json();
    }

    /**
     * Update "active" for the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateActive(Request $request, $id)
    {
        $post = $this->blogRepository->getById($id);

        $this->authorize('change', $post);
        
        $this->blogRepository->updateActive($request->all(), $id);

        return response()->json();
    }
}
