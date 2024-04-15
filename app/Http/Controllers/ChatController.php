<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return Chat::all();
    }

    public function store(Request $request)
    {
        $chat = Chat::create($request->all());
    
        return response()->json($chat, 201);
    }

    public function show(Chat $chat,string $identifier)
    {
        
        $chat = Chat::where('id_chat', $identifier)->first();
        if (!$chat) {
            return response()->json(['error' => 'chat not found'], 404);
        }
        else{
    
        return response()->json($chat);
        }
    }

    public function destroy(Chat $chat,string $identifier)
    
    {
        $chat = Chat::where('id_chat', $identifier)->first();

        $chat->delete();

    return response()->json(null, 204);
    }


}
