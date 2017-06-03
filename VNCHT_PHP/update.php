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

        //$resultado = $_SESSION["resultado"] ;
        $recurso = mysqli_connect("localhost", "root", "", "tiendaonline");
        $i = 0;
        $variable = 'added_' . $i;
        $variabl2 = 'delet_' . $i;
        while ($i < $_SESSION['numprod']) {
            $modificado = 'modRow=' . $i;
            $eliminado  = 'delRow=' . $i;
            if (isset($_POST[$variable])) {
                if ($modificado === (string) $_POST[$variable]) {
                    $index = $i + 1;
                    $nombre = 'nom_' . $i;
                    $descripcion = 'des_' . $i;
                    $existencias = 'exi_' . $i;
                    $precio = 'pre_' . $i;
                    //echo"UPDATE productos SET nombre='$_POST[$nombre]', descripcion='$_POST[$descripcion]', existencias='$_POST[$existencias]', precio='$_POST[$precio]' WHERE id_producto='$index'";
                    mysqli_query($recurso, "UPDATE productos SET nombre='$_POST[$nombre]', descripcion='$_POST[$descripcion]', existencias='$_POST[$existencias]', precio='$_POST[$precio]' WHERE id_producto='$index'");
                    ?>
                    <h1>La operación para actualizar el producto con referencia <?php echo $index?> se ha completado</h1>
                    <?php
                }
            } else if (isset($_POST[$variabl2])){
                if ($eliminado === (string) $_POST[$variabl2]) {
                    $nombre = 'nom_' . $i;
                    echo"DELETE FROM productos WHERE id_producto='$nombre'";
                    mysqli_query($recurso, "DELETE FROM productos WHERE nombre='$_POST[$nombre]'");
                    ?>
                    <h1>La operación para eliminar el producto con referencia <?php echo $index?> se ha completado</h1>
                    <?php
                }
            }
            $i = $i + 1;
            $variable = 'added_' . $i;
            $variabl2 = 'delet_' . $i;
        }
        $variable = 'added_new';
        if (isset($_POST[$variable])) {
            $new_id         = $_SESSION['newid'];
            $nombre         = 'nom_new';
            $descripcion    = 'des_new';
            $existencias    = 'exi_new';
            $precio         = 'pre_new';
            //echo"UPDATE productos SET nombre='$_POST[$nombre]', descripcion='$_POST[$descripcion]', existencias='$_POST[$existencias]', precio='$_POST[$precio]' WHERE id_producto='$index'";
            mysqli_query($recurso, "INSERT INTO productos (nombre, descripcion, existencias, precio) VALUES ('$_POST[$nombre]', '$_POST[$descripcion]', '$_POST[$existencias]','$_POST[$precio]')");
            ?>
            <h1>La operación para agregar un producto se ha completado. Su referencia es <?php echo $new_id?></h1>
            <?php
        }
        ?>
            <a href="http://localhost/VNCHT_PHP/gestionProductos.php"> Puedes volver a la gestión de productos desde aquí </a>
    </body>
</html>