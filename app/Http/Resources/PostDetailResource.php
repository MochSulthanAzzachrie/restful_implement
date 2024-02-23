<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            // 'image' => $this->image,
            'novel_content' => $this->novel_content,
            'created_at' => date_format($this->created_at, "Y-m-d H:i:s"),
            'author' => $this->user_id,
            'writer' => $this->whenLoaded('writer'),
            'comments' => $this->whenLoaded('comments', function () {
                return collect($this->comments)->each(function ($comment) {
                    $comment->commentator;
                    return $comment;
                });
            }),
            'comments_total' => $this->whenLoaded('comments', function () {
                return $this->comments->count();
            })
        ];
    }
}
