<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div id="res" >
                <?php
                    if(isset($_GET['res']) && !empty($_GET['res'])){
                        echo $_GET['res'];
                    }
                ?>
            </div>
        </div>
    </div>
</section>
<section class="container">
        <div class="row">
            <div class="col-lg-6">
                <h5>Formuliario de Acceso</h5>
                <form class="form-control" method="post" action="../controllers/controller.php">
                    <input class="form-control" type="email" name="user" placeholder="Nombre de usuario:" minlength="5" maxlength="150" required />
                    <br>
                    <input class="form-control" type="password" name="pass" placeholder="Contraseña" minlength="5" maxlength="30" required/>
                    <br>
                    <input type="hidden" name="accion" value="FORM_LOGIN" />
                    <br>
                    <input class="btn btn-primary" type="submit" value="LOGIN" />
                    <input class="btn btn-danger" type="reset" value="RESET" />
                </form>              
            </div>
            <div class="col-lg-6">
                <h5>Formuliario de Registro de Usuario</h5>
                    <form id="form_reg" class="form-control" method="post" action="../controllers/controller.php">
                        <input class="form-control" type="email" name="email" placeholder="Un correo electrónico" required />
                        <br>
                        <input class="form-control" type="text" name="user" placeholder="Nombre de usuario:" minlength="5" maxlength="15" required />
                        <br>
                        <input id="pass1" class="form-control" type="password" placeholder="Contraseña" minlength="5" maxlength="15" required/>
                        <br>
                        <input id="pass2" onchange="Verificar(this.value)" class="form-control" type="password" name="pass" placeholder="Repetir contraseña" minlength="5" maxlength="15" required/>
                        <br>
                        <input type="hidden" name="accion" value="FORM_REG_LOGIN" />
                        <br>
                        <input class="btn btn-primary" type="submit" value="REGISTRARSE" />
                        <input class="btn btn-danger" type="reset" value="RESET" />
                    </form>
                </div>
        </div>
    </section>