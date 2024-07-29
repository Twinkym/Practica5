<?php

Class ConectorDB{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $port;
    public $con;
    public function __construct(){       
            $this->host = "localhost";
            $this->user = "root";
            $this->pass = "";
            $this->db = "mvc";
            $this->port = "3306";
            $this->ConectarBD();       
    }
    public function SeleccionarDatos(String $sql){
            $this->ConectarBD();
            $datos = mysqli_query($this->con,$sql);           
            $this->DesconectarBD();
            return $datos;
    }
    /*
    public function ConsultaSeguras($sql,$user){
        $this->ConectarBD();
        // Preparar la consulta
        $stmt = $this->con->prepare($sql);
        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt === false) {
            die("Error al preparar la consulta: " . $this->con->error);
        }      

        // Vincular el parámetro a la consulta preparada
        $stmt->bind_param("s", $user);
        // Ejecutar la consulta
        $stmt->execute();

        // Almacenar el resultado
        $stmt->store_result();

        // Verificar si el usuario existe
        if ($stmt->num_rows > 0) {
            echo "El usuario existe con seguridad.";
        } else {
            echo "El usuario no existe con seguridad.";
        }
    }
    */
    private function ConectarBD(){        
        $this->con = mysqli_connect($this->host,$this->user,$this->pass,$this->db,$this->port);
        
    }
    private function DesconectarBD(){
        $res = mysqli_close($this->con);
        return $res;
    }
}


Class UsuariosDB extends ConectorDB{
    public function ConsultarUsuariosDB(){
        $sql = "SELECT * FROM `app_users`";
        $datos = $this->SeleccionarDatos($sql);
        $total = mysqli_num_rows($datos);
        if($total != 0){
            $i=1;
            foreach($datos as $dato){
                $datosUsers[$i] = $dato;
                $i++;
            }            
            return $datosUsers;
        }
    }
    public function ConsultarUsuariosDBId(Int $rowid){
        $sql = "SELECT * FROM `app_users` WHERE `rowid`=".$rowid;
        
        try{
            $datos = $this->SeleccionarDatos($sql)or die( $msn = "Algo pasó en la base de datos");
            $total = mysqli_num_rows($datos);
            if($total != 0){             
                foreach($datos as $dato);
                return $dato;           
            }
            else
            {
                return $msn;
            }
        }catch(Exception $e){
            return $e;
        }
            
    }
    public function CambiarEstadoUsuariosBD($user){
        // Prevenir el SQL Inject
        $user = trim($user); // Eliminar espacios en blanco innecesarios
        $user = htmlspecialchars($user, ENT_QUOTES, 'UTF-8'); // Convertir caracteres especiales en entidades HTML
        
        
        // recuperamos la rowid y tambén verificamos que existe.
        $sql = "SELECT `rowid` FROM `app_users` WHERE `name` ='".$user."'";
        $datos = $this->SeleccionarDatos($sql);
        $total = mysqli_num_rows($datos);
        if($total > 0){
               
                foreach($datos as $dato);
                // Pasar del valor estado=1 a estado=2
                $sql1 = "UPDATE `app_users` SET `status` = '2' WHERE `app_users`.`rowid` =".$dato['rowid'];               
                if($this->SeleccionarDatos($sql1)){ return true; }else{ return false;}
                
        }
        else
        {
             return false;
        }
      
            // Prevenir el SQL Inject
            //$sql1 = "SELECT *  FROM `app_users` WHERE `name` = ?";
            //$datos = $this->ConsultaSeguras($sql1,$user);
     
    }
    public function CambiarStatusBD($rowid){
        $sql = "SELECT `status` FROM `app_users` WHERE `rowid`=".$rowid;
        if($datos = $this->SeleccionarDatos($sql)){
            foreach($datos as $dato);
            if($dato['status'] == 2){$status=1;}else{$status=2;}
            $sql1 = "UPDATE `app_users` SET `status`=".$status." WHERE `rowid`=".$rowid;
            $res = $this->SeleccionarDatos($sql1);
            if($res == 1){ return true; }else{ return false;}
        }
    }
    public function GuardarUsuariosBD(Array $datos){
        if(isset($datos['status'])){ $status = $datos['status']; }else{ $status = 1;}
        $sql = "        
        INSERT INTO `app_users`
        (`rowid`,`name`,`pass`,`email`,`status`)
        VALUES
        (NULL,'".$datos['user']."','".MD5($datos['pass'])."','".$datos['email']."',".$status.")
        ";

        return $res = $this->SeleccionarDatos($sql);
        
    }
    public function UpdateUsuariosBD(Array $datos){
        if(isset($datos['pass']) and !empty($datos['pass'])){
            $sql = "
            UPDATE `app_users` SET
            `name`='".$datos['user']."',
            `pass`='".MD5($datos['pass'])."',
            `email`='".$datos['email']."',
            `status`=".$datos['status']."
            WHERE `rowid`=".$datos['rowid'];
        }
        else
        {
            $sql = "
            UPDATE `app_users` SET
            `name`='".$datos['user']."',
            `email`='".$datos['email']."',
            `status`=".$datos['status']."
            WHERE `rowid`=".$datos['rowid']; 
        }
        
        
        return $res = $this->SeleccionarDatos($sql)or die("Todo salió mal!!!!!");

    }
    public function DeleteUsuariosDBId(Int $rowid){
        $sql = "DELETE FROM `app_users` WHERE `rowid`=".$rowid;
        $res =$this->SeleccionarDatos($sql);
        return $res;    
    }
} 

Class TareasDB extends ConectorDB{
    public function InstallTareas(){
        $sql = "
            CREATE TABLE IF NOT EXISTS `app_tareas`
            (
                `rowid` int NOT NULL primary key auto_increment,
                `idUser` int NOT NULL,
                `nombre` varchar(150) not null,
                `descrip` varchar(250) not null,
                `horaProgram` datatime ,
                `finicio`  date,
                `ffinal` date,
                `estado` enum('activa','pendiente','finalizar','en curso','cancelada','fallida') NOT NULL,
                FOREIGN KEY (`idUser`) REFERENCES `app_users` (`rowid`) ON DELETE RESTRICT ON UPDATE RESTRICT
            );
        ";
        return $res = $this->SeleccionarDatos($sql);
    }

    public function GuardarTareasDB($datos){
        $sql = "INSERT INTO `app_tareas`
        (`idUser`,`nombre`,`descrip`,`horaProgram`,`finicio`,`ffinal`,`estado`) 
        VALUE
        (
        '".$datos['idUser']."',
        '".$datos['nombre']."',
        '".$datos['descrip']."',
        '".$datos['horaProgramada']."',
        '".$datos['finicio']."',
        '".$datos['ffinal']."',
        '".$datos['estado']."'
        )
        ";

        return $res = $this->SeleccionarDatos($sql);
         


    }

    public function ConsultarTareasDB(int $idUser){
        $sql = "SELECT app_tareas.*, app_users.name 
                FROM `app_tareas` 
                JOIN `app_users` ON `app_users`.`idUser` = `app_users`.`rowid`
                WHERE `idUsers` = ".$idUser." 
                ORDER BY `finicio` ASC;
        ";

        $datos = $this->SeleccionarDatos($sql);
        $total = mysqli_num_rows($datos);
    }

    public function DeleteTareasDBId(int $rowid){
        $sql = "DELETE FROM `app_tareas` WHERE `rowid = ".$rowid;
        return $res = $this->SeleccionarDatos($sql);
    }

    public function ConsultarTareasId(int $rowid) {
        $sql = "SELECT * FROM `app_tareas WHERE `rowid = ".$rowid;
        $datos = $this->SeleccionarDatos($sql);
        $total = mysqli_num_rows($datos);
        if ($total> 0){
            return $datos;
        } else{
            return $datos = [];
        }
    }

public function UdateTareasDB(array $datos) {
    $sql = "UPDATE `app_tareas` SET `nombre` = '".$datos['nombre']."',
    `descrip` = '".$datos['descrip']."',
    `horaProgramada` = '".$datos['horaProgramada']."',
    `finicio` = '".$datos['finicio']."',
    `ffinal` = '".$datos['ffinal']."',
    `estado` = '".$datos['estado']."'
    WHERE `rowid` = ".$datos['rowid'];

    return $res = $this->SeleccionarDatos($sql);
}
}