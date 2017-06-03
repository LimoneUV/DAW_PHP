<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form form method="post" action="gestionUsuarios.php">
            <table>
                <tr>
                    <td><label>User: </label></td>
                    <td><input type="text" name="nick"/></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Buscar" name="buscar"/></td>
                </tr>
            </table>
        </form>
        <?php
            $recurso=mysqli_connect("localhost","root","","tiendaonline");
            if(mysqli_connect_error()){
                printf("Error conectando a la BD tiendaonline: %s\n",mysqli_connect_error());
                exit();
}
            if(isset($_POST['buscar']) || isset($_POST['eliminar']) || isset($_POST['modificar'])){
                if(!isset($_POST['eliminar']) && !isset($_POST['modificar'])){
            $nick=$_POST['nick'];
            ($resultado=mysqli_query($recurso,
                                    "SELECT password,nombre,apellidos,email,direccion,fecha_nac,tipo,estado"
                    . "              FROM user WHERE nick LIKE '$nick'"));
                
            $fila=mysqli_fetch_row($resultado);
                $password=$fila[0];
                $nombre=$fila[1];
                $apellidos=$fila[2];
                $email=$fila[3];
                $direccion=$fila[4];
                $fecha_nac=$fila[5];
                $tipo=$fila[6];
                $estado=$fila[7];
                }
                else{
                    $nick=null;
                    $password=null;
                    $nombre=null;
                    $apellidos=null;
                    $email=null;
                    $direccion=null;
                    $fecha_nac=null;
                    $tipo=null;
                    $estado=null;
                }
        ?>
        <form method="post" action="gestionUsuarios.php">
            <table>
                <tr>
                    <td><label>User:</label></td>
                    <td><input type="text" name="nickf" value="<?PHP echo $nick ?>" readonly="readonly"/></td>
                    <td><label>Password:</label></td>
                    <td><input type="text" name="password" value="<?PHP echo $password ?>"/></td>
                </tr>
                <tr>
                    <td><label>Nombre:</label></td>
                    <td><input type="text" name="nombre" value="<?PHP echo $nombre ?>"/></td>
                    <td><label>Apellidos:</label></td>
                    <td><input type="text" name="apellidos" value="<?PHP echo $apellidos ?>"/></td>
                </tr>
                <tr>
                    <td><label>Email:</label></td>
                    <td><input type="text" name="email" value="<?PHP echo $email ?>"/></td>
                </tr>
                <tr>
                    <td><label>Dirección:</label></td>
                    <td><input type="text" name="direccion" value="<?PHP echo $direccion ?>"/></td>
                </tr>
                <tr>
                    <td><label>Fecha nacimiento:</label></td>
                    <td><input type="text" name="fecha_nac" value="<?PHP echo $fecha_nac ?>"/></td>
                </tr>
                <tr>
                    <td><label>Tipo:</label></td>
                    <td><input type="text" name="tipo" value="<?PHP echo $tipo ?>"/></td>
                    <td><label>Estado:</label></td>
                    <td><input type="text" name="estado" value="<?PHP echo $estado ?>"/></td>
                </tr>
                <tr>
                    <td><input type="submit" name="modificar" value="Modificar"/></td>
                    <td><input type="submit" name="eliminar" value="Eliminar"/></td>
                </tr>
            </table>
        </form>
        <?PHP
        if(!isset($_POST['buscar']) || isset($_POST['eliminar']) || isset($_POST['modificar'])){
            $nickf=$_POST['nickf'];
            $passwordf=$_POST['password'];
            $nombref=$_POST['nombre'];
            $apellidosf=$_POST['apellidos'];
            $emailf=$_POST['email'];
            $direccionf=$_POST['direccion'];
            $fecha_nacf=$_POST['fecha_nac'];
            $tipof=$_POST['tipo'];
            $estadof=$_POST['estado'];
            if(isset($_POST['modificar'])){
                ($resultado=mysqli_query($recurso,
                                    "UPDATE user"
                        . "         SET nombre='$nombref',apellidos='$apellidosf',password='$passwordf',email='$emailf',direccion='$direccionf',fecha_nac='$fecha_nacf',tipo='$tipof',estado='$estadof'"
                        . "         WHERE nick LIKE '$nickf'"));
                printf("El usuario se ha modificado\n");
            }
            if(isset($_POST['eliminar'])){
                ($resultado=mysqli_query($recurso,
                                    "DELETE FROM user"
                        . "         WHERE nick LIKE '$nickf'"));
                printf("El usuario se ha eliminado\n");
            }
            }
            }
        ?>
    </body>
</html>
