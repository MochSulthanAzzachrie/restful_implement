<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function createComment(array $data)
    {

        $data['user_id'] = auth()->user()->id;

        $comment = self::create($data);

        return $comment;
    }

    public static function updateComment(array $data, $id)
    {

        $comment = self::find($id);
        $comment->update(['comments_content' => $data['comments_content']]);

        return $comment;
    }

    public static function deleteComment($id)
    {
        $comment = self::findOrFail($id);
        $comment->delete();

        return $comment;
    }
}
