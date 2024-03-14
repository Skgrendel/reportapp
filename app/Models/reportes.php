<?php

namespace App\Models;

use BaconQrCode\Renderer\RendererStyle\Fill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportes extends Model
{
    use HasFactory;

    static $rules =[
        'personal_id'=> 'required',
        'contrato'=>'required',
        'lectura'=>'required',
        'anomalia'=>'required',
        'imposibilidad'=>'nullable',
        'foto1'=>'required|image|max:2048',
        'foto2'=>'required|image|max:2048',
        'foto3'=>'required|image|max:2048',
        'foto4'=>'required|image|max:2048',
        'foto5'=>'required|image|max:2048'
    ];

    protected $fillable = [
        'personal_id',
        'contrato',
        'lectura',
        'anomalia',
        'imposibilidad',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5'
    ];

    public function personal()
    {
        return $this->belongsTo(personals::class);
    }


    public function EstadoReporte()
    {
        return $this->hasOne(vs_estado::class, 'id', 'estado');
    }
}
