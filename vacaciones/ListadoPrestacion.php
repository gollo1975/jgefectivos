<html>
        <head>
                <title>Prestaciones Sociales</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4>Consulta de Zona </h4></center>
                  <form action="" method="post">
                        <table border="0" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="nropresta">Nro_Prestación
                                                        <option value="cedemple">Documento
                                                        <option value="nombres">Empleado
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
                        $consulta="select prestacion.*,zona.zona from sucursal,zona,prestacion,empleado
                               where sucursal.codsucursal=zona.codsucursal and
                               zona.codzona=empleado.codzona and
                               prestacion.cedemple=empleado.cedemple and
                               prestacion.control='ACTIVA' order by zona.zona";
                elseif ($campo=='nropresta'):
                        $consulta="select prestacion.*,zona.zona from sucursal,zona,prestacion,empleado
                               where sucursal.codsucursal=zona.codsucursal and
                               zona.codzona=empleado.codzona and
                               zona.estado='ACTIVA' and
                               prestacion.cedemple=empleado.cedemple and
                               prestacion.control='ACTIVA' and
                               prestacion.nropresta='$valor'";
                elseif ($campo=='cedemple'):
                        $consulta="select prestacion.*,zona.zona from sucursal,zona,prestacion,empleado
                               where sucursal.codsucursal=zona.codsucursal and
                               zona.codzona=empleado.codzona and
                               zona.estado='ACTIVA' and
                               prestacion.cedemple=empleado.cedemple and
                               prestacion.control='ACTIVA' and
                               prestacion.cedemple='$valor' order by prestacion.nropresta DESC";
                else:
                        $consulta="select prestacion.*,zona.zona from sucursal,zona,prestacion,empleado
                               where sucursal.codsucursal=zona.codsucursal and
                               zona.codzona=empleado.codzona and
                               zona.estado='ACTIVA' and
                               prestacion.cedemple=empleado.cedemple and
                               prestacion.control='ACTIVA' and
                               prestacion.nombres like '%$valor%' order by prestacion.nombres";
                endif;
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                if ($registros==0):
        ?>
                   <script language="javascript">
                                alert("No Existen Registros en la consulta")
                                history.back()
                  </script>
        <?
                else:
        ?>
                         
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
                                                <th><a href="ListadoPrestacion.php">Actualizar</a></th>
                                </tr>
                                <tr>
                                        <th>&nbsp;</th>
                                        <td><b>Nro_Prest.</b></td>
                                        <td><b>Documento</b></td>
                                        <td><b>Empleado</b></td>
                                        <td><b>Zona</b></td>
                                        <td><b>F_Proceso</td>
                                        <td><b>Vlr_Generado</b></td>
                                        <td><b>Vlr_Pagar</b></td>
                                </tr>
        <?             $i=1;
                        while ($filas=mysql_fetch_array($resultado)):
                               $Valor1=number_format($filas["total"],0);
                               $Valor2=number_format($filas["totalp"],0);
                                   ?>
                                <tr class="cajas">
                                        <th><? echo $i;?></th>
                                         <td><a href="imprimirpresta.php?nropresta=<?echo $filas["nropresta"];?>"><?echo $filas["nropresta"];?></a></td>
                                        <td><?echo $filas["cedemple"];?></td>
                                        <td><?echo $filas["nombres"];?></td>
                                        <td><?echo $filas["zona"];?></td>
                                        <td><?echo $filas["fechapro"];?></td>
                                        <td><div align="center"><?echo $Valor1;?></div></td>
                                        <td><div align="center"><?echo $Valor2;?></div></td>

                                </tr>
        <?
                     $Suma=$Suma+$filas["total"];
                     $i=$i+1;
                       endwhile;
                       $Suma=number_format($Suma,0);
         ?>
                        </table>
                        <div align="center"><b><h5>Totales:&nbsp;$<?echo $Suma;?></h5></b></div>
          <?
           endif;
         ?>


        </body>
</html>
