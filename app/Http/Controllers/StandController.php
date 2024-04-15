<?php

namespace App\Http\Controllers;

use App\Models\Stand;
use App\Models\User;
use Illuminate\Http\Request;

class StandController extends Controller
{


    public function index()
    {
        return Stand::all();
    }
   


    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                //'exposant_id' => 'required|exists:users,id',
               // 'description' => 'nullable|string|max:255',
                'numero' => 'required|string|max:255',
                'superficie' => 'required|numeric',
                'longeur' => 'required|numeric',
                'largeur' => 'required|numeric',
                'etat' => 'required|in:disponible,reservee,non disponible',
                'prix' => 'required|numeric',

                // ... other validation rules
            ]);
    
            // Retrieve the corresponding user
            $exposant_id = $request->input('exposant_id');

            // Create a new stand instance
            $stand = new Stand([
                //'exposant_id' => $exposant_id,
                //'description' => $request->input('description'),
                'numero' => $request->input('numero'),
                'superficie' => $request->input('superficie'),
                'longeur' => $request->input('longeur'),
                'largeur' => $request->input('largeur'),
                'etat' => $request->input('etat'),
                'prix' => $request->input('prix'),
                // ... other fields
            ]);
    
            // Save the stand to the database
            $stand->save();
    
            // Return a response
            return response()->json($stand);
    
        } catch (\Exception $e) {
            // Log or handle the exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function show(stand $stand,string $identifier)
    {
        $stand = stand::where('id_stand', $identifier)->first();
        if (!$stand) {
            return response()->json(['error' => 'stand not found'], 404);
        }
        else{
    
        return response()->json($stand);
        }    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, stand $stand,string $identifier)
    {
        $stand = stand::where('id_stand', $identifier)->first();

        // Check if the user exists
        if (!$stand) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        // Update specific attributes
        if ($request->has('numero')) {
            $stand->numero = $request->input('numero');
        }

        if ($request->has('superficie')) {
            $stand->superficie = $request->input('superficie');
        }

        if ($request->has('longeur')) {
            $stand->longeur = $request->input('longeur');
        }

        if ($request->has('largeur')) {
            $stand->largeur = $request->input('largeur');
        }
    
        if ($request->has('etat')) {
            $stand->etat = $request->input('etat');
        }

        if ($request->has('prix')) {
            $stand->prix = $request->input('prix');
        }
    
        // Update other attributes similarly
    
        // Save the changes
        $stand->save();
    
        // Return the updated user
        return response()->json($stand);        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(stand $stand,string $identifier)
    {
        $stand = stand::where('id_stand', $identifier)->first();

        $stand->delete();

    return response()->json(null, 204);
    } 
    
    

}
