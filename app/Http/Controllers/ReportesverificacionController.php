<?php

namespace App\Http\Controllers;

use App\Models\direcciones;
use App\Models\reportesverificacion;
use App\Models\vs_anomalias;
use App\Models\vs_estado;
use App\Models\vs_comercios;
use App\Models\vs_imposibilidad;
use App\Services\DataGisServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpWord\TemplateProcessor;

class ReportesverificacionController extends Controller
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
        $anomalias = vs_anomalias::pluck('nombre', 'id');
        $comercios = vs_comercios::pluck('nombre', 'id');
        $imposibilidad = vs_imposibilidad::pluck('nombre', 'id');
        return view('verificacion.index', compact('anomalias', 'comercios', 'imposibilidad'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('verificacion.verificaciontable');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(reportesverificacion::$rules);
        $latitud = $request->input('latitud');
        $longitud = $request->input('longitud');
        $fontSize = 50;

        if ($request->input('contrato')) {
            $contrato = direcciones::where('contrato', $request->input('contrato'))->first();
            if (!$contrato) {
                notify()->error('el "Contrato" No esta en la Lista de Contratos');
                return redirect()->route('verificacion.index');
            }
        }

        if ($request->input('contrato')) {
            $contrato = reportesverificacion::where('contrato', $request->input('contrato'))->first();
            if ($contrato) {
                $fechaCreacion = $contrato->created_at->format('d-m-Y'); // Formato de fecha
                $nombreCreador = $contrato->personal->nombres . ' ' . $contrato->personal->apellidos;; // Nombre del creador
                $mensaje = "El contrato ya fue registrado. Fecha de Registro: $fechaCreacion, Registrado por: $nombreCreador";
                notify()->error($mensaje);
                return redirect()->route('verificacion.index');
            }
        }

        if ($latitud == null || $longitud == null) {
            notify()->error('No se pudo obtener la direccion , Active su GPS y vuelva a intentarlo');
            return redirect()->route('verificacion.index');
        } else {
            $response = Http::withoutVerifying()->get("https://revgeocode.search.hereapi.com/v1/revgeocode?apikey=auuOOORgqWd_T4DFf0onY2JlvMDhz4tP0G0o7fRYDRU&at=$latitud,$longitud&lang=es-ES");
            $data = $response->json();
            $direccion = $data['items'][0]['address']['label'];
        }


        $AnomaliaJson = json_encode($request->anomalia);
        $reportes = $request->all();
        $reportes['personal_id'] = Auth::user()->personal->id;
        $reportes['anomalia'] = $AnomaliaJson;
        $reportes['latitud'] = $latitud;
        $reportes['longitud'] = $longitud;
        $reportes['direccion'] = $direccion;
        $reportes['estado'] = 5;


        foreach (range(1, 6) as $i) {
            if ($imagen = $request->file('foto' . $i)) {
                $path = 'imgverificacion/';
                $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
                $imagen->move($path, $foto);
                $reportes['foto' . $i] = $foto;
                //  Abrir la imagen utilizando GD
                $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
                // Añadir texto del contrato  a la imagen
                $textoContrato = "Contrato N°:" . $request->input('contrato');
                $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
                $posXContrato = 10; // Ajusta según tu diseño
                $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);
                // Añadir texto de coordenadas a la imagen
                $textoCoordenadas = "Direccion: " . $direccion;
                $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
                $posXCoordenadas = 10; // Ajusta según tu diseño
                $posYCoordenadas = imagesy($imagenGD) - 20; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXCoordenadas, $posYCoordenadas, $colorTexto, public_path('font/arial.ttf'), $textoCoordenadas);

                //Añadir texto de fecha a la imagen
                $fechaActual = date("Y-m-d H:i:s");
                $posXFecha = 10; // Ajusta según tu diseño
                $posYFecha = imagesy($imagenGD) - 90; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");

                // Guardar la imagen modificada
                imagejpeg($imagenGD, public_path($path . $foto));

                // Liberar la memoria
                imagedestroy($imagenGD);
            }
        }
        reportesverificacion::create($reportes);
        notify()->success('Lectura Guardada Con Exito');
        return redirect()->route('reportes.index');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)

    {
        $gis = $this->info->DataGisVerificacion($id);
        $reporte = reportesverificacion::find($id);
        $contrato = $reporte->contrato;
        $validate = direcciones::where('contrato', $contrato)->first();
        $anomaliasIds = json_decode($reporte->anomalia);
        $anomalias = vs_anomalias::whereIn('id', $anomaliasIds)->get();
        return view('verificacion.show', compact('reporte', 'anomalias', 'validate','gis'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $reporte = reportesverificacion::find($id);

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
        if (file_exists(public_path('imgverificacion/' . $img)) and $img != null) {
            return $templateProcessor->setImageValue($var, array('path' => public_path('imgverificacion/' . $img), 'width' => 400, 'height' => 400, 'ratio' => true));
        } else {
            return $templateProcessor->setValue($var, 'Sin Registro Fotografico');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $reporte)
    {
        $reportes = reportesverificacion::find($reporte);
        $fontSize = 50;
        if ($video = $request->file('video')) {
            $path = 'video/';
            $videoname = rand(1000, 9999) . "_" . date('YmdHis') . "." . $video->getClientOriginalExtension();
            $video->move($path, $videoname);
            $report['video'] = $videoname;
        }
        foreach (range(1, 6) as $i) {
            if ($imagen = $request->file('foto' . $i)) {
                $path = 'imgverificacion/';
                $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
                $imagen->move($path, $foto);
                $report['foto' . $i] = $foto;
                //  Abrir la imagen utilizando GD
                $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
                // Añadir texto del contrato  a la imagen
                $textoContrato = "Contrato N°:" . $reportes->contrato;
                $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
                $posXContrato = 10; // Ajusta según tu diseño
                $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);
                // Añadir texto de coordenadas a la imagen
                $textoCoordenadas = "Direccion:" . $reportes->direccion;
                $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
                $posXCoordenadas = 10; // Ajusta según tu diseño
                $posYCoordenadas = imagesy($imagenGD) - 20; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXCoordenadas, $posYCoordenadas, $colorTexto, public_path('font/arial.ttf'), $textoCoordenadas);
                //Añadir texto de fecha a la imagen
                $fechaActual = date("Y-m-d H:i:s");
                $posXFecha = 10; // Ajusta según tu diseño
                $posYFecha = imagesy($imagenGD) - 90; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");
                // Guardar la imagen modificada
                imagejpeg($imagenGD, public_path($path . $foto));
                // Liberar la memoria
                imagedestroy($imagenGD);
                // Obtener el nombre de la foto anterior desde la base de datos
                $fotoAnterior = $reportes->foto . $i;
                // Eliminar la foto anterior si existe
                if ($fotoAnterior) {
                    $rutaFotoAnterior = public_path($path . $fotoAnterior);
                    if (file_exists($rutaFotoAnterior)) {
                        unlink($rutaFotoAnterior);
                    }
                }
                $report['foto' . $i] = $foto;
            } else {
                unset($report['foto' . $i]);
            }
        }
        $reportes->update($report);

        return redirect()->route('verificacion.create')->with('success', 'Registro Actualizado Con Exito');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reportesverificacion $reportes)
    {
        //
    }
}
