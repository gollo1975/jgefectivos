
<html>
        <head>
                <title>Listado de Zonas</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4>Consulta de Zonas </h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="codzona">Cod_Zona
                                                        <option value="zona">Zona
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
                        $consulta="select zona.codzona,zona.zona,zona.dirzona,zona.nitzona,zona.telzona,sso_sucursal.nombre from sucursal,zona,sso_sucursal 
						 where zona.nomina='SI' and 
						       zona.estado='ACTIVA' and
                               sucursal.codsucursal=zona.codsucursal and 
							   sso_sucursal.codigo_sucursal_pk=zona.codigo_sso_sucursal_fk order by zona.zona";
                }
                elseif ($campo=='codzona')
                {
                        $consulta="select zona.codzona,zona.zona,zona.dirzona,zona.nitzona,zona.telzona,sso_sucursal.nombre from sucursal,zona,sso_sucursal
						where  zona.nomina='SI' and
						zona.estado='ACTIVA' and
						sucursal.codsucursal=zona.codsucursal and 
				       sso_sucursal.codigo_sucursal_pk=zona.codigo_sso_sucursal_fk  and
						zona.codzona = '$valor'";

                }
                else
                {
                        $consulta="select zona.codzona,zona.zona,zona.dirzona,zona.nitzona,zona.telzona,sso_sucursal.nombre from sucursal,zona,sso_sucursal 
						where zona.nomina='SI' and
						zona.estado='ACTIVA' and
						sucursal.codsucursal=zona.codsucursal and 
					    sso_sucursal.codigo_sucursal_pk=zona.codigo_sso_sucursal_fk and
						zona.zona like '%$valor%'order by zona.zona";
                       
                }
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                $registros=mysql_affected_rows();
                if ($registros==0)
                {
        ?>
                   <script language="javascript">
                                alert("No hay Zonas Para mostra en la consulta?")
                                 history.back()
                  </script>
        <?
                }
                else
                {
                      ?>
                           <center><h4>Listado Zonas</h4></center>
                           <table border="1" align="center">
                         
                                
                                <tr>
								        <th><b>#</b></th> 
                                        <th><b>Cod_Zona</b></th>
                                        <th><b>Zona</b></th>
                                        <th><b>Dirección</th>
                                        <th><b>Teléfono</b></th>
                                        <th><b>Nit_Zona</b></th>
										 <th><b>Sucursal_Pila</b></th>
                                </tr>
        <?
                      $i=$i+1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th><? echo $i;?></th>
                                         <td>&nbsp;<a href="listado1.php?cod=<?echo $filas["codzona"];?>"><?echo $filas["codzona"];?></a></td>
                                        <td>&nbsp;<?echo $filas["zona"];?></td>
                                        <td>&nbsp;<?echo $filas["dirzona"];?></td>
                                        <td>&nbsp;<?echo $filas["telzona"];?></td>
                                        <td>&nbsp;<?echo $filas["nitzona"];?></td>
										<td>&nbsp;<?echo $filas["nombre"];?></td>

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
