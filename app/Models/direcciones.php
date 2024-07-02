<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class direcciones extends Model
{
    use HasFactory;

    protected $fillable = ['contrato','direccion','latitud','longitud'];

    public function reportesv()
    {
        return $this->belongsTo(reportesverificacion::class, 'contrato', 'contrato');
    }
}
