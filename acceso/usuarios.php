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
                                                        <option value="nombre">Cliente
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
                        $consulta="select acceso.usuario,acceso.clave,acceso.cedula,acceso.nombre,acceso.telusuario,acceso.menu,acceso.fechaven,acceso.fechaingreso,acceso.horaingreso,acceso.estado from acceso  order by acceso.usuario";
                }
                elseif ($campo=='usuario')
                {
                    $consulta="select acceso.usuario,acceso.clave,acceso.cedula,acceso.nombre,acceso.telusuario,acceso.menu,acceso.fechaven,acceso.fechaingreso,acceso.horaingreso,acceso.estado from acceso  where acceso.usuario='$valor'";
                }
                elseif ($campo=='cedula')
                {
                    $consulta="select acceso.usuario,acceso.clave,acceso.cedula,acceso.nombre,acceso.telusuario,acceso.menu,acceso.fechaven,acceso.fechaingreso,acceso.horaingreso,acceso.estado from acceso  where acceso.cedula='$valor'";
                }
                else
                {
                        $consulta="select acceso.usuario,acceso.clave,acceso.cedula,acceso.nombre,acceso.telusuario,acceso.menu,acceso.fechaven,acceso.fechaingreso,acceso.horaingreso,acceso.estado from acceso  where acceso.nombre like '%$valor%'";
                       
                }
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                $registros=mysql_affected_rows();
                if ($registros==0)
                {
        ?>
                   <script language="javascript">
                                alert("No hay Usuarios Para mostra en la consulta?")
                                 history.back()
                  </script>
        <?
                }
                else
                {
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
                                                  <th>&nbsp;</th>
                                                <th><a href="usuarios.php">Actualizar</a></th>

                                </tr>
                                <tr>
                                        <th>&nbsp;</th>
                                        <th>Usuario</b></td>
                                         <th>Clave</b></td>
                                        <th>Documento</b></td>
                                        <th>Nombre</td>
                                        <th>Tel�fono</b></td>
                                        <th>Menu</b></td>
                                        <th>F_Vcto</b></td>
                                        <th>F_Ingreso</b></td>
                                        <th><b>H_Ingreso</b></td>
                                        <th><b>Estado</b></td>
                                  </tr>
        <?
                       $i=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th><?echo $i;?></th>
                                         <td>&nbsp;<a href="modificar.php?usuario=<?echo $filas["usuario"];?>"><?echo $filas["usuario"];?></a></td>
                                         <td>&nbsp;<?echo $filas["clave"];?></td>
                                        <td>&nbsp;<?echo $filas["cedula"];?></td>
                                        <td>&nbsp;<?echo $filas["nombre"];?></td>
                                        <td>&nbsp;<?echo $filas["telusuario"];?></td>
                                        <td>&nbsp;<?echo $filas["menu"];?></td>
                                        <td>&nbsp;<?echo $filas["fechaven"];?></td>
                                        <td>&nbsp;<?echo $filas["fechaingreso"];?></td>
                                        <td>&nbsp;<?echo $filas["horaingreso"];?></td>
                                         <td>&nbsp;<?echo $filas["estado"];?></td>

                                </tr>
        <?
                        $i=$i+1;
                        }
                }


?>
                        </table>
                        <tr><td><br></td></tr>

                        </body>
</html>
