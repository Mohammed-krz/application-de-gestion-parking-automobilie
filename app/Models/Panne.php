<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panne extends Model
{
    use HasFactory;

    protected $fillable = [
         
        'Numero_panne','Date_panne','Type_panne','vehicule_id'

       ];

       public function vehicule(){

          return $this->belongsTo(Vehicule::class);

       }
}
