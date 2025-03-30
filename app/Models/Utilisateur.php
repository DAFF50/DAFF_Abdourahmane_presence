<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    public function service(){
        return $this->belongsTo(Service::class);
    }
}
