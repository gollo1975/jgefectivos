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
                                                        <option value="nombre">Nombres
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
                        $consulta="select accesoasociado.* from accesoasociado order by fechar DESC";
                }
                elseif ($campo=='usuario')
                {
                    $consulta="select accesoasociado.* from accesoasociado  where usuario='$valor'";
                }
                else
                {
                        $consulta="select accesoasociado.* from accesoasociado  where nombre like '%$valor%'";
                       
                }
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                $registros=mysql_affected_rows();
                                  ?>
                          
                           <table border="1" align="center">
                                <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>   
                                                 <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                           <th><a href="listadoasociado.php">Actualizar</a></th>

                                </tr>
                                <tr>
                                        <th>Item</th>
                                        <td><b>Usuario</b></td>
                                         <td><b>Clave</b></td>
                                        <td><b>Asociado</b></td>
                                        <td><b>Telefono</b></td>
                                        <td><b>Celular</b></td>
                                        <td><b>Email</b></td>
                                        <td><b>Fecha_Pro.</b></td>  


                                  </tr>
        <?  $a=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th><?echo $a;?></th>
                                        <td><?echo $filas["usuario"];?></td>
                                        <td><?echo $filas["clave"];?></td>
                                        <td><?echo $filas["nombre"];?></td>
                                         <td><?echo $filas["telefono"];?></td>
                                         <td><?echo $filas["celular"];?></td>
                                         <td><?echo $filas["email"];?></td>
                                         <td><?echo $filas["fechar"];?></td>



                                </tr>
        <?     $a=$a+1;
                        }



?>
                        </table>
                        <tr><td><br></td></tr>

                        </body>
</html>
