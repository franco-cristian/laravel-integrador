<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Cotizacion;

/**
 * @group Cotización de Dólar
 *
 * APIs para la conversión de dólar a pesos y consulta de promedios históricos.
 */
class CotizacionController extends Controller
{
    /**
     * Conversor en Tiempo Real
     * 
     * Convierte un monto en dólares (USD) a pesos argentinos (ARS) utilizando la cotización
     * en tiempo real de un tipo de dólar específico.
     *
     * @unauthenticated
     * 
     * @queryParam valor float required El monto en dólares a convertir. Example: 150.50
     * @queryParam tipo string Opcional. El tipo de cotización a utilizar. Si no se envía, se usa 'oficial'. Example: blue
     *
     */
    public function convertir(Request $request)
    {
        $request->validate([
            'valor' => 'required|numeric|min:0.01',
            'tipo' => 'sometimes|string|in:oficial,blue,bolsa,contadoconliqui,mayorista,cripto,tarjeta',
        ]);

        $valorUSD = (float) $request->query('valor');
        $tipo = $request->query('tipo', 'oficial');
        $baseUrl = config('services.dolarapi.url');
        $apiUrl = "{$baseUrl}/{$tipo}";

        $response = Http::timeout(10)->get($apiUrl);

        if ($response->failed()) {
            Log::error("Error al consumir DolarAPI: " . $response->body());
            return response()->json(['error' => 'No se pudo obtener la cotización en este momento.'], 502);
        }

        $data = $response->json();
        $cotizacion_venta = $data['venta'] ?? null;
        $cotizacion_compra = $data['compra'] ?? null;

        if (is_null($cotizacion_venta)) {
            return response()->json(['error' => "La cotización para el tipo '{$tipo}' no está disponible."], 404);
        }

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
     * Promedio Mensual Histórico
     * 
     * Calcula el promedio mensual de la cotización de compra o venta para un tipo de dólar,
     * mes y año específicos, basado en los datos almacenados en la base de datos.
     *
     * @unauthenticated
     * 
     * @queryParam anio integer required El año para el cálculo. Example: 2025
     * @queryParam mes integer required El mes para el cálculo (1-12). Example: 9
     * @queryParam tipo_dolar string required El tipo de dólar a promediar. Example: blue
     * @queryParam tipo_valor string required El valor a promediar ('compra' o 'venta'). Example: venta
     */
    public function promedioMensual(Request $request)
    {
        $validated = $request->validate([
            'anio' => 'required|integer|date_format:Y|min:2000',
            'mes' => 'required|integer|between:1,12',
            'tipo_dolar' => 'required|string|exists:cotizaciones,tipo',
            'tipo_valor' => 'required|string|in:compra,venta',
        ]);

        $anio = $validated['anio'];
        $mes = $validated['mes'];
        $tipoDolar = $validated['tipo_dolar'];
        $tipoValor = $validated['tipo_valor'];

        $query = Cotizacion::query()
            ->where('tipo', $tipoDolar)
            ->whereYear('fecha', $anio)
            ->whereMonth('fecha', $mes);
            
        $registrosEncontrados = $query->count();
        $promedio = $query->avg($tipoValor);
        
        if ($registrosEncontrados === 0) {
            return response()->json([
                'mensaje' => 'No se encontraron registros para los parámetros especificados.',
                'parametros' => $validated,
                'promedio' => 0,
                'registros_encontrados' => 0,
            ], 404);
        }

        return response()->json([
            'parametros' => $validated,
            'promedio' => round($promedio, 2),
            'registros_encontrados' => $registrosEncontrados,
        ]);
    }
}