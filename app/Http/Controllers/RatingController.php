<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Type;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        return Rating::all();
    }


    public function store(Request $request)
    {
        $Rate = Rating::create($request->all());
    
        return response()->json($Rate, 201);
    }


    public function show(Rating $rating,string $identifier)
    {
        
        $rating = Rating::where('id_rating', $identifier)->first();
        if (!$rating) {
            return response()->json(['error' => 'rating not found'], 404);
        }
        else{
    
        return response()->json($rating);
        }
    }
    

    public function update(Request $request, Rating $rate,string $identifier)

    {

         // Find the user by the given identifier
    $rate = Rating::where('id_rating', $identifier)->first();

    // Check if the user exists
    if (!$rate) {
        return response()->json(['error' => 'User not found'], 404);
    }

    // Update specific attributes
    if ($request->has('rating')) {
        $rate->rating = $request->input('rating');
    }

    if ($request->has('review')) {
        $rate->review = $request->input('review');
    }

    // Update other attributes similarly

    // Save the changes
    $rate->save();

    // Return the updated user
    return response()->json($rate);    }


    public function destroy(Rating $Rate,string $identifier)
    
    {
        $Rate = Rating::where('id_rating', $identifier)->first();

        $Rate->delete();

    return response()->json(null, 204);
    }



}
