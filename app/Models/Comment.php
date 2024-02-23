<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'post_id', 'user_id', 'comments_content',
    ];

    /**
     * Get the commentator that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commentator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function createComment(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required',
        ]);

        $request['user_id'] = auth()->user()->id;

        $comment = Comment::create($request->all());

        return $comment;
    }

    public static function editComment(Request $request, $id)
    {
        $validated = $request->validate([
            'comments_content' => 'required',
        ]);

        $comment = Comment::find($id);
        $comment->update($request->only('comments_content'));

        return $comment;
    }
    
    public static function breakComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return $comment;
    }
}
