<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Models\personals;
use App\Models\reportes;
use App\Models\User;
use App\Models\vs_cargo;
use App\Models\vs_tipo_documento;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:coordinador');

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendientes = reportes::where('estado', '5')->get();
        $revisados = reportes::where('estado', '6')->get();
        $rechazados = reportes::where('estado', '7')->get();

        $tabData = [
            [
                'id' => 'pendientes',
                'opacity' => '100',
                'data' => $pendientes,
                'estado' => 5,
                'estado_class' => 'text-white bg-yellow-500 rounded px-2 py-1',
                'estado_text' => 'Pendiente',
            ],
            [
                'id' => 'rechazados',
                'opacity' => '0',
                'data' => $rechazados,
                'estado' => 7,
                'estado_class' => 'text-white bg-danger rounded px-2 py-1',
                'estado_text' => 'Rechazado',
            ],
            [
                'id' => 'revisados',
                'opacity' => '0',
                'data' => $revisados,
                'estado' => 6,
                'estado_class' => 'text-white bg-success rounded px-2 py-1',
                'estado_text' => 'Revisado',
            ],
        ];

        return view('coordinador.index', compact('pendientes', 'revisados', 'rechazados', 'tabData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reporte = reportes::find($id);
        return view('coordinador.show', compact('reporte'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reporte = reportes::find($id);
        $pdf = Pdf::loadView('informepdf.index',compact('reporte')) ;


        return $pdf->stream('invoice.pdf');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $estado = $request->estado;



        $reporte = reportes::find($id);
        if ($estado == 6) {
            $reporte->estado = $request->estado;
            $reporte->update();
            notify()->success('Observacion creada con éxito');
        }

        $reporte->estado = $request->estado;
        $reporte->observaciones = $request->observaciones;
        $reporte->update();
        notify()->success('Observacion creada con éxito');
        return redirect()->route('coordinador.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
