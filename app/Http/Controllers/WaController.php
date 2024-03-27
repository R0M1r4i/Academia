<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\estudiante;
use App\Models\ciclo;

class WaController
{
    public function envia()
    {
        // limite de tiempo de ejecucion
        set_time_limit(300);

        $telefonos = Estudiante::where('ciclo_id_ciclo', Ciclo::latest('id_ciclo')->first()->id_ciclo)
            ->pluck('celular_apoderado')
            ->toArray();

        // Agregar '51' a cada número de teléfono
        $telefonos = array_map(function($telefono) {
            return '51' . $telefono;
        }, $telefonos);

        $token = 'EAFjXYPGxn3oBO5TzXlw8ZApuBwZCZBMOQKrIUVkHZBCZAe88vQj7Pq6AfTfYX0YthRL0ZCVgZBDZBQdT7DnlOD1dkx571kDgTP69181ZAAtBCnxoC0zCSm4mXKFo4syxTVbLAESJW9nrMhhF2Awgq1qZAZB7hmIrlY1mTpXctXpeohKJJpvr0OEk9mSpmZCjKTdEbHpr';
        $url = 'https://graph.facebook.com/v18.0/239170182621200/messages';

        $errores = [];
        $contador = 0;

        foreach ($telefonos as $telefono) {
            if ($contador == 200) {

                $contador = 0;
            }

            $mensaje = "{ \"messaging_product\": \"whatsapp\", \"to\": \"$telefono\",
 \"type\": \"template\", \"template\": { \"name\": \"servicio\",
 \"language\": { \"code\": \"en_US\" } } }";

            $header = array("Authorization: Bearer " . $token, "Content-Type: application/json");

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = json_decode(curl_exec($curl), true);

            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status_code != 200) {
                $telefonoSinPrefijo = substr($telefono, 2); // quita el prefijo '51'
                $errores[] = $telefonoSinPrefijo;
            }

            curl_close($curl);
            $contador++;
        }

        return response()->json([
            'errores' => $errores,
        ]);
    }
}


