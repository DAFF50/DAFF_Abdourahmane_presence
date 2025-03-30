<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emargement extends Model
{
    public function utilisateur(){
        return $this->belongsTo(Utilisateur::class);
    }
}
