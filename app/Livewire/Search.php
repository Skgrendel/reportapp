<?php

namespace App\Livewire;

use App\Models\direcciones;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Search extends Component
{
    public $search = '';
    public $direccion = '';
    public $contrato = '';
    public $medidor = '';
    public $nombre_user = '';
    public $categoria = '';
    public $descripcion = '';
    public $estado_servicio = '';
    public $nombre_barrio = '';
    public $errorMessage = '';


    public function resetAll()
{
    $this->reset('search', 'result', 'direccion', 'errorMessage');
}

    public function SearchLocation()
    {
        $token ='lNonRqbV5deWakOmePwDf7VIJChpJ_8IYrkrHMmK_50J0IdGUTeWniXN_r74mn9b9z13Du5egEEG88V5RadOve82YgACV4t6EtoRAabbj5Owr8sRodGTs2R8cdf3QxNtISjU3GVUqxNBsZqOTQlebWr07tA7GZrJUF_6s__oxkChThBei0KoUR9_Lr1ZfoCQTQneZH-ALYa5zZUzA5rdDy0P7BwSqBFIAXIEltYHKCCQsFSjH_BILnTE1SR_8Mp6c2NWEHvnHeCLHSXSUMNhjg..';
        $urlConsulta = Http::withoutVerifying()->get("https://arcgisportal.surtigas.com.co/geaserver/rest/services/Ingenieria/FC_PTDIRECCIONES/MapServer/0/query?f=json&where=(SUBSCRIPTION_ID%20IS%20NOT%20NULL)%20AND%20(SUBSCRIPTION_ID%20%3D%20$this->search)&returnGeometry=true&spatialRel=esriSpatialRelIntersects&outFields=OBJECTID%2CORDEN%2CRID%2COBJECTID_1%2CDEPARTAMENTO%2CLOCALIDAD%2CNOMBRE%2CADDRESS_ID%2CID_PREMISE%2CNUP%2CDIRECCION%2CTAG%2CANILLADO%2CTIPOPREDIO%2CCICLO%2CDESCRIPCION%2CBARRIO%2CNOMBREBARRIO%2CCATEGORIA%2CDESCATEGORIA%2CESTRATO%2CPRODUCT_ID%2CPRODUCT_STATUS_ID%2CESTADOPRODUCTO%2CSUBSCRIPTION_ID%2CDESCESTADOCORTE%2CCODIDOESTADOCORTE%2CNOMBREUSUARIO%2CAPELLIDO%2CELEMENTOMEDICION%2CORIG_FID&outSR=102100&resultOffset=0&resultRecordCount=1000&token=$token");
        $data = $urlConsulta->json();
        $this->errorMessage = null;

        if ($data === null) {
            // Manejar el caso de error aquí. Por ejemplo, puedes establecer un mensaje de error en una variable.
            $this->errorMessage = 'No se encontró ninguna dirección con ese contrato.';
        } else {
             $this->direccion = $data['features']['0']['attributes']['DIRECCION'];
             $this->estado_servicio = $data['features']['0']['attributes']['ESTADOPRODUCTO'];
             $this->nombre_user=$data['features']['0']['attributes']['NOMBREUSUARIO'];
             $this->nombre_barrio=$data['features']['0']['attributes']['NOMBREBARRIO'];
             $this->categoria=$data['features']['0']['attributes']['DESCATEGORIA'];
             $this->descripcion=$data['features']['0']['attributes']['DESCRIPCION'];
             $this->medidor=$data['features']['0']['attributes']['ELEMENTOMEDICION'];
             $this->contrato=$data['features']['0']['attributes']['PRODUCT_ID'];
        }
    }

    function render()
    {
        return view('livewire.search');
    }
}
