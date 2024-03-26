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


        return view('coordinador.index', compact('pendientes', 'revisados', 'rechazados'));
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
    public function show($id)
    {
        $reporte = reportes::find($id);
        return view('coordinador.show', compact('reporte'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reportes $id)
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
