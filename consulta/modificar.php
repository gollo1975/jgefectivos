<?
 session_start();
?>
<html>
        <head>
                <title>Consulta de Memorandos</title>
        </head>
        <body>
        <?
         if(session_is_registered("validar")):
                if (!isset($cedemple)):
                 ?>
                        <form action="" method="post">
                                <table border="1" align="center">
                               <br>
                                        <tr>
                                                <th colspan="2">Consulta de Momerandos</th>
                                        </tr>
                                        <tr>
                                                <td>Digite el Documento</td>
                                                <td><input type="text" name="cedemple" value="" size="10" maxleng="10"></td>
                                        </tr>
                                        <tr>
                                                <th colspan="2"><input type="submit" Value="Buscar">&nbsp;<input type="reset" Value="Limpiar"></th>
                                        </tr>
                                </table>
                        </form>
        <?

                elseif (empty($cedemple)):
                  ?>
                    <script language="javascript">
                       alert("Digite el documento del Empleado")
                       history.back()
                    </script>

              <?
                 else:
                     include("../conexion.php");
                     $consulta="select empleado.*,memorando.* from empleado,memorando where
                     empleado.cedemple=memorando.cedemple and empleado.cedemple='$cedemple'";
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
                      <th><a href="modificar.php">Regresar</a></th>
                       <table border="1" align="center">
                      <tr>
                        <th colspan="9">Datos Consultados</th>
                        </tr>
                        <tr>
                          <br>
                             <th>Radicado</th>
                             <th>Ducumento:</th>
                             <th>Nombre</th>
                             <th>Apellido</th>
                             <th>Fecha_Proceso</th>

                        <?
                             while($filas=mysql_fetch_array($resultado)):
                             ?>
                              <tr>
                                   <td> <a href="auxiliarmeno.php?radicado=<?echo $filas["radicado"];?>"><?echo $filas["radicado"];?></a></td>
                                   <td><?echo $filas["cedemple"];?></td>
                                   <td><?echo $filas["nomemple"];?></td>
                                   <td><?echo $filas["apemple"];?></td>
                                   <td><?echo $filas["fecha"];?></td>
                               </tr>
                                <?
                             endwhile;
                          endif;
                   endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;                   
                                  ?>
                </table>
         </body>
</html>

