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
//le damos a un elemento del archivo la capacidad de hacer la solicitud
document.addEventListener("DOMContentLoaded", function () {
    let botonGuardar = document.getElementById("botonGuardar");
    botonGuardar.addEventListener("click", guardar);
});

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