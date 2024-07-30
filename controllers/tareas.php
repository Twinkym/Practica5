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
        if($_POST['action'] === 'EDIT_TAREA') {
            $res = $datosDB->UpdateTareasDB($_POST);
            if($res === true) {
                $msn = '<div class="alert alert-succes">La tarea: <b> '.$datos_post['nombre'].' ha sido guardada correctamente</div>';
                header('location:https://practica5.test/index.php?views=tareas&&res='.$msn);
            }else{
                $msn = '<div class="alert alert-danger">No se ha podido guardar la tarea: <b>'.$datos_post['nombre'].'</div>';
                header('location:https://practica5.test/index.php?views=tareaas&&res='.$msn);
            }
        }
    }
}

if($_GET){
    if(isset($_GET['views']) && !empty($_GET['views']) && $_GET['views'] == 'tareas'){
        if(isset($_SESSION['rowid']) && !empty($_SESSION['rowid'])){
            $idUser = $_SESSION['rowid'];
            if(!isset($_GET['action']) && empty($_GET['action'])){
                $ListaTareas = $datosDB->ConsultarTareasUser($idUser);
            }           

        }
        if(isset($_GET['action']) && !empty($_GET['action'])){
            if($_GET['action']=='delete_tarea'){
                $id = base64_decode($_GET['id']);
                $res = $datosDB->DeleteTareasDB($id);
                if($res == true){
                    $msn = '<div class="alert alert-success">La tarea: <b>'.$datos_post['nombre'].' ha sido borrada correctamente</div>';
                    header('location:https://practica5.test/index.php?views=tareas&&res='.$msn);
                }else{
                    $msn = '<div class="alert alert-danger">No se ha podido borrar la tarea: <b>'.$datos_post['nombre'].'</div>';
                    header('location:https://practica5.test/index.php?views=tareas&&res='.$msn);
                }
                
            }
            if($_GET['action']=='edit_tarea'){
                // Conger de la tarea por id
                $rowid = base64_decode(trim(htmlspecialchars($_GET['id'])));
                $dtTareas = $datosDB->ConsultarTareasId($rowid);           
                foreach($dtTareas as $dtTarea);
                
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
    if ($estado == "en curso")
    $color = "orange";
    if ($estado == "cancelada")
    $color = "red";
    if ($estado == "fallada")
    $color = "blpurpleue";

    return $color;
}
