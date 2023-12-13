<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Tymon\JWTAuth\Contracts\Providers\JWT;
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
            'role' =>1,
            'status' => 'active',
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
            $user =auth()->user();
        } catch (JWTException $e) {
            return response()->json([
                'error' =>'token no creado'
            ], 500);
        }

        return response()->json([
            'token' => $token,
            'user' =>  $user,
        ]);

    }

    public function verifyToken()
    {
        try {
            $token = JWTAuth::getToken();

            if (!$token) {
                return response()->json([
                    'error', 'Token no proporcionado.',
                ], 400);
            }

            // Verificar si el token es valido
            $user = JWTAuth::parseToken()->authenticate();

            // Obtener el token asociado al usuario
            $ValidateToken = JWTAuth::fromUser($user);

            // si el token es válido retornamos una respuesta exitosa
            return response()->json([
                'message' => 'Token válido',
                'user' => $user,
                'token' => $ValidateToken,
            ], 200);
        } catch (JWTException $e) {
            // Manejo de excepciones
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                // Si el token ha expirado, intentamos refrescarlo
                try {
                    $newToken = JWTAuth::refresh();
                    $user = JWTAuth::setToken($newToken)->toUser();

                    return response()->json([
                        'message' => 'Token refrescado',
                        'user' => $user,
                        'token' => $newToken,
                    ], 200);
                } catch (JWTException $e) {
                    // No se pudo refrescar el token
                    return response()->json(['error' => 'No se pudo refrescar el token'], 401);
                }
            }

            // Otros casos de excepciones JWT
            return response()->json(['error' => 'Token inválido'], 401);
        }
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
