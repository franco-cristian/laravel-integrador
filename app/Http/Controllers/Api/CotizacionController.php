<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CotizacionController extends Controller
{
    /**
     * Convierte un valor en dólares a pesos argentinos según un tipo de cotización.
     */
    public function convertir(Request $request)
    {
        // 1. Validar los datos de entrada
        $request->validate([
            'valor' => 'required|numeric|min:0.01',
            'tipo' => 'sometimes|string|in:oficial,blue,bolsa,contado_con_liqui,mayorista,cripto,tarjeta',
        ]);

        $valorUSD = (float) $request->query('valor');
        // Si no se especifica el tipo, usamos 'oficial' por defecto
        $tipo = $request->query('tipo', 'oficial');

        // 2. Obtener la URL base desde el archivo de configuración
        $baseUrl = config('services.dolarapi.url');
        $apiUrl = "{$baseUrl}/{$tipo}";

        // 3. Consumir la API externa
        $response = Http::timeout(5)->get($apiUrl);

        // 4. Manejar respuestas fallidas de la API externa
        if ($response->failed()) {
            Log::error("Error al consumir DolarAPI: " . $response->body());
            return response()->json(['error' => 'No se pudo obtener la cotización en este momento.'], 502); // 502 Bad Gateway
        }

        $data = $response->json();
        $cotizacion = $data['venta'] ?? null;

        // 5. Manejar el caso en que la cotización no esté disponible
        if (is_null($cotizacion)) {
            return response()->json(['error' => "La cotización para el tipo '{$tipo}' no está disponible."], 404);
        }

        // 6. Calcular y devolver el resultado
        $resultado = $valorUSD * $cotizacion;

        return response()->json([
            'tipo_cotizacion' => $tipo,
            'valor_dolar' => $valorUSD,
            'valor_venta_dolar' => $cotizacion,
            'resultado_en_pesos' => round($resultado, 2),
            'fuente' => 'https://dolarapi.com',
            'ultima_actualizacion' => $data['fechaActualizacion'] ?? null,
        ]);
    }
}