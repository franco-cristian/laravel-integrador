<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    /**
     * Muestra la vista principal de la aplicación.
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
     * Obtiene un "todo" de ejemplo desde JSONPlaceholder.
     * Este método será llamado por nuestra API interna.
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
