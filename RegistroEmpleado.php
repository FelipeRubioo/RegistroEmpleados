<html>

<head>

    <?php include 'funciones.php';
    include 'Catalogo.php';
    $catalogo = new Catalogo();
    ?>
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
    <form action="RegistroEmpleado.php" method="post" enctype="multipart/form-data">
        <label for="apellidoPaterno">Apellido Paterno:</label>
        <input type="text" id="apellidoPaterno" name="apellidoPaterno">

        <label for="apellidoMaterno">Apellido Materno:</label>
        <input type="text" id="apellidoMaterno" name="apellidoMaterno">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">

        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo">
            <?php
            //sexos es un arreglo que contiene tres arreglos
            $sexos = $catalogo->GetCatSexo();
            //para cada arreglo (0, 1 y 2) se obtiene la descripcion 
            foreach ($sexos as $sexo) {
                $nombreSexo = $sexo['Descripcion'];
                //el valor de la descripcion se pone como opcion del select
                echo "<option value=\"$nombreSexo\">$nombreSexo</option>";
            }
            ?>
        </select>

        <label for="fechaNacimiento">Fecha de nacimiento:</label>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento">

        <label for="fotografia">Seleccione una fotografia:</label>
        <input type="file" name="fotografia" id="fotografia" accept="image/*" onchange="mostrarPreview()">
        <img id="preview" src="#" style="display:none; max-width: 300px; max-height: 300px;">
        <input type="submit">


    </form>

    <script>
        function mostrarPreview() {
            var fotografia = document.getElementById('fotografia');
            var preview = document.getElementById('preview');

            // Ensure that a file is selected
            if (fotografia.files && fotografia.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(fotografia.files[0]);
            }
        }
    </script>

    <?php
    //obtener datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $apellidoPaterno = $_POST["apellidoPaterno"];
        $apellidoMaterno = $_POST["apellidoMaterno"];
        $nombre = $_POST["nombre"];
        $sexo = $_POST["sexo"];
        $fechaNacimiento = $_POST["fechaNacimiento"];
        $fotografia = $_FILES["fotografia"];
    }

    $numeroEmpleado = generaNumeroEmpleado();
    guardarEmpleadoData($apellidoPaterno, $apellidoMaterno, $nombre, $sexo, $fechaNacimiento, $fotografia, $numeroEmpleado);





    //obtener carpeta
    $archivoJson = file_get_contents($rutaArchivo);

    //leer archivo JSON
    $datosEmpleado = json_decode($archivoJson);

    $apellidoPaternoJSON = $datosEmpleado->apellidoPaterno;



    $catalogo->GetCatSexo();
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