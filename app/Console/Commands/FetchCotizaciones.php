<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cotizacion;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class FetchCotizaciones extends Command
{
    /**
     * The name and signature of the console command.
     * Usaremos 'cotizaciones:fetch' como un nombre descriptivo.
     */
    protected $signature = 'cotizaciones:fetch';

    /**
     * The console command description.
     */
    protected $description = 'Obtiene las cotizaciones del dólar desde DolarAPI y las guarda en la base de datos.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando la obtención de cotizaciones del dólar...');

        // Obtenemos la URL base desde el archivo de configuración
        $baseUrl = config('services.dolarapi.url');

        // Hacemos una única llamada a la API que nos trae todos los tipos
        $response = Http::get($baseUrl);

        if ($response->failed()) {
            $this->error('Error al conectar con la API de cotizaciones.');
            Log::error('DolarAPI fetch failed: ' . $response->body());
            return 1; // Termina el comando con un código de error
        }

        $cotizaciones = $response->json();

        // Verificamos que la respuesta sea un array
        if (!is_array($cotizaciones)) {
            $this->error('La respuesta de la API no tiene el formato esperado.');
            Log::warning('DolarAPI response was not an array.');
            return 1;
        }
        
        $count = 0;
        foreach ($cotizaciones as $c) {
            // Nos aseguramos de tener los datos necesarios
            if (!isset($c['nombre'], $c['compra'], $c['venta'], $c['fechaActualizacion'])) {
                continue;
            }

            // Usamos updateOrCreate para evitar duplicados.
            // Busca un registro con la misma fecha y tipo. Si lo encuentra, lo actualiza.
            // Si no, lo crea.
            Cotizacion::updateOrCreate(
                [
                    'tipo' => $c['casa'], // 'oficial', 'blue', etc.
                    'fecha' => Carbon::parse($c['fechaActualizacion'])->toDateString(),
                ],
                [
                    'compra' => $c['compra'],
                    'venta' => $c['venta'],
                ]
            );
            $count++;
        }

        $this->info("Proceso completado. Se obtuvieron y guardaron {$count} cotizaciones.");
        return 0; // Termina el comando exitosamente
    }
}