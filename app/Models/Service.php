<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function departement(){
        return $this->belongsTo(Departement::class);
    }

}
