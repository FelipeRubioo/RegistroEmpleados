function guardar() {
    //objeto para hacer peticiones
    var xhttp = new XMLHttpRequest();
    //revisar el estatus de la peticion 
    xhttp.onreadystatechange = function () {
        //validamos que la peticion es correcta
        if (this.readyState == 4 && this.status == 200) {
            //lo que nos retorne la peticion lo pasaremos 
            document.getElementById('botonSubmit').click();
        }
    };
    //indicamos que dato vamos a llamar
    //GET o POST, archivo donde haremos la solicitud, false (sincrono) o true(asincrono)
    xhttp.open('POST', "RegistroEmpleado.php", true);
    //realizar la peticion
    try {
        xhttp.send();
        console.log("se hizo el procedimiento asincrono");
    } catch (error) {
        console.error("este es el error: " + error.message);
    }
}
//en el archivo RegistroEmpleado.php, el botonGuardar activa la funcion, la cual activa el submit del form
document.addEventListener("DOMContentLoaded", function () {
    let botonGuardar = document.getElementById("botonGuardar");
    botonGuardar.addEventListener("click", guardar);
});

//misma logica que la funcion guardar
function actualizar() {
    
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function () {
        
        if (this.readyState == 4 && this.status == 200) {
            
            document.getElementById('botonSubmitActualizar').click();
        }
    };
    
    xhttp.open('POST', "ConsultarEmpleado.php", true);
    
    try {
        xhttp.send();
        console.log("se hizo el procedimiento asincrono");
    } catch (error) {
        console.error("este es el error: " + error.message);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    let botonActualizar = document.getElementById("botonActualizar");
    botonActualizar.addEventListener("click", actualizar);
});

//misma logica que la funcion guardar y actualizar
function borrar() {
    
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function () {
        
        if (this.readyState == 4 && this.status == 200) {
            
            document.getElementById('botonSubmitBorrar').click();
        }
    };
    
    xhttp.open('POST', "ConsultarEmpleado.php", true);
    
    try {
        xhttp.send();
        console.log("se hizo el procedimiento asincrono");
    } catch (error) {
        console.error("este es el error: " + error.message);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    let botonBorrar = document.getElementById("botonBorrar");
    botonBorrar.addEventListener("click", borrar);
});