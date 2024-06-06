<?php

namespace App\Models;

use BaconQrCode\Renderer\RendererStyle\Fill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportes extends Model
{
    use HasFactory;

    static $rules = [
        'contrato' => 'required',
        'medidor' => 'required',
        'lectura' => 'required',
        'anomalia' => 'required',
        'imposibilidad' => 'required  ',
        'tipo_comercio' => 'required',
        'foto1' => 'image|max:7120',
        'foto2' => 'image|max:7120',
        'foto3' => 'image|max:7120',
        'foto4' => 'image|max:7120',
        'foto5' => 'image|max:7120',
        'foto6' => 'image|max:7120'
    ];

    static $rulesupdate = [
        'contrato' => 'required',
        'lectura' => 'required',
        'anomalia' => 'required',
        'imposibilidad' => 'required',
        'tipo_comercio' => 'required',
        'foto1' => 'image|max:7120',
        'foto2' => 'image|max:7120',
        'foto3' => 'image|max:7120',
        'foto4' => 'image|max:7120',
        'foto5' => 'image|max:7120',
        'foto6' => 'image|max:7120',
    ];

    protected $fillable = [
        'personal_id',
        'contrato',
        'medidor',
        'lectura',
        'anomalia',
        'medidor_anomalia',
        'medidor_cambio',
        'imposibilidad',
        'direccion',
        'tipo_comercio',
        'comentarios',
        'observaciones',
        'latitud',
        'longitud',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5',
        'foto6',
        'video',
        'estado',
        'nuevo_comercio',
        'revisado',
        'nombre_comercio',
        'confirmado_anomalia'
    ];

    public function personal()
    {
        return $this->hasOne(personals::class, 'id', 'personal_id');
    }


    public function EstadoReporte()
    {
        return $this->hasOne(vs_estado::class, 'id', 'estado');
    }

    public function imposibilidadReporte()
    {
        return $this->hasOne(vs_imposibilidad::class, 'id', 'imposibilidad');
    }

    public function AnomaliaReporte()
    {
        return $this->hasOne(vs_anomalias::class, 'id', 'anomalia');
    }

    public function ciclos()
    {
        return $this->hasOne(direcciones::class, 'contrato', 'contrato');
    }
    
    public function ComercioReporte()
    {
        return $this->hasOne(vs_comercios::class, 'id', 'tipo_comercio');
    }
}
