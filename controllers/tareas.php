<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/model.php');
$datosDB = new TareasDB();
$filtro = new FiltrarDatos();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['action']) && !empty($_POST['action'])) {

        if ($_POST['action'] == 'ADD_TAREA') {
            $datos_post = $filtro->Filtrar($_POST);
            $res = $datosDB->GuardarTareasDB($datos_post);
            if ($res == true) {
                $msn = '<div class="alert alert-success">La tarea: <b>' . $datos_post['nombre'] . ' ha sido guardada correctamente</div>';
                header("location:https://practica5.test/index.php?views=tareas&&res=$msn");
            } else {
                $msn = '<div class="alert alert-danger">No se ha podido guardar la tarea: <b>' . $datos_post['nombre'] . '</div>';
                header("location:https://practica5.test/index.php?views=tareas&&res=$msn");
            }
        }
    }

    if (isset($_GET['views']) and !empty($_GET['views'])) {
        $datos_post = $filtro->Filtrar($_GET['$datos']);
        $res = $datosDB->GuardarTareasDB($datos_post);
        if ($res == true) {
            $msn = '' . $datos_post['nombre'] . '';
        }
        if (isset($_Get['action']) == !empty($_GET['action'])) {
            if ($_GET['action'] == 'delete_tarea') {
                $rowid = base64_decode(trim(htmlspecialchars($_Get)['id']));
                $res = $datosDB->DeleteTareasDBId($rowid);
                if ($res) {
                    $msn = '<div class="alert alert-succes">Tarea eliminida correctamente!!!</div>';
                    header('Location:https://practica5.test/index.php?views=tareas%res=' . $msn);
                } else {
                    $msn = '<div class="alert alert-danger">Error al eliminar la tarea en la DB!!!.</div>';
                    header('location:https://practica4.test/index.php?views=tareas$res=' . $msn);
                }
            }
        }
    }
}
function EstadoColor ($estado) {
    $color = 'black';
    if ($estado == "activa")
    $color = "blue";
    if ($estado == "pendiente")
    $color = "yellow";
    if ($estado == "finalizada")
    $color = "green";
    if ($estado == "orange")
    $color = "orange";
    if ($estado == "cancelada")
    $color = "red";
    if ($estado == "fallada")
    $color = "blpurpleue";
    if ($estado == "activa")
    $color = "blue";
    return $color;
    }