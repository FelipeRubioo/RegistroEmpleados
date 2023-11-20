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


<body onload="probarFuncion()">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <!-- Form de datos generales  -->

    <h3>Datos generales:</h3>
    <form id="formDatosGenerales" action="RegistroEmpleado.php" method="post" enctype="multipart/form-data">
        <label for="apellidoPaterno">Apellido Paterno:</label>
        <input type="text" id="apellidoPaterno" name="apellidoPaterno" pattern="[A-Za-z ]+" title="Escriba un apellido valido, solo letras" maxlength="20" required>

        <label for="apellidoMaterno">Apellido Materno:</label>
        <input type="text" id="apellidoMaterno" name="apellidoMaterno" pattern="[A-Za-z ]+" title="Escriba un apellido valido, solo letras" maxlength="20" required>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" pattern="[A-Za-z ]+" title="Escriba un nombre valido, solo letras" maxlength="30" required>

        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" required>
            <?php
            crearSelect("sexo");
            ?>
        </select>

        <label for="fechaNacimiento">Fecha de nacimiento:</label>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento" required>

        <label for="fotografia">Seleccione una fotografia:</label>
        <input type="file" name="fotografia" id="fotografia" accept="image/*" onchange="mostrarPreviewPonerDefault()">
        <img id="preview" src="#" style="display:none; max-width: 300px; max-height: 300px;">




        <!-- Form de datos adicionales -->

        <h3>Datos adicionales:</h3>
    
        <label for="curp">CURP:</label>
        <input type="text" id="curp" name="curp" maxlength="18" required>

        <label for="RFC">RFC:</label>
        <input type="text" id="rfc" name="rfc" maxlength="13" required>
        <span class="help-text">13 caracteres</span>

        <label for="estadoCivil">Estado civil:</label>
        <select name="estadoCivil" id="estadoCivil" required>
            <?php
            crearSelect("estadoCivil");
            ?>
        </select>

        <label for="tipoSangre">Tipo de sangre:</label>
        <select name="tipoSangre" id="tipoSangre" required>
            <?php
            crearSelect("tipoSangre");
            ?>
        </select>

        <label for="estatura">Estatura:</label>
        <input type="number" id="estatura" name="estatura" step="0.01" min="1.40" max="2.30" required>

        <label for="peso">Peso:</label>
        <input type="number" id="peso" name="peso" step="0.01" min="40" max="150" required>

        <label for="complexion">Complexion:</label>
        <select name="complexion" id="complexion" required>
            <?php
            crearSelect("complexion");
            ?>
        </select>

        <label for="discapacidad">Discapacidad:</label>
        <select name="discapacidad" id="discapacidad" required>
            <?php
            crearSelect("discapacidad");
            ?>
        </select>

        <!-- Domicilio -->

        <h3>Domicilio:</h3>

        <label for="pais">País:</label>
        <select name="pais" id="pais" required>
            <?php
            crearSelect("pais");
            ?>
        </select>

        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <?php
            crearSelect("estado");
            ?>
        </select>

        <label for="municipio">Municipio:</label>
        <select name="municipio" id="municipio" required>
            <?php
            crearSelect("municipio");
            ?>
        </select>

        <label for="localidad">Localidad:</label>
        <select name="localidad" id="localidad" required>
            <?php
            crearSelect("localidad");
            ?>
        </select>

        <label for="colonia">Colonia:</label>
        <select name="colonia" id="colonia" required>
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
        <input type="text" id="nombreVialidad" name="nombreVialidad" maxlength="30" required>

        <label for="numeroExterior">Numero exterior:</label>
        <input type="number" id="numeroExterior" name="numeroExterior" minlength="1" maxlength="6" required>

        <label for="numeroInterior">Numero interior:</label>
        <input type="number" id="numeroInterior" name="numeroInterior" minlength="5" maxlength="10">

        <!-- Estudios -->

        <h3>Estudios:</h3>

        <div id="studies-container">
            <!-- aqui se agregan o quitan estudios -->
        </div>

        <button type="button" id="add-study-btn" onclick="agregarEstudio()">Agregar Estudio</button>

        <input id="submitDatosGenerales" type="submit" style="display: none;">
    </form>

    <button onclick="probarFuncion()">Probar funcion</button>

    <script>
        var studyCount = 0;

        function agregarEstudio() {
            var container = document.getElementById('studies-container');
            var newStudyDiv = document.createElement('div');
            newStudyDiv.innerHTML = `
            <div class="study-container">
                <label for="escuela">Escuela:</label>
                <input type="text" name="escuela" maxlength="30" required>

                <label for="gradoDeEstudios">Grado de estudios:</label>
                <select name="gradoDeEstudios" id="gradoDeEstudios" required>
                        <?php
                        crearSelect("gradoDeEstudios");
                        ?>
                        </select>

                <label for="fechaInicio">Fecha de inicio:</label>
                <input type="date" name="fechaInicio" required>

                <label for="fechaFin">Fecha de Fin:</label>
                <input type="date" name="fechaFin" required>

                <button onclick="quitarEstudio(this)">Eliminar Estudio</button>

            </div>
        `;
            //Cambiar el ID del nuevo div para que sea unico
            studyCount++;
            var studyID = 'studyContainer' + studyCount;
            newStudyDiv.id = studyID;

            container.appendChild(newStudyDiv);
        }

        function quitarEstudio(boton) {
            var container = document.getElementById('studies-container');
            var studyDiv = boton.parentNode.parentNode.id;

            var studyDiv = document.getElementById(studyDiv);

            //se elimina el div con su contenido 
            container.removeChild(studyDiv);

        }
    </script>



    <button id="botonGuardar" name="botonGuardar" onclick="subirForm()"> guardar </button>

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

        function subirForm() {
            document.getElementById("submitDatosGenerales").click();
        }
    </script>

    <script>
        function probarFuncion() {
            // obtiene el url actual
            var currentUrl = window.location.href;
            // obtiene el numero de empleado del url, asumiendo que es el ultimo elemento del url
            var matches = currentUrl.match(/\/(\d+)$/);
            //si hay un numero al final de la URL se hace el redirect
            if (matches) {
                var number = matches[1];
                
                // se crea el nuevo url (con el numero de empleado al final)
                var newUrl = 'http://localhost/ConsultarEmpleado.php?variable=' + number;
                // redirecciona al nuevo url
                window.location.replace(newUrl);
            }
        }
    </script>
    <?php
    //obtener datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        //Datos generales
        if (isset($_POST["apellidoPaterno"])) {
            $apellidoPaterno = $_POST["apellidoPaterno"];
            $apellidoMaterno = $_POST["apellidoMaterno"];
            $nombre = $_POST["nombre"];
            $sexo = $_POST["sexo"];
            $fechaNacimiento = $_POST["fechaNacimiento"];
            $fotografia = $_FILES["fotografia"];

            //Datos adicionales
            $curp = $_POST["curp"];
            $rfc = $_POST["rfc"];
            $estadoCivil = $_POST["estadoCivil"];
            $tipoSangre = $_POST["tipoSangre"];
            $estatura = $_POST["estatura"];
            $peso = $_POST["peso"];
            $complexion = $_POST["complexion"];
            $discapacidad = $_POST["discapacidad"];


            //Domicilio
            
            $pais = $_POST["pais"];
            $estado = $_POST["estado"];
            $municipio = $_POST["municipio"];
            $localidad = $_POST["localidad"];
            $colonia = $_POST["colonia"];
            $codigoPostal = $_POST["codigoPostal"];
            $tipoVialidad = $_POST["tipoVialidad"];
            $nombreVialidad = $_POST["nombreVialidad"];
            $numeroExterior = $_POST["numeroExterior"];
            $numeroInterior = $_POST["numeroInterior"];

            //estudios
            
            $escuela = $_POST["escuela"];
            $gradoDeEstudios = $_POST["gradoDeEstudios"];
            $fechaInicio = $_POST["fechaInicio"];
            $fechaFin = $_POST["fechaFin"];

            $numeroEmpleado = generaNumeroEmpleado();
            guardarEmpleadoData($apellidoPaterno, $apellidoMaterno, $nombre, $sexo, $fechaNacimiento, $fotografia, $numeroEmpleado , $curp, $rfc, $estadoCivil, $tipoSangre, $estatura, $peso, $complexion , $discapacidad, $pais, $estado, $municipio, $localidad, $colonia, $codigoPostal, $tipoVialidad, $nombreVialidad, $numeroExterior, $numeroInterior, $escuela, $gradoDeEstudios, $fechaInicio, $fechaFin);
        }
    }

    

    
    ?>

</body>

<footer>

</footer>

</html>