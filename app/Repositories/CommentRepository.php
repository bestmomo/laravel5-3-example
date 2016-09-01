<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository extends BaseRepository
{
    /**
     * Create a new CommentRepository instance.
     *
     * @param  \App\Models\Comment $comment
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    /**
     * Get comments collection.
     *
     * @param  int  $n
     * @return Illuminate\Support\Collection
     */
    public function getCommentsWithPostsAndUsers($n)
    {
        return $this->model
            ->with('post', 'user')
            ->oldest('seen')
            ->latest()
            ->paginate($n);
    }

    /**
     * Store a comment.
     *
     * @param  array $inputs
     * @param  int   $user_id
     * @return void
     */
    public function store($inputs, $user_id)
    {
        $this->model->content = $inputs['comments'];
        $this->model->post_id = $inputs['post_id'];
        $this->model->user_id = $user_id;

        $this->model->save();
    }
    /**
     * Update a comment.
     *
     * @param  string $content
     * @param  int    $id
     * @return void
     */
    public function updateContent($content, $id)
    {
        $comment = $this->getById($id);

        $comment->content = $content;

        $comment->save();
    }

    /**
     * Update a comment.
     *
     * @param  bool  $seen
     * @param  int   $id
     * @return void
     */
    public function update($seen, $id)
    {
        $comment = $this->getById($id);

        $comment->seen = $seen == 'true';

        $comment->save();
    }
}
