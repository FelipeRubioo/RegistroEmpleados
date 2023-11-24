<!DOCTYPE html>
<?php include 'funciones.php';

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Empleado</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="/EjercicioReclutamiento/css/estilo.css" type="text/css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<!-- cuando carga la pagina, todos los inputs toman los valores el empleado que estamos consultando -->

<body onload="activarSelects()">

    <?php
    //obtenemos el numero de empleado, ya sea que el metodo sea GET o POST
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $numeroEmpleado = $_GET['numeroEmpleado'];
    } elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
        $numeroEmpleado = $_POST['numeroEmpleado'];
    }

    //se obtiene un arreglo con todos los atributos del empleado 
    $empleado = obtenerEmpleado($numeroEmpleado);
    //estudios es un arreglo que contiene arreglos
    $estudios = $empleado['estudios'];
    ?>
    <!-- formConsulta contiene todos los inputs que se pueden guardar (actualizar) -->
    <form id="formConsulta" action="ConsultarEmpleado.php" method="post">

        <div class="container mt-5">
            <div class="card">
                <div class="card-body">

                    <h3 class="mb-3 border-bottom pb-2 ">Datos generales:</h3>

                    <!-- numeroEmpleado se necesita para guardar la informacion, asi que se guarda en este input oculto-->
                    <input value=<?php echo json_encode($numeroEmpleado) ?> type="hidden" id="numeroEmpleado" name="numeroEmpleado">
                    <!-- el valor hiddenBorrarEmpleado determina si el empleado se borrará o no-->
                    <!--hiddenBorrarEmpleado valdra 0 siempre y cuando no se presione el boton de borrar empleado-->
                    <input value=0 type="hidden" id="hiddenBorrarEmpleado" name="hiddenBorrarEmpleado">

                    <!-- Datos Generales-->
                    <div class="row">

                        <div class="col-md-4">
                            <label class="text-muted" for="apellidoPaterno">Apellido Paterno<span class="text-danger">*</span>:</label>
                            <input value=<?php echo json_encode($empleado['apellidoPaterno']); ?> type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" pattern="[A-Za-z ]+" title="Escriba un apellido valido, solo letras" maxlength="20" required>

                        </div>

                        <div class="col-md-4">
                            <label class="text-muted" for="apellidoMaterno">Apellido Materno<span class="text-danger">*</span>:</label>
                            <input value=<?php echo json_encode($empleado['apellidoMaterno']); ?> type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" pattern="[A-Za-z ]+" title="Escriba un apellido valido, solo letras" maxlength="20" required>
                        </div>

                        <div class="col-md-4">
                            <label class="text-muted" for="nombre">Nombre<span class="text-danger">*</span>:</label>
                            <input value=<?php echo json_encode($empleado['nombre']); ?> type="text" class="form-control" id="nombre" name="nombre" pattern="[A-Za-z ]+" title="Escriba un nombre valido, solo letras" maxlength="30" required>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="sexo">Sexo<span class="text-danger">*</span>:</label>
                            <select class="form-control" name="sexo" id="sexo" required>
                                <!--crea el select con todas sus opciones -->
                                <?php
                                crearSelect("sexo");
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="fechaNacimiento">Fecha de nacimiento<span class="text-danger">*</span>:</label>
                            <input value=<?php echo json_encode($empleado['fechaNacimiento']); ?> type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" min="1920-01-01" max="2009-01-01" required>
                        </div>
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


                                }
                            }
                        </script>
                        <!-- se puede seleccionar una fotografia distinta para el empleado-->
                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="fotografia">Seleccione una fotografia:</label>
                            <input type="file" class="form-control-file mt-2" name="fotografia" id="fotografia" accept="image/*" onchange="mostrarPreviewPonerDefault()">
                            <img id="preview" src="#" style="display:none; max-width: 300px; max-height: 300px;">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Datos adicionales -->
            <div class="card mt-4">
                <div class="card-body">
                    <h3 class="mb-3 border-bottom pb-2 ">Datos adicionales:</h3>

                    <div class="row">
                        <div class="col-md-4">
                            <label class="text-muted" for="curp">CURP<span class="text-danger">*</span>:</label>
                            <input value=<?php echo json_encode($empleado['curp']); ?> type="text" class="form-control" id="curp" name="curp" maxlength="18" required>

                        </div>

                        <div class="col-md-4">
                            <label class="text-muted" for="RFC">RFC<span class="text-danger">*</span>:</label>
                            <input value=<?php echo json_encode($empleado['rfc']); ?> type="text" class="form-control" id="rfc" name="rfc" maxlength="13" required>
                            <span class="help-text text-muted">13 caracteres</span>

                        </div>

                        <div class="col-md-4">
                            <label class="text-muted" for="estadoCivil">Estado civil<span class="text-danger">*</span>:</label>
                            <select class="form-control" name="estadoCivil" id="estadoCivil" required>
                                <?php
                                crearSelect("estadoCivil");
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="tipoSangre">Tipo de sangre<span class="text-danger">*</span>:</label>
                            <select class="form-control" name="tipoSangre" id="tipoSangre" required>
                                <?php
                                crearSelect("tipoSangre");
                                ?>
                            </select>

                        </div>

                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="estatura">Estatura<span class="text-danger">*</span>:</label>
                            <input value=<?php echo json_encode($empleado['estatura']); ?> class="form-control" type="number" id="estatura" name="estatura" placeholder="Ingrese la estatura en metros" step="0.01" min="1.40" max="2.30" required>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="peso">Peso<span class="text-danger">*</span>:</label>
                            <input value=<?php echo json_encode($empleado['peso']); ?> class="form-control" type="number" id="peso" name="peso" placeholder="Ingrese el peso en kilogramos" step="0.01" min="40" max="150" required>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="complexion">Complexion<span class="text-danger">*</span>:</label>
                            <select class="form-control" name="complexion" id="complexion" required>
                                <?php
                                crearSelect("complexion");
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="discapacidad">Discapacidad<span class="text-danger">*</span>:</label>
                            <select class="form-control" name="discapacidad" id="discapacidad" required>
                                <?php
                                crearSelect("discapacidad");
                                ?>
                            </select>

                        </div>

                    </div>
                </div>

            </div>
            <!-- Domicilio -->
            <div class="card mt-4">
                <div class="card-body">
                    <h3 class="mb-3 border-bottom pb-2 ">Domicilio:</h3>
                    <div class="row">

                        <div class="col-md-4">
                            <label class="text-muted" for="pais">País<span class="text-danger">*</span>:</label>
                            <select class="form-control" name="pais" id="pais" required>
                                <?php
                                crearSelect("pais");
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="text-muted" for="estado">Estado<span class="text-danger">*</span>:</label>
                            <select class="form-control" name="estado" id="estado" required>
                                <?php
                                crearSelect("estado");
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="text-muted" for="municipio">Municipio<span class="text-danger">*</span>:</label>
                            <select class="form-control" name="municipio" id="municipio" required>
                                <?php
                                crearSelect("municipio");
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="localidad">Localidad<span class="text-danger">*</span>:</label>
                            <select class="form-control" name="localidad" id="localidad" required>
                                <?php
                                crearSelect("localidad");
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="colonia">Colonia<span class="text-danger">*</span>:</label>
                            <select class="form-control" name="colonia" id="colonia" required>
                                <?php
                                crearSelect("colonia");
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="codigoPostal">Codigo postal<span class="text-danger">*</span>:</label>
                            <input value=<?php echo json_encode($empleado['codigoPostal']); ?> class="form-control" type="number" id="codigoPostal" name="codigoPostal" minlength="5" maxlength="10" required>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="tipoVialidad">Tipo de vialidad:</label>
                            <select class="form-control" name="tipoVialidad" id="tipoVialidad">
                                <?php
                                crearSelect("tipoVialidad");
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="nombreVialidad">Nombre de vialidad<span class="text-danger">*</span>:</label>
                            <input value=<?php echo json_encode($empleado['nombreVialidad']); ?> class="form-control" type="text" id="nombreVialidad" name="nombreVialidad" maxlength="30" required>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="numeroExterior">Numero exterior<span class="text-danger">*</span>:</label>
                            <input value=<?php echo json_encode($empleado['numeroExterior']); ?> class="form-control" type="number" id="numeroExterior" name="numeroExterior" minlength="1" maxlength="6" required>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="numeroInterior">Numero interior:</label>
                            <input value=<?php echo json_encode($empleado['numeroInterior']); ?> class="form-control" type="number" id="numeroInterior" name="numeroInterior" minlength="5" maxlength="10">
                        </div>

                    </div>
                </div>

            </div>
            <!-- Estudios -->
            <div class="card mt-4">
                <div class="card-body">
                    <h3 class="mb-3 border-bottom pb-2 ">Estudios:</h3>
                    <div id="studies-container">
                        <!-- aqui se agregan o quitan estudios -->
                    </div>
                    <input type="hidden" id="studyCount" name="studyCount">
                    <button type="button" id="add-study-btn" onclick="agregarEstudio()">Agregar Estudio</button>

                    <button type="button" id="botonActualizar" name="botonActualizar" onclick="postData()">Guardar</button>
                    <button type="button" id="botonBorrar" name="botonBorrar" onclick="eliminarEmpleado()">Eliminar empleado</button>
    </form>

    </div>

    <script>
        var studyCount = 0;
        //igual que en RegistrarEmpleado, agregan inputs dinamicamente, dependiendo de los botones agregar y  quitar estudio           
        function agregarEstudio() {
            var container = document.getElementById('studies-container');
            var newStudyDiv = document.createElement('div');
            newStudyDiv.innerHTML = `
            <div class="study-container">
                <div class="row">
                    <div class="col-md-3">
                        <label class="text-muted" for="escuela">Escuela<span class="text-danger">*</span>:</label>
                        <input class="form-control" type="text" id="escuela" name="escuela" maxlength="30" >

                    </div>

                    <div class="col-md-3">
                        <label  class="text-muted" for="gradoDeEstudios">Grado de estudios<span class="text-danger">*</span>:</label>
                        <select class="form-control" id="gradoDeEstudios" name="gradoDeEstudios">
                        <?php
                        crearSelect("gradoDeEstudios");
                        ?>
                        </select>

                    </div>

                    <div class="col-md-3">
                        <label class="text-muted" for="fechaInicio">Fecha de inicio<span class="text-danger">*</span>:</label>
                        <input class="form-control" type="date" id="fechaInicio" name="fechaInicio">

                    </div>

                    <div class="col-md-3">
                        <label class="text-muted" for="fechaFin">Fecha de Fin<span class="text-danger">*</span>:</label>
                        <input class="form-control" type="date" id="fechaFin" name="fechaFin">

                    </div>

                    <button onclick="quitarEstudio(this)">Eliminar Estudio</button>
            
                </div>

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

        //al quitar un estudio, se reduce por 1 el contador de estudios para que no interfiera con el ciclo de guardado el manejo del post en php
        function quitarEstudio(boton) {
            studyCount--;
            var container = document.getElementById('studies-container');
            //queremos el study div generado, el que contiene los 4 inputs
            //el parentNode del study container es el studyDiv, el cual está dentro del studies-container
            var studyDiv = boton.parentNode.parentNode.parentNode;

            //se elimina el div con su contenido y se actualiza el contador de estudios
            container.removeChild(studyDiv);
            var contadorEstudios = document.getElementById('studyCount');
            contadorEstudios.value = studyCount;
        }
    </script>
    <?php
    //en este bloque de php se asignan los datos del empleado a los inputs
    $numeroEstudios = 0;
    //estudios es el arreglo que contiene arreglos
    //si se tienen tres estudios, $numeroEstudio es 3, 3 arreglos con propiedades
    //por cada estudio, se agrega un estudio (los 4 inputs con un boton de eliminar estudio, esto con la funcion agregarEstudio();)
    foreach ($estudios as $numeroEstudio) {
        $numeroEstudios++;
        echo "<script>";
        echo  "agregarEstudio();";
        echo '</script>';
        //cada estudio tiene su $dato (escuela,grado, fechainicio,fechafin) y cada dato tiene su llave
        //se crean los nombres de todos los inputs que ya se registraron
        //ej: $nombreInput = "escuela1"
        //   $valorInput = "unison"     
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
        function mostrarPreviewPonerDefault() {

            var fotografia = document.getElementById('fotografia');
            var preview = document.getElementById('preview');

            // asegura que se tenga seleccionado un archivo
            if (fotografia.files && fotografia.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(fotografia.files[0]);
            } else {


            }
        }
    </script>
    <script>
        //funcion que toma los datos del form y hace el post en esta misma pagina
        function postData() {
            //se toman todos inputs y sus valores del formConsulta
            var formConsulta = new FormData(document.getElementById('formConsulta'));

            //se crea un objeto XMLHttpRequest que enviara un metodo post
            //se enviara a la pagina donde se encuentra (window.location.href) y sera de tipo asincrono (true)
            var xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.href, true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    //por ahora no se tiene que hacer con la respuesta del exito
                }
            };
            //se envia el post con los datos del form a esta misma pagina
            xhr.send(formConsulta);
        }

        //funcion de cuando se da click al boton de borrar empleado
        function eliminarEmpleado() {
            //se cambia el valor del input escondido, cuando se lea el valor de "1" en el manejo del post, se eliminará el empleado
            let hiddenBotonBorrar = document.getElementById('hiddenBorrarEmpleado');
            hiddenBotonBorrar.value = 1;
            //se hace post
            postData();
        }
    </script>
    </div>

    </div>

    <script>
        //cuando carga el sistema, se agregan los valores del empleado en los inputs vacios
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
        //para cada select, se itera por todas las opciones que tiene
        //cuando la opcion coincide con el del empleado, se selecciona (selected = true)
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
    //cuando entra el post, se valida que todos los campos requeridos tengan valor o no se actualizaran los valores
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (
            isset($_POST["apellidoPaterno"]) && isset($_POST["apellidoMaterno"]) && isset($_POST["nombre"]) && isset($_POST["sexo"]) && isset($_POST["fechaNacimiento"]) && isset($_POST["curp"]) && isset($_POST["rfc"]) && isset($_POST["estadoCivil"]) && isset($_POST["tipoSangre"])
            && isset($_POST["estatura"]) && isset($_POST["peso"]) && isset($_POST["complexion"]) && isset($_POST["discapacidad"]) && isset($_POST["pais"]) && isset($_POST["estado"]) && isset($_POST["municipio"]) && isset($_POST["localidad"]) && isset($_POST["colonia"])
            && isset($_POST["codigoPostal"]) && isset($_POST["nombreVialidad"]) && isset($_POST["numeroExterior"])
        ) {

            //si este valor es 0, no se activó el boton de borrarEmpleado
            $borrarEmpleado = $_POST["borrarEmpleado"];
            //Datos generales
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
            //por cada estudio que se guardó (valor de studyCount), se obtiene el valor de cada input de cada estudio agregado
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
            } //se guarda el empleado, sobreescribiendo el archivo existente del empleado
            guardarEmpleadoData($apellidoPaterno, $apellidoMaterno, $nombre, $sexo, $fechaNacimiento, $fotografia, $numeroEmpleado, $curp, $rfc, $estadoCivil, $tipoSangre, $estatura, $peso, $complexion, $discapacidad, $pais, $estado, $municipio, $localidad, $colonia, $codigoPostal, $tipoVialidad, $nombreVialidad, $numeroExterior, $numeroInterior, $estudios);
        } //si se dio click al boton borrar, el valor del hidden es 1
        if ($_POST['hiddenBorrarEmpleado'] == 1) {
            borrarEmpleado($numeroEmpleado);
        }
    }
    ?>


</body>

</html>