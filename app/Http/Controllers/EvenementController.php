<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{

    public function index()
    {
        return Evenement::all();
    }


    public function store(Request $request)
    {

        
        try {
            // Validate the request data
            $request->validate([
                //'exposant_id' => 'required|exists:users,id',
               // 'description' => 'nullable|string|max:255',
                'nom' => 'nullable|string|max:255',
                'ville' => 'nullable|string|max:255',
                'affiche' => 'nullable|string|max:255',
                'date' => 'nullable|date',
                'dateFin' => 'nullable|date',
                

                // ... other validation rules
            ]);
    
            // Retrieve the corresponding user

            // Create a new stand instance
            $event = new Evenement([
                //'exposant_id' => $exposant_id,
                //'description' => $request->input('description'),
                'nom' => $request->input('nom'),
                'affiche' => $request->input('affiche'),
                'ville' => $request->input('ville'),
                'date' => $request->input('date'),
                'dateFin' => $request->input('dateFin'),
                // ... other fields
            ]);
    
            // Save the stand to the database
            $event->save();
    
            // Return a response
            return response()->json($event);
    
        } catch (\Exception $e) {
            // Log or handle the exception
            return response()->json(['error' => $e->getMessage()], 500);
        }   }


    public function show(Evenement $evenement,string $identifier)
        {
            $evenement = Evenement::where('id_event', $identifier)->first();
            if (!$evenement) {
                return response()->json(['error' => 'Event not found'], 404);
            }
            else{
        
            return response()->json($evenement);
            }    }


            public function showDate(Evenement $evenement,string $identifier)
            {
                $evenement = Evenement::where('nom', $identifier)->first();
                if (!$evenement) {
                    return response()->json(['error' => 'Event not found'], 404);
                }
                $date = $evenement->date; // Assuming the date field is named 'date' in your database

                 return response()->json(['date' => $date]);


                 $dateFin = $evenement->dateFin; // Assuming the date field is named 'date' in your database

                 return response()->json(['dateFin' => $dateFin]);
                
                }   
                
                



    public function update(Request $request, Evenement $evenement,string $identifier)
    {
        $evenement = Evenement::where('id_event', $identifier)->first();

        // Check if the user exists
        if (!$evenement) {
            return response()->json(['error' => 'Event not found'], 404);
        }
    
        // Update specific attributes
        if ($request->has('nom')) {
            $evenement->nom = $request->input('nom');
        }
    
        if ($request->has('description')) {
            $evenement->description = $request->input('description');
        }

        if ($request->has('ville')) {
            $evenement->ville = $request->input('ville');
    
        }
        if ($request->has('affiche')) {
            $evenement->affiche = $request->input('affiche');
    
        }

        if ($request->has('date')) {
            $evenement->date = $request->input('date');
    
        }
        if ($request->has('dateFin')) {
            $evenement->dateFin = $request->input('dateFin');
    
        }

        if ($request->has('id_rating')) {
            $evenement->id_rating = $request->input('id_rating');
    
        }

        if ($request->has('id_type')) {
            $evenement->id_type = $request->input('id_type');
    
        }
    
        // Update other attributes similarly
    
        // Save the changes
        $evenement->save();
    
        // Return the updated user
        return response()->json($evenement);     }


        public function destroy(Evenement $evenement,string $identifier)
        {
            $evenement = Evenement::where('id_event', $identifier)->first();
    
            $evenement->delete();
    
        return response()->json(null, 204);
        }


}
