var form_reg = document.getElementById('form_reg');

form_reg.onsubmit = function(e) {
    var pass2 = $('#pass2').val();
    if(!Verificar(pass2)) {
        e.preventDefault();
    }
}

function Verificar(pass2) {
    var pass1 = $('#pass1').val();

    if (pass1 == pass2) {
        $('#pass2').css({'background-color': 'white', 'border': '1px solid green'});
         return true;
    } else {
        $('#pass2').css({'background-color':'red', 'border': '1px solid red'});
        $('#res').html('<div class="alert alert-danger">Las Contraseñas no coinciden!!!</div>');
    }
}