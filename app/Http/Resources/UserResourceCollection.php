<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'users' => $this->collection->transform(function ($user) {
                return $user;
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
