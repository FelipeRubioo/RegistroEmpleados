<?php
include 'Catalogo.php';

$catalogo = new Catalogo();

function getNumeroArchivos()
{

    //itera por todos los archivos de EmpleadoData, el numero del nuevo Empleado es el primer numero vacio que encuentre
    //si un archivo se elimina, se tomara su lugar
    $directorio = 'C:/xampp/htdocs/EjercicioReclutamiento/EmpleadoData';
    $archivos = scandir($directorio);

    //elimina el directorio actual y el padre del conteo
    $archivos = array_diff($archivos, ['.', '..']);
    $numeroArchivos = count($archivos);

    return $numeroArchivos;
}

function generaNumeroEmpleado()
{

    $numeroArchivos = getNumeroArchivos();
        //itera por todos los archivos existentes en Data, si hay uno disponible lo toma como el nuevo numero de empleado
    for ($i = 1; $i <= $numeroArchivos + 1; $i++) {
        $existeArchivo = file_exists('C:/xampp/htdocs/EjercicioReclutamiento/EmpleadoData/' . $i . '.json');
        if ($existeArchivo == false) {
            $numeroEmpleado = $i;
        }
    }

    return $numeroEmpleado;
}


function crearArregloEmpleado($apellidoPaterno, $apellidoMaterno, $nombre, $sexo, $fechaNacimiento, $fotografia, $numeroEmpleado, $curp, $rfc, $estadoCivil, $tipoSangre, $estatura, $peso, $complexion, $discapacidad, $pais, $estado, $municipio, $localidad, $colonia, $codigoPostal, $tipoVialidad, $nombreVialidad, $numeroExterior, $numeroInterior, $estudios)
{

    //almacenar datos en un arreglo
    $empleado = array(
        'apellidoPaterno' => $apellidoPaterno,
        'apellidoMaterno' => $apellidoMaterno,
        'nombre' => $nombre,
        'sexo' => $sexo,
        'fechaNacimiento' => $fechaNacimiento,
        'fotografia' => $fotografia,
        'numeroEmpleado' => $numeroEmpleado,
        'curp' => $curp,
        'rfc' => $rfc,
        'estadoCivil' => $estadoCivil,
        'tipoSangre' => $tipoSangre,
        'estatura' => $estatura,
        'peso' => $peso,
        'complexion' => $complexion,
        'discapacidad' => $discapacidad,
        'pais' => $pais,
        'estado' => $estado,
        'municipio' => $municipio,
        'localidad' => $localidad,
        'colonia' => $colonia,
        'codigoPostal' => $codigoPostal,
        'tipoVialidad' => $tipoVialidad,
        'nombreVialidad' => $nombreVialidad,
        'numeroExterior' => $numeroExterior,
        'numeroInterior' => $numeroInterior,
        'estudios' => $estudios
    );

    return $empleado;
}


function guardarEmpleadoData($apellidoPaterno, $apellidoMaterno, $nombre, $sexo, $fechaNacimiento, $fotografia, $numeroEmpleado, $curp, $rfc, $estadoCivil, $tipoSangre, $estatura, $peso, $complexion, $discapacidad, $pais, $estado, $municipio, $localidad, $colonia, $codigoPostal, $tipoVialidad, $nombreVialidad, $numeroExterior, $numeroInterior, $estudios)
{

    $empleado = crearArregloEmpleado($apellidoPaterno, $apellidoMaterno, $nombre, $sexo, $fechaNacimiento, $fotografia, $numeroEmpleado, $curp, $rfc, $estadoCivil, $tipoSangre, $estatura, $peso, $complexion, $discapacidad, $pais, $estado, $municipio, $localidad, $colonia, $codigoPostal, $tipoVialidad, $nombreVialidad, $numeroExterior, $numeroInterior, $estudios);

    //solo se guarda un archivo si se llenaron todos los campos del formulario
    if ($apellidoPaterno != null) {
        //guardar arreglo en formato JSON
        $jsonEmpleado = json_encode($empleado);

        //guardar archivo en carpeta
        $rutaArchivoData = 'C:/xampp/htdocs/EjercicioReclutamiento/EmpleadoData/' . $numeroEmpleado . '.json';
        file_put_contents($rutaArchivoData, $jsonEmpleado);

        //guardar imagen en img

        $rutaArchivoImg = 'C:/xampp/htdocs/EjercicioReclutamiento/img/' . $numeroEmpleado . '.jpg';
        $tmpName = $fotografia['tmp_name'];
        if ($tmpName != null) {
            move_uploaded_file($tmpName, $rutaArchivoImg);
        }else{
            $rutaDefault = "C:/xampp/htdocs/EjercicioReclutamiento/img/silueta.png";
            copy($rutaDefault, $rutaArchivoImg);
        }
       
    }
}

function borrarEmpleado($numeroEmpleado)
{   //se toma la ubicacion del archivo datos e imagen del empleado
    $rutaArchivo = 'C:/xampp/htdocs/EjercicioReclutamiento/EmpleadoData/' . $numeroEmpleado . '.json';
    $rutaArchivoImg = 'C:/xampp/htdocs/EjercicioReclutamiento/img/' . $numeroEmpleado . '.jpg';
    // se eliminan ambos archivos del empleado
    if (unlink($rutaArchivo) && unlink($rutaArchivoImg)) {
        echo 'se elimino el empleado.';
    } else {
        echo 'no se puedo eliminar el empleado';
    }
}
function obtenerEmpleado($numeroEmpleado)
{

    $rutaArchivo = 'C:/xampp/htdocs/EjercicioReclutamiento/EmpleadoData/' . $numeroEmpleado . '.json';

    //obtener archivo de datos del empleado
    $archivoJson = file_get_contents($rutaArchivo);

    //leer archivo JSON
    $datosEmpleado = json_decode($archivoJson);

    //obtener datos del archivo
    //Datos generales
    $apellidoPaterno = $datosEmpleado->apellidoPaterno;
    $apellidoMaterno = $datosEmpleado->apellidoMaterno;
    $nombre = $datosEmpleado->nombre;
    $sexo = $datosEmpleado->sexo;
    $fechaNacimiento = $datosEmpleado->fechaNacimiento;
    $fotografia = $datosEmpleado->fotografia;
    $numeroEmpleado = $datosEmpleado->numeroEmpleado;

    //Datos adicionales
    $curp = $datosEmpleado->curp;
    $rfc = $datosEmpleado->rfc;
    $estadoCivil = $datosEmpleado->estadoCivil;
    $tipoSangre = $datosEmpleado->tipoSangre;
    $estatura = $datosEmpleado->estatura;
    $peso = $datosEmpleado->peso;
    $complexion = $datosEmpleado->complexion;
    $discapacidad = $datosEmpleado->discapacidad;

    //Domicilio
    $pais = $datosEmpleado->pais;
    $estado = $datosEmpleado->estado;
    $municipio = $datosEmpleado->municipio;
    $localidad = $datosEmpleado->localidad;
    $colonia = $datosEmpleado->colonia;
    $codigoPostal = $datosEmpleado->codigoPostal;
    $tipoVialidad = $datosEmpleado->tipoVialidad;
    $nombreVialidad = $datosEmpleado->nombreVialidad;
    $numeroExterior = $datosEmpleado->numeroExterior;
    $numeroInterior = $datosEmpleado->numeroInterior;

    //Estudios 
    $estudios = $datosEmpleado->estudios;


    //guardar los datos en un arreglo y regresarlo
    $empleado = crearArregloEmpleado($apellidoPaterno, $apellidoMaterno, $nombre, $sexo, $fechaNacimiento, $fotografia, $numeroEmpleado, $curp, $rfc, $estadoCivil, $tipoSangre, $estatura, $peso, $complexion, $discapacidad, $pais, $estado, $municipio, $localidad, $colonia, $codigoPostal, $tipoVialidad, $nombreVialidad, $numeroExterior, $numeroInterior, $estudios);
    return $empleado;
}


function crearSelect($datoABuscar)
{
    global $catalogo;
    $arreglo = array();
    //dependiendo del dato que indiquemos, se nos devuelve el arreglo que contiene arreglos para ese dato
    switch ($datoABuscar) {
        case 'sexo':
            $arreglo = $catalogo->GetCatSexo();
            break;
        case 'estadoCivil':
            $arreglo = $catalogo->GetCatEstadoCivil();
            break;
        case 'tipoSangre':
            $arreglo = $catalogo->GetCatTipoSangre();
            break;
        case 'complexion':
            $arreglo = $catalogo->GetCatComplexion();
            break;
        case 'discapacidad':
            $arreglo = $catalogo->GetCatDsicapacidad();
            break;
        case 'pais':
            $arreglo = $catalogo->GetCatPais();
            break;
        case 'estado':
            $arreglo = $catalogo->GetCatEstado();
            break;
        case 'municipio':
            $arreglo = $catalogo->GetCatMunicipio();
            break;
        case 'localidad':
            $arreglo = $catalogo->GetCatLocalidad();
            break;
        case 'colonia':
            $arreglo = $catalogo->GetCatColonia();
            break;
        case 'tipoVialidad':
            $arreglo = $catalogo->GetCatVialidad();
            break;
        case 'gradoDeEstudios':
            $arreglo = $catalogo->GetCatGradoEstudio();
            break;
    }

    //tenemos un arreglo que contiene arreglos
    //para cada opcion (0,1,2,3,etc) se tienen sus keys (descripcion, id, etc.), solo ocupamos la de ID para dar valor a los options
    foreach ($arreglo as $opciones) {
        $valor = $opciones['Descripcion'];
        echo "<option value=\"$valor\">$valor</option>";
    }
}

