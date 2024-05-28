<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $rules = [
            'name' => 'nullable|string|min:1|max:24',
            'lastname' => 'nullable|string|min:1|max:24',
            'curp' => 'nullable|string|min:18|max:18',
            'email' => 'nullable|string|email|min:1|max:64',
            'username' => 'nullable|string|min:1|max:48',
            'role_id' => 'nullable|numeric'              
        ];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        echo $request->role_id;

        $user = $request->user();
        $user->fill($request->all());
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User data updated successfully',
            'user' => $user
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'password' => 'required|string|min:8|max:255'            
        ];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully'
        ], 200);
    }


}
