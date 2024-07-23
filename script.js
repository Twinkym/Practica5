const mensajes = document.querySelectorAll("#res"); 
var form_reg = document.getElementById('form_reg');
// EVENTOS DE LAS ALERTAS DESDE PHP
document.addEventListener("DOMContentLoaded", function() {
  
        function startCounter() {
            mensajes.forEach((mensaje, index) => {
                setTimeout(() => {
                    mensaje.style.display = "none";
                }, (index + 1) * 3000);
            });
        }
        startCounter();
});
// EVENTO DEL LOGIN DE USUARIOS
form_reg.onsubmit = function(e){
    var pass2 = $('#pass2').val();
    if(!Verificar(pass2)){
        e.preventDefault();
    }      
    
}

// CONTADOR PARA LAS ALERTAS DESDE JS
function startCounter() {
            mensajes.forEach((mensaje, index) => {
                setTimeout(() => {
                    mensaje.style.display = "none";
                }, (index + 1) * 3000);
            });
}
// VALIDAR EL PASSWORD DEL FORMULARIO ADD Y EDIT USUARIOS.
function ValidarPass(ValPass2){
        let pass1 = document.getElementById('pass1');
        let pass2 = document.getElementById('pass2');
        let res = document.getElementById('res');
        if(ValPass2 != pass1.value){
            pass2.style.backgroundColor = "red";
            pass2.value = "";
            res.style.display = "block";
            res.innerHTML = '<div class="alert alert-danger">Las contraseñas no coinciden!!!</div>';
            startCounter();
        }
}
