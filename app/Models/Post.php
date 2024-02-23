<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'novel_content', 'user_id',
        //  'image',
    ];

    /**
     * Get the writer that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function writer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the comments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public static function getPosts()
    {
        $posts = Post::with('comments')->get();

        return $posts;
    }

    public static function getPostById($id)
    {
        $post = Post::with('comments')->find($id);

        return $post;
    }

    public static function createPost(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:225',
            'novel_content' => 'required',
        ]);

        $request['user_id'] = Auth::user()->id;
        $post = Post::create($request->all());

        return $post;
    }

    public static function editPost(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'nullable|max:225',
            'novel_content' => 'nullable',
        ]);

        $post = Post::find($id);
        $post->update($request->all());

        return $post;
    }

    public static function breakPost($id)
    {
        $post = Post::find($id);
        $post->delete();

        return $post;
    }
}
