<?php

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

function guardarEmpleadoData($apellidoPaterno, $apellidoMaterno, $nombre, $sexo, $fechaNacimiento, $numeroEmpleado)
{

    //almacenar datos en un arreglo
    $empleado = array(
        'apellidoPaterno' => $apellidoPaterno,
        'apellidoMaterno' => $apellidoMaterno,
        'nombre' => $nombre,
        'sexo' => $sexo,
        'fechaNacimento' => $fechaNacimiento,
        'numeroEmpleado' => $numeroEmpleado
    );

    //solo se guarda un archivo si se llenaron todos los campos del formulario
    if ($empleado['apellidoPaterno'] != null ) {
        //guardar arreglo en formato JSON
        $jsonEmpleado = json_encode($empleado);

        //guardar archivo en carpeta
        $rutaArchivo = 'C:/xampp/htdocs/EjercicioReclutamiento/EmpleadoData/' . $numeroEmpleado . '.json';
        file_put_contents($rutaArchivo, $jsonEmpleado);
    }
}
