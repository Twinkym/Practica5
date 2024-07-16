<h3>Listado de Usuarios</h3>
<a class="btn btn-primary" href="index.php?views=usuarios&&action=add_user">Nuevo Usuario</a>
<Table id="table-users" class="table table-striped table-dark table-hover">
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
        if (isset($DatosUsers)) {
            $i = 1;
            foreach ($DatosUsers as $DatosUser) {
                echo print_r($DatosUser);
                $checked = ($DatosUser['status'] == 2) ? "checked" : "";}
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $DatosUser->user . '</td>';
                echo '<td>' . $DatosUser->email . '</td>';
                echo '<td>' . $DatosUser->estado . '</td>';
                echo '<td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" >
                    </div>
                </td>';
                echo '<td><i class="fa-solid fa-pen-to-square"></i></td>';
                echo '<td><i class="fa-solid fa-trash"></i></td>';
                echo '</tr>';
                $i++;
            }
        ?>
    </tbody>
    <tfoot></tfoot>
</Table>

<script>let table = new DataTable('table-users');</script>