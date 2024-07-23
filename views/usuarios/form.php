
<?php

if(isset($_GET['action']) and !empty($_GET['action']) and $_GET['action']=='add_user'){ 
    
?>
    <h3>Formulario de Nuevo Usuarios</h3>
    <form class="form-control container" method="post" action="controller/usuarios.php">
        <div class="row p-2">
            <div class="col-lg-4">
                <input class="form-control" type="text" name="name" placeholder="Nombre de usuario:" minlength="5" maxlength="15" required />
            </div>
            <div class="col-lg-4">
                <input id="pass1" class="form-control" type="password" placeholder="Escribe una contraseña:" minlength="5" maxlength="15" required />
            </div>
            <div class="col-lg-4">
                <input id="pass2" onchange="ValidarPass(this.value)" class="form-control" type="password" name="pass" placeholder="Repetir contraseña:" minlength="5" maxlength="15" required />
            </div>
        </div>
        <div class="row p-2">
            <div class="col-lg-12">            
                <div class="input-group mb-3">
                        <input class="form-control" name="email" type="email" placeholder="Correo Electrónico:" minlength="10" maxlength="150" required />
                        <span class="input-group-text" id="basic-addon2">@example.com</span>
                </div>       
            </div>
        </div>
        <div class="row p-2">
            <div class="col-lg-6">
                <label for="labstatus">Estado del Usuario:</label>
                <select id="labstatus" class="form-select" name="status" >
                    <option></option>
                    <option value="1">Bloqueado</option>
                    <option value="2">Activo</option>
                </select>
            </div>
            <div class="col-lg-6">
                <input type="hidden" name="action" value="FORM_REG_USER" />
                <input class="btn btn-success" type="submit" value="Guardar" style="margin-top:1.4rem" />
                <input class="btn btn-danger" type="reset" value="Reset" style="margin-top:1.4rem" />
            </div>
        </div>
    </form>

<?php
}
else if(isset($_GET['action']) and !empty($_GET['action']) and $_GET['action']=='edit_user'){ 
?>



    <h3>Formulario de Editar Usuarios</h3>
    <form class="form-control container" method="post" action="controller/usuarios.php">
        <div class="row p-2">
            <div class="col-lg-4">
                <input class="form-control" type="text" name="name" placeholder="Nombre de usuario:" minlength="5" maxlength="15" value="<?php echo $datosUser['name']; ?>" required />
            </div>
            <div class="col-lg-4">
                <input id="pass1" class="form-control" type="password" placeholder="Escribe una contraseña:" minlength="5" maxlength="15"  />
            </div>
            <div class="col-lg-4">
                <input id="pass2" onchange="ValidarPass(this.value)" class="form-control" type="password" name="pass" placeholder="Repetir contraseña:" minlength="5" maxlength="15"  />
            </div>
        </div>
        <div class="row p-2">
            <div class="col-lg-12">            
                <div class="input-group mb-3">
                        <input class="form-control" name="email" type="email" placeholder="Correo Electrónico:" minlength="10" maxlength="150" value="<?php echo $datosUser['email']; ?>" required />
                        <span class="input-group-text" id="basic-addon2">@example.com</span>
                </div>       
            </div>
        </div>
        <div class="row p-2">
            <div class="col-lg-6">
                <label for="labstatus">Estado del Usuario:</label>
                <?php 
                
                    if($datosUser['status'] == 2){ $sel2 = "selected";}else{ $sel2 = "";} 
                    if($datosUser['status'] == 1){ $sel1 = "selected";}else{ $sel1 = "";} 
                ?>
                <select id="labstatus" class="form-select" name="status" >
                    <option></option>
                    <option value="1" <?php echo $sel1; ?> >Bloqueado</option>
                    <option value="2" <?php echo $sel2; ?> >Activo</option>
                </select>
            </div>
            <div class="col-lg-6">
                <input type="hidden" name="rowid" value="<?php echo $datosUser['rowid']; ?>" />
                <input type="hidden" name="action" value="FORM_UPDATE_USER" />
                <input class="btn btn-success" type="submit" value="Guardar" style="margin-top:1.4rem" />
                <input class="btn btn-danger" type="reset" value="Reset" style="margin-top:1.4rem" />
            </div>
        </div>
    </form>


<?php
}
?>

