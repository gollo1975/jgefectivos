<html>
        <head>
                <title>Tipo de Recibos</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4>Tipos de Recibos</h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo" id="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="idrecibo">id
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
                        $consulta="select tiporecibo.idrecibo,tiporecibo.descripcion,tiporecibo.porcentaje from tiporecibo  order by descripcion";
                }
                elseif ($campo=='idrecibo')
                {
                    $consulta="select tiporecibo.idrecibo,tiporecibo.descripcion,tiporecibo.porcentaje from tiporecibo where tiporecibo.idrecibo='$valor'";
                }
                else
                {
                        $consulta="select tiporecibo.idrecibo,tiporecibo.descripcion,tiporecibo.porcentaje from tiporecibo where tiporecibo.descripcion like '%$valor%'";

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
                                           <th>&nbsp;</th>

                                </tr>
                                <tr>
                                        <td><b>Item</b></td>
                                        <td><b>Código</b></td>
                                        <td><b>Descripción</b></td>
                                         <td><b>Porcentaje</b></td>


                                  </tr>
        <?
                       $i=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <td>&nbsp;<?echo $i;?></td>
                                        <td><div align="center"><a href="ModificarTipoRecibo.php?codigo=<?echo $filas["idrecibo"];?>"><?echo $filas["idrecibo"];?></a></div></td>
                                        <td><?echo $filas["descripcion"];?></td>
                                        <td><div align="right"><?echo $filas["porcentaje"];?></div></td>

                                </tr>
        <?
                 $i=$i+1;
                        }



?>
                        </table>
                        <tr><td><br></td></tr>

                        </body>
</html>
