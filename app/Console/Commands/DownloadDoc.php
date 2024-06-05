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
            $this->info('inicio');
            $reportes = reportes::select('id','contrato')->get();
            $controlador = new CoordinadorController();

            foreach ($reportes as $reporte) {
                $this->info('Descargando contrato #'.$reporte->contrato);
                $controlador->exportdoc($reporte->id);
                $this->info('Descargando');
            }
            $this->info('terminado');
        } catch (\Throwable $th) {
            $this->error('error '.$th->getMessage());
        }

    }
}
