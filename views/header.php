<header class="container" style="height:150px;">
    <!-- div respuestas -->
    <div id="res">
        <?php
        if (isset($_GET['res']) && !empty($_GET['res'])){
            echo $_GET['res'];
        }
        ?>
    </div>
</header>