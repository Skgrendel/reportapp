<?php

namespace App\Services;

use App\Models\direcciones;
use App\Models\reportes;
use Illuminate\Support\Facades\Http;


class DataGisServices
{
    public function DataGis(string $id)
    {
        $token = 'tgTMx_2NDmcYyhmiKpTZfEZVR2VEKCIZjtTg9IwNNxjX-Iq9vEjeu2PU7DL9gE7fSjBEvJqTW8UqSyB1VWGFoz0q7EAxKsSaoNZ8pqPspfcM2ahoRfoiaao18AcrpXYaIL2pt32oCrb5AD8PlLgN8i8ioWxEaq-JhfHlBA5XOaGDJKWEY7eOhlz78CdKlB-NlBpgUq7hEWrt8Rb7_1Id1KmB6tolkaAmskh2hgoAmKd2bx_cehm3d7MJujGGLzTwxUBhBdwLCVy1uU2CFmAGQw..';
        $data = reportes::find($id);
        $surtigas = direcciones::where('contrato', $data->contrato)->first();
        // URL de consulta
        $urlConsulta = Http::withoutVerifying()->get("https://arcgisportal.surtigas.com.co/geaserver/rest/services/Ingenieria/FC_PTDIRECCIONES/MapServer/0/query?f=json&where=(SUBSCRIPTION_ID%20IS%20NOT%20NULL)%20AND%20(SUBSCRIPTION_ID%20%3D%20$surtigas->contrato)&returnGeometry=true&spatialRel=esriSpatialRelIntersects&outFields=OBJECTID%2CORDEN%2CRID%2COBJECTID_1%2CDEPARTAMENTO%2CLOCALIDAD%2CNOMBRE%2CADDRESS_ID%2CID_PREMISE%2CNUP%2CDIRECCION%2CTAG%2CANILLADO%2CTIPOPREDIO%2CCICLO%2CDESCRIPCION%2CBARRIO%2CNOMBREBARRIO%2CCATEGORIA%2CDESCATEGORIA%2CESTRATO%2CPRODUCT_ID%2CPRODUCT_STATUS_ID%2CESTADOPRODUCTO%2CSUBSCRIPTION_ID%2CDESCESTADOCORTE%2CCODIDOESTADOCORTE%2CNOMBREUSUARIO%2CAPELLIDO%2CELEMENTOMEDICION%2CORIG_FID&outSR=102100&resultOffset=0&resultRecordCount=1000&token=$token");

        // Decodificar la respuesta JSON
        $data = $urlConsulta->json();
        $attributes = $data['features'][0]['attributes'];

        return [
            'info' => [
                'direccion' => $attributes['DIRECCION'],
                'estado' => $attributes['ESTADOPRODUCTO'],
                'usuario' => $attributes['NOMBREUSUARIO'],
                'barrio' => $attributes['NOMBREBARRIO'],
                'categoria' =>$attributes['DESCATEGORIA'],
                'descripcion' =>$attributes['DESCRIPCION'],
                'contrato'=> $attributes['PRODUCT_ID'],
                'medidor'=> $attributes['ELEMENTOMEDICION']
            ],
        ];
    }
}
