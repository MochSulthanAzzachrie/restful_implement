<?php

namespace App\Models;

use QueryParam\Params\Limiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Pagination\LengthAwarePaginator;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'novel_content', 'user_id',
        //  'image',
    ];
    protected $casts = [
        'id' => 'string',
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

    public static function getPosts(array $fields, ?array $filters, $sorters, Limiter $limiter): LengthAwarePaginator
    {
        $posts = self::query()->select($fields['posts']);
        foreach ($fields as $entity => $entityFields) {
            if ($entity != 'posts') {
                $posts->with([
                    $entity => function ($query) use ($entityFields) {
                        $query->select($entityFields);
                    }
                ]);
            }
        }

        if (is_array($filters)) {
            foreach ($filters as $filter) {
                if ($filter->condition == 'between')
                    $posts->whereBetween($filter->field, $filter->values);
                else if ($filter->condition == 'like')
                    if ($filter->field == 'username') {
                        $posts->orWhereHas('users', function ($query) use ($filter) {
                            $query->where($filter->field, 'LIKE', '%' . $filter->values[0] . '%');
                        });
                    } else {
                        $posts->where($filter->field, 'LIKE', '%' . $filter->values[0] . '%');
                    }
                else
                    $posts->where($filter->field, $filter->condition, $filter->values[0]);
            }
        }

        if ($sorters) {
            foreach ($sorters as $sorter) {
                $posts->orderBy($sorter->field, $sorter->directive);
            }
        }

        return $posts->paginate($limiter->limit);
    }

    public static function getPostById(array $fields, array $filters)
    {
        $post = self::query()->select($fields['posts']);
        foreach ($fields as $entity => $entityFields) {
            if ($entity != 'posts') {
                $post->with([
                    $entity => function ($query) use ($entityFields) {
                        $query->select($entityFields);
                    }
                ]);
            }
        }

        if (is_array($filters)) {
            foreach ($filters as $filter) {
                if ($filter->condition == 'between')
                    $post->whereBetween($filter->field, $filter->values);
                else if ($filter->condition == 'like')
                    $post->where($filter->field, 'LIKE', '%' . $filter->values[0] . '%');
                else
                    $post->where($filter->field, $filter->condition, $filter->values[0]);
            }
        }

        return $post->first();
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
