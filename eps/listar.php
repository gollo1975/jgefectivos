<html>
        <head>
                <title>Listado de Eps</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select * from eps";
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                if ($registros==0):
                 ?>
                   <script language="javascript">
                     alert("No Existen Registros")
                     history.back()
                   </script>
                <?
                else:

                      ?>
                      <center><h4>Listado de Eps</h4></center>
                              <table border="0"align="center">
                                <tr class="cajas">
                                  <td>Para Ver los Empleados por Eps, Presione Click sobre el Cod_Eps...</td>
                                </tr>
                              </table>
                                       <table border="0" align="center">
                                <tr>
                                        <td colspan="9"></td>
                                </tr>
                                <tr class="cajas">
                                 <td><b>&nbsp;&nbsp;Cod_Eps</b></td>
                                 <td><b>&nbsp;&nbsp;Eps</b></td>
                                  <td><b>&nbsp;&nbsp;Direccion</b></td>
                                  <td><b>&nbsp;&nbsp;Telefono</b></td>
                                  <td><b>&nbsp;&nbsp;Municipio</b></td>
                                </tr>
        <?
                        while ($filas=mysql_fetch_array($resultado)):
                        ?>
                                <tr class="cajas">
                                        <td>&nbsp;&nbsp;<a href="maestroeps.php?campo=<?echo $filas["codeps"];?>"><?echo $filas["codeps"];?></a></td>
                                        <td>&nbsp;&nbsp;<?echo $filas["eps"];?></td>
                                        <td>&nbsp;&nbsp;<?echo $filas["direps"];?></td>
                                        <td>&nbsp;&nbsp;<?echo $filas["teleps"];?></td>
                                        <td>&nbsp;&nbsp;<?echo $filas["municipio"];?></td>
                                </tr>
        <?
                       endwhile;
                 endif;
        ?>
           </table>
     </body>
</html>
