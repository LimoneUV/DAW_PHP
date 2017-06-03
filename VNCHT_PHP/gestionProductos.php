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
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <h1>GESTIÓN DE LOS PRODUCTOS</h1>
        <?php
            session_start();
            
            $recurso = mysqli_connect("localhost", "root", "", "tiendaonline");
            if (mysqli_connect_error()) {
                printf("Error conectando a la base de datos: %s\n",mysqli_connect_error());
                exit();
            }
            
            $resultado = mysqli_query($recurso,"SELECT id_producto, nombre, descripcion, existencias, precio FROM productos");
            $_SESSION["resultado"] = $resultado;
            ?>
            <form method="post" action="./update.php">
            <table>
                <tr>
                    <th aling="center">
                        Referencia del producto 
                    </th>
                    <th>
                        Nombre del producto
                    </th>
                    <th aling="center">
                        Descripción
                    </th>
                    <th aling="center">
                        Existencias
                    </th>
                    <th>
                        Precio Unitario
                    </th>
                    <th aling="center">
                        Modificado/Agregado?
                    </th>
                    <th aling="center">
                        Eliminar?
                    </th>
                </tr>
            <?php
            $i = 0;
            while ($fila = mysqli_fetch_row($resultado)){
                ?>
            <tr>
                <?php
                    $referencia     = $fila[0];
                    $nombre         = $fila[1];
                    $descripcion    = $fila[2];
                    $existencias    = $fila[3];
                    $precio         = $fila[4];
                ?>
                <td aling="center"><?php echo $referencia ?></td>
                <td aling="center"><input type="text" name="nom_<?php echo $i?>" value="<?php echo $nombre ?>"/></td>
                <td aling="center"><input type="text" name="des_<?php echo $i?>" value="<?php echo $descripcion ?>"/></td>
                <td aling="center"><input type="text" name="exi_<?php echo $i?>" value="<?php echo $existencias ?>"/></td>
                <td aling="center"><input type="text" name="pre_<?php echo $i?>" value="<?php echo $precio ?>"/></td>
                <td aling="center"><input type="checkbox" name="added_<?php echo $i?>" value="modRow=<?php echo $i?>"></td>
                <td aling="center"><input type="checkbox" name="delet_<?php echo $i?>" value="delRow=<?php echo $i?>"></td>
            </tr>
                <?php
                $i = $i + 1;
            }
            $_SESSION['numprod'] = $i + 1;
            $_SESSION['newid'] = $referencia + 1;
            ?>
            <tr>
                <td></td>
                <td aling="center"><input type="text" name="nom_new" value=""/></td>
                <td aling="center"><input type="text" name="des_new" value=""/></td>
                <td aling="center"><input type="text" name="exi_new" value=""/></td>
                <td aling="center"><input type="text" name="pre_new" value=""/></td>
                <td aling="center"><input type="checkbox" name="added_new" value="modRow=new"></td>
            </tr>
            <td colspan="6" align="center"><input type="submit" name="actualizar" value="UPDATE"/></td>
            </table>
                </form><?php
        ?>
    </body>
</html>
