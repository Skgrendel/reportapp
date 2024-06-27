<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class auditoria extends Model
{
    use HasFactory;

    protected $fillable = ['reporte_id','medidor_coincide','lectura_correcta','comercio_coincide','foto_correcta','no_encontrado','soborno','observaciones'];
}
