<?php

namespace App\Services;

use App\Models\direcciones;
use App\Models\reportes;
use App\Models\reportesverificacion;
use Illuminate\Support\Facades\Http;


class DataGisServices
{
    public function DataGis(string $id)
    {
        try {
            $token = env('GIS_API_TOKEN');
            $data = reportes::find($id);
            $surtigas = direcciones::where('contrato', $data->contrato)->first();
            $url = "https://arcgisportal.surtigas.com.co/geaserver/rest/services/Ingenieria/FC_PTDIRECCIONES/MapServer/0/query?f=json&where=(SUBSCRIPTION_ID%20IS%20NOT%20NULL)%20AND%20(SUBSCRIPTION_ID%20%3D%20$surtigas->contrato)&returnGeometry=true&spatialRel=esriSpatialRelIntersects&outFields=OBJECTID%2CORDEN%2CRID%2COBJECTID_1%2CDEPARTAMENTO%2CLOCALIDAD%2CNOMBRE%2CADDRESS_ID%2CID_PREMISE%2CNUP%2CDIRECCION%2CTAG%2CANILLADO%2CTIPOPREDIO%2CCICLO%2CDESCRIPCION%2CBARRIO%2CNOMBREBARRIO%2CCATEGORIA%2CDESCATEGORIA%2CESTRATO%2CPRODUCT_ID%2CPRODUCT_STATUS_ID%2CESTADOPRODUCTO%2CSUBSCRIPTION_ID%2CDESCESTADOCORTE%2CCODIDOESTADOCORTE%2CNOMBREUSUARIO%2CAPELLIDO%2CELEMENTOMEDICION%2CORIG_FID&outSR=102100&resultOffset=0&resultRecordCount=1000&token=$token";

            if (!$surtigas) {
                return [
                    'error' => 'No se encontró informacion asociada al contrato proporcionado.'
                ];
            }

            // URL de consulta
            $urlConsulta = Http::withoutVerifying()
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
                ])
                ->get($url);

            // Verificar el estado de la respuesta
            if ($urlConsulta->failed()) {
                return [
                    'error' => 'Error al consultar el servicio GIS. Por favor, inténtelo más tarde.'
                ];
            }

            // Decodificar la respuesta JSON
            $data = $urlConsulta->json();

            if (isset($data['error'])) {
                return [
                    'error' => $data['error']['message']
                ];
            }

            if (!$data || !isset($data['features'][0])) {
                return [
                    'error' => 'No se encontraron datos para el contrato proporcionado.'
                ];
            }

            $attributes = $data['features'][0]['attributes'];
            $geometry = $data['features'][0]['geometry'];

            // Convertir coordenadas de Web Mercator a latitud y longitud
            list($lat, $lng) = $this->convertWebMercatorToLatLng($geometry['x'], $geometry['y']);

            return [
                'info' => [
                    'direccion' => $attributes['DIRECCION'],
                    'estado' => $attributes['ESTADOPRODUCTO'],
                    'estadoCorte' => $attributes['DESCESTADOCORTE'],
                    'usuario' => $attributes['NOMBREUSUARIO'],
                    'apellido' => $attributes['APELLIDO'],
                    'barrio' => $attributes['NOMBREBARRIO'],
                    'categoria' => $attributes['DESCATEGORIA'],
                    'descripcion' => $attributes['DESCRIPCION'],
                    'contrato' => $attributes['PRODUCT_ID'],
                    'medidor' => $attributes['ELEMENTOMEDICION']
                ],
                'geometry' => [
                    'latitude' => $lat,
                    'longitude' => $lng
                ]
            ];
        } catch (\Exception $e) {
            return [
                'error' => 'Se produjo un error al intentar acceder al servicio : ' // . $e->getMessage()
            ];
        }
    }

    public function DataGisVerificacion(string $id)
    {
        try {

            $token = env('GIS_API_TOKEN');
            $data = reportesverificacion::find($id);
            $surtigas = direcciones::where('contrato', $data->contrato)->first();
            $url = "https://arcgisportal.surtigas.com.co/geaserver/rest/services/Ingenieria/FC_PTDIRECCIONES/MapServer/0/query?f=json&where=(SUBSCRIPTION_ID%20IS%20NOT%20NULL)%20AND%20(SUBSCRIPTION_ID%20%3D%20$surtigas->contrato)&returnGeometry=true&spatialRel=esriSpatialRelIntersects&outFields=OBJECTID%2CORDEN%2CRID%2COBJECTID_1%2CDEPARTAMENTO%2CLOCALIDAD%2CNOMBRE%2CADDRESS_ID%2CID_PREMISE%2CNUP%2CDIRECCION%2CTAG%2CANILLADO%2CTIPOPREDIO%2CCICLO%2CDESCRIPCION%2CBARRIO%2CNOMBREBARRIO%2CCATEGORIA%2CDESCATEGORIA%2CESTRATO%2CPRODUCT_ID%2CPRODUCT_STATUS_ID%2CESTADOPRODUCTO%2CSUBSCRIPTION_ID%2CDESCESTADOCORTE%2CCODIDOESTADOCORTE%2CNOMBREUSUARIO%2CAPELLIDO%2CELEMENTOMEDICION%2CORIG_FID&outSR=102100&resultOffset=0&resultRecordCount=1000&token=$token";

            if (!$surtigas) {
                return [
                    'error' => 'No se encontró la dirección asociada al contrato proporcionado.'
                ];
            }

            // URL de consulta
            $urlConsulta = Http::withoutVerifying()
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
                ])
                ->get($url);

            // Verificar el estado de la respuesta
            if ($urlConsulta->failed()) {
                return [
                    'error' => 'Error al consultar el servicio GIS. Por favor, inténtelo más tarde.'
                ];
            }

            // Decodificar la respuesta JSON
            $data = $urlConsulta->json();

            if (isset($data['error'])) {
                return [
                    'error' => $data['error']['message']
                ];
            }

            if (!$data || !isset($data['features'][0])) {
                return [
                    'error' => 'No se encontraron datos para el contrato proporcionado.'
                ];
            }

            $attributes = $data['features'][0]['attributes'];
            $geometry = $data['features'][0]['geometry'];
            return [
                'info' => [
                    'direccion' => $attributes['DIRECCION'],
                    'estado' => $attributes['ESTADOPRODUCTO'],
                    'estadoCorte' => $attributes['DESCESTADOCORTE'],
                    'usuario' => $attributes['NOMBREUSUARIO'],
                    'apellido' => $attributes['APELLIDO'],
                    'barrio' => $attributes['NOMBREBARRIO'],
                    'categoria' => $attributes['DESCATEGORIA'],
                    'descripcion' => $attributes['DESCRIPCION'],
                    'contrato' => $attributes['SUBSCRIPTION_ID'],
                    'medidor' => $attributes['ELEMENTOMEDICION'],
                ],
                'geometry_x' => $geometry['x'],
                'geometry_y' => $geometry['y']
            ];
        } catch (\Exception $e) {
            return [
                'error' => 'Se produjo un error al intentar acceder al servicio : ' // . $e->getMessage()
            ];
        }
    }

    public function DataGisubicacion(string $id)
    {
        try {
            $token = env('GIS_API_TOKEN');
            $surtigas = direcciones::where('contrato', $id)->first();
            $url = "https://arcgisportal.surtigas.com.co/geaserver/rest/services/Ingenieria/FC_PTDIRECCIONES/MapServer/0/query?f=json&where=(SUBSCRIPTION_ID%20IS%20NOT%20NULL)%20AND%20(SUBSCRIPTION_ID%20%3D%20$surtigas->contrato)&returnGeometry=true&spatialRel=esriSpatialRelIntersects&outFields=OBJECTID%2CORDEN%2CRID%2COBJECTID_1%2CDEPARTAMENTO%2CLOCALIDAD%2CNOMBRE%2CADDRESS_ID%2CID_PREMISE%2CNUP%2CDIRECCION%2CTAG%2CANILLADO%2CTIPOPREDIO%2CCICLO%2CDESCRIPCION%2CBARRIO%2CNOMBREBARRIO%2CCATEGORIA%2CDESCATEGORIA%2CESTRATO%2CPRODUCT_ID%2CPRODUCT_STATUS_ID%2CESTADOPRODUCTO%2CSUBSCRIPTION_ID%2CDESCESTADOCORTE%2CCODIDOESTADOCORTE%2CNOMBREUSUARIO%2CAPELLIDO%2CELEMENTOMEDICION%2CORIG_FID&outSR=102100&resultOffset=0&resultRecordCount=1000&token=$token";

            if (!$surtigas) {
                return [
                    'error' => 'No se encontró informacion asociada al contrato proporcionado.'
                ];
            }

            // URL de consulta
            $urlConsulta = Http::withoutVerifying()
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
                ])
                ->get($url);

            // Verificar el estado de la respuesta
            if ($urlConsulta->failed()) {
                return [
                    'error' => 'Error al consultar el servicio GIS. Por favor, inténtelo más tarde.'
                ];
            }

            // Decodificar la respuesta JSON
            $data = $urlConsulta->json();

            if (isset($data['error'])) {
                return [
                    'error' => $data['error']['message']
                ];
            }

            if (!$data || !isset($data['features'][0])) {
                return [
                    'error' => 'No se encontraron datos para el contrato proporcionado.'
                ];
            }

            $attributes = $data['features'][0]['attributes'];
            $geometry = $data['features'][0]['geometry'];

            // Convertir coordenadas de Web Mercator a latitud y longitud
            list($lat, $lng) = $this->convertWebMercatorToLatLng($geometry['x'], $geometry['y']);

            return [
                'info' => [
                    'direccion' => $attributes['DIRECCION'],
                    'estado' => $attributes['ESTADOPRODUCTO'],
                    'estadoCorte' => $attributes['DESCESTADOCORTE'],
                    'usuario' => $attributes['NOMBREUSUARIO'],
                    'apellido' => $attributes['APELLIDO'],
                    'barrio' => $attributes['NOMBREBARRIO'],
                    'categoria' => $attributes['DESCATEGORIA'],
                    'descripcion' => $attributes['DESCRIPCION'],
                    'contrato' => $attributes['PRODUCT_ID'],
                    'medidor' => $attributes['ELEMENTOMEDICION']
                ],
                'geometry' => [
                    'latitude' => $lat,
                    'longitude' => $lng
                ]
            ];
        } catch (\Exception $e) {
            return [
                'error' => 'Se produjo un error al intentar acceder al servicio : ' // . $e->getMessage()
            ];
        }
    }

    private function convertWebMercatorToLatLng($x, $y)
    {
        $lng = ($x / 6378137) * (180 / pi());
        $lat = (2 * atan(exp($y / 6378137)) - (pi() / 2)) * (180 / pi());
        return [$lat, $lng];
    }
}
