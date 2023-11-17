<html>

<head>


    <link rel="stylesheet" href="estilo.css" type="text/css">
    <title>Registro de empleados</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>


<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <!-- Form de datos generales  -->
    <form action="RegistroEmpleado.php" method="post">
        <label for="apellidoPaterno">Apellido Paterno:</label>
        <input type="text" id="apellidoPaterno" name="apellidoPaterno">

        <label for="apellidoMaterno">Apellido Materno:</label>
        <input type="text" id="apellidoMaterno" name="apellidoMaterno">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">

        <label for="sexo">Sexo:</label>
        <input type="text" id="sexo" name="sexo">

        <label for="fechaNacimiento">Fecha de nacimiento:</label>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento">

    
        <!-- fotografia -->

        <input type="submit">


    </form>

    <?php
    //obtener datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $apellidoPaterno = $_POST["apellidoPaterno"];
        $apellidoMaterno = $_POST["apellidoMaterno"];
        $nombre = $_POST["nombre"];
        $sexo = $_POST["sexo"];
        $fechaNacimiento = $_POST["fechaNacimiento"];
        //$numeroEmpleado = $_POST["numeroEmpleado"];
    }

    //itera por todos los archivos de EmpleadoData, el numero del nuevo Empleado es el siguiente numero
    $directorio = 'C:/xampp/htdocs/EjercicioReclutamiento/EmpleadoData';
    $archivos = scandir($directorio);
    
    //elimina el directorio actual y el padre del conteo
    $archivos = array_diff($archivos, ['.', '..']);
    $numeroArchivos = count($archivos);
    echo "numero de archivos: $numeroArchivos";

    for ($i=1; $i <= $numeroArchivos + 1; $i++) { 
        $existeArchivo = file_exists('C:/xampp/htdocs/EjercicioReclutamiento/EmpleadoData/'.$i.'.json');
        if ($existeArchivo == false){
            $numeroEmpleado = $i;
        }
    }
    
    //almacenar datos en un arreglo
    $empleado = array(
        'apellidoPaterno' => $apellidoPaterno,
        'apellidoMaterno' => $apellidoMaterno,
        'nombre' => $nombre,
        'sexo' => $sexo,
        'fechaNacimento' => $fechaNacimiento,
        'numeroEmpleado' => $numeroEmpleado
    );


    if ($empleado['apellidoPaterno'] != null ) {
        //guardar arreglo en formtato JSON
        $jsonEmpleado = json_encode($empleado);

        //guardar archivo en carpeta
        $rutaArchivo = 'C:/xampp/htdocs/EjercicioReclutamiento/EmpleadoData/' . $numeroEmpleado . '.json';
        file_put_contents($rutaArchivo, $jsonEmpleado);
    }




    //obtener carpeta
    $archivoJson = file_get_contents($rutaArchivo);

    //leer archivo JSON
    $datosEmpleado = json_decode($archivoJson);

    $apellidoPaternoJSON = $datosEmpleado->apellidoPaterno;


    /*echo "apellido paterno: $apellidoPaternoJSON <br>";
    echo "apellido materno: $apellidoMaternojSON <br>";
    echo "nombre: $nombreJSON <br>";
    echo "fechaNacimiento: $fechaNacimientoJSON <br>";
    echo "numeroEmpleado: $numeroEmpleadoJSON <br>";
*/

    ?>


</body>


<footer>



</footer>

</html>