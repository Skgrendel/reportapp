<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Search extends Component
{
    public $search = '';
    public $direccion = '';
    public $contrato = '';
    public $medidor = '';
    public $nombre_user = '';
    public $apellido = '';
    public $categoria = '';
    public $descripcion = '';
    public $estado_servicio = '';
    public $nombre_barrio = '';
    public $errorMessage = '';

    public function SearchLocation()
    {
        // Inicializar las variables
        $this->direccion = null;
        $this->estado_servicio = null;
        $this->nombre_user = null;
        $this->apellido = null;
        $this->nombre_barrio = null;
        $this->categoria = null;
        $this->descripcion = null;
        $this->medidor = null;
        $this->contrato = null;
        $this->errorMessage = null;

        // Token de acceso  a la aplicacion del gis
        $token = env('GIS_API_TOKEN');

        // URL de API
        $url = "https://arcgisportal.surtigas.com.co/geaserver/rest/services/Ingenieria/FC_PTDIRECCIONES/MapServer/0/query?f=json&where=(SUBSCRIPTION_ID%20IS%20NOT%20NULL)%20AND%20(SUBSCRIPTION_ID%20%3D%20$this->search)&returnGeometry=true&spatialRel=esriSpatialRelIntersects&outFields=OBJECTID%2CORDEN%2CRID%2COBJECTID_1%2CDEPARTAMENTO%2CLOCALIDAD%2CNOMBRE%2CADDRESS_ID%2CID_PREMISE%2CNUP%2CDIRECCION%2CTAG%2CANILLADO%2CTIPOPREDIO%2CCICLO%2CDESCRIPCION%2CBARRIO%2CNOMBREBARRIO%2CCATEGORIA%2CDESCATEGORIA%2CESTRATO%2CPRODUCT_ID%2CPRODUCT_STATUS_ID%2CESTADOPRODUCTO%2CSUBSCRIPTION_ID%2CDESCESTADOCORTE%2CCODIDOESTADOCORTE%2CNOMBREUSUARIO%2CAPELLIDO%2CELEMENTOMEDICION%2CORIG_FID&outSR=102100&resultOffset=0&resultRecordCount=1000&token=$token";

        // URL de consulta
        $urlConsulta = Http::withoutVerifying()
            ->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
            ])
            ->get($url);

        // Verificar el estado de la respuesta
        if ($urlConsulta->failed()) {
            return [
                $this->errorMessage = 'Error al consultar el servicio GIS. Por favor, inténtelo más tarde.'
            ];
        }
        // Decodificar la respuesta JSON
        $data = $urlConsulta->json();

        if ($data['error']) {
            return [
                $this->errorMessage = $data['error']['message']
            ];
        }

        // Verificar si hay datos y si el array 'features' tiene al menos un elemento
        if (!$data || !isset($data['features'][0])) {
            // Manejar el caso de error
            $this->errorMessage = 'No se encontró ninguna información con ese contrato.';
        } else {
            // Obtener los atributos de la primera característica
            $attributes = $data['features'][0]['attributes'];
            $geometry = $data['features'][1]['geometry'];

            $this->direccion = $attributes['DIRECCION'];
            $this->estado_servicio = $attributes['ESTADOPRODUCTO'];
            $this->nombre_user = $attributes['NOMBREUSUARIO'];
            $this->apellido = $attributes['APELLIDO'];
            $this->nombre_barrio = $attributes['NOMBREBARRIO'];
            $this->categoria = $attributes['DESCATEGORIA'];
            $this->descripcion = $attributes['DESCRIPCION'];
            $this->medidor = $attributes['ELEMENTOMEDICION'];
            $this->contrato = $attributes['SUBSCRIPTION_ID'];
        }
    }

    function render()
    {
        return view('livewire.search');
    }
}
