<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            session_start();
            $recurso = mysqli_connect("localhost", "root", "", "tiendaonline");
            $i = 0;
            $variable = 'modded_' .$i;
            $id = 'id_'.$i;
            while ($i < $_SESSION['numped']) {
            $modded  = 'modRow=' . $i;
            $estado = 'input_estado_' . $i;
            if (isset($_POST[$variable])) {
                if ($modded === (string) $_POST[$variable]) {
                    $index = $_POST[$id];
                    $state = $_POST[$estado];
                    echo "UPDATE productos SET estado = '$state' WHERE id_pedido='$index'";
                    mysqli_query($recurso, "UPDATE productos SET estado = '$state' WHERE id_pedido='$index'");
                    ?>
                    <h1>La operación para actualizar el estado del pedido con referencia <?php echo $index?> se ha completado</h1>
                    <?php
                }
            }
            $i = $i + 1;
            $modificado = 'modded_' . $i;
            $id = 'id_'.$i;
        }
        ?>
                    <a href="http://localhost/VNCHT_PHP/gestionPedidos.php"> Puedes volver a la gestion de los pedidos desde aquí </a>
    </body>
</html>
