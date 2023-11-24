<html>

<head>

    <?php include 'funciones.php';

    ?>
    <title>Registro de empleados</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <style>
        body {
            background-color: #f8f9fa;
            /* Light gray background color */
        }
    </style>

</head>

<!-- cuando se pone el url, se hace la redireccion, pero al cargar la pagina pasa por el if si se debe hacer la redireccion  -->

<body onload="redireccion()">
    <form id="formRegistro" action="RegistroEmpleado.php" method="post" enctype="multipart/form-data">
        <div class="container mt-5">
            <!-- Datos generales -->
            <div class="card">
                <div class="card-body">

                    <h3 class="mb-3 border-bottom pb-2 ">Datos generales:</h3>
                    <!-- Form registro, contiene todos los inputs: Datos generales, Datos adicionales, Domicilio y estudios -->

                    <div class="row">

                        <div class="col-md-4">
                            <label class="text-muted" for="apellidoPaterno">Apellido Paterno<span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" pattern="[A-Za-z ]+" title="Escriba un apellido valido, solo letras" maxlength="20" required>

                        </div>

                        <div class="col-md-4">
                            <label class="text-muted" for="apellidoMaterno">Apellido Materno<span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" pattern="[A-Za-z ]+" title="Escriba un apellido valido, solo letras" maxlength="20" required>
                        </div>

                        <div class="col-md-4">
                            <label class="text-muted" for="nombre">Nombre<span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" pattern="[A-Za-z ]+" title="Escriba un nombre valido, solo letras" maxlength="30" required>
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
                        <!--el empleado no puede tener mas de 100 años ni menor de 15 años-->
                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="fechaNacimiento">Fecha de nacimiento<span class="text-danger">*</span>:</label>
                            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" min="1920-01-01" max="2009-01-01" required>
                        </div>
                        <!--al cambiar el estatus del archivo (cuando se selecciona) se muestra el preview-->
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
                            <input type="text" class="form-control" id="curp" name="curp" maxlength="18" required>

                        </div>

                        <div class="col-md-4">
                            <label class="text-muted" for="RFC">RFC<span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="rfc" name="rfc" maxlength="13" required>
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
                            <input class="form-control" type="number" id="estatura" name="estatura" placeholder="Ingrese la estatura en metros" step="0.01" min="1.40" max="2.30" required>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="peso">Peso<span class="text-danger">*</span>:</label>
                            <input class="form-control" type="number" id="peso" name="peso" placeholder="Ingrese el peso en kilogramos" step="0.01" min="40" max="150" required>
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
                            <input class="form-control" type="number" id="codigoPostal" name="codigoPostal" minlength="5" maxlength="10" required>
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
                            <input class="form-control" type="text" id="nombreVialidad" name="nombreVialidad" maxlength="30" required>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="numeroExterior">Numero exterior<span class="text-danger">*</span>:</label>
                            <input class="form-control" type="number" id="numeroExterior" name="numeroExterior" minlength="1" maxlength="6" required>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mt-3">
                            <label class="text-muted" for="numeroInterior">Numero interior:</label>
                            <input class="form-control" type="number" id="numeroInterior" name="numeroInterior" minlength="5" maxlength="10">
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
                    <button type="submit" id="botonSubmit">Guardar</button>

    </form>
        </div>




    <script>
        var studyCount = 0;

        function agregarEstudio() {
            //al agregar un estudio, se genera un div, al que se le pone dentro (innerHTML) 4 inputs
            //el id del div, los 4 inputs y sus nombres se cambian con un contador para que cada uno sea unico
            var container = document.getElementById('studies-container');
            var newStudyDiv = document.createElement('div');
            newStudyDiv.innerHTML = `
            <div class="study-container">
                <div class="row">
                    <div class="col-md-3">
                        <label class="text-muted" for="escuela">Escuela<span class="text-danger">*</span>:</label>
                        <input class="form-control" type="text" id="escuela" name="escuela" maxlength="30">

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
                        <input class="form-control" type="date" id="fechaInicio" name="fechaInicio" >

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

            //var studyDiv = document.getElementById(studyDiv);

            //se elimina el div con su contenido y se actualiza el contador de estudios
            container.removeChild(studyDiv);
            var contadorEstudios = document.getElementById('studyCount');
            contadorEstudios.value = studyCount;
        }
    </script>
    </div>

    </div>




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
    </script>


    <?php
    //obtener datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Todos los datos requeridos deben venir en el post, de no ser asi, no se genera un nuevo registro
        //Datos generales
        if (
            isset($_POST["apellidoPaterno"]) && isset($_POST["apellidoMaterno"]) && isset($_POST["nombre"]) && isset($_POST["sexo"]) && isset($_POST["fechaNacimiento"]) && isset($_POST["curp"]) && isset($_POST["rfc"]) && isset($_POST["estadoCivil"]) && isset($_POST["tipoSangre"])
            && isset($_POST["estatura"]) && isset($_POST["peso"]) && isset($_POST["complexion"]) && isset($_POST["discapacidad"]) && isset($_POST["pais"]) && isset($_POST["estado"]) && isset($_POST["municipio"]) && isset($_POST["localidad"]) && isset($_POST["colonia"])
            && isset($_POST["codigoPostal"]) && isset($_POST["nombreVialidad"]) && isset($_POST["numeroExterior"])
        ) {

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

                //se agrega al arreglo asociativo
                $estudios[$i] = ["escuela" => $escuela, "gradoDeEstudios" => $gradoDeEstudios, "fechaInicio" => $fechaInicio, "fechaFin" => $fechaFin];
            }

            //se genera el numero de empleado y se guarda el empleado en el archivo (la imagen tambien)
            $numeroEmpleado = generaNumeroEmpleado();
            guardarEmpleadoData($apellidoPaterno, $apellidoMaterno, $nombre, $sexo, $fechaNacimiento, $fotografia, $numeroEmpleado, $curp, $rfc, $estadoCivil, $tipoSangre, $estatura, $peso, $complexion, $discapacidad, $pais, $estado, $municipio, $localidad, $colonia, $codigoPostal, $tipoVialidad, $nombreVialidad, $numeroExterior, $numeroInterior, $estudios);
        }
    }




    ?>

    <script>
        function redireccion() {
            // obtiene el url actual
            var currentUrl = window.location.href;
            // obtiene el numero de empleado del url, asumiendo que es el ultimo elemento del url
            var matches = currentUrl.match(/\/(\d+)$/);
            //si hay un numero al final de la URL se hace el redirect
            if (matches) {
                var number = matches[1];

                // se crea el nuevo url (con el numero de empleado al final)
                var newUrl = 'http://localhost/ConsultarEmpleado.php?numeroEmpleado=' + number;
                // redirecciona al nuevo url
                window.location.replace(newUrl);
            }
        }
    </script>
    <script>
        // se sube el form con ajax
        $(document).ready(function() {
            $('#formRegistro').submit(function(event) {
                event.preventDefault(); // no se sube el form de manera estandar


                // crea objeto de data 
                var formData = new FormData(this);
                // Se envia la solicitud ajax
                $.ajax({
                    type: 'POST',
                    url: '/RegistroEmpleado.php',
                    data: formData,
                    //estas dos lineas son para que se pueda pasar la imagen correctamente
                    contentType: false,
                    //si enviamos formData, processData debe ser False
                    processData: false,

                    success: function(response) {
                        console.log('se subio el form usando ajax');
                        alert('Se registró el usuario');
                        //despues de aceptar el alert, refresca la pagina
                        window.location.replace(window.location.href);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(error);
                    }
                });
            });
        });
    </script>

</body>

<footer>

</footer>

</html>