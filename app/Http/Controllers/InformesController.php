<?php

namespace App\Http\Controllers;

use App\Models\reportes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Fx\Chartjs\Factory\Chartjs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class InformesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function InfoGeneral()
    {
        return view('informes.informeGeneral');
    }
    public function InfoDia()
    {
        return view('informes.informeDia');
    }

    public function testEndpoint()
    {
        $surtigas = (object) [
            'contrato' => '196005', // Asegúrate de reemplazar esto con el valor real
        ];

        $token = 'AlKmp29agyc19puOX-3TvwLvB-RUg-sP1v3L4q1zhnQs-e3vlCcG71fD8IWvMdu3L88DbdBhK1QLcyxYOHJlDGElSSxqlM6fW3KnVYiRXJhmCvEmleMGKS-I7L90LSkCY2Q0mN2OboVugJiSZyr5U_PRR1JIwR-b0dv6H70OJS8vXBu4Y6yJseAO-65cuhFFjFFG86fgyccfcN6SMWN4mJ8VmsitDM7AAo2kQPOiumcKk1QO-Cou8QPFYrbNyAWq8VU-g8OTdAq2YglplSk-NQ..'; // Asegúrate de reemplazar esto con tu token real

        // Construir la URL con los parámetros dinámicos
        $urlConsulta = "https://arcgisportal.surtigas.com.co/geaserver/rest/services/Ingenieria/FC_PTDIRECCIONES/MapServer/0/query?f=json&where=(SUBSCRIPTION_ID%20IS%20NOT%20NULL)%20AND%20(SUBSCRIPTION_ID%20%3D%20$surtigas->contrato)&returnGeometry=true&spatialRel=esriSpatialRelIntersects&outFields=OBJECTID%2CORDEN%2CRID%2COBJECTID_1%2CDEPARTAMENTO%2CLOCALIDAD%2CNOMBRE%2CADDRESS_ID%2CID_PREMISE%2CNUP%2CDIRECCION%2CTAG%2CANILLADO%2CTIPOPREDIO%2CCICLO%2CDESCRIPCION%2CBARRIO%2CNOMBREBARRIO%2CCATEGORIA%2CDESCATEGORIA%2CESTRATO%2CPRODUCT_ID%2CPRODUCT_STATUS_ID%2CESTADOPRODUCTO%2CSUBSCRIPTION_ID%2CDESCESTADOCORTE%2CCODIDOESTADOCORTE%2CNOMBREUSUARIO%2CAPELLIDO%2CELEMENTOMEDICION%2CORIG_FID&outSR=102100&resultOffset=0&resultRecordCount=1000&token=$token";

        // Realizar la solicitud HTTP
        $response = Http::withoutVerifying()->get($urlConsulta);

        // Retornar la respuesta como JSON
        return $response->json();
    }

}
