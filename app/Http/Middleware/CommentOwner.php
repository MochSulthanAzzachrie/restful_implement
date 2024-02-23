<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CommentOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $comment = Comment::where('id', $request->id)->where('user_id', $user->id)->first();

        if (!$comment) {
            $response = array(
                'success' => false,
                'message' => 'comment not found',
                'data' => null,
            );

            return response()->json($response, 404);
        }

        return $next($request);
    }
}
