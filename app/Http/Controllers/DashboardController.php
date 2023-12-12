<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{

    /*
     * Show the dashboard view.
     *
     *
     */
    public function index()
    {
        try {
            // Fetch all posts
            $posts = Post::all();

            // Count the number of posts
            $numberOfPosts = $posts->count();

            // Fetch all disabled users
            $disabledUsers = User::where('status', 'disabled')->get();

            // Count the number of disabled users
            $numberOfDisabledUsers = $disabledUsers->count();

            // Fetch all active users
            $activeUsers = User::where('status', 'active')->get();

            // Count the number of active users
            $numberOfActiveUsers = $activeUsers->count();

            // Fetch the post with the most likes and comments
            $mostPopularPost = Post::orderBy('likesCount', 'desc')->orderBy('comments', 'desc')->first();

            // Pass the data to the view
            return view('layouts.dashboard', compact('numberOfPosts', 'numberOfDisabledUsers','numberOfActiveUsers' ,'mostPopularPost'));

        } catch (QueryException $exception) {
            //Log::info($e->getMessage());
            throw new \Exception($exception->getMessage());
            //return redirect()->route('errorDB');
        }
    }

    /*
     * Show the Database error.
     *
     *
     */
    public function errorDB()
    {
        return view('errors.error', ['message' => 'No se pudo conectar a la base de datos.']);
    }

}
