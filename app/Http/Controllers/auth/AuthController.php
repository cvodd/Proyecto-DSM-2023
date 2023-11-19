<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */



     public function register(RegisterRequest $request)
     {

       $user = User::create([
            'name' => $request->name,
            'lastName' => $request->lastName,
            'userName' => $request->userName,
            'birthDate' => $request->birthDate,
            'email' => $request->email,
            'password' =>$request->password,
        ]);

        // Generar el token
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => 'register',

        ]);

     }


    public function login(LoginRequest $request)
    {
        $credentials =$request->only('email','password');

        try {
            if(!$token =JWTAuth::attempt($credentials)){
                return response()->json([
                    'message' => 'Los datos ingresados no existen.'
                ]);

            }
        } catch (JWTException $e) {
            return response()->json([
                'error' =>'token no creado'
            ], 500);
        }

        return response()->json(compact(('token')));

    }
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
