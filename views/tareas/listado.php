
<h3>Listado de Tareas</h3>
<a class="btn btn-primary" href="http://practica5.test/index.php?views=tareas&&action=add_tarea">Nueva Tareas</a>
<table id="table-tareas" class="table table-striped table-primary table-hover">
    <thead>
        <tr>
            <th>Num.</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Hora programada</th>
            <th>Fecha de inicio</th>
            <th>Fecha final</th>
            <th>Estado</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($ListaTareas)){
                $i=1;
                foreach($ListaTareas as $ListaTarea){                    
                    if($_SESSION['rowid'] == $ListaTarea['idUser']){
                        $horap = new DateTimeImmutable($ListaTarea['horaProgram']);                        
                        $finicio = date_format(date_create($ListaTarea['finicio']),'d-m-Y');
                        $ffinal = date_format(date_create($ListaTarea['ffinal']),'d-m-Y');                       
                        echo "<tr>";
                        echo "<td>".$i."</td>";                    
                        echo "<td>".$_SESSION['user']."</td>";
                        echo "<td>".$ListaTarea['nombre']."</td>";
                        echo '<td>'.$ListaTarea['descrip'].'</td>';                    
                        echo '<td>'.$horap->format('d-m-Y H:i').'</td>';
                        echo '<td>'.$finicio.'</td>';
                        echo '<td>'.$ffinal.'</td>';
                        $color = EstadoColor($ListaTarea['estado']);
                        echo '<td><i id="ico-e" class="fa-solid fa-circle-dot" style="color:'.$color.'" ></i>'.$ListaTarea['estado'].'</td>';    
                        echo '<td><a class="btn btn-success" href="index.php?views=tareas&&action=edit_tarea&&id='.base64_encode($ListaTarea['rowid']).'"><i class="fa-solid fa-pen-to-square"></i></a></td>';
                        echo '<td><a class="btn btn-danger" href="index.php?views=tareas&&action=delete_tarea&&id='.base64_encode($ListaTarea['rowid']).'"><i class="fa-solid fa-trash"></i></a></td>';
                        echo "</tr>";
                        $i++;
                    }             
                }
            }
        ?>
    </tbody>
    <tfoot></tfoot>
</table>
<script>
    let table = new DataTable('#table-tareas');
    var jsId = 'TareasJS'; 
    if (!document.getElementById(jsId)) {
        var body = document.getElementsByTagName('body')[0];
        var script = document.createElement('script');
        script.id = jsId;
        script.src = 'https://practica5.test/tareas.js';       
        body.appendChild(script);
    }
</script>