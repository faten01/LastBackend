<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    use HasFactory;
    
    protected $table = 'stands'; 
    protected $primaryKey = 'id_stand';



    protected $fillable = [
        'numero',
        'superficie',
        'exposant_id',
        'longeur',
        'largeur',
        'etat',
        'prix'
    ];
}
