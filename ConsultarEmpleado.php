<!DOCTYPE html>
<?php include 'funciones.php';

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Empleado</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body onload="activarSelects()">

    <?php
    //obtenemos el numero de empleado, ya sea que el metodo sea GET o POST
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $numeroEmpleado = $_GET['numeroEmpleado'];
    } elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
        $numeroEmpleado = $_POST['numeroEmpleado'];
    }

    $empleado = obtenerEmpleado($numeroEmpleado);
    //estudios es el arreglo que contiene arreglos
    $estudios = $empleado['estudios'];
    ?>


    <h1>Pagina de consulta de empleado</h1>
    <!-- no se puede poner solo el mismo archivo como action ya que desasparece el numero de empleado, hay que agregarlo al URL-->
    <form id="formConsulta" action="ConsultarEmpleado.php" method="post">
        <input value=<?php echo json_encode($numeroEmpleado) ?> type="hidden" id="numeroEmpleado" name="numeroEmpleado">
        <input value=0 type="hidden" id="hiddenBorrarEmpleado" name="hiddenBorrarEmpleado">
        <!-- Datos Generales-->
        <h3>Datos generales:</h3>

        <label for="apellidoPaterno">Apellido Paterno:</label>

        <input value=<?php echo json_encode($empleado['apellidoPaterno']); ?> type="text" id="apellidoPaterno" name="apellidoPaterno" pattern="[A-Za-z]+" title="Escriba un apellido valido, solo letras" maxlength="20" required>

        <label for="apellidoMaterno">Apellido Materno:</label>
        <input value=<?php echo json_encode($empleado['apellidoMaterno']); ?> type="text" id="apellidoMaterno" name="apellidoMaterno" pattern="[A-Za-z]+" title="Escriba un apellido valido, solo letras" maxlength="20" required>

        <label for="nombre">Nombre:</label>
        <input value=<?php echo json_encode($empleado['nombre']); ?> type="text" id="nombre" name="nombre" pattern="[A-Za-z ]+" title="Escriba un nombre valido, solo letras" maxlength="30" required>

        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" required>
            <?php
            crearSelect("sexo");
            ?>
        </select>

        <label for="fechaNacimiento">Fecha de nacimiento:</label>
        <input value=<?php echo json_encode($empleado['fechaNacimiento']); ?> type="date" id="fechaNacimiento" name="fechaNacimiento" required>

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

        <label for="fotografia">Seleccione una fotografia:</label>
        <input type="file" name="fotografia" id="fotografia" accept="image/*" onchange="mostrarPreviewPonerDefault()">
        <img id="preview" src="#" style="display:none; max-width: 300px; max-height: 300px;">
        <?php $source = "C:/xampp/htdocs/EjercicioReclutamiento/img/$numeroEmpleado.jpg" ?>
        <img src=<?php echo $source; ?> alt="Description" width="30px" height="20px">
        <!-- Form de datos adicionales -->
        <h3>Datos adicionales:</h3>

        <label for="curp">CURP:</label>
        <input value=<?php echo json_encode($empleado['curp']); ?> type="text" id="curp" name="curp" minlength="18" maxlength="18" required>

        <label for="RFC">RFC:</label>
        <input value=<?php echo json_encode($empleado['rfc']); ?> type="text" id="rfc" name="rfc" minlength="13" maxlength="13" required>
        <span class="help-text">13 caracteres</span>

        <label for="estadoCivil">Estado civil:</label>
        <select value=<?php echo json_encode($empleado['estadoCivil']); ?> name="estadoCivil" id="estadoCivil" required>
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
        <input value=<?php echo json_encode($empleado['estatura']); ?> type="number" id="estatura" name="estatura" step="0.01" min="1.40" max="2.30" required>

        <label for="peso">Peso:</label>
        <input value=<?php echo json_encode($empleado['peso']); ?> type="number" id="peso" name="peso" step="0.01" min="40" max="150" required>

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
        <input value=<?php echo json_encode($empleado['codigoPostal']); ?> type="number" id="codigoPostal" name="codigoPostal" minlength="5" maxlength="10" required>

        <label for="tipoVialidad">Tipo de vialidad:</label>
        <select name="tipoVialidad" id="tipoVialidad">
            <?php
            crearSelect("tipoVialidad");
            ?>
        </select>

        <label for="nombreVialidad">Nombre de vialidad:</label>
        <input value=<?php echo json_encode($empleado['nombreVialidad']); ?> type="text" id="nombreVialidad" name="nombreVialidad" maxlength="30" required>

        <label for="numeroExterior">Numero exterior:</label>
        <input value=<?php echo json_encode($empleado['numeroExterior']); ?> type="number" id="numeroExterior" name="numeroExterior" minlength="1" maxlength="6" required>

        <label for="numeroInterior">Numero interior:</label>
        <input value=<?php echo json_encode($empleado['numeroInterior']); ?> type="number" id="numeroInterior" name="numeroInterior" minlength="5" maxlength="10">

        <!-- Estudios -->
        <h3>Estudios:</h3>
        <div id="studies-container">

            <!-- aqui se agregan o quitan estudios -->
        </div>
        <input type="hidden" id="studyCount" name="studyCount">
        <script>
            var studyCount = 0;

            function agregarEstudio() {
                var container = document.getElementById('studies-container');
                var newStudyDiv = document.createElement('div');
                newStudyDiv.innerHTML = `
                <div class="study-container">
                <label for="escuela">Escuela:</label>
                <input type="text" id="escuela" name="escuela" maxlength="30">

                <label for="gradoDeEstudios">Grado de estudios:</label>
                <select id="gradoDeEstudios" name="gradoDeEstudios">
                        <?php
                        crearSelect("gradoDeEstudios");
                        ?>
                        </select>

                <label for="fechaInicio">Fecha de inicio:</label>
                <input type="date" id="fechaInicio" name="fechaInicio">

                <label for="fechaFin">Fecha de Fin:</label>
                <input type="date" id="fechaFin" name="fechaFin">

                <button onclick="quitarEstudio(this)">Eliminar Estudio</button>

            </div>
        `;
                //Cambiar el ID del nuevo div para que sea unico
                studyCount++;
                var studyID = 'studyContainer' + studyCount;
                newStudyDiv.id = studyID;
                //se agrega el nuevo div con inputs al codigo 
                container.appendChild(newStudyDiv);
                //cambiar nombre y id de los inputs
                var escuela = document.getElementById('escuela');
                var gradoDeEstudios = document.getElementById('gradoDeEstudios');
                var fechaInicio = document.getElementById('fechaInicio');
                var fechaFin = document.getElementById('fechaFin');

                
                escuela.id = 'escuela' + studyCount;
                escuela.name = 'escuela' + studyCount;
                gradoDeEstudios.id = 'gradoDeEstudios' + studyCount;
                gradoDeEstudios.name = 'gradoDeEstudios' + studyCount;
                fechaInicio.id = 'fechaInicio' + studyCount;
                fechaInicio.name = 'fechaInicio' + studyCount;
                fechaFin.id = 'fechaFin' + studyCount;
                fechaFin.name = 'fechaFin' + studyCount;

                //los inputs se hacen obligatorios una vez se crean
                escuela.setAttribute('required', 'true');
                gradoDeEstudios.setAttribute('required', 'true');
                fechaInicio.setAttribute('required', 'true');
                fechaFin.setAttribute('required', 'true');


                //se actualiza el contador de estudios
                var contadorEstudios = document.getElementById('studyCount');
                contadorEstudios.value = studyCount;

                //la fecha fin no puede ser antes que la de inicio
                //cuando cambia la fecha de inicio, se establece como el maximo de la fecha fin   
                fechaInicio.addEventListener('change', function() {

                    fechaFin.setAttribute('min', this.value);

                })

            }

            function quitarEstudio(boton) {
                studyCount--;
                var container = document.getElementById('studies-container');
                var studyDiv = boton.parentNode.parentNode.id;

                var studyDiv = document.getElementById(studyDiv);

                //se elimina el div con su contenido y se actualiza el contador de estudios
                container.removeChild(studyDiv);
                var contadorEstudios = document.getElementById('studyCount');
                contadorEstudios.value = studyCount;
            }
        </script>

        <?php
        $numeroEstudios = 0;
        //si se tienen tres estudios, $numeroEstudio es 3
        foreach ($estudios as $numeroEstudio) {
            $numeroEstudios++;
            echo "<script>";
            echo  "agregarEstudio();";
            echo '</script>';
            foreach ($numeroEstudio as $dato => $valor) {
                $nombreInput = "$dato$numeroEstudios";
                $valorInput = $valor;

                echo "<script>";
                echo "for (let i = 1; i <= $numeroEstudios ; i++) {";
                //se agregan los valores a los inputs
                echo "let valorInput = '$valorInput';";
                echo "document.getElementById('$nombreInput').value = valorInput;";
                echo "}";
                echo '</script>';
            }
        }
        ?>
        <script>
            //funcion que toma los datos del form y hace el post en esta misma pagina
            function postData() {
                var formConsulta = new FormData(document.getElementById('formConsulta'));

                var xhr = new XMLHttpRequest();
                xhr.open('POST', window.location.href, true);

                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        //document.getElementById('result').innerHTML = xhr.responseText;
                    }
                };

                xhr.send(formConsulta);
            }

            //funcion de cuando se da click al boton de borrar empleado
            function eliminarEmpleado() {
                let hiddenBotonBorrar = document.getElementById('hiddenBorrarEmpleado');
                hiddenBotonBorrar.value = 1;
                postData();
            }
        </script>


        <button type="button" id="add-study-btn" onclick="agregarEstudio()">Agregar Estudio</button>


        <button type="button" id="botonActualizar" name="botonActualizar" onclick="postData()">Guardar</button>


        <button type="button" id="botonBorrar" name="botonBorrar" onclick="eliminarEmpleado()">Eliminar empleado</button>

    </form>


    <script>
        function activarSelects() {
            //seleccionar opcion en distintos selects
            seleccionarOpcion(<?php echo json_encode($empleado['sexo']); ?>, "sexo");
            seleccionarOpcion(<?php echo json_encode($empleado['estadoCivil']); ?>, "estadoCivil");
            seleccionarOpcion(<?php echo json_encode($empleado['tipoSangre']); ?>, "tipoSangre");
            seleccionarOpcion(<?php echo json_encode($empleado['complexion']); ?>, "complexion");
            seleccionarOpcion(<?php echo json_encode($empleado['discapacidad']); ?>, "discapacidad");
            seleccionarOpcion(<?php echo json_encode($empleado['pais']); ?>, "pais");
            seleccionarOpcion(<?php echo json_encode($empleado['estado']); ?>, "estado");
            seleccionarOpcion(<?php echo json_encode($empleado['municipio']); ?>, "municipio");
            seleccionarOpcion(<?php echo json_encode($empleado['localidad']); ?>, "localidad");
            seleccionarOpcion(<?php echo json_encode($empleado['colonia']); ?>, "colonia");
            seleccionarOpcion(<?php echo json_encode($empleado['tipoVialidad']); ?>, "tipoVialidad");

        }

        function seleccionarOpcion(opcion, nombreSelect) {
            select = document.getElementById(nombreSelect)
            for (let i = 0; i < select.options.length; i++) {
                if (opcion == select.options[i].value) {
                    select.options[i].selected = true;
                }
            }
        }
    </script>

    <?php

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["apellidoPaterno"]) && isset($_POST["apellidoMaterno"]) && isset($_POST["nombre"]) && isset($_POST["sexo"]) && isset($_POST["fechaNacimiento"]) && isset($_POST["curp"]) && isset($_POST["rfc"]) && isset($_POST["estadoCivil"]) && isset($_POST["tipoSangre"])
            && isset($_POST["estatura"]) && isset($_POST["peso"]) && isset($_POST["complexion"]) && isset($_POST["discapacidad"]) && isset($_POST["pais"]) && isset($_POST["estado"]) && isset($_POST["municipio"]) && isset($_POST["localidad"]) && isset($_POST["colonia"]) 
            && isset ($_POST["codigoPostal"]) && isset($_POST["nombreVialidad"]) && isset($_POST["numeroExterior"])) {

            //si este valor es 0, no se activó el boton de borrarEmpleado
            $borrarEmpleado = $_POST["borrarEmpleado"];
            //actualizar empleado
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
            $studyCount = $_POST["studyCount"];
            $estudios = [];
            //
            for ($i = 1; $i <= $studyCount; $i++) {
                $escuelaName = "escuela$i";
                $gradoDeEstudiosName = "gradoDeEstudios$i";
                $fechaInicioName = "fechaInicio$i";
                $fechaFin = "fechaFin$i";

                $escuela = $_POST[$escuelaName];
                $gradoDeEstudios = $_POST[$gradoDeEstudiosName];
                $fechaInicio = $_POST[$fechaInicioName];
                $fechaFin = $_POST[$fechaFin];

                //se agrega al arreglo
                $estudios[$i] = ["escuela" => $escuela, "gradoDeEstudios" => $gradoDeEstudios, "fechaInicio" => $fechaInicio, "fechaFin" => $fechaFin];
            }
            guardarEmpleadoData($apellidoPaterno, $apellidoMaterno, $nombre, $sexo, $fechaNacimiento, $fotografia, $numeroEmpleado, $curp, $rfc, $estadoCivil, $tipoSangre, $estatura, $peso, $complexion, $discapacidad, $pais, $estado, $municipio, $localidad, $colonia, $codigoPostal, $tipoVialidad, $nombreVialidad, $numeroExterior, $numeroInterior, $estudios);
        }
        if ($_POST['hiddenBorrarEmpleado'] == 1) {
            borrarEmpleado($numeroEmpleado);
        }
    }
    ?>


</body>

</html>