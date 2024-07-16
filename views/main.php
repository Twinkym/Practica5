<section class="container-fluid">
    <?php require 'views/navi.php'; ?>
</section>

<header class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Zona Privada de la App</h2>
            <!-- div respuestas -->
            <div id="res">
                <?php
                if (isset($_GET['res']) && !empty($_GET['res'])) {
                    echo $_GET['res'];
                }
                ?>
            </div>
        </div>
    </div>

</header>

<section class="container">
    <?php
    if (isset($_GET['views']) && !empty($_GET['views'])){
        echo print_r($_GET);
        if ($_GET['views'] == 'usuarios') {
            if (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == 'add_user' ){
                include($_SERVER['DOCUMENT_ROOT'].'/views/usuarios/form.php');
            }
            else 
            {
                include($_SERVER['DOCUMENT_ROOT'] . 'views/usuarios/listado.php');
            }
        }
    }
    ?>
</section>