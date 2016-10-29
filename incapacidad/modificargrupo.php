<html>
        <head>
                <title>Listado de códigos</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4>Listado de diagnostico</h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="1">Códigos
                                                        <option value="2">Descripción
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
                if (empty($valor)):

                        $consulta="select control.codigo,control.concepto from control
                        order by control.codigo";
                else:
                    if($campo=='0'):
                      ?> 
                          <script language="javascript">
                                alert("Debe de seleccionar una opcion del sistema")
                                history.back()
                         </script>
                      <?
                    else: 
                      if($campo=='1'):
                         $consulta="select control.codigo,control.concepto from control  where control.codigo='$valor'";
                      else:
                        $consulta="select control.codigo,control.concepto from control  where control.concepto like '%$valor%' order by control.codigo";
                    endif;   
                      endif;     
                endif;

                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                if ($registros==0)
                {
        ?>
                   <script language="javascript">
                                alert("No Existen Registros")
                                history.back()
                  </script>
        <?
                }
                else
                {
        ?>
                           <center><h4>Resultado de la busqueda</h4></center>
                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>
                                                <th>&nbsp;</th>
                                                 <th>&nbsp;</th>

                                                <td><a href="modificargrupo.php">Actualizar</a></td>
                                </tr>
                                <tr>
                                        <th>Item</th>
                                        <td><b>Código</b></td>
                                        <td><b>Diagnóstico</b></td>
                                </tr>
        <?
        $i=1;
                        while ($filas=mysql_fetch_array($resultado)):
                             ?>
                                <tr class="cajas">
                                        <th><? echo $i;?></th>
                                         <td><a href="detalladogrupo.php?cod=<?echo $filas["codigo"];?>"><?echo $filas["codigo"];?></a></td>
                                        <td><?echo $filas["concepto"];?></td>

                                </tr>
        <?
                                                $i=$i+1;
                        endwhile;

                        }
?>
                        </table>
                        

        </body>
</html>
