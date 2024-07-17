<h3>Listado de Usuarios</h3>

<a class="btn btn-primary" href="index.php?views=usuarios&&action=add_user">Nuevo Usuario</a>

<table id="table-users" class="table table-striped table-primary table-hover">
    <thead>
        <tr>
            <th>Num.</th>
            <th>User</th>
            <th>Email</th>
            <th>Estado</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($DatosUsers)){
                $i=1;
                foreach($DatosUsers as $DatosUser){
                   if($DatosUser['status'] == 2){ $checked="checked"; }else{ $checked=""; }
                    echo "<tr>";
                    echo "<td>".$i."</td>";
                    echo "<td>".$DatosUser['name']."</td>";
                    echo "<td>".$DatosUser['email']."</td>";
                    echo '<td>                    
                        <div class="form-check form-switch">
                            <input onchange="Cstatus" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" '.$checked.' >                        
                        </div>                    
                    </td>';
                    echo '<td><a class="btn btn-success" href="index.php?views=usuarios&&action=edit_user&&id='.base64_encode($DatosUser['rowid']).'"><i class="fa-solid fa-pen-to-square"></i></a></td>';
                    echo '<td><a class="btn btn-danger" href="index.php?views=usuarios&&action=delete_user&&id='.base64_encode($DatosUser['rowid']).'"><i class="fa-solid fa-trash"></i></a></td>';
                    echo "</tr>";
                    $i++;
                }
            }
        ?>
    </tbody>
    <tfood>

    </tfood>
</table>

<script>
let table = new DataTable('#table-users');

function Cstatus(id) {
    Data = {'action':'CAMBIAR_STATUS_USER', 'id':id}

    $.post('controllers/usuarios.php', Data, function(res){
        alert(res);
    })

    $.get('controllers/usuarios.php', Daata,function(res) {
    });
}
</script>