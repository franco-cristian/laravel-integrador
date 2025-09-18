<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.3.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.3.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-cotizacion-de-dolar" class="tocify-header">
                <li class="tocify-item level-1" data-unique="cotizacion-de-dolar">
                    <a href="#cotizacion-de-dolar">Cotización de Dólar</a>
                </li>
                                    <ul id="tocify-subheader-cotizacion-de-dolar" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="cotizacion-de-dolar-GETapi-convertir">
                                <a href="#cotizacion-de-dolar-GETapi-convertir">Conversor en Tiempo Real</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="cotizacion-de-dolar-GETapi-cotizaciones-promedio-mensual">
                                <a href="#cotizacion-de-dolar-GETapi-cotizaciones-promedio-mensual">Promedio Mensual Histórico</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-pruebas-y-ejemplos" class="tocify-header">
                <li class="tocify-item level-1" data-unique="pruebas-y-ejemplos">
                    <a href="#pruebas-y-ejemplos">Pruebas y Ejemplos</a>
                </li>
                                    <ul id="tocify-subheader-pruebas-y-ejemplos" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="pruebas-y-ejemplos-GETapi-get-todo">
                                <a href="#pruebas-y-ejemplos-GETapi-get-todo">Endpoint de Prueba (JSONPlaceholder)</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: September 18, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="cotizacion-de-dolar">Cotización de Dólar</h1>

    <p>APIs para la conversión de dólar a pesos y consulta de promedios históricos.</p>

                                <h2 id="cotizacion-de-dolar-GETapi-convertir">Conversor en Tiempo Real</h2>

<p>
</p>

<p>Convierte un monto en dólares (USD) a pesos argentinos (ARS) utilizando la cotización
en tiempo real de un tipo de dólar específico.</p>

<span id="example-requests-GETapi-convertir">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/convertir?valor=150.5&amp;tipo=blue" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"valor\": 27,
    \"tipo\": \"blue\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/convertir"
);

const params = {
    "valor": "150.5",
    "tipo": "blue",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "valor": 27,
    "tipo": "blue"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-convertir">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;tipo_cotizacion&quot;: &quot;blue&quot;,
    &quot;valor_dolar&quot;: 150.5,
    &quot;valor_venta_dolar&quot;: 1505,
    &quot;valor_compra_dolar&quot;: 1485,
    &quot;resultado_en_pesos_venta&quot;: 226502.5,
    &quot;resultado_en_pesos_compra&quot;: 223492.5,
    &quot;fuente&quot;: &quot;https://dolarapi.com&quot;,
    &quot;ultima_actualizacion&quot;: &quot;2025-09-18T14:34:00.000Z&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-convertir" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-convertir"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-convertir"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-convertir" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-convertir">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-convertir" data-method="GET"
      data-path="api/convertir"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-convertir', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-convertir"
                    onclick="tryItOut('GETapi-convertir');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-convertir"
                    onclick="cancelTryOut('GETapi-convertir');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-convertir"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/convertir</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-convertir"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-convertir"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>valor</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="valor"                data-endpoint="GETapi-convertir"
               value="150.5"
               data-component="query">
    <br>
<p>El monto en dólares a convertir. Example: <code>150.5</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tipo</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="tipo"                data-endpoint="GETapi-convertir"
               value="blue"
               data-component="query">
    <br>
<p>Opcional. El tipo de cotización a utilizar. Si no se envía, se usa 'oficial'. Example: <code>blue</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>valor</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="valor"                data-endpoint="GETapi-convertir"
               value="27"
               data-component="body">
    <br>
<p>Must be at least 0.01. Example: <code>27</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tipo</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="tipo"                data-endpoint="GETapi-convertir"
               value="blue"
               data-component="body">
    <br>
<p>Example: <code>blue</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>oficial</code></li> <li><code>blue</code></li> <li><code>bolsa</code></li> <li><code>contadoconliqui</code></li> <li><code>mayorista</code></li> <li><code>cripto</code></li> <li><code>tarjeta</code></li></ul>
        </div>
        </form>

                    <h2 id="cotizacion-de-dolar-GETapi-cotizaciones-promedio-mensual">Promedio Mensual Histórico</h2>

<p>
</p>

<p>Calcula el promedio mensual de la cotización de compra o venta para un tipo de dólar,
mes y año específicos, basado en los datos almacenados en la base de datos.</p>

<span id="example-requests-GETapi-cotizaciones-promedio-mensual">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/cotizaciones/promedio-mensual?anio=2025&amp;mes=9&amp;tipo_dolar=blue&amp;tipo_valor=venta" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"anio\": \"bngzmiyvdljnikhwaykcmyuwpwlvqwrsitcpscqldzsnrwtujwvlxjklqppwqbewtnnoqitpxntltcvipojsausgioglrbchgsrzyhcttwbkmkftmgosgtvnbobmzezcrcvalexqztppihrtgkkrerexhqziqvndjouolkgssaaypacbpeaybeqdpmkbfywhzmitnadsmrvbekdxdemofrggdrzcntxpvfaybyznkfbqoezonyqoewjbrzzabxblgvzzddqnfsrkycqdnhzrktyiixxfimbnlcqpsktxrjtqjhqcvcuphijpurfuavpadbixxveywjxjynvkqwvyoxhaakfdlwzlkdidhwnpbeedexnjzbtfsusczxslxsmdqlbmccrxlvbqqaoadotsqfahakzuocywklhwyqpxqtukasrfcacbixszfdfwblzcatijadzidpwasgnnvpgzetkkzglgbpfeijzfirbfmnyzpjiewqozeugghcjwovpwqrirooelambubqytzjyiqezaidtgrzmldsqfclzflyemehdapjvgercftckwfevmwurdyqdejshholoweqyqxpabdfcbbimtgtbnmonbbxsyralfpyollokjnttdnfkvreoovpjtbactjxlontxowpquieppkltoskmehdttopcdlfbmxyxkunzlyjvifnbkgxzjqnoutzxbeomjcxwntdpnsjvemogajnpxfxehrlxiwldqhoekvdppysmuihihcdbeltisfqjhpprjnzvfrjizsxxxkoloqowbmbsxywaipkfgjrduyapouajtuhszjhizztdubpldrsbbulbydiodanpzjxcwotrojazujxlsnxcalszwjpfauplsnsfwlerrsumezwmvggintpntkdsiuigptzduqlajamtq\",
    \"mes\": 1,
    \"tipo_dolar\": \"architecto\",
    \"tipo_valor\": \"venta\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cotizaciones/promedio-mensual"
);

const params = {
    "anio": "2025",
    "mes": "9",
    "tipo_dolar": "blue",
    "tipo_valor": "venta",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "anio": "bngzmiyvdljnikhwaykcmyuwpwlvqwrsitcpscqldzsnrwtujwvlxjklqppwqbewtnnoqitpxntltcvipojsausgioglrbchgsrzyhcttwbkmkftmgosgtvnbobmzezcrcvalexqztppihrtgkkrerexhqziqvndjouolkgssaaypacbpeaybeqdpmkbfywhzmitnadsmrvbekdxdemofrggdrzcntxpvfaybyznkfbqoezonyqoewjbrzzabxblgvzzddqnfsrkycqdnhzrktyiixxfimbnlcqpsktxrjtqjhqcvcuphijpurfuavpadbixxveywjxjynvkqwvyoxhaakfdlwzlkdidhwnpbeedexnjzbtfsusczxslxsmdqlbmccrxlvbqqaoadotsqfahakzuocywklhwyqpxqtukasrfcacbixszfdfwblzcatijadzidpwasgnnvpgzetkkzglgbpfeijzfirbfmnyzpjiewqozeugghcjwovpwqrirooelambubqytzjyiqezaidtgrzmldsqfclzflyemehdapjvgercftckwfevmwurdyqdejshholoweqyqxpabdfcbbimtgtbnmonbbxsyralfpyollokjnttdnfkvreoovpjtbactjxlontxowpquieppkltoskmehdttopcdlfbmxyxkunzlyjvifnbkgxzjqnoutzxbeomjcxwntdpnsjvemogajnpxfxehrlxiwldqhoekvdppysmuihihcdbeltisfqjhpprjnzvfrjizsxxxkoloqowbmbsxywaipkfgjrduyapouajtuhszjhizztdubpldrsbbulbydiodanpzjxcwotrojazujxlsnxcalszwjpfauplsnsfwlerrsumezwmvggintpntkdsiuigptzduqlajamtq",
    "mes": 1,
    "tipo_dolar": "architecto",
    "tipo_valor": "venta"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-cotizaciones-promedio-mensual">
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The anio field must be an integer. (and 3 more errors)&quot;,
    &quot;errors&quot;: {
        &quot;anio&quot;: [
            &quot;The anio field must be an integer.&quot;,
            &quot;The anio field must match the format Y.&quot;,
            &quot;The anio field must be at least 2000.&quot;
        ],
        &quot;tipo_dolar&quot;: [
            &quot;The selected tipo dolar is invalid.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-cotizaciones-promedio-mensual" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-cotizaciones-promedio-mensual"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-cotizaciones-promedio-mensual"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-cotizaciones-promedio-mensual" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-cotizaciones-promedio-mensual">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-cotizaciones-promedio-mensual" data-method="GET"
      data-path="api/cotizaciones/promedio-mensual"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-cotizaciones-promedio-mensual', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-cotizaciones-promedio-mensual"
                    onclick="tryItOut('GETapi-cotizaciones-promedio-mensual');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-cotizaciones-promedio-mensual"
                    onclick="cancelTryOut('GETapi-cotizaciones-promedio-mensual');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-cotizaciones-promedio-mensual"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/cotizaciones/promedio-mensual</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-cotizaciones-promedio-mensual"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-cotizaciones-promedio-mensual"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>anio</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="anio"                data-endpoint="GETapi-cotizaciones-promedio-mensual"
               value="2025"
               data-component="query">
    <br>
<p>El año para el cálculo. Example: <code>2025</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>mes</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="mes"                data-endpoint="GETapi-cotizaciones-promedio-mensual"
               value="9"
               data-component="query">
    <br>
<p>El mes para el cálculo (1-12). Example: <code>9</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tipo_dolar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tipo_dolar"                data-endpoint="GETapi-cotizaciones-promedio-mensual"
               value="blue"
               data-component="query">
    <br>
<p>El tipo de dólar a promediar. Example: <code>blue</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tipo_valor</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tipo_valor"                data-endpoint="GETapi-cotizaciones-promedio-mensual"
               value="venta"
               data-component="query">
    <br>
<p>El valor a promediar ('compra' o 'venta'). Example: <code>venta</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>anio</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="anio"                data-endpoint="GETapi-cotizaciones-promedio-mensual"
               value="bngzmiyvdljnikhwaykcmyuwpwlvqwrsitcpscqldzsnrwtujwvlxjklqppwqbewtnnoqitpxntltcvipojsausgioglrbchgsrzyhcttwbkmkftmgosgtvnbobmzezcrcvalexqztppihrtgkkrerexhqziqvndjouolkgssaaypacbpeaybeqdpmkbfywhzmitnadsmrvbekdxdemofrggdrzcntxpvfaybyznkfbqoezonyqoewjbrzzabxblgvzzddqnfsrkycqdnhzrktyiixxfimbnlcqpsktxrjtqjhqcvcuphijpurfuavpadbixxveywjxjynvkqwvyoxhaakfdlwzlkdidhwnpbeedexnjzbtfsusczxslxsmdqlbmccrxlvbqqaoadotsqfahakzuocywklhwyqpxqtukasrfcacbixszfdfwblzcatijadzidpwasgnnvpgzetkkzglgbpfeijzfirbfmnyzpjiewqozeugghcjwovpwqrirooelambubqytzjyiqezaidtgrzmldsqfclzflyemehdapjvgercftckwfevmwurdyqdejshholoweqyqxpabdfcbbimtgtbnmonbbxsyralfpyollokjnttdnfkvreoovpjtbactjxlontxowpquieppkltoskmehdttopcdlfbmxyxkunzlyjvifnbkgxzjqnoutzxbeomjcxwntdpnsjvemogajnpxfxehrlxiwldqhoekvdppysmuihihcdbeltisfqjhpprjnzvfrjizsxxxkoloqowbmbsxywaipkfgjrduyapouajtuhszjhizztdubpldrsbbulbydiodanpzjxcwotrojazujxlsnxcalszwjpfauplsnsfwlerrsumezwmvggintpntkdsiuigptzduqlajamtq"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y</code>. Must be at least 2000 characters. Example: <code>bngzmiyvdljnikhwaykcmyuwpwlvqwrsitcpscqldzsnrwtujwvlxjklqppwqbewtnnoqitpxntltcvipojsausgioglrbchgsrzyhcttwbkmkftmgosgtvnbobmzezcrcvalexqztppihrtgkkrerexhqziqvndjouolkgssaaypacbpeaybeqdpmkbfywhzmitnadsmrvbekdxdemofrggdrzcntxpvfaybyznkfbqoezonyqoewjbrzzabxblgvzzddqnfsrkycqdnhzrktyiixxfimbnlcqpsktxrjtqjhqcvcuphijpurfuavpadbixxveywjxjynvkqwvyoxhaakfdlwzlkdidhwnpbeedexnjzbtfsusczxslxsmdqlbmccrxlvbqqaoadotsqfahakzuocywklhwyqpxqtukasrfcacbixszfdfwblzcatijadzidpwasgnnvpgzetkkzglgbpfeijzfirbfmnyzpjiewqozeugghcjwovpwqrirooelambubqytzjyiqezaidtgrzmldsqfclzflyemehdapjvgercftckwfevmwurdyqdejshholoweqyqxpabdfcbbimtgtbnmonbbxsyralfpyollokjnttdnfkvreoovpjtbactjxlontxowpquieppkltoskmehdttopcdlfbmxyxkunzlyjvifnbkgxzjqnoutzxbeomjcxwntdpnsjvemogajnpxfxehrlxiwldqhoekvdppysmuihihcdbeltisfqjhpprjnzvfrjizsxxxkoloqowbmbsxywaipkfgjrduyapouajtuhszjhizztdubpldrsbbulbydiodanpzjxcwotrojazujxlsnxcalszwjpfauplsnsfwlerrsumezwmvggintpntkdsiuigptzduqlajamtq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mes</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="mes"                data-endpoint="GETapi-cotizaciones-promedio-mensual"
               value="1"
               data-component="body">
    <br>
<p>Must be between 1 and 12. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tipo_dolar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tipo_dolar"                data-endpoint="GETapi-cotizaciones-promedio-mensual"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>tipo</code> of an existing record in the cotizaciones table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tipo_valor</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tipo_valor"                data-endpoint="GETapi-cotizaciones-promedio-mensual"
               value="venta"
               data-component="body">
    <br>
<p>Example: <code>venta</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>compra</code></li> <li><code>venta</code></li></ul>
        </div>
        </form>

                <h1 id="pruebas-y-ejemplos">Pruebas y Ejemplos</h1>

    <p>Controladores que no pertenecen al dominio principal de la aplicación,
como la vista principal y endpoints de prueba.</p>

                                <h2 id="pruebas-y-ejemplos-GETapi-get-todo">Endpoint de Prueba (JSONPlaceholder)</h2>

<p>
</p>

<p>Obtiene el &quot;todo&quot; con ID 1 desde la API pública de JSONPlaceholder.
Este endpoint es un ejemplo estático y no acepta parámetros.</p>

<span id="example-requests-GETapi-get-todo">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/get-todo" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/get-todo"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-get-todo">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;userId&quot;: 1,
    &quot;id&quot;: 1,
    &quot;title&quot;: &quot;delectus aut autem&quot;,
    &quot;completed&quot;: false
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-get-todo" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-get-todo"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-get-todo"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-get-todo" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-get-todo">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-get-todo" data-method="GET"
      data-path="api/get-todo"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-get-todo', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-get-todo"
                    onclick="tryItOut('GETapi-get-todo');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-get-todo"
                    onclick="cancelTryOut('GETapi-get-todo');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-get-todo"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/get-todo</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-get-todo"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-get-todo"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
