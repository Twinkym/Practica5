<?php





?>

<h3>Formulario de Tareas</h3>
<form class="form-control" method="post" action="controllers/tareas.php">
    <div class="row p-2">
        <div class="col-lg-12">
            <?php echo 'Usuario: <b>' . $_SESSION['user'] . '</b>'; ?>
            <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Escribe un nombre de tarea" />
        </div>
    </div>
    <div class="row p-2">
        <div class="col-lg-12">
            <textarea class="form-control" name="descrip" id="descrip" rows="5" placeholder="Descripción de la tarea"></textarea>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-lg-4">
            <input class="form-control" type="datetime-local" name="horaProgramada" id="horaProg" placeholder="Hora programada de la tarea" />
        </div>
        <div class="col-lg-4">
            <input class="form-control" type="date" name="finicio" id="finicio" placeholder="Fecha inicio:">
        </div>
        <div class="col-lg-4">
            <input class="form-control" type="date" name="ffinal" id="ffinal" placeholder="Fecha final:">
        </div>
    </div>
    <div class="row p-2">
        <div class="col-lg-12">
            <div class="input-group mb-3">
                <span class="input-group-text" id="ico-estado"><i id="ico-e" class="fa-solid fa-circle-dot"></i></span>
            <select onchange="CambioColor(this.value)" class="form-select" name="estado" id="estado" aria-describedby="ico-estado">
                <option></option>
                <option>activo</option>
                <option>pendiente</option>
                <option>finalizada</option>
                <option>en curso</option>
                <option>fallida</option>
            </select>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <input type="hidden" name="idUser" value="<?php echo $_SESSION['rowid']; ?>">
            <input type="hidden" name="action" value="ADD_TAREA">
            <input class="btn btn-success" type="submit" value="Guardar Tarea">
            <input class="btn btn-danger" type="reset" value="Reset">
        </div>
    </div>
</form>
<form action="controllers/tareas.php" method="post">
    
</form>

<script>
    function CambioColor(value) {
        switch(value) {
            case 'activo':
                $('#ico-e').css({'color':'blue'});
            brake;
            case 'pendiente':
                $('#ico-e').css({'color':'yellow'});
            brake;
            case 'finalizada':
                $('#ico-e').css({'color':'green'});
            brake;
            case 'enCurso':
                $('#ico-e').css({'color':'lightblue'});
            brake;
            case 'fallida':
                $('#ico-e').css({'color':'red'});
            brake;
            default:
            break;
            

        }
    }
</script>

