<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Reservations;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return Reservation::all();
    }


    public function store(Request $request)
    {
        $reservation = Reservation::create($request->all());

        return response()->json($reservation, 201); 
    }


    public function show(Reservation $reservation,string $identifier)
    {
        $reservation = Reservation::where('id', $identifier)->first();
        if (!$reservation) {
            return response()->json(['error' => 'User not found'], 404);
        }
        else{
    
        return response()->json($reservation);
        }     }


        public function update(Request $request,Reservation $reservation,string $identifier)
        {
            $reservation = Reservation::where('id', $identifier)->first();
    
            // Check if the user exists
            if (!$reservation) {
                return response()->json(['error' => 'User not found'], 404);
            }
        
            // Update specific attributes
            if ($request->has('acceptation')) {
                $reservation->acceptation	 = $request->input('acceptation');
            }
            if ($request->has('stand_id')) {
                $reservation->stand_id	 = $request->input('stand_id');
            }

            if ($request->has('event_id')) {
                $reservation->event_id	 = $request->input('event_id');
            }
        
        
        
            if ($request->has('DateDebut')) {
                $reservation->DateDebut = $request->input('DateDebut');
            }
    
           
    
            if ($request->has('DateFin')) {
                $reservation->DateFin = $request->input('DateFin');
        
            }
    
            if ($request->has('Statut')) {
                $reservation->Statut = $request->input('Statut');
        
            }
        
            // Update other attributes similarly
        
            // Save the changes
            $reservation->save();
        
            // Return the updated user
            return response()->json($reservation);      }


            public function destroy(Reservation $reservation,string $identifier)
            {
                $reservation = Reservation::where('id', $identifier)->first();
        
                $reservation->delete();
        
            return response()->json("deleted successfuly", 204);
            }
}
