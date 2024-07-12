
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
</head> -->

<body> 
    <section class="container">
        <div class="row">
            <div class="col-lg-6">
                <h5>Formuliario de Acceso</h5>
                <form class="form-control" method="post" action="/controllers/controller.php">
                    <input class="form-control" type="text" name="user" placeholder="Nombre de usuario:" minlength="5" maxlength="15" required />
                    <br>
                    <input class="form-control" type="password" name="pass" placeholder="Contraseña" minlength="5" maxlength="" required />
                    <br>
                    <input type="hidden" name="accion" value="FORM_LOGIN" />
                    <br>
                    <input class="btn btn-primary" type="submit" value="LOGIN" />
                    <input class="btn btn-danger" type="reset" value="RESET" />
                </form>
            </div>
            <div class="col-lg-6">
                <h5>Formuliario de Registro de Usuario</h5>
                <form class="form-control" method="post" action="controllers\controller.php">
                    <input class="form-control" type="email" name="email" placeholder="Un correo electrónico" required />
                    <br>
                    <input class="form-control" type="text" name="user" placeholder="Nombre de usuario:" minlength="5" maxlength="150" required />
                    <br>
                    <input class="form-control" type="password" placeholder="Contraseña" minlength="5" maxlength="30" required />
                    <br>
                    <input onchange="" class="form-control" type="password" name="pass" placeholder="Repetir contraseña" minlength="5" maxlength="30" required />
                    <br>
                    <input type="hidden" name="accion" value="FORM_REG_LOGIN" />
                    <br>
                    <input class="btn btn-primary" type="submit" value="REGISTRARSE" />
                    <input class="btn btn-danger" type="reset" value="RESET" />
                </form>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

<!-- </html> -->
