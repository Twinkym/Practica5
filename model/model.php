<?php
/**
 * Summary of ConectorDB
 * 
 * @category  ConectorDB
 * @package   Conector
 * @author    David De La Puente <ddelapuenteenriquez@gmail.com>
 * @copyright 2024-2030 David De La Puente <denridev@2024>
 * @license   http://opensource.org/licenses/MIT MIT License
 * @link      http://curso_obj.test/php/practicasGenericas/
 */
class ConectorDB
{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $port;
    public $con;
    /**
     * Summary of __construct
     * 
     * @param string $host
     */
    public function __construct()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->db = "mvc";
        $this->port = "3306";
        $this->ConectarBD();
    }
    public function SeleccionarDatos(string $sql)
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
    public function ConsultarUsuariosDB(){
        $sql = "SELECT * FROM `app_users`";
        $datos = $this->SeleccionarDatos($sql);
        $total = mysqli_num_rows($datos);
        if ($total != 0) {
            $i = 1;
            foreach ($datos as $dato){
                $datosUsers[$i] = $dato;
                $i++;
            }
            return $datosUsers;
        }
    }
    public function ConsultarUsuariosDBId(Int $rowid){
        $sql = "SELECT * FROM `app_users`";
        $datos = $this->SeleccionarDatos($sql);
    }
    public function BuscarUsuariosBD($user)
    {
        // Prevenir el SQL Injection
        // Remove spaces.
        $user = trim($user);  
        // Convert specialChars to entities.
        $user = htmlspecialchars($user, ENT_QUOTES, 'UTF-8'); 
        $sql = "SELECT `rowid` FROM `app_users` WHERE `name` = '".$user."'";
        $datos = $this->SeleccionarDatos($sql);
        $total = mysqli_num_rows($datos);

        if ($total > 0) {
            foreach($datos as $dato);
            $sql1 = "UPDATE `app_users` SET 'status' = '2' WHERE 'rowid' = ".$dato['rowid'];
            $datos = $this->SeleccionarDatos($sql);
        } else {
            return false;
        }
    }
/**
 * Summary of guardarUsuarisBD
 *
 * @param mixed $datos Datos
 *                         
 * @return mixed
 */
    public function GuardarUsuariosBD($datos)
    {
        $status = (isset($datos['status'])) ? $datos['status'] : 1;
        $sql = "        
        INSERT INTO `app_users`
        (`rowid`,`name`,`pass`,`email`,`status`)
        VALUES
        (NULL,'" . $datos['user'] . "','" . MD5($datos['pass']) . "','" . $datos['email'] . "'," . $status . ")";

        return $res = $this->SeleccionarDatos($sql);
    }

}