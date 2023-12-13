<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

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
            throw new \Exception($exception->getMessage());
        }
    }

    public function loginAuth(LoginRequest $request)
    {
        try {
            //code...
            $validated = $request->validated();

            if(!auth()->attempt($validated->only('email', 'password'), $validated->remember) )
            {
                return back()->with('message', 'Usuario no registrado o contraseña incorrecta');
            }
            // Check if the authenticated user has a role of 2
            if(auth()->user()->role != 2) {
                // Log out the user
                auth()->logout();
                // Redirect back with an error message
                return back()->with('message', 'Solamente el administrador puede acceder a esta página.');
            }
            return redirect()->route('dashboard');
        } catch (\Throwable $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function logout()
    {
        try {
            // Log out the user
            auth()->logout();
            // Redirect back with a success message
            return redirect()->route('login')->with('message', 'Has cerrado sesión correctamente.');
        } catch (\Throwable $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function login()
    {
        // Check if the user is already logged in
        if(auth()->check()) {
            // Redirect to the dashboard
            return redirect()->route('dashboard');
        }
        // Return the login view
        return view('login');

    }
}
