<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //  public function register(Request $request)
    // {

    //     $request->validate([
    //         'nom' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'prenom' => 'required|string|max:250',
    //         'MotDePasse' => 'required|string|min:6',
    //         'telephone' => 'required|string|max:20',
    //     ]);
    //    /* $request->validate([
    //         'Nom' => 'required|string|max:250',
    //         'Prenom' => 'required|string|max:250',
    //         'Email' => 'required|email|max:250|unique:user_utilisateurs',
    //         'Telephone' => 'required|string|max:20',
    //         'Role' => 'required|string|max:50',
    //         'MotDePasse' => 'required|min:8|confirmed',
    //     ]);*/

    //     $user = User::create([
    //         'nom' => $request->nom,
    //         'prenom' => $request->prenom,
    //         'email' => $request->email,
    //         'telephone' => $request->telephone,
    //       //  'role' => $request->Role,
    //         'MotDePasse' => Hash::make($request->MotDePasse),
    //     ]);

    //     $token = $user->createToken('api_token')->plainTextToken;

    //     return response()->json(['token' => $token, 'message' => 'You have successfully registered & logged in!']);
    // }


    public function register(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:250',
                'email' => 'required|string|email|max:255|unique:users',
                'telephone' => 'required|string|max:20',
                'MotDePasse' => 'required|string|min:6',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage(), 'code' => 422]);
        }

        // Hash the password
        $hashedPassword = Hash::make($request->MotDePasse);

        // Create the user
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'MotDePasse' => $hashedPassword,
        ]);

        return response()->json(['status' => 1, 'message' => 'You have successfully registered', 'code' => 200]);
    }


    public function login(Request $request)
    {
        // Validate the request fields
        $request->validate([
            'email' => 'required|string|email',
            'MotDePasse' => 'required|string',
        ]);

        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and if the password matches
        if (!$user || !Hash::check($request->MotDePasse, $user->MotDePasse)) {
            return response()->json(['message' => 'These credentials do not match our records.'], 401);
        }

        // Generate JWT token
        $token = JWTAuth::claims([
            'id'=> $user->id,
            'nom' => $user->nom,
            'prenom' => $user->prenom,
            'telephone' => $user->telephone,
            'email' => $user->email,
            'role' => $user->role,
            'ville' => $user->ville,
            'entreprise' => $user->entreprise,
            'photo' => $user->photo,
        ])->fromUser($user);

        // JSON response with the user, their role, and the token
        $response = [
            'user' => $user,
            'role' => $user->role,
            'token' => $token
        ];

        return response()->json($response, 200);
    }




    // public function login(Request $request)
    // {
    //     // Valider les champs de la requête
    //     $request->validate([
    //         'email' => 'required|string|email',
    //         'MotDePasse' => 'required|string',
    //     ]);

    //     // Récupérer les informations d'identification de la requête
    //     $credentials = $request->only('email', 'MotDePasse');

    //     try {
    //         // Tentative d'authentification avec JWT
    //         if (!$token = JWTAuth::attempt($credentials)) {
    //             return response()->json(['message' => 'These credentials do not match our records.'], 401);
    //         }
    //     } catch (JWTException $e) {
    //         return response()->json(['message' => 'Could not create token.'], 500);
    //     }

    //     // Récupérer l'utilisateur authentifié
    //     $user = JWTAuth::user();

    //     // Réponse JSON avec l'utilisateur, son rôle et le token
    //     $response = [
    //         'user' => $user,
    //         'role' => $user->role,
    //         'token' => $token
    //     ];

    //     return response()->json($response, 200);
    // }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'You have logged out successfully!']);
    }


    public function login2(Request $request)
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
        validator(
            request()->all(),
            [
                'email' => ['required', 'email'],
                'MotDePasse' => ['required']

            ]
        )->validate();

    }






}



