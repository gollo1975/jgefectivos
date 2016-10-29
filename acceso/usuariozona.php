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
                                                        <option value="cedula">Documento
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
                        $consulta="select accesozona.usuario,accesozona.clave,accesozona.cedula,accesozona.nombre,accesozona.telefono,accesozona.codigo,zona.zona,accesozona.fechaven,accesozona.estado from accesozona,zona where zona.codzona=accesozona.codzona  order by accesozona.usuario";
                }
                elseif ($campo=='usuario')
                {
                    $consulta="select accesozona.usuario,accesozona.clave,accesozona.cedula,accesozona.nombre,accesozona.telefono,,accesozona.fechavenaccesozona.codigo,zona.zona,accesozona.estado from accesozona,zona  where zona.codzona=accesozona.codzona and accesozona.usuario='$valor'";
                }
                else
                {
                        $consulta="select accesozona.usuario,accesozona.clave,accesozona.cedula,accesozona.nombre,accesozona.telefono,accesozona.codigo,zona.zona,accesozona.fechaven,accesozona.estado from accesozona,zona  where zona.codzona=accesozona.codzona and accesozona.cedula like '%$valor%'";
                       
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
                                                <th>&nbsp;</th>
                                                 <th>&nbsp;</th>
                                                 <th>&nbsp;</th>
                                                 <th>&nbsp;</th>
                                       <th>&nbsp;</th>
                                                <th><a href="usuariozona.php">Actualizar</a></th>

                                </tr>
                                <tr>
                                        <th>&nbsp;</th>
                                        <th><b>Código</b></td>
                                        <th><b>Usuario</b></td>
                                         <th><b>Clave</b></td>
                                        <th><b>Documento</b></td>
                                        <th><b>Nombre</td>
                                        <th><b>Teléfono</b></td>
                                        <th><b>F_Vcto</b></td>
                                        <th><b>Zona</b></td>
                                        <th><b>Estado</b></td>

                                  </tr>
        <?
                          $t=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th><?echo $t;?></th>
                                         <td>&nbsp;<a href="modificarzona.php?CodU=<?echo $filas["codigo"];?>"><?echo $filas["codigo"];?></a></td>
                                          <td>&nbsp;<?echo $filas["usuario"];?></td>
                                         <td>&nbsp;<?echo $filas["clave"];?></td>
                                        <td>&nbsp;<?echo $filas["cedula"];?></td>
                                        <td>&nbsp;<?echo $filas["nombre"];?></td>
                                        <td>&nbsp;<?echo $filas["telefono"];?></td>
                                        <td>&nbsp;<?echo $filas["fechaven"];?></td>
                                        <td>&nbsp;<?echo $filas["zona"];?></td>
                                        <td>&nbsp;<?echo $filas["estado"];?></td>  


                                </tr>
        <?
                         $t=$t+1;
                        }



?>
                        </table>
                        <tr><td><br></td></tr>

                        </body>
</html>
