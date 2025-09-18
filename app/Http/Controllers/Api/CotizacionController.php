<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Cotizacion;

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
            'tipo' => 'sometimes|string|in:oficial,blue,bolsa,contadoconliqui,mayorista,cripto,tarjeta',
        ]);

        $valorUSD = (float) $request->query('valor');
        // Si no se especifica el tipo, usamos 'oficial' por defecto
        $tipo = $request->query('tipo', 'oficial');

        // 2. Obtener la URL base desde el archivo de configuración
        $baseUrl = config('services.dolarapi.url');
        $apiUrl = "{$baseUrl}/{$tipo}";

        // 3. Consumir la API externa
        $response = Http::timeout(10)->get($apiUrl);

        // 4. Manejar respuestas fallidas de la API externa
        if ($response->failed()) {
            Log::error("Error al consumir DolarAPI: " . $response->body());
            return response()->json(['error' => 'No se pudo obtener la cotización en este momento.'], 502); // 502 Bad Gateway
        }

        $data = $response->json();
        // Obtenemos ambos valores, compra y venta
        $cotizacion_venta = $data['venta'] ?? null;
        $cotizacion_compra = $data['compra'] ?? null;

        // 5. Manejar el caso en que la cotización no esté disponible
        if (is_null($cotizacion_venta)) {
            return response()->json(['error' => "La cotización para el tipo '{$tipo}' no está disponible."], 404);
        }

        // 6. Calcular y devolver el resultado
        $resultado_venta = $valorUSD * $cotizacion_venta;
        $resultado_compra = $valorUSD * $cotizacion_compra;

        return response()->json([
            'tipo_cotizacion' => $tipo,
            'valor_dolar' => $valorUSD,
            'valor_venta_dolar' => $cotizacion_venta,
            'valor_compra_dolar' => $cotizacion_compra,
            'resultado_en_pesos_venta' => round($resultado_venta, 2),
            'resultado_en_pesos_compra' => round($resultado_compra, 2),
            'fuente' => 'https://dolarapi.com',
            'ultima_actualizacion' => $data['fechaActualizacion'] ?? null,
        ]);
    }
    /**
     * Calcula el promedio mensual de una cotización específica.
     */
    public function promedioMensual(Request $request)
    {
        // 1. Validar los parámetros de entrada
        $validated = $request->validate([
            'anio' => 'required|integer|date_format:Y|min:2000',
            'mes' => 'required|integer|between:1,12',
            'tipo_dolar' => 'required|string|exists:cotizaciones,tipo', // Valida que el tipo exista en la tabla
            'tipo_valor' => 'required|string|in:compra,venta',
        ]);

        $anio = $validated['anio'];
        $mes = $validated['mes'];
        $tipoDolar = $validated['tipo_dolar'];
        $tipoValor = $validated['tipo_valor']; // 'compra' o 'venta'

        // 2. Construir la consulta a la base de datos
        $query = Cotizacion::query()
            ->where('tipo', $tipoDolar)
            ->whereYear('fecha', $anio)
            ->whereMonth('fecha', $mes);
            
        // 3. Contar los registros encontrados antes de calcular el promedio
        $registrosEncontrados = $query->count();

        // 4. Calcular el promedio de la columna solicitada ('compra' o 'venta')
        $promedio = $query->avg($tipoValor);
        
        // 5. Devolver una respuesta JSON clara
        if ($registrosEncontrados === 0) {
            return response()->json([
                'mensaje' => 'No se encontraron registros para los parámetros especificados.',
                'parametros' => $validated,
                'promedio' => 0,
                'registros_encontrados' => 0,
            ], 404); // Not Found
        }

        return response()->json([
            'parametros' => $validated,
            'promedio' => round($promedio, 2), // Redondeamos a 2 decimales
            'registros_encontrados' => $registrosEncontrados,
        ]);
    }
}