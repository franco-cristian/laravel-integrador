<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cotizaciones';

    /**
     * The attributes that are mass assignable.
     * Estos son los campos que permitimos que se llenen de forma masiva
     * a través de métodos como create() o updateOrCreate().
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tipo',
        'fecha',
        'compra',
        'venta',
    ];

    /**
     * The attributes that should be cast to native types.
     * Esto le dice a Eloquent cómo tratar los datos cuando los lee
     * de la base de datos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha' => 'date',      // Convierte la columna 'fecha' a un objeto Carbon
        'compra' => 'decimal:2', // Asegura que 'compra' se trate como un decimal con 2 decimales
        'venta' => 'decimal:2',  // Asegura que 'venta' se trate como un decimal con 2 decimales
    ];
}