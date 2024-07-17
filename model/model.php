<?php

class ConectorDB
{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $port;
    public $con;
    public function __construct()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->db = "mvc";
        $this->port = "3306";
        $this->ConectarBD();
    }
    public function SeleccionarDatos(String $sql)
    {
        $this->ConectarBD();
        $datos = mysqli_query($this->con, $sql);
        $this->DesconectarBD();
        return $datos;
    }

    private function ConectarBD()
    {
        $this->con = mysqli_connect($this->host, $this->user, $this->pass, $this->db, $this->port);
    }
    private function DesconectarBD()
    {
        $res = mysqli_close($this->con);
        return $res;
    }
}


class UsuariosDB extends ConectorDB
{
    public function ConsultarUsuariosDB()
    {
        $sql = "SELECT * FROM `app_users`";
        $datos = $this->SeleccionarDatos($sql);
        $total = mysqli_num_rows($datos);
        if ($total != 0) {
            $i = 1;
            foreach ($datos as $dato) {
                $datosUsers[$i] = $dato;
                $i++;
            }
            return $datosUsers;
        }
    }
    public function ConsultarUsuariosDBId(Int $rowid)
    {
        $sql = "SELECT * FROM `app_users` WHERE `rowid`=" . $rowid;
        try {
            $datos = $this->SeleccionarDatos($sql) or die($msn = "Algo pasó en la base de datos.");
            $total = mysqli_num_rows($datos);
            if ($total != 0) {
                foreach ($datos as $dato);
                return $dato;
            }
            else 
            {
                return $msn;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function CambiarEstadoUsuariosBD($user)
    {
        // Prevenir el SQL Inject
        $user = trim($user); // Eliminar espacios en blanco innecesarios
        $user = htmlspecialchars($user, ENT_QUOTES, 'UTF-8'); // Convertir caracteres especiales en entidades HTML


        // recuperamos la rowid y tambén verificamos que existe.
        $sql = "SELECT `rowid` FROM `app_users` WHERE `name` ='" . $user . "'";
        $datos = $this->SeleccionarDatos($sql);
        $total = mysqli_num_rows($datos);
        if ($total > 0) {

            foreach ($datos as $dato);
            // Pasar del valor estado=1 a estado=2
            $sql1 = "UPDATE `app_users` SET `status` = '2' WHERE `app_users`.`rowid` =" . $dato['rowid'];
            if ($this->SeleccionarDatos($sql1)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

        // Prevenir el SQL Inject
        //$sql1 = "SELECT *  FROM `app_users` WHERE `name` = ?";
        //$datos = $this->ConsultaSeguras($sql1,$user);

    }

    public function CambiarStatusDB($rowid)
    {
        $sql = "SELECT `status` FROM `app_users` WHERE `rowid` = " . $rowid;
        if ($datos = $this->SeleccionarDatos($sql)) {
            foreach ($datos as $dato) {
                $status = ($dato['status'] == 2) ? 1 : 2;;
            }
            $sql1 = "UPDATE `app_users` SET `status`= " . $status . " WHERE `rowid` = " . $rowid;
            $res = $this->SeleccionarDatos($sql1);
            if ($res == 1) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function GuardarUsuariosBD($datos)
    {
        if (isset($datos['status'])) {
            $status = $datos['status'];
        } else {
            $status = 1;
        }
        $sql = "        
        INSERT INTO `app_users`
        (`rowid`,`name`,`pass`,`email`,`status`)
        VALUES
        (NULL,'" . $datos['user'] . "','" . MD5($datos['pass']) . "','" . $datos['email'] . "'," . $status . ")
        ";

        return $res = $this->SeleccionarDatos($sql);
    }
}
