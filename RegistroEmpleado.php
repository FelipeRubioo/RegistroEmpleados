<html>

<head>

    <?php include 'funciones.php';

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
    <div>
        <h3>Datos generales:</h3>
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
                crearSelect("sexo");
                ?>
            </select>

            <label for="fechaNacimiento">Fecha de nacimiento:</label>
            <input type="date" id="fechaNacimiento" name="fechaNacimiento">

            <label for="fotografia">Seleccione una fotografia:</label>
            <input type="file" name="fotografia" id="fotografia" accept="image/*" onchange="mostrarPreviewPonerDefault()">
            <img id="preview" src="#" style="display:none; max-width: 300px; max-height: 300px;">
            <input type="submit">

        </form>
    </div>

    <!-- Form de datos adicionales -->
    <div>
        <h3>Datos adicionales:</h3>
        <form action="RegistroEmpleado.php" method="post">
            <label for="curp">CURP:</label>
            <input type="text" id="curp" name="curp">

            <label for="RFC">RFC:</label>
            <input type="text" id="RFC" name="RFC">
            <span class="help-text">13 caracteres</span>

            <label for="estadoCivil">Estado civil:</label>
            <select name="estadoCivil" id="estadoCivil">

                <?php
                crearSelect("estadoCivil");
                ?>
            </select>

            <label for="tipoSangre">Tipo de sangre:</label>
            <select name="tipoSangre" id="tipoSangre">
                <?php
                crearSelect("tipoSangre");
                ?>
            </select>

            <label for="estatura">Estatura:</label>
            <input type="number" id="estatura" name="estatura" step="0.01" min="1.40" max="2.30" required>

            <label for="peso">Peso:</label>
            <input type="number" id="peso" name="peso" step="0.01" min="40" max="150" required>

            <label for="complexion">Complexion:</label>
            <select name="complexion" id="complexion">
                <?php
                crearSelect("complexion");
                ?>
            </select>

            <label for="discapacidad">Discapacidad:</label>
            <select name="discapacidad" id="discapacidad">
                <?php
                crearSelect("discapacidad");
                ?>
            </select>

            <input type="submit">

        </form>




    </div>

    <!-- Domicilio -->
    <div>
        <h3>Domicilio:</h3>
        <form action="RegistroEmpleado.php" method="post"></form>

        <label for="pais">País:</label>
        <select name="pais" id="pais">
            <?php
            crearSelect("pais");
            ?>
        </select>

        <label for="estado">Estado:</label>
        <select name="estado" id="estado">
            <?php
            crearSelect("estado");
            ?>
        </select>

        <label for="municipio">Municipio:</label>
        <select name="municipio" id="municipio">
            <?php
            crearSelect("municipio");
            ?>
        </select>

        <label for="localidad">Localidad:</label>
        <select name="localidad" id="localidad">
            <?php
            crearSelect("localidad");
            ?>
        </select>

        <label for="colonia">Colonia:</label>
        <select name="colonia" id="colonia">
            <?php
            crearSelect("colonia");
            ?>
        </select>

        <label for="codigoPostal">Codigo postal:</label>
        <input type="number" id="codigoPostal" name="codigoPostal" minlength="5" maxlength="10" required>

        <label for="tipoVialidad">Tipo de vialidad:</label>
        <select name="tipoVialidad" id="tipoVialidad">
            <?php
            crearSelect("tipoVialidad");
            ?>
        </select>

        <label for="nombreVialidad">Nombre de vialidad:</label>
        <input type="text" id="nombreVialidad" name="nombreVialidad" required>

        <label for="numeroExterior">Numero exterior:</label>
        <input type="number" id="numeroExterior" name="numeroExterior" minlength="1" maxlength="6" required>

        <label for="numeroInterior">Numero interior:</label>
        <input type="number" id="numeroInterior" name="numeroInterior" minlength="5" maxlength="10">
    </div>

     <!-- Estudios -->

    <script>
        function mostrarPreviewPonerDefault() {
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
            } else {
                fotografia.src = '"C:/xampp/htdocs/EjercicioReclutamiento/img/silueta.png"';

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

        // revisarFotografia($fotografia);

        //   if(strlen($fotografia["tmp_name"]) == 0){
        //       $fotografia["name"] = "silueta.png";
        //   }
    }

    $numeroEmpleado = generaNumeroEmpleado();
    guardarEmpleadoData($apellidoPaterno, $apellidoMaterno, $nombre, $sexo, $fechaNacimiento, $fotografia, $numeroEmpleado);





    //obtener carpeta
    //  $archivoJson = file_get_contents($rutaArchivo);

    //leer archivo JSON
    //  $datosEmpleado = json_decode($archivoJson);

    // $apellidoPaternoJSON = $datosEmpleado->apellidoPaterno;

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