<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return Message::all();
    }

    public function store(Request $request)
    {
        $Message = Message::create($request->all());
    
        return response()->json($Message, 201);
    }


    public function show(Message $message,string $identifier)
    {
        
        $message = Message::where('id_message', $identifier)->first();
        if (!$message) {
            return response()->json(['error' => 'message not found'], 404);
        }
        else{
    
        return response()->json($message);
        }
    }


    public function update(Request $request, Message $message,string $identifier)

    {

         // Find the user by the given identifier
    $message = Message::where('id_message', $identifier)->first();

    // Check if the user exists
    if (!$message) {
        return response()->json(['error' => 'User not found'], 404);
    }

    // Update specific attributes
    if ($request->has('contenu')) {
        $message->contenu = $request->input('contenu');
    }

    if ($request->has('dateEnvoi')) {
        $message->dateEnvoi = $request->input('dateEnvoi');
    }

    if ($request->has('dateRecu')) {
        $message->dateRecu = $request->input('dateRecu');
    }

    // Update other attributes similarly

    // Save the changes
    $message->save();

    // Return the updated user
    return response()->json($message);    }

    public function destroy(Message $message,string $identifier)
    
    {
        $message = Message::where('id_message', $identifier)->first();

        $message->delete();

    return response()->json(null, 204);
    }


}
