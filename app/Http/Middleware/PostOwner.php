<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PostOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = auth()->user();
        $post = Post::where('id', $request->id)->where('user_id', $currentUser->id)->first();

        if (!$post) {
            $response = array(
                'success' => false,
                'message' => 'post not found',
                'data' => null,
            );

            return response()->json($response, 404);
        }

        // return response()->json($currentUser->id);
        return $next($request);
    }
}
