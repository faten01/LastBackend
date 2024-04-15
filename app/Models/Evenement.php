<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $table = 'evenements'; 
    protected $primaryKey = 'id_event';


    protected $fillable = [
        'nom',
        'description',
        'affiche',
        'ville',
        'date',
        'dateFin'
        
    
    ];
}
