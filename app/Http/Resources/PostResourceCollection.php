<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'posts' => $this->collection->transform(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'novel_content' => $post->novel_content,
                    'created_at' => $post->created_at->format("Y-m-d H:i:s"),
                    'author' => $post->user_id,
                    'writer' => $post->writer,
                    'comments' => $post->comments,
                    'comments_total' => count($post->comments),
                ];
            }),
            'pagination' => [
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'total_page' => $this->lastPage(),
                'per_page' => $this->perPage(),
                'total_data' => $this->total(),
                'from' => $this->firstItem(),
                'to' => $this->lastItem(),
                'links' => [
                    'prev_page_url' => $this->previousPageUrl(),
                    'next_page_url' => $this->nextPageUrl(),
                    'first_page_url' => $this->url(1),
                    'last_page_url' => $this->url($this->lastPage())
                ],
            ]
        ];
    }
}
