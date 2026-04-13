<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    use HasFactory;
    
    public function plantel()
{
    return $this->belongsTo(Planteles::class, 'plantel_id');
}
}
