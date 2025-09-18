<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de APIs - Laravel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 font-sans antialiased">

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Dashboard de APIs</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 mt-2">Integración de DolarAPI, JSONPlaceholder y Promedios</p>
        </header>

        <!-- Contenedor de Pestañas -->
        <div x-data="{ tab: 'conversor' }" class="w-full max-w-4xl mx-auto">
            <!-- Navegación de Pestañas -->
            <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
                <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                    <button @click="tab = 'conversor'"
                        :class="{'border-indigo-500 text-indigo-600 dark:text-indigo-400': tab === 'conversor', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': tab !== 'conversor'}"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                        Conversor Dólar
                    </button>
                    <button @click="tab = 'historial'"
                        :class="{'border-indigo-500 text-indigo-600 dark:text-indigo-400': tab === 'historial', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': tab !== 'historial'}"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                        Historial y Promedios
                    </button>
                    <button @click="tab = 'placeholder'"
                        :class="{'border-indigo-500 text-indigo-600 dark:text-indigo-400': tab === 'placeholder', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': tab !== 'placeholder'}"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                        Test JSONPlaceholder
                    </button>
                </nav>
            </div>

            <!-- Contenido de las Pestañas -->
            <div>
                <!-- PESTAÑA 1: CONVERSOR -->
                <div x-show="tab === 'conversor'" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold mb-4">Conversor de Dólar a Pesos (Tiempo Real)</h2>
                    <form id="dolar-form" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div>
                            <label for="valor_dolar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Monto en USD</label>
                            <input type="number" id="valor_dolar" name="valor" step="0.01" required placeholder="Ej: 150" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div>
                            <label for="tipo_dolar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Cotización</label>
                            <select id="tipo_dolar" name="tipo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                @foreach($tiposDolar as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Convertir</button>
                    </form>
                    <div id="dolar-result" class="mt-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-md text-sm min-h-[50px]"></div>
                </div>

                <!-- PESTAÑA 2: HISTORIAL Y PROMEDIOS -->
                <div x-show="tab === 'historial'" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold mb-4">Calcular Promedio Mensual de Cotización</h2>
                    <form id="promedio-form" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4 items-end">
                        <div>
                            <label for="prom_anio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Año</label>
                            <select id="prom_anio" name="anio" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                @foreach($anios as $a)
                                <option value="{{ $a }}">{{ $a }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="prom_mes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mes</label>
                            <select id="prom_mes" name="mes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ date('n') == $i ? 'selected' : '' }}>{{ strftime('%B', mktime(0, 0, 0, $i, 1)) }}</option>
                                    @endfor
                            </select>
                        </div>
                        <div>
                            <label for="prom_tipo_dolar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Dólar</label>
                            <select id="prom_tipo_dolar" name="tipo_dolar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                @foreach($tiposDolar as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Valor</label>
                            <div class="flex space-x-4 mt-2">
                                <label><input type="radio" name="tipo_valor" value="venta" checked class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"> Venta</label>
                                <label><input type="radio" name="tipo_valor" value="compra" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"> Compra</label>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-teal-600 text-white py-2 px-4 rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">Calcular</button>
                    </form>
                    <div id="promedio-result" class="mt-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-md text-sm min-h-[50px]"></div>
                </div>

                <!-- PESTAÑA 3: JSONPLACEHOLDER -->
                <div x-show="tab === 'placeholder'" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold mb-4">Consulta a JSONPlaceholder</h2>
                    <form id="placeholder-form" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div>
                            <label for="resource_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Recurso</label>
                            <select id="resource_type" name="resource" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                <option value="todos">Todos</option>
                                <option value="posts">Posts</option>
                                <option value="users">Users</option>
                                <option value="comments">Comments</option>
                            </select>
                        </div>
                        <div>
                            <label for="resource_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID (Opcional)</label>
                            <input type="number" id="resource_id" name="id" placeholder="Ej: 1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Consultar</button>
                    </form>
                    <div class="mt-4">
                        <h3 class="font-semibold mb-2">Respuesta:</h3>
                        <pre id="placeholder-result" class="p-4 bg-gray-900 text-white rounded-md text-xs overflow-x-auto min-h-[150px]"><code></code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js para las pestañas -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- JavaScript para la lógica de la API -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- LÓGICA PARA EL CONVERSOR DE DÓLAR ---
            const dolarForm = document.getElementById('dolar-form');
            if (dolarForm) {
                const dolarResult = document.getElementById('dolar-result');
                dolarForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    dolarResult.innerHTML = 'Cargando...';
                    const valor = document.getElementById('valor_dolar').value;
                    const tipo = document.getElementById('tipo_dolar').value;
                    const url = `/api/convertir?valor=${valor}&tipo=${tipo}`;
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                dolarResult.innerHTML = `<span class="text-red-500">Error: ${data.error}</span>`;
                            } else {
                                // Formateamos ambos resultados
                                const formattedVenta = new Intl.NumberFormat('es-AR', {
                                    style: 'currency',
                                    currency: 'ARS'
                                }).format(data.resultado_en_pesos_venta);
                                const formattedCompra = new Intl.NumberFormat('es-AR', {
                                    style: 'currency',
                                    currency: 'ARS'
                                }).format(data.resultado_en_pesos_compra);

                                // HTML más detallado para mostrar ambos resultados
                                let htmlResult = `<div class="space-y-2">`;
                                htmlResult += `<p><strong>Resultado (Venta):</strong> ${formattedVenta} <span class="text-gray-500 dark:text-gray-400">(Cotización: $${data.valor_venta_dolar})</span></p>`;

                                // Solo mostramos la compra si el valor es válido
                                if (data.valor_compra_dolar > 0) {
                                    htmlResult += `<p><strong>Resultado (Compra):</strong> ${formattedCompra} <span class="text-gray-500 dark:text-gray-400">(Cotización: $${data.valor_compra_dolar})</span></p>`;
                                }
                                htmlResult += `</div>`;

                                dolarResult.innerHTML = htmlResult;
                            }
                        })
                        .catch(error => {
                            dolarResult.innerHTML = `<span class="text-red-500">Error de conexión. Intente de nuevo.</span>`;
                        });
                });
            }

            // --- LÓGICA PARA JSONPLACEHOLDER ---
            const placeholderForm = document.getElementById('placeholder-form');
            if (placeholderForm) {
                const placeholderResult = document.querySelector('#placeholder-result code');
                placeholderForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    placeholderResult.textContent = 'Cargando...';
                    const resource = document.getElementById('resource_type').value;
                    const id = document.getElementById('resource_id').value;
                    const url = `https://jsonplaceholder.typicode.com/${resource}/${id || ''}`;
                    fetch(url)
                        .then(response => {
                            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                            return response.json();
                        })
                        .then(data => {
                            placeholderResult.textContent = JSON.stringify(data, null, 2);
                        })
                        .catch(error => {
                            placeholderResult.textContent = `Error: ${error.message}`;
                        });
                });
            }

            // --- LÓGICA PARA PROMEDIO MENSUAL ---
            const promedioForm = document.getElementById('promedio-form');
            if (promedioForm) {
                const promedioResult = document.getElementById('promedio-result');
                promedioForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    promedioResult.innerHTML = 'Calculando...';
                    const anio = document.getElementById('prom_anio').value;
                    const mes = document.getElementById('prom_mes').value;
                    const tipo_dolar = document.getElementById('prom_tipo_dolar').value;
                    const tipo_valor = document.querySelector('input[name="tipo_valor"]:checked').value;
                    const url = `/api/cotizaciones/promedio-mensual?anio=${anio}&mes=${mes}&tipo_dolar=${tipo_dolar}&tipo_valor=${tipo_valor}`;

                    fetch(url)
                        .then(response => {
                            // si la respuesta no es OK (ej: 404, 422, 500),
                            // intentamos leer el error como JSON para mostrar un mensaje más útil.
                            if (!response.ok) {
                                return response.json().then(errorData => {
                                    // Creamos un error personalizado para pasar al bloque .catch
                                    throw new Error(errorData.message || 'Error del servidor.');
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.promedio === 0) {
                                promedioResult.innerHTML = `<span class="text-yellow-500">${data.mensaje || 'No se encontraron datos.'}</span>`;
                            } else {
                                const formattedAvg = new Intl.NumberFormat('es-AR', {
                                    style: 'currency',
                                    currency: 'ARS'
                                }).format(data.promedio);
                                promedioResult.innerHTML = `El promedio de <strong>${tipo_valor}</strong> para <strong>${tipo_dolar}</strong> fue de <strong>${formattedAvg}</strong> (basado en ${data.registros_encontrados} registros).`;
                            }
                        })
                        .catch(error => {
                            // Ahora el catch puede mostrar mensajes de error más específicos
                            promedioResult.innerHTML = `<span class="text-red-500">${error.message || 'Error de conexión. Intente de nuevo.'}</span>`;
                        });
                });
            }
        });
    </script>

</body>

</html>