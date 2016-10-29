<html>
        <head>
                <title>Documentos contables</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4>Tipos de Comprobante</h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo" id="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="id">id
                                                        <option value="descripcion">Descripción
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
                        $consulta="select tipocomprobante.id,tipocomprobante.descripcion from tipocomprobante  order by descripcion";
                }
                elseif ($campo=='id')
                {
                    $consulta="select tipocomprobante.id,tipocomprobante.descripcion from tipocomprobante where tipocomprobante.id='$valor'";
                }
                else
                {
                        $consulta="select tipocomprobante.id,tipocomprobante.descripcion from tipocomprobante where tipocomprobante.descripcion like '%$valor%'";

                }
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                $registros=mysql_affected_rows();
                                  ?>
                           <table border="0" align="center">
                             <tr><td class="cajas">Para Modificar el registro, presione click en el campo [CODIGO]</td></tr>
                           </table>
                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>
                                                <th>&nbsp;</th>
                                                 <th>&nbsp;</th>
                                           <th>&nbsp;</th>

                                </tr>
                                <tr>
                                        <td><b>Item</b></td>
                                        <td><b>Código</b></td>
                                         <td><b>Descripción</b></td>


                                  </tr>
        <?
                       $i=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <td>&nbsp;<?echo $i;?></td>
                                        <td><div align="center"><a href="modificar.php?codigo=<?echo $filas["id"];?>"><?echo $filas["id"];?></a></div></td>
                                        <td><?echo $filas["descripcion"];?></td>

                                </tr>
        <?
                 $i=$i+1;
                        }



?>
                        </table>
                        <tr><td><br></td></tr>

                        </body>
</html>
