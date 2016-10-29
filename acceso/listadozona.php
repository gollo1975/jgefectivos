<html>
        <head>
                <title>Consulta de Usuarios</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4>Consulta de Usuarios</h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="usuario">Usuario
                                                        <option value="clave">Clave
                                                </select></td>
                                        <td><input type="text" name="valor" value="" size="40" maxlength="40"></td>
                                </tr>
                                <tr>
                                        <td colspan="2"><input type="submit" value="Buscar" class="boton"><input type="reset" value="Limpiar"class="boton"></th>
                                </tr>
                        </table>
                </form>
        <?

                include("../conexion.php");
                if (empty($valor))
                {
                        $consulta="select zona.zona,zona.nitzona,zona.permiso,zona.fechaven from zona   where zona.permiso!='' order by zona.zona";
                }
                elseif ($campo=='usuario')
                {
                    $consulta="select zona.zona,zona.nitzona,zona.permiso,zona.fechaven from zona  where zona.nitzona='$valor'";
                }
                else
                {
                        $consulta="select zona.zona,zona.nitzona,zona.permiso,zona.fechaven from zona  where zona.permiso like '%$valor%'";
                       
                }
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                $registros=mysql_affected_rows();
                                  ?>
                           <center><h4>Listado de Usuarios</h4></center>
                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                 <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                           <th><a href="listadozona.php">Actualizar</a></th>

                                </tr>
                                <tr>
                                        <th>Item</th>
                                        <td><b>Zona</b></td>
                                         <td><b>Usuario</b></td>
                                        <td><b>Clave</b></td>
                                        <td><b>F_Vcto</b></td>


                                  </tr>
        <?  $a=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th><?echo $a;?></th>
                                        <td><?echo $filas["zona"];?></td>
                                        <td><?echo $filas["nitzona"];?></td>
                                        <td><?echo $filas["permiso"];?></td>
                                         <td><?echo $filas["fechaven"];?></td>



                                </tr>
        <?     $a=$a+1;
                        }



?>
                        </table>
                        <tr><td><br></td></tr>

                        </body>
</html>
