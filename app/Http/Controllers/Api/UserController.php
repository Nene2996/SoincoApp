<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function postLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => 'Campos requeridos'
            ], 500);
        }

        $user = User::where('email', $request->input('username'))->first();
        
        if ($user) {
            if (Hash::check($request->input('password'), $user->password)) {
                return $user;
            } else {
                return response()->json([
                    'status' => 203,
                    'message' => 'Usuario/Contraseña incorrecta'
                ], 203);
            }
        }

        return response()->json([
            'status' => 500,
            'message' => 'Usuario no existe en los registros'
        ], 500);
    }
}
