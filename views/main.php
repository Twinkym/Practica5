<section class="container-fluid">
    <?php require 'views/navi.php' ?>
</section>
<header class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Zona Privada de la App</h2>
            <!-- div respuestas  -->
            <div id="res" >
                <?php
                    if(isset($_GET['res']) && !empty($_GET['res'])){
                        echo $_GET['res'];
                    }
                ?>
            </div>
        </div>
    </div>        
</header>

<section class="container">   
    <?php
    if(isset($_GET['views']) && !empty($_GET['views'])){
        if($_GET['views'] == 'usuarios'){
            if(isset($_GET['action']) && !empty($_GET['action'])){
                if($_GET['action'] == 'add_user' || $_GET['action'] == 'edit_user'){
                    include ($_SERVER['DOCUMENT_ROOT'].'/views/usuarios/form.php');
                }
            }           
            else
            {
                include $_SERVER['DOCUMENT_ROOT'].'/views/usuarios/listado.php';
            }            
        }
        if($_GET['views'] == 'tareas'){
            if(isset($_GET['action']) && !empty($_GET['action'])){
                if($_GET['action'] == 'add_tareas' || $_GET['action'] == 'edit_tarea'){
                    include ($_SERVER['DOCUMENT_ROOT'].'/views/tareas/form.php');
                }
            }           
            else
            {
                include ($_SERVER['DOCUMENT_ROOT'].'/views/tareas/listado.php');
            }            
        }
    }
   ?>                 
</section>

