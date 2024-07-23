<?php
require_once 'D:\servidor\www\Practica5\model\model.php';
$UserDB = new UsuariosDB();


if($_GET){
    if(isset($_GET['views']) && !empty($_GET['views'])){
        if($_GET['views'] == 'usuarios'){           
            $DatosUsers = $UserDB->ConsultarUsuariosDB();
            if(isset($_GET['action']) and !empty($_GET['action'])){
                if($_GET['action']=='edit_user'){
                    $rowid = base64_decode(trim(htmlspecialchars($_GET['id'])));                   
                    $datosUser = $UserDB->ConsultarUsuariosDBId($rowid);
                }
                if($_GET['action']=='delete_user'){
                    $rowid = base64_decode(trim(htmlspecialchars($_GET['id'])));                   
                    $res = $UserDB->DeleteUsuariosDBId($rowid);
                    if($res == 1){
                        $msn = '<div class="alert alert-success">Usuario Borrado Correctamente</div>';
                        header('location:https://practica5.test/index.php?views=usuarios&&res='.urlencode($msn));
                    }
                    else
                    {
                        $msn = '<div class="alert alert-success">Usuario No se ha podido borrar Correctamente</div>';
                        header('location:https://practica5.test/index.php?views=usuarios&&res='.urlencode($msn));
                    }
                }
            } 
        }
    }
}

if($_POST){   
    if(isset($_POST['action']) && !empty($_POST['action'])){
        if($_POST['action'] == 'FORM_REG_USER'){            
            $datos['user'] = trim(htmlspecialchars($_POST['name']));
            $datos['pass'] = trim(htmlspecialchars($_POST['pass']));
            $datos['email'] = trim(htmlspecialchars($_POST['email']));
            $datos['status'] = trim(htmlspecialchars($_POST['status']));
            $res = $UserDB->GuardarUsuariosBD($datos);
            if($res == 1){
                $msn = '<div class="alert alert-success">Usuario Guardado Correctamente</div>';
                header('location:https://practica5.test/index.php?views=usuarios&&res='.urlencode($msn));
            }
            else
            {
                $msn = '<div class="alert alert-success">Error al guardar el Usuario en la BD</div>';
                header('location:https://practica5.test/index.php?views=usuarios&&res='.urlencode($msn)); 
            }

        }
        if($_POST['action'] == 'CAMBIAR_STATUS_USER'){
           $rowid = $_POST['rowid'];
           echo $res = $UserDB->CambiarStatusBD($rowid);

        }
        if($_POST['action'] == 'FORM_UPDATE_USER'){
            
            $datos['rowid'] = trim(htmlspecialchars($_POST['rowid']));
            $datos['user'] = trim(htmlspecialchars($_POST['name']));
            $datos['pass'] = trim(htmlspecialchars($_POST['pass']));
            $datos['email'] = trim(htmlspecialchars($_POST['email']));
            $datos['status'] = trim(htmlspecialchars($_POST['status']));
            $res = $UserDB->UpdateUsuariosBD($datos);
            if($res == 1){
                $msn = '<div class="alert alert-success">Usuario Actualizado Correctamente</div>';
                header('location:https://practica5.test/index.php?views=usuarios&&res='.urlencode($msn));
            }
            else
            {
                $msn = '<div class="alert alert-success">Error al actualizar el Usuario en la BD</div>';
                header('location:https://practica5.test/index.php?views=usuarios&&res='.urlencode($msn)); 
            }
        }
    }    
}

class Usuarios{
    public $user;
    public $validar = "false";

    public function getUser(){
        return $this->user;
    }
    public function getValidar(){
        return $this->validar;
    }
    public function setUser($user){
        $this->user = $user;
    }
    public function VerificarUsuario($user){
        // Buscar en la BD si el usuario que trae el link está previamente registrado.
        // cambiar el estado de 1 a 2.
        $UserDB = new UsuariosDB();
        if($UserDB->CambiarEstadoUsuariosBD($user)){
            $this->validar = true;
        }
    }
}

