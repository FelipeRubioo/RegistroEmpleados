<?php
include 'Catalogo.php';
$catalogo = new Catalogo();
function getNumeroArchivos()
{

    //itera por todos los archivos de EmpleadoData, el numero del nuevo Empleado es el siguiente numero
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

    for ($i = 1; $i <= $numeroArchivos + 1; $i++) {
        $existeArchivo = file_exists('C:/xampp/htdocs/EjercicioReclutamiento/EmpleadoData/' . $i . '.json');
        if ($existeArchivo == false) {
            $numeroEmpleado = $i;
        }
    }

    return $numeroEmpleado;
}

function guardarEmpleadoData($apellidoPaterno, $apellidoMaterno, $nombre, $sexo, $fechaNacimiento, $fotografia, $numeroEmpleado)
{

    //almacenar datos en un arreglo
    $empleado = array(
        'apellidoPaterno' => $apellidoPaterno,
        'apellidoMaterno' => $apellidoMaterno,
        'nombre' => $nombre,
        'sexo' => $sexo,
        'fechaNacimento' => $fechaNacimiento,
        'fotografia'=> $fotografia,  
        'numeroEmpleado' => $numeroEmpleado
    );

    //solo se guarda un archivo si se llenaron todos los campos del formulario
    if ($empleado['apellidoPaterno'] != null ) {
        //guardar arreglo en formato JSON
        $jsonEmpleado = json_encode($empleado);

        //guardar archivo en carpeta
        $rutaArchivoData = 'C:/xampp/htdocs/EjercicioReclutamiento/EmpleadoData/' . $numeroEmpleado . '.json';
        file_put_contents($rutaArchivoData, $jsonEmpleado);

        //guardar imagen en img
        $rutaArchivoImg = 'C:/xampp/htdocs/EjercicioReclutamiento/img/'. $numeroEmpleado.'.png';
        move_uploaded_file($fotografia, $rutaArchivoImg);
    }
}

//si no se selecciono una fotografia, se pone silueta.png como default
function revisarFotografia($fotografia){

    //si no se tiene una imagen guardada por el post, se le dan los valores de silueta.png
    if(strlen($fotografia["tmp_name"]) == 0){
        echo "se entro en revisarFotografia()";
        $fotografia["name"] = "silueta.png";
       // $fotografia["full_path"] = "silueta.png";
      //  $fotografia["type"] = "image\/png";
      //  $fotografia["tmp_name"] = "C:\\xampp\\htdocs\\EjercicioReclutamiento\\img\\silueta.png";
      //  $fotografia["size"] = getimagesize("C:\\xampp\\htdocs\\EjercicioReclutamiento\\img\\silueta.png");
    }
}

function crearSelect($datoABuscar){
    global $catalogo;
    $arreglo = array();

        switch($datoABuscar){
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
        }

        //tenemos un arreglo que contiene arreglos
        foreach ($arreglo as $opciones) {
            $valor = $opciones['Descripcion'];
            echo "<option value=\"$valor\">$valor</option>";
        }

    }
    

    



?>