<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }


    public function store(Request $request)
    {
        $user = User::create($request->all());
    
        return response()->json($user, 201);
    }

    public function show(User $user,string $id)
    {
        
        $user = User::where('id', $id)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        else{
    
        return response()->json($user);
        }
    }

    public function update(Request $request, User $user,string $identifier)

    {

         // Find the user by the given identifier
    $user = User::where('id', $identifier)->first();

    // Check if the user exists
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    // Update specific attributes
    if ($request->has('nom')) {
        $user->nom = $request->input('nom');
    }

    if ($request->has('prenom')) {
        $user->prenom = $request->input('prenom');
    }

    // Update other attributes similarly

    // Save the changes
    $user->save();

    // Return the updated user
    return response()->json($user);    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user,string $identifier)
    
    {
        $user = User::where('id', $identifier)->first();

        $user->delete();

    return response()->json(null, 204);
    }

}
