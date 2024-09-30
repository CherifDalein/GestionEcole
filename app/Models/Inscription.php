<?php

namespace App\Models;
use App\Models\Classe;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    public function classe(){
        return $this->belongsTo(classe::class);
    }
}
