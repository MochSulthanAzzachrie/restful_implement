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
    public function users(): BelongsTo
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
        $posts = self::with('comments')->get();

        return $posts;
    }

    public static function getPostById($id)
    {
        $post = self::with('comments')->find($id);

        return $post;
    }

    public static function createPost(array $data)
    {

        $data['user_id'] = Auth::user()->id;
        $post = self::create($data);

        return $post;
    }

    public static function updatePost(array $data, $id)
    {

        $post = self::find($id);
        $post->update($data);

        return $post;
    }

    public static function deletePost($id)
    {
        $post = self::find($id);
        $post->delete();

        return $post;
    }
}
