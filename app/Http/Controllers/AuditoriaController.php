<?php

namespace App\Http\Controllers;

use App\Models\auditoria;
use App\Models\direcciones;
use App\Models\reportes;
use App\Models\vs_anomalias;
use App\Models\vs_comercios;
use App\Models\vs_imposibilidad;
use App\Services\DataGisServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class AuditoriaController extends Controller
{
    private  $info;

    public function __construct()
    {
        $this->info = new DataGisServices();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auditoria.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auditoria.revisado');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gis = $this->info->DataGis($id);
        $anomaliasver = vs_anomalias::pluck('nombre', 'id');
        $comercios = vs_comercios::pluck('nombre', 'id');
        $imposibilidad = vs_imposibilidad::pluck('nombre', 'id');
        $reporte = reportes::find($id);
        $data = direcciones::where('contrato',$reporte->contrato)->first();
        $reporte->load('auditorias');
        $contrato = $reporte->contrato;
        $validate = direcciones::where('contrato', $contrato)->first();
        $anomaliasIds = json_decode($reporte->anomalia);
        $anomalias = vs_anomalias::whereIn('id', $anomaliasIds)->get();
        return view('auditoria.show', compact('reporte', 'anomalias', 'validate', 'anomaliasver', 'comercios', 'imposibilidad', 'anomaliasIds','gis',' $data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $reporte = reportes::find($id);

        $anomaliasIds = json_decode($reporte->anomalia);

        $anomalias = vs_anomalias::whereIn('id', $anomaliasIds)->get();

        $direccion = direcciones::where('contrato', $reporte->contrato)->first();

        // Ruta de la plantilla
        $templateFile = public_path('template/temp.docx');

        // Cargar la plantilla
        $templateProcessor = new TemplateProcessor($templateFile);

        // Reemplazar marcadores de posición con datos
        $templateProcessor->setValue('contrato', $reporte->contrato);
        $templateProcessor->setValue('fecha', $reporte->created_at);
        $templateProcessor->setValue('direccion', $direccion->direccion);
        $templateProcessor->setValue('medidor', $reporte->medidor);
        $templateProcessor->setValue('medidor_anomalia', $reporte->medidor_anomalia);
        $templateProcessor->setValue('lectura', $reporte->lectura);
        $templateProcessor->setValue('comercio', $reporte->ComercioReporte->nombre);
        $nombresAnomalias = array();
        foreach ($anomalias as $anomalia) {
            $nombresAnomalias[] = $anomalia->nombre;
        }
        $stringAnomalias = implode(", ", $nombresAnomalias);
        $templateProcessor->setValue('anomalia', $stringAnomalias);

        $templateProcessor->setValue('imposibilidad', $reporte->imposibilidadReporte->nombre);
        $templateProcessor->setValue('observaciones', $reporte->comentarios);
        $templateProcessor->setValue('video', config('app.url') . '/video/' . $reporte->video);

        for ($i = 1; $i < 7; $i++) {
            $foto = 'foto' . $i;
            $this->ImgExist($reporte->$foto, $templateProcessor, $foto);
        }

        $rand = rand(600, 1000);
        $fecha = Carbon::now()->format('d-m-Y');

        $outputFile = public_path('template/Reporte del contrato ' . $reporte->contrato . '-' . $fecha . '-' . $rand . '.docx');
        $templateProcessor->saveAs($outputFile);

        // Descargar el documento
        return response()->download($outputFile)->deleteFileAfterSend();
    }

    private function ImgExist($img, $templateProcessor, $var)
    {
        if (file_exists(public_path('imagen/' . $img)) and $img != null) {
            return $templateProcessor->setImageValue($var, array('path' => public_path('imagen/' . $img), 'width' => 400, 'height' => 400, 'ratio' => true));
        } else {
            return $templateProcessor->setValue($var, 'Sin Registro Fotografico');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reporte = reportes::find($id);
        $id = $reporte->id;

        auditoria::create([
            'reporte_id' => $id,
            'medidor_coincide' => $request->input('medidor_coincide'),
            'lectura_correcta' => $request->input('lectura_correcta'),
            'foto_correcta' => $request->input('foto_correcta'),
            'comercio_coincide' => $request->input('comercio_coincide'),
            'no_encontrado' => $request->input('no_encontrado'),
            'observaciones' => $request->input('observaciones'),
        ]);

        if ($request->input('revisado') == 1) {
            $reporte->update(['revisado' => $request->input('revisado')]);
        }

        if ($request->input('confirmado_anomalia') == 1) {

            $reporte->update(['confirmado_anomalia' => $request->input('confirmado_anomalia')]);
        }

        if ($request->contrato) {
            $anomalias = json_encode($request->anomalias);
            $reporte->contrato = $request->contrato;
            $reporte->medidor = $request->medidor;
            $reporte->lectura = $request->lectura;
            $reporte->imposibilidad = $request->imposibilidad;
            $reporte->tipo_comercio = $request->tipo_comercio;
            $reporte->medidor_anomalia = $request->medidor_anomalia;
            $reporte->anomalia = $anomalias;
            $reporte->update();
        }


        return redirect()->route('auditorias.index')->with('success', 'Reporte Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
