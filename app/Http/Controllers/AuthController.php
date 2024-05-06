<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{ 
    


    

    public function register(Request $request)
    {

        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'prenom' => 'required|string|max:250',
            'MotDePasse' => 'required|string|min:6',
            'telephone' => 'required|string|max:20',
        ]);
       /* $request->validate([
            'Nom' => 'required|string|max:250',
            'Prenom' => 'required|string|max:250',
            'Email' => 'required|email|max:250|unique:user_utilisateurs',
            'Telephone' => 'required|string|max:20',
            'Role' => 'required|string|max:50',
            'MotDePasse' => 'required|min:8|confirmed',
        ]);*/

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
          //  'role' => $request->Role,
            'MotDePasse' => Hash::make($request->MotDePasse),
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json(['token' => $token, 'message' => 'You have successfully registered & logged in!']);
    }

   


    public function login(Request $request)
    {
       
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return response([
                'message' => ['User not found.']
            ], 404);
        }
    
        if (!Hash::check($request->MotDePasse, $user->MotDePasse)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 401);
        }
    
        $token = $user->createToken('my-app-token')->plainTextToken;
    
        $response = [
            'user' => $user,
            'token' => $token,
            'role' => $user->role
        ];
    
        return response($response, 201);
    }
    
    public function logout(Request $request)
        {
            $request->user()->tokens()->delete();
    
            return response()->json(['message' => 'You have logged out successfully!']);
        }    




        public function login1(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'MotDePasse' => 'required',
        ]);

        if (!Auth::attempt(['email' => $request->email, 'MotDePasse' => $request->MotDePasse])) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = $request->user();
        $token = $user->createToken('api_token')->plainTextToken;


        return response()->json(['token' => $token, 'message' => 'You have successfully logged in!']);
    }


    public function logins()
    {
        validator(request()->all(), 
        [
            'email'=>['required','email'],
            'MotDePasse'=>['required']

        ])->validate();

    }


 

    

}



