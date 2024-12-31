<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;
use App\Models\Producto;
use App\Models\ProductoCrucero;
use App\Models\Naviera;

class PromocionController extends Controller
{
public function mostrarDisponibilidadArgentina(Request $request)
{    
    $productos = Producto::where('ubicacion', 'Argentina')->get();
    // Consultar los destinos de Arg
    $destinosArgentinaArray = $this->dispo_consultarDestinosArgentinaAPI();
    $paquetes = [];       
    // Verificación del cookie y lógica de usuario
    if ($request->hasCookie('comercioAdherido')) {
        $userId = $request->cookie('comercioAdherido');
        $cliente = auth()->guard('client')->user();
        if ($cliente && $cliente->fk_users_id === null) {
            $cliente->fk_users_id = $userId;
            try {
                $cliente->save();
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        return view('productos.argentina.argentina', [
        'productos' => $productos, // Usa la misma variable que en mostrarDisponibilidadCaribe
        'paquetes' => $paquetes,
        'destinosArgentina' => json_encode($this->dispo_consultarDestinosArgentinaAPI()),
         ]);
    } else {
        $userId = $request->query('comercioAdherido') ?? 1;
        $user = User::find($userId);
        if (!$user) {
            $userId = 1;
        }
        $cookie = cookie('comercioAdherido', $userId, 60 * 24 * 30 * 12);
        $cliente = auth()->guard('client')->user();
        if ($cliente && $cliente->fk_users_id === null) {
            $cliente->fk_users_id = $userId;
            try {
                $cliente->save();
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        return view('productos.argentina.argentina', [
        'productos' => $productos, // Usa la misma variable que en mostrarDisponibilidadCaribe
        'paquetes' => $paquetes,
        'destinosArgentina' => json_encode($this->dispo_consultarDestinosArgentinaAPI()),
         ]);        
    }
}
private function dispo_consultarDestinosArgentinaAPI()
{
    $url = "https://admin.ola.com.ar/wsola/endpoint.php";
    $requestXml = <<<XML
    <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
                       xmlns:xsd="http://www.w3.org/2001/XMLSchema"
                       xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                       xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/"
                       xmlns:tns="https://admin.ola.com.ar/wsola/endpoint.php"
                       SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
        <SOAP-ENV:Body>
            <tns:GetPackagesFaresDestinations xmlns:tns="https://admin.ola.com.ar/wsola/endpoint.php">
                <Request xsi:type="xsd:string">
                    <![CDATA[
                        <GetPackagesFaresDestinationsRequest>
                            <GeneralParameters>
                                <Username>argtravels</Username>
                                <Password>uNKx4YW59i6rWye</Password>
                                <CustomerIp>181.165.55.94</CustomerIp>
                            </GeneralParameters>
                            <Outlet>1</Outlet>
                            <PackageType>ALL</PackageType>
                        </GetPackagesFaresDestinationsRequest>
                    ]]>
                </Request>
            </tns:GetPackagesFaresDestinations>
        </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>
    XML;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: text/xml; charset=ISO-8859-1",
        "SOAPAction: \"https://admin.ola.com.ar/wsola/endpoint.php#GetPackagesFaresDestinations\"",
        "Content-Length: " . strlen($requestXml)
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXml);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        return []; // Si hay error, retornar array vacío
    } else {
        curl_close($ch);
        return $this->dispo_parsearDestinosArgentina($response);

      return $destinos;
    }
}
 private function dispo_parsearDestinosArgentina($response)
{    
     $destinos = [];
    // Convertir la respuesta a UTF-8
    $response = mb_convert_encoding($response, 'UTF-8', 'ISO-8859-1');
    // Manejar errores de XML al cargar
    libxml_use_internal_errors(true);
    $xml = simplexml_load_string($response);

    if ($xml === false) {
        // Registrar errores de carga de XML
        foreach (libxml_get_errors() as $error) {
            error_log("XML Error: {$error->message}");
        }
        libxml_clear_errors();
        dd("Error al procesar el XML. Verifica la respuesta: ", $response); // Inspecciona la respuesta
    }

    // Extraer la sección 'Response'
    $responseNodes = $xml->xpath('//*[local-name()="Response"]');
    if (empty($responseNodes)) {
        error_log("No se encontró el nodo 'Response' en el XML proporcionado.");
        dd("XML recibido no contiene el nodo 'Response': ", $response); // Verifica si está el nodo
    }

    // Asignar el XML interno
    $internalXmlString = (string) $responseNodes[0];
    $internalXml = simplexml_load_string($internalXmlString);

    if ($internalXml === false) {
        foreach (libxml_get_errors() as $error) {
            error_log("XML Internal Error: {$error->message}");
        }
        libxml_clear_errors();
        dd("Error al procesar el XML interno: ", $internalXmlString);
    }

    // Procesar las zonas y países
    foreach ($internalXml->xpath('//Zone') as $zone) {
        // Filtrar solo la región 'CARIBE Y CENTROAMERICA'
        if ((string)$zone->Name === 'ARGENTINA') {
            foreach ($zone->Countries->Country as $country) {
                $nombrePais = (string) $country->Name;
                $codigoPais = (string) $country->Code;

                if (!isset($destinos[$codigoPais])) {
                    $destinos[$codigoPais] = [
                        'nombre_pais' => $nombrePais,
                        'zona' => 'CARIBE Y CENTROAMERICA',
                        'ciudades' => []
                    ];
                }

                foreach ($country->Cities->City as $city) {
                    $destinos[$codigoPais]['ciudades'][] = [
                        'codigo_ciudad' => (string) $city->Code,
                        'nombre_ciudad' => (string) $city->Name
                    ];
                }
            }
        }
    }

    return $destinos;
} 
public function consultarPaquetesArgentina(Request $request)
{
    // Recibir los datos del formulario
    $pais = $request->input('pais');
    $destino = $request->input('destino');
    $fechaInicio = $request->input('fecha_inicio');
    $fechaFin = $request->input('fecha_fin');
    
    // URL del endpoint
    $url = "https://admin.ola.com.ar/wsola/endpoint.php";

    // Generar el XML de la solicitud
    $requestXml = <<<XML
    <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
        <SOAP-ENV:Body>
            <GetPackagesFares>
                <Request><![CDATA[
                    <GetPackagesFaresRequest>
                        <GeneralParameters>
                            <Username>argtravels</Username>
                            <Password>uNKx4YW59i6rWye</Password>
                            <CustomerIp>181.165.55.94</CustomerIp>
                        </GeneralParameters>
                        <DepartureDate>
                            <From>{$fechaInicio}</From>
                            <To>{$fechaFin}</To>
                        </DepartureDate>
                        <Rooms>
                            <Room>
                                <Passenger Type="ADL"/>
                                <Passenger Type="ADL"/>
                            </Room>
                        </Rooms>
                        <ArrivalDestination>{$destino}</ArrivalDestination>
                        <FareCurrency>PESOS</FareCurrency>
                        <Outlet>1</Outlet>
                        <PackageType>ALL</PackageType>
                    </GetPackagesFaresRequest>
                ]]></Request>
            </GetPackagesFares>
        </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>
    XML;

    // Configurar cURL para enviar la solicitud
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: text/xml; charset=ISO-8859-1",
        "SOAPAction: \"GetPackagesFares\"",
        "Content-Length: " . strlen($requestXml)
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXml);

    // Obtener la respuesta
    $response = curl_exec($ch);
    curl_close($ch);

    if (curl_errno($ch)) {
        return response()->json(['error' => curl_error($ch)]);
    }

    // Procesar la respuesta XML y obtener los paquetes
    $paquetes = $this->parsearPaquetesXMLArgentina($response);

    // Obtener productos personales
    $productos = Producto::where('ubicacion', 'Argentina')->get();

    // Pasar los paquetes y productos a la vista
    return view('productos.argentina.argentina', [
        'productos' => $productos, // Incluye los productos personales
        'paquetes' => $paquetes,
        'destinosArgentina' => json_encode($this->dispo_consultarDestinosArgentinaAPI())
    ]);
}
private function parsearPaquetesXMLArgentina($response)
{
    $paquetes = [];
     
    $xml = simplexml_load_string($response);
    $internalXmlString = (string) $xml->xpath('//*[local-name()="Response"]')[0];
    $internalXml = simplexml_load_string($internalXmlString);
    $paqueteCodigos = [];

    foreach ($internalXml->xpath('//PackageFare') as $packageFare) {
        $codigoPaquete = (string) $packageFare->FareCodes->PackageCode;
        $configurationNumber = (string) $packageFare->FareCodes->ConfigurationNumber;
        $uniqueIdentifier = $codigoPaquete . '-' . $configurationNumber;

        if (!in_array($uniqueIdentifier, $paqueteCodigos)) {
            // Extraer las imágenes del paquete
            $imagenes = $this->obtenerImagenes($packageFare->Package->Pictures->Picture);

            // Calcular el precio final del paquete
            $precioNeto = (float) $packageFare->FareTotal->Net;
            $iva = (float) $packageFare->FareTotal->Vat;
            $impuesto = (float) $packageFare->FareTotal->Tax;
            $precioFinal = $precioNeto + $iva + $impuesto;

            // Extraer los hoteles y sus precios
            $hoteles = [];
            foreach ($packageFare->Descriptions->Description as $descripcion) {
                if ((string)$descripcion->Type === 'HOTEL') {
                    $nombreHotel = (string)$descripcion->Name;
                    $precioHotel = 0;
                    
                    // Buscar el precio correspondiente en FareComponent
                    foreach ($packageFare->xpath('.//FareComponent') as $fareComponent) {
                        if ((string)$fareComponent->Type === 'HOTEL' && (string)$fareComponent->Name === $nombreHotel) {
                            $netoHotel = (float) $fareComponent->Total->Net;
                            $ivaHotel = (float) $fareComponent->Total->Vat;
                            $impuestoHotel = (float) $fareComponent->Total->Tax;
                            $precioHotel = $netoHotel + $ivaHotel + $impuestoHotel;
                            break;
                        }
                    }

                    $hoteles[] = [
                        'nombre' => $nombreHotel,
                        'precio' => $precioHotel,
                        'imagenes' => $this->obtenerImagenes($descripcion->Pictures->Picture)
                    ];
                }
            }

            // Extraer país del destino
            $arrivalCountryCode = (string) $packageFare->xpath('.//Trip/ArrivalCountry/@Iata')[0] ?? null;
            $arrivalCountryName = (string) $packageFare->xpath('.//Trip/ArrivalCountry')[0] ?? null;
            // Extraer nombre ciudad
            $departureCityName = (string) $packageFare->xpath('.//Trip/DepartureCity')[0] ?? null;
            // Crear el array del paquete con los detalles de hoteles
            $paquetes[] = [
                'titulo' => (string) $packageFare->Package->Name,
                'codigo_paquete' => $codigoPaquete,
                'precio' => $precioFinal, // Usar precio final aquí
                'moneda' => (string) $packageFare->FareTotal->Currency,
                'notas' => $this->obtenerNotas($packageFare->FareNotes->FareNote),
                'imagenes' => $imagenes,
                'fecha_salida' => (string) $packageFare->Flight->Trips->Trip->DepartureDate,
                'incluye_aereo' => isset($packageFare->Flight),
                'noches' => (string) $packageFare->Package->Nights,
                'hoteles' => $hoteles,
                'nombre_pais' => $arrivalCountryName,
                'ciudad_origen_nombre' => $departureCityName // Añadir detalles de los hoteles
            ];

            $paqueteCodigos[] = $uniqueIdentifier;
        }
    }
    return $paquetes;
}
private function obtenerImagenes($imagenes)
{
    $listaImagenes = [];

    // Verifica si $imagenes es un array o un objeto antes de hacer el foreach
    if (is_array($imagenes) || is_object($imagenes)) {
        foreach ($imagenes as $imagen) {
            $listaImagenes[] = (string) $imagen;
        }
    }

    return $listaImagenes;
}

private function obtenerNotas($notas)
{
    $listaNotas = [];
    foreach ($notas as $nota) {
        $listaNotas[] = (string) $nota;
    }
    return implode(" ", $listaNotas);
}

public function mostrarDisponibilidadBrasil(Request $request)
{    
    $productos = Producto::where('ubicacion', 'Brasil')->get();
    // Consultar los destinos de Caribe usando el nuevo método de la API
    $destinosBrasil = $this->dispo_consultarDestinosBrasilAPI();
    $paquetes = [];       
    // Verificación del cookie y lógica de usuario
    if ($request->hasCookie('comercioAdherido')) {
        $userId = $request->cookie('comercioAdherido');
        $cliente = auth()->guard('client')->user();
        if ($cliente && $cliente->fk_users_id === null) {
            $cliente->fk_users_id = $userId;
            try {
                $cliente->save();
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        return view('productos.conoce_america.brasil', [
        'productos' => $productos, // Usa la misma variable que en mostrarDisponibilidadCaribe
        'paquetes' => $paquetes,
        'destinosBrasil' => json_encode($this->dispo_consultarDestinosBrasilAPI()),
         ]);
    } else {
        $userId = $request->query('comercioAdherido') ?? 1;
        $user = User::find($userId);
        if (!$user) {
            $userId = 1;
        }
        $cookie = cookie('comercioAdherido', $userId, 60 * 24 * 30 * 12);
        $cliente = auth()->guard('client')->user();
        if ($cliente && $cliente->fk_users_id === null) {
            $cliente->fk_users_id = $userId;
            try {
                $cliente->save();
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        return view('productos.conoce_america.brasil', [
        'productos' => $productos, // Usa la misma variable que en mostrarDisponibilidadCaribe
        'paquetes' => $paquetes,
        'destinosBrasil' => json_encode($this->dispo_consultarDestinosBrasilAPI()),
         ]);        
    }
}
private function dispo_consultarDestinosBrasilAPI()
{
    $url = "https://admin.ola.com.ar/wsola/endpoint.php";
    $requestXml = <<<XML
    <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
                       xmlns:xsd="http://www.w3.org/2001/XMLSchema"
                       xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                       xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/"
                       xmlns:tns="https://admin.ola.com.ar/wsola/endpoint.php"
                       SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
        <SOAP-ENV:Body>
            <tns:GetPackagesFaresDestinations xmlns:tns="https://admin.ola.com.ar/wsola/endpoint.php">
                <Request xsi:type="xsd:string">
                    <![CDATA[
                        <GetPackagesFaresDestinationsRequest>
                            <GeneralParameters>
                                <Username>argtravels</Username>
                                <Password>uNKx4YW59i6rWye</Password>
                                <CustomerIp>181.165.55.94</CustomerIp>
                            </GeneralParameters>
                            <Outlet>1</Outlet>
                            <PackageType>ALL</PackageType>
                        </GetPackagesFaresDestinationsRequest>
                    ]]>
                </Request>
            </tns:GetPackagesFaresDestinations>
        </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>
    XML;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: text/xml; charset=ISO-8859-1",
        "SOAPAction: \"https://admin.ola.com.ar/wsola/endpoint.php#GetPackagesFaresDestinations\"",
        "Content-Length: " . strlen($requestXml)
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXml);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        return []; // Si hay error, retornar array vacío
    } else {
        curl_close($ch);
        return $this->dispo_parsearDestinosBrasil($response);

      return $destinos;
    }
}
 private function dispo_parsearDestinosBrasil($response)
{    
     $destinos = [];
    // Convertir la respuesta a UTF-8
    $response = mb_convert_encoding($response, 'UTF-8', 'ISO-8859-1');
    // Manejar errores de XML al cargar
    libxml_use_internal_errors(true);
    $xml = simplexml_load_string($response);

    if ($xml === false) {
        // Registrar errores de carga de XML
        foreach (libxml_get_errors() as $error) {
            error_log("XML Error: {$error->message}");
        }
        libxml_clear_errors();
        dd("Error al procesar el XML. Verifica la respuesta: ", $response); // Inspecciona la respuesta
    }

    // Extraer la sección 'Response'
    $responseNodes = $xml->xpath('//*[local-name()="Response"]');
    if (empty($responseNodes)) {
        error_log("No se encontró el nodo 'Response' en el XML proporcionado.");
        dd("XML recibido no contiene el nodo 'Response': ", $response); // Verifica si está el nodo
    }

    // Asignar el XML interno
    $internalXmlString = (string) $responseNodes[0];
    $internalXml = simplexml_load_string($internalXmlString);

    if ($internalXml === false) {
        foreach (libxml_get_errors() as $error) {
            error_log("XML Internal Error: {$error->message}");
        }
        libxml_clear_errors();
        dd("Error al procesar el XML interno: ", $internalXmlString);
    }

    // Procesar las zonas y países
    foreach ($internalXml->xpath('//Zone') as $zone) {
        // Filtrar solo la región 'CARIBE Y CENTROAMERICA'
        if ((string)$zone->Name === 'LATINOAMERICA') {
            foreach ($zone->Countries->Country as $country) {
                $nombrePais = (string) $country->Name;
                $codigoPais = (string) $country->Code;

                if (!isset($destinos[$codigoPais])) {
                    $destinos[$codigoPais] = [
                        'nombre_pais' => $nombrePais,
                        'zona' => 'BRASIL',
                        'ciudades' => []
                    ];
                }

                foreach ($country->Cities->City as $city) {
                    $destinos[$codigoPais]['ciudades'][] = [
                        'codigo_ciudad' => (string) $city->Code,
                        'nombre_ciudad' => (string) $city->Name
                    ];
                }
            }
        }
    }

    return $destinos;
} 
public function consultarPaquetesBrasil(Request $request)
{
    // Recibir los datos del formulario
    $pais = $request->input('pais');
    $destino = $request->input('destino');
    $fechaInicio = $request->input('fecha_inicio');
    $fechaFin = $request->input('fecha_fin');
    
    // URL del endpoint
    $url = "https://admin.ola.com.ar/wsola/endpoint.php";

    // Generar el XML de la solicitud
    $requestXml = <<<XML
    <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
        <SOAP-ENV:Body>
            <GetPackagesFares>
                <Request><![CDATA[
                    <GetPackagesFaresRequest>
                        <GeneralParameters>
                            <Username>argtravels</Username>
                            <Password>uNKx4YW59i6rWye</Password>
                            <CustomerIp>181.165.55.94</CustomerIp>
                        </GeneralParameters>
                        <DepartureDate>
                            <From>{$fechaInicio}</From>
                            <To>{$fechaFin}</To>
                        </DepartureDate>
                        <Rooms>
                            <Room>
                                <Passenger Type="ADL"/>
                                <Passenger Type="ADL"/>
                            </Room>
                        </Rooms>
                        <ArrivalDestination>{$destino}</ArrivalDestination>
                        <FareCurrency>USD</FareCurrency>
                        <Outlet>1</Outlet>
                        <PackageType>ALL</PackageType>
                    </GetPackagesFaresRequest>
                ]]></Request>
            </GetPackagesFares>
        </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>
    XML;

    // Configurar cURL para enviar la solicitud
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: text/xml; charset=ISO-8859-1",
        "SOAPAction: \"GetPackagesFares\"",
        "Content-Length: " . strlen($requestXml)
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXml);

    // Obtener la respuesta
    $response = curl_exec($ch);
    curl_close($ch);

    if (curl_errno($ch)) {
        return response()->json(['error' => curl_error($ch)]);
    }

    // Procesar la respuesta XML y obtener los paquetes
    $paquetes = $this->parsearPaquetesXMLBrasil($response);

    // Obtener productos personales
    $productos = Producto::where('ubicacion', 'Brasil')->get();

    // Pasar los paquetes y productos a la vista
    return view('productos.conoce_america.brasil', [
        'productos' => $productos, // Incluye los productos personales
        'paquetes' => $paquetes,
        'destinosBrasil' => json_encode($this->dispo_consultarDestinosBrasilAPI())
    ]);
}
private function parsearPaquetesXMLBrasil($response)
{
    $paquetes = [];
     
    $xml = simplexml_load_string($response);
    $internalXmlString = (string) $xml->xpath('//*[local-name()="Response"]')[0];
    $internalXml = simplexml_load_string($internalXmlString);
    $paqueteCodigos = [];

    foreach ($internalXml->xpath('//PackageFare') as $packageFare) {
        $codigoPaquete = (string) $packageFare->FareCodes->PackageCode;
        $configurationNumber = (string) $packageFare->FareCodes->ConfigurationNumber;
        $uniqueIdentifier = $codigoPaquete . '-' . $configurationNumber;

        if (!in_array($uniqueIdentifier, $paqueteCodigos)) {
            // Extraer las imágenes del paquete
            $imagenes = $this->obtenerImagenes($packageFare->Package->Pictures->Picture);

            // Calcular el precio final del paquete
            $precioNeto = (float) $packageFare->FareTotal->Net;
            $iva = (float) $packageFare->FareTotal->Vat;
            $impuesto = (float) $packageFare->FareTotal->Tax;
            $precioFinal = $precioNeto + $iva + $impuesto;

            // Extraer los hoteles y sus precios
            $hoteles = [];
            foreach ($packageFare->Descriptions->Description as $descripcion) {
                if ((string)$descripcion->Type === 'HOTEL') {
                    $nombreHotel = (string)$descripcion->Name;
                    $precioHotel = 0;
                    
                    // Buscar el precio correspondiente en FareComponent
                    foreach ($packageFare->xpath('.//FareComponent') as $fareComponent) {
                        if ((string)$fareComponent->Type === 'HOTEL' && (string)$fareComponent->Name === $nombreHotel) {
                            $netoHotel = (float) $fareComponent->Total->Net;
                            $ivaHotel = (float) $fareComponent->Total->Vat;
                            $impuestoHotel = (float) $fareComponent->Total->Tax;
                            $precioHotel = $netoHotel + $ivaHotel + $impuestoHotel;
                            break;
                        }
                    }

                    $hoteles[] = [
                        'nombre' => $nombreHotel,
                        'precio' => $precioHotel,
                        'imagenes' => $this->obtenerImagenes($descripcion->Pictures->Picture)
                    ];
                }
            }

            // Extraer país del destino
            $arrivalCountryCode = (string) $packageFare->xpath('.//Trip/ArrivalCountry/@Iata')[0] ?? null;
            $arrivalCountryName = (string) $packageFare->xpath('.//Trip/ArrivalCountry')[0] ?? null;
            // Extraer nombre ciudad
            $departureCityName = (string) $packageFare->xpath('.//Trip/DepartureCity')[0] ?? null;
            // Crear el array del paquete con los detalles de hoteles
            $paquetes[] = [
                'titulo' => (string) $packageFare->Package->Name,
                'codigo_paquete' => $codigoPaquete,
                'precio' => $precioFinal, // Usar precio final aquí
                'moneda' => (string) $packageFare->FareTotal->Currency,
                'notas' => $this->obtenerNotas($packageFare->FareNotes->FareNote),
                'imagenes' => $imagenes,
                'fecha_salida' => (string) $packageFare->Flight->Trips->Trip->DepartureDate,
                'incluye_aereo' => isset($packageFare->Flight),
                'noches' => (string) $packageFare->Package->Nights,
                'hoteles' => $hoteles,
                'nombre_pais' => $arrivalCountryName,
                'ciudad_origen_nombre' => $departureCityName // Añadir detalles de los hoteles
            ];

            $paqueteCodigos[] = $uniqueIdentifier;
        }
    }
    return $paquetes;
}
    

    

     
    public function cookie_europa(Request $request)
    {
        //$productos = Producto::all();
       // $productos = Producto::where('pais_destino', 'Argentina')->get();
        $productos = Producto::with(['hotel', 'service', 'itinerario','destinos'])->get();
        if ($request->hasCookie('comercioAdherido')) {
            $userId = $request->cookie('comercioAdherido');
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            /*  $elim_cookie = 'promotorOficialVerificado';
             setcookie($elim_cookie, '', time() - 3600, '/');
             dd('se elimino la cookie: ', $userId);*/
            return view('productos.conoce_europa.europa', compact('productos'));
        } else {
            $userId = $request->query('comercioAdherido') ?? 1;
            $user = User::find($userId);
            if (!$user) {
                $userId = 1;
            }
            $cookie = cookie('comercioAdherido', $userId, 60 * 24 * 30 * 12);
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            return response()
                ->view('productos.conoce_europa.europa', compact('productos'))
                ->withCookie($cookie);
        }
    }

   public function cookie_porElMundo(Request $request)
    {
        //$productos = Producto::all();
       // $productos = Producto::where('pais_destino', 'Argentina')->get();
        $productos = Producto::with(['hotel', 'service', 'itinerario','destinos'])->get();
        if ($request->hasCookie('comercioAdherido')) {
            $userId = $request->cookie('comercioAdherido');
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            /*  $elim_cookie = 'promotorOficialVerificado';
             setcookie($elim_cookie, '', time() - 3600, '/');
             dd('se elimino la cookie: ', $userId);*/
            return view('productos.mundo.por-el-mundo', compact('productos'));
        } else {
            $userId = $request->query('comercioAdherido') ?? 1;
            $user = User::find($userId);
            if (!$user) {
                $userId = 1;
            }
            $cookie = cookie('comercioAdherido', $userId, 60 * 24 * 30 * 12);
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            return response()
                ->view('productos.mundo.por-el-mundo', compact('productos'))
                ->withCookie($cookie);
        }
    }

    public function cookie_vuelos(Request $request)
    {       
        $productos = Producto::with(['hotel', 'service', 'itinerario','destinos'])->get();
        if ($request->hasCookie('comercioAdherido')) {
            $userId = $request->cookie('comercioAdherido');
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            /*  $elim_cookie = 'promotorOficialVerificado';
             setcookie($elim_cookie, '', time() - 3600, '/');
             dd('se elimino la cookie: ', $userId);*/
            return view('productos.aereos.aereos', compact('productos'));
        } else {
            $userId = $request->query('comercioAdherido') ?? 1;
            $user = User::find($userId);
            if (!$user) {
                $userId = 1;
            }
            $cookie = cookie('comercioAdherido', $userId, 60 * 24 * 30 * 12);
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            return response()
                ->view('productos.aereos.aereos', compact('productos'))
                ->withCookie($cookie);
        }
    }   
    public function cookie_cruceros(Request $request)
    {       
       $productos = ProductoCrucero::with('naviera')->get();
            
        if ($request->hasCookie('comercioAdherido')) {
            $userId = $request->cookie('comercioAdherido');
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            /*  $elim_cookie = 'promotorOficialVerificado';
             setcookie($elim_cookie, '', time() - 3600, '/');
             dd('se elimino la cookie: ', $userId);*/
            return view('productos.cruceros.cruceros', compact('productos'));
        } else {
            $userId = $request->query('comercioAdherido') ?? 1;
            $user = User::find($userId);
            if (!$user) {
                $userId = 1;
            }
            $cookie = cookie('comercioAdherido', $userId, 60 * 24 * 30 * 12);
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) { 
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            return response()
                ->view('productos.cruceros.cruceros', compact('productos'))
                ->withCookie($cookie);
        }
    }
    }