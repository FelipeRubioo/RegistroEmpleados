<!DOCTYPE html>
<?php include 'funciones.php';

?>
<script src="peticion.js"></script>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Empleado</title>
</head>

<body onload="activarSelects()">
    <h1>Pagina de consulta de empleado</h1>

    <?php
    $numeroEmpleado = $_GET['variable'];
    $empleado = obtenerEmpleado($numeroEmpleado);
    ?>
    <!-- no se puede poner solo el mismo archivo como action ya que desasparece el numero de empleado, hay que agregarlo al URL-->
    <form action=<?php echo $_SERVER['PHP_SELF'] . "?variable=" . $numeroEmpleado; ?> method="POST">

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
            <?php

            ?>
            <!-- aqui se agregan o quitan estudios -->
        </div>

        <button type="button" id="add-study-btn" onclick="agregarEstudio()">Agregar Estudio</button>

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
        <button type="submit" id="botonSubmitActualizar" style="display:none;"></button>
        <button type="button" name="botonActualizar">Guardar</button>

        <button type="submit" id="botonSubmitBorrar" style="display:none;"></button>
        <button type="button" name="botonBorrar">Eliminar empleado</button>
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['botonSubmitActualizar'])) {
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
            $escuela = $_POST["escuela"];
            $gradoDeEstudios = $_POST["gradoDeEstudios"];
            $fechaInicio = $_POST["fechaInicio"];
            $fechaFin = $_POST["fechaFin"];
            guardarEmpleadoData($apellidoPaterno, $apellidoMaterno, $nombre, $sexo, $fechaNacimiento, $fotografia, $numeroEmpleado, $curp, $rfc, $estadoCivil, $tipoSangre, $estatura, $peso, $complexion, $discapacidad, $pais, $estado, $municipio, $localidad, $colonia, $codigoPostal, $tipoVialidad, $nombreVialidad, $numeroExterior, $numeroInterior, $escuela, $gradoDeEstudios, $fechaInicio, $fechaFin);
        } elseif (isset($_POST['formBorrar'])) {
            borrarEmpleado($numeroEmpleado);
        }
    }
    ?>


</body>

</html>