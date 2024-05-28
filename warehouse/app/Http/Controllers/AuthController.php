<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Pivot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:1|max:24',
            'lastname' => 'required|string|min:1|max:24',
            'curp' => 'required|string|min:18|max:18',
            'email' => 'required|string|email|min:1|max:64',
            'username' => 'required|string|min:1|max:48',
            'password' => 'required|string|min:8|max:255',
            'role_id' => 'required|numeric',
            'area_id' => 'required|numeric',              
        ];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'curp' => $request->curp,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'area_id' => $request->area_id,
        ]);

        $user->load('role', 'area');

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'data' => $user,
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);
    }


    public function login(Request $request)
    {
        // Definir reglas de validación
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), $rules);

        // Si la validación falla, devolver errores
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        // Intentar autenticar al usuario
        if (!Auth::attempt($request->only('username', 'password'))) {
            return response()->json([
                'status' => false,
                'errors' => ['Unauthorized']
            ], 401);
        }

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Devolver respuesta exitosa con el usuario y el token
        return response()->json([
            'status' => true,
            'message' => 'User logged in successfully',
            'data' => $user,
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);
    }


    public function checkToken()
    {
        return response()->json([
            'status' => true,
            'message' => 'The token is valid'
        ], 200);
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'User logged out successfully'
        ], 200);
    }
}
