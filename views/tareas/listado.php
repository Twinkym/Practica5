<h3>Listado de Tareas</h3>
<a class="btn btn-primary" href="http://practica5.test/index.php?views=tareas&&action=add_tareas">Nueva Tareas</a>
<table id="table-tareas" class="table table-striped table-primary table-hover">
    <tbody>
        <?php 
            if(isset($ListaTareas)){
                foreach($ListaTareas as $ListaTarea){
                    echo print_r($ListaTarea);
                    if($_SESSION['rowid'] == $ListaTarea['idUser']){
                        $horap = new DateTimeImmutable($ListaTarea['horaProgram']);

                        $finicio = date_format(date_create($ListaTarea['finicio']),'d-m-y');
                        $ffinal = date_format(date_create($ListaTarea['ffinal']),'d-m-y');
                        $i=1;
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$_SESSION['user']."</td>";
                        echo "<td>".$ListaTarea['nombre']."</td>";
                        echo "<td>".$ListaTarea['descrip']."</td>";
                        echo '<td'.$horap->format('d-m-Y H:i:s').'</td>';
                        echo '<td>'.$finicio.'</td>';
                        echo '<td>'.$ffinal.'</td>';
                        echo '<td>'.$ListaTarea['estado'].'</td>';
                        echo '<td><a class="btn btn-succes" href="index.php?views=tareas&&action=edit_tareas&&id='.base64_encode($ListaTarea['rowid']).'"><i class="fa-solid fa-pen-to-square"></i></a></td>';
                        echo '<td><a class="btn btn-danger" href="index.php?views=tareas&&action=edit_tareas&&id='.base64_encode($ListaTarea['rowid']).'"><i class="fa-solid fa-pen-to-square"></i></a></td>';
                        echo "</tr>";
                        $i++;
                    }
                }
            }
        ?>
    </tbody>
    <tfoot>
    </tfoot>
</table>