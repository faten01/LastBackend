<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        return Type::all();
    }

    public function store(Request $request)
    {
        $Type = Type::create($request->all());
    
        return response()->json($Type, 201);
    }

    public function show(Type $Type,string $identifier)
    {
        
        $Type = Type::where('id_type', $identifier)->first();
        if (!$Type) {
            return response()->json(['error' => 'type not found'], 404);
        }
        else{
    
        return response()->json($Type);
        }
    }


    public function update(Request $request, Type $type,string $identifier)

    {

         // Find the user by the given identifier
    $type = Type::where('id_type', $identifier)->first();

    // Check if the user exists
    if (!$type) {
        return response()->json(['error' => 'User not found'], 404);
    }

    // Update specific attributes
    if ($request->has('type')) {
        $type->type = $request->input('type');
    }

    if ($request->has('photo')) {
        $type->photo = $request->input('photo');
    }

    // Update other attributes similarly

    // Save the changes
    $type->save();

    // Return the updated user
    return response()->json($type);    }


    public function destroy(Type $type,string $identifier)
    
    {
        $type = Type::where('id_type', $identifier)->first();

        $type->delete();

    return response()->json(null, 204);
    }



}
