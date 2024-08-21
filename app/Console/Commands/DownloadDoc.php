<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\CoordinadorController;
use App\Models\reportes;
class DownloadDoc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:download-doc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        try {
            $this->info('Inicio de descarga de reportes.');

            // Obtener los reportes que coinciden con los contratos en el array
            $reportes = Reportes::all();

            if ($reportes->isEmpty()) {
                $this->info('No se encontraron reportes.');
            } else {
                $controlador = new CoordinadorController();

                foreach ($reportes as $reporte) {
                    $this->info('Descargando contrato #' . $reporte->contrato);
                    $controlador->exportdoc($reporte->id);
                    $this->info('Reporte descargado.');
                }
            }

            $this->info('Proceso de descarga completado.');
        } catch (\Throwable $th) {
            $this->error('Se produjo un error: ' . $th->getMessage());
        }


    }
}
