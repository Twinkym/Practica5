<?php

if($_GET){
    if(isset($_GET['action']) && !empty($_GET['action'])){

        if($_GET['action'] == 'add_tarea'){
            ?>
            <h3>Formulario de Tareas</h3>
            <form class="form-control" method="post" action="controller/tareas.php">
                <div class="row p-2">
                    <div class="col-lg-12">
                        <?php echo 'Usuario: <b>'.$_SESSION['user'].'</b>'; ?>
                        <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Escribe un nombre de tarea" />
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-lg-12">
                        <textarea class="form-control" name="descrip" id="descrip" rows="5" placeholder="Descripción de la tareai"></textarea>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-lg-4">
                        <input class="form-control" type="datetime-local" name="horaProgram" id="horaProg" placeholder="Hora programada de la tarea" />
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
                                <option>activa</option>
                                <option selected >pendiente</option>
                                <option>finalizar</option>
                                <option>en curso</option>
                                <option>cancelada</option>
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
            <?php
        }
        elseif($_GET['action'] == 'edit_tarea'){
            ?>
            
            <h3>Editar Tareas</h3>
            <form class="form-control" method="post" action="controllers/tareas.php" >
                <?php 
                    if(isset($dtTarea) && !empty($dtTarea)){ 
                ?>
                <div class="row p-2">
                    <div class="col-lg-12">
                        <?php echo 'Usuario: <b>'.$_SESSION['user'].'</b>'; ?>
                        <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Escribe un nombre de tarea" value="<?php echo $dtTarea['nombre']; ?>" />
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-lg-12">
                        <textarea class="form-control" name="descrip" id="descrip" rows="5" placeholder="Descripción de la tareai" >
                            <?php echo $dtTarea['descrip']; ?>
                        </textarea>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-lg-4">
                        <input class="form-control" type="datetime-local" name="horaProgram" id="horaProg" placeholder="Hora programada de la tarea" value="<?php echo $dtTarea['horaProgram']; ?>"/>
                    </div>
                    <div class="col-lg-4">
                        <input class="form-control" type="date" name="finicio" id="finicio" placeholder="Fecha inicio:" value="<?php echo $dtTarea['finicio']; ?>">
                    </div>
                    <div class="col-lg-4">
                        <input class="form-control" type="date" name="ffinal" id="ffinal" placeholder="Fecha final:" value="<?php echo $dtTarea['ffinal']; ?>">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-lg-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="ico-estado"><i id="ico-e" class="fa-solid fa-circle-dot"></i></span>
                            <select class="form-select" name="estado" id="estado" onchange="CambioColor(this.value)" aria-describedby="ico-estado" >
                                <option></option>
                                <option <?php if($dtTarea['estado']=='activa'){ echo "selected";} ?>>activa</option>
                                <option <?php if($dtTarea['estado']=='pendiente'){ echo "selected";} ?>>pendiente</option>
                                <option <?php if($dtTarea['estado']=='finalizar'){ echo "selected";} ?>>finalizada</option>
                                <option <?php if($dtTarea['estado']=='en curso'){ echo "selected";} ?>>en curso</option>
                                <option <?php if($dtTarea['estado']=='cancelada'){ echo "selected";} ?>>cancelada</option>
                                <option <?php if($dtTarea['estado']=='fallida'){ echo "selected";} ?>>fallida</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <input type="hidden" name="idUser" value="<?php echo $_SESSION['rowid']; ?>">
                        <input type="hidden" name="rowid" value="<?php echo $dtTarea['rowid']; ?>">
                        <input type="hidden" name="action" value="EDIT_TAREA">
                        <input class="btn btn-success" type="submit" value="Guardar Tarea">
                        <input class="btn btn-danger" type="reset" value="Reset">
                    </div>
                </div> 
                <?php } ?> 
            </form>
            <?php
        }


    }
   
}
?>


<script>
    var jsId = 'TareasJS'; 
    if (!document.getElementById(jsId)) {
        var body = document.getElementsByTagName('body')[0];
        var script = document.createElement('script');
        script.id = jsId;
        script.src = 'https://practica5.test/tareas.js';       
        body.appendChild(script);
    }
</script>
