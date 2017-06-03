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
        <h1>GESTIÓN DE LOS PEDIDOS</h1>
        <?php
        session_start();

        $recurso = mysqli_connect("localhost", "root", "", "tiendaonline");
        if (mysqli_connect_error()) {
            printf("Error conectando a la base de datos: %s\n", mysqli_connect_error());
            exit();
        }

        $resultado = mysqli_query($recurso, "SELECT id_pedido, fecha_pedido, precio_pedido, nick, estado FROM pedidos");
        $_SESSION["resultado"] = $resultado;
        ?>
        <form method="post" action="./updatePedidos.php">
            <table>
                <tr>
                    <th aling="center">
                        ID Pedido 
                    </th>
                    <th>
                        Fecha de realización del pedido
                    </th>
                    <th aling="center">
                        Precio total del pedido
                    </th>
                    <th aling="center">
                        Cliente
                    </th>
                    <th>
                        Estado actualizado?
                    </th>
                    <th aling="center">
                        Estado actual
                    </th>
                </tr>
                <?php
                $i = 0;
                while ($fila = mysqli_fetch_row($resultado)) {
                    ?>
                    <tr>
                        <?php
                        $id = $fila[0];
                        $fecha = $fila[1];
                        $precio = $fila[2];
                        $cliente = $fila[3];
                        $estado = 1;
                        if ($fila[4] == 'pendiente') {
                            $estado = 0;
                        }
                        ?>
                        <td aling="center"><?php echo $id ?><input type="hidden" name="id_<?php echo $i?>"/></td>
                        <td aling="center"><input type="text" name="fecha_<?php echo $i ?>" value="<?php echo $fecha ?>"/></td>
                        <td aling="center"><input type="text" name="preci_<?php echo $i ?>" value="<?php echo $precio ?>"/></td>
                        <td aling="center"><input type="text" name="clien_<?php echo $i ?>" value="<?php echo $cliente ?>"/></td>
                        <td aling="center"><input type="checkbox" name="modded_<?php echo $i ?>" value="modRow=<?php echo $i ?>"></td>
                        <?php if ($estado == 0) { ?>
                            <td aling="center">
                                <select name="input_estado_<?php echo $i?>">
                                    <option value="pendiente" selected="selected">Pendiente</option>
                                    <option value="enviado">Enviado</option>
                                </select>
                            </td>
                            <?php } else { ?>
                            <td aling="center">
                                <select name="input_estado_<?php echo $i?>">
                                    <option value="pendiente">Pendiente</option>
                                    <option value="enviado" selected="selected">Enviado</option>
                                </select>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php
                        $i = $i + 1;
                    }
                    $_SESSION['numped'] = $i;
                    ?>
                <td colspan="6" align="center"><input type="submit" name="actualizar" value="UPDATE"/></td>
            </table>
        </form>
    </body>
</html>
