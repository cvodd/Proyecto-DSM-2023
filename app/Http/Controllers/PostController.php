<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::whereHas('user', function ($query) {
            $query->where('status', 'active');
        })->orderBy('created_at', 'desc')->get();

        return response()->json($posts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        try {
            $token = $request->header('Authorization');

            // Obtenemos al usuario autenticado
            $user = JWTAuth::toUser($token);

            // Crear el post
            $post = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'pathPhoto' => $request->pathPhoto,
                'likesCount' => 0,
                'comments' => 0,
                'user_id' => $user->id,
            ]);

            // Retornamos la respuesta
            return response()->json([
                'post' => $post,
            ], 200);
        } catch (JWTException $e) {
            // Retornamos la respuesta
            return response()->json([
                'message' => 'Oops ha ocurido un error...',
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
