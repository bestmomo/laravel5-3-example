<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\User;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTag;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Role::create([
            'title' => 'Administrator',
            'slug' => 'admin',
        ]);

        Role::create([
            'title' => 'Redactor',
            'slug' => 'redac',
        ]);

        Role::create([
            'title' => 'User',
            'slug' => 'user',
        ]);

        User::create([
            'username' => 'GreatAdmin',
            'email' => 'admin@la.fr',
            'password' => bcrypt('admin'),
            'seen' => true,
            'role_id' => 1,
            'confirmed' => true,
        ]);

        User::create([
            'username' => 'GreatRedactor',
            'email' => 'redac@la.fr',
            'password' => bcrypt('redac'),
            'seen' => true,
            'role_id' => 2,
            'valid' => true,
            'confirmed' => true,
        ]);

        User::create([
            'username' => 'Walker',
            'email' => 'walker@la.fr',
            'password' => bcrypt('walker'),
            'role_id' => 3,
            'confirmed' => true,
        ]);

        User::create([
            'username' => 'Slacker',
            'email' => 'slacker@la.fr',
            'password' => bcrypt('slacker'),
            'role_id' => 3,
            'confirmed' => true,
        ]);

        Contact::create([
            'name' => 'Dupont',
            'email' => 'dupont@la.fr',
            'message' => Lipsum::short()->text(2),
        ]);

        Contact::create([
            'name' => 'Durand',
            'email' => 'durand@la.fr',
            'message' => Lipsum::short()->text(2),
        ]);

        Contact::create([
            'name' => 'Martin',
            'email' => 'martin@la.fr',
            'message' => Lipsum::short()->text(2),
            'seen' => true,
        ]);

        Tag::create([
            'tag' => 'Tag1',
        ]);

        Tag::create([
            'tag' => 'Tag2',
        ]);

        Tag::create([
            'tag' => 'Tag3',
        ]);

        Tag::create([
            'tag' => 'Tag4',
        ]);

        Post::create([
            'title' => 'Post 1',
            'slug' => 'post-1',
            'summary' => '<img alt="" src="/files/user2/mega-champignon.png" style="float:left; height:128px; width:128px" />' . Lipsum::short()->html(2),
            'content' => Lipsum::medium()->html(2) . '<pre>
<code class="language-php">protected function getUserByRecaller($recaller)
{
    if ($this-&gt;validRecaller($recaller) &amp;&amp; ! $this-&gt;tokenRetrievalAttempted)
    {
        $this-&gt;tokenRetrievalAttempted = true;

        list($id, $token) = explode("|", $recaller, 2);

        $this-&gt;viaRemember = ! is_null($user = $this-&gt;provider-&gt;retrieveByToken($id, $token));

        return $user;
    }
}</code></pre>' . Lipsum::medium()->html(2),
            'active' => true,
            'user_id' => 1,
        ]);

        Post::create([
            'title' => 'Post 2',
            'slug' => 'post-2',
            'summary' => '<img alt="" src="/files/user2/goomba.png" style="float:left; height:128px; width:128px" />' . Lipsum::short()->html(2),
            'content' => Lipsum::medium()->link()->html(8),
            'active' => true,
            'user_id' => 2,
        ]);

        Post::create([
            'title' => 'Post 3',
            'slug' => 'post-3',
            'summary' => '<img alt="" src="/files/user2/rouge-shell.png" style="float:left; height:128px; width:128px" />' . Lipsum::short()->html(2),
            'content' => Lipsum::medium()->link()->html(8),
            'active' => true,
            'user_id' => 2,
        ]);

        Post::create([
            'title' => 'Post 4',
            'slug' => 'post-4',
            'summary' => '<img alt="" src="/files/user2/rouge-shyguy.png" style="float:left; height:128px; width:128px" />' . Lipsum::short()->html(2),
            'content' => Lipsum::medium()->link()->html(8),
            'active' => true,
            'user_id' => 2,
        ]);

        PostTag::create([
            'post_id' => 1,
            'tag_id' => 1,
        ]);

        PostTag::create([
            'post_id' => 1,
            'tag_id' => 2,
        ]);

        PostTag::create([
            'post_id' => 2,
            'tag_id' => 1,
        ]);

        PostTag::create([
            'post_id' => 2,
            'tag_id' => 2,
        ]);

        PostTag::create([
            'post_id' => 2,
            'tag_id' => 3,
        ]);

        PostTag::create([
            'post_id' => 3,
            'tag_id' => 1,
        ]);

        PostTag::create([
            'post_id' => 3,
            'tag_id' => 2,
        ]);

        PostTag::create([
            'post_id' => 3,
            'tag_id' => 4,
        ]);

        Comment::create([
            'content' => Lipsum::medium()->text(3),
            'user_id' => 2,
            'post_id' => 1,
        ]);

        Comment::create([
            'content' =>Lipsum::medium()->text(2),
            'user_id' => 2,
            'post_id' => 2,
        ]);

        Comment::create([
            'content' => Lipsum::medium()->text(3),
            'user_id' => 3,
            'post_id' => 1,
        ]);
    }
}
