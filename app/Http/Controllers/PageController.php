<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * @group Pruebas y Ejemplos
 *
 * Controladores que no pertenecen al dominio principal de la aplicación,
 * como la vista principal y endpoints de prueba.
 */
class PageController extends Controller
{
    /**
     * Muestra la vista principal de la aplicación.
     * @hideFromAPIDocumentation
     */
    public function dashboard()
    {
        // Lista de tipos de dólar para los formularios
        $tiposDolar = [
            'oficial' => 'Oficial',
            'blue' => 'Blue',
            'bolsa' => 'Bolsa (MEP)',
            'contadoconliqui' => 'Contado con Liquidación (CCL)',
            'mayorista' => 'Mayorista',
            'cripto' => 'Cripto',
            'tarjeta' => 'Tarjeta',
        ];

        // Generar una lista de años para el selector (ej: desde 2020 hasta el año actual)
        $anios = range(date('Y'), 2020);

        return view('dashboard', [
            'tiposDolar' => $tiposDolar,
            'anios' => $anios
        ]);
    }

    /**
     * Endpoint de Prueba (JSONPlaceholder)
     * 
     * Obtiene el "todo" con ID 1 desde la API pública de JSONPlaceholder.
     * Este endpoint es un ejemplo estático y no acepta parámetros.
     *
     * @unauthenticated
     * 
     */
    public function getTodoExample()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/todos/1');

        if ($response->failed()) {
            Log::error("Error al consumir JSONPlaceholder: " . $response->body());
            return response()->json(['error' => 'No se pudo obtener la información.'], 502);
        }

        return $response->json();
    }
}