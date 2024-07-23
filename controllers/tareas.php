<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/controller.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/model.php');
$datosDB = new TareasDB();
$filtro = new FiltrarDatos();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(isset($_POST['action']) && !empty($_POST['action'])){              
       
        if($_POST['action'] == 'ADD_TAREA'){
            $datos_post = $filtro->Filtrar($_POST);
            $res = $datosDB->GuardarTareasDB($datos_post);
            if($res == true){
                $msn = '<div class="alert alert-success">La tarea: <b>'.$datos_post['nombre'].' ha sido guardada correctamente</div>';
                header("location:https://practica5.test/index.php?views=tareas&&res=$msn");
            }else{
                $msn = '<div class="alert alert-danger">No se ha podido guardar la tarea: <b>'.$datos_post['nombre'].'</div>';
                header("location:https://practica5.test/index.php?views=tareas&&res=$msn");
            }

        }
    }
}












