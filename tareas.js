window.addEventListener('load', function () {

    CambioColor($('#estado').val())
});

function CambioColor(value) {
    switch (value) {
        case 'activo':
            color = 'blue'
            break;
        case 'pendiente':
            color = 'yellow'
            break;
        case 'finalizada':
            color = 'green'
            break;
        case 'en curso':
            color = 'lightgreen'
            break;
        case 'fallida':
            color = 'red'
            break;
        default:
            break;
    }
    $('#ico-e').css({ 'color': color })
}