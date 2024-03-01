<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'comments' => $this->collection->transform(function ($user) {
                return array(
                    'id' => $user->id,
                    'post_id' => $user->post_id,
                    'user_id' => $user->user_id,
                    'comments_content' => $user->comments_content,
                    'created_at' => date_format($user->created_at, "Y-m-d H:i:s"),
                );
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
