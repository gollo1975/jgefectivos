<html>

<head>
  <title>Consulta de Nomina por Zona</title>
      <LINK  REL="stylesheet" HREF="../formato.css"  type="text/css">

</head>

<?
  if (!isset($desde)):
  ?>
  <center><h4><u>Consolidado de Nomina</u></h4></center>
<form action="" method="post" width="200">
  <table border="1" align="center">
  <tr><td>
   <table border="0" align="center">
  <tr class="fondo">
       <th colspan="8"><br></th>
  </tr>
  <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
     <tr><td><br></td></tr>
   <tr>
    <th colspan="2">
      <input type="submit" value="Buscar">
      <input type="reset" value="Limpiar">
    </th>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($desde)):
?>
  <script language="javascript">
    alert ("Digite la fecha de Incio ?")
    history.back()
  </script>
    <?
else:
?>
  <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
   </script>
   <body onload="imprimir()" >
                <?
  include ("../conexion.php");
      $consulta="select maestro.codmaestro, maestro.dvmaestro, maestro.nomaestro, sucursal.sucursal, maestro.dirmaestro, maestro.telmaestro, maestro.faxmaestro, zona.zona, nomina.*, empleado.nomemple, empleado.nomemple1, empleado.apemple, empleado.apemple1, empleado.cuenta, observacion.descripcion, eps.eps, pension.pension, contrato.cargo from maestro, nomina, empleado, eps, pension, sucursal, zona, periodo, observacion, contrato
                where maestro.codmaestro = sucursal.codmaestro and
                 sucursal.codsucursal=zona.codsucursal and
                 sucursal.codsucursal=observacion.codsucursal and
                 zona.codzona=periodo.codzona and
                 empleado.cedemple=nomina.cedemple and
                 empleado.codeps=eps.codeps and
                 empleado.codpension=pension.codpension and
                 empleado.colilla=' ' and
                 empleado.codemple=contrato.codemple and
                 periodo.codigo=nomina.codigo and
                  periodo.desde='$desde' and periodo.hasta='$hasta' and
                 zona.codzona='$codigo' and
                 (contrato.fechater = '0000-00-00' or contrato.contrato = (select max(contrato.contrato) from contrato inner join empleado on contrato.codemple = empleado.codemple inner join nomina on nomina.cedemple = empleado.cedemple where nomina.consecutivo='$codigo')) order by empleado.nomemple,empleado.apemple";
                   $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                   $registros=mysql_num_rows($resultado);
                   if($registros!=0):
                        while ($filas=mysql_fetch_array($resultado))
                                                    {
                        $codnomina=$filas["consecutivo"];
                        $basico=number_format($filas["basico"],0);
                        $pagado=number_format($filas["pagado"],0);
                ?>
                              <table border="1" align="center" width="719" height="486" >
                              <tr>
                               <tr class="cajasletras"><td colspan="60"><?echo $filas["descripcion"];?></td></tr>
                              <td>
                              <table border="0" align="center"width="719" >

                              <tr>
                               <th colspan="25"align="center" class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>EXTRACTO DE SALARIOS</u></th><td colspan="25" class="cajas"><b>Nro_Extracto:</b>&nbsp;<?echo $filas["consecutivo"];?></td>
                                </tr>
                               <tr><td><br></td></tr>
                               <tr>
                                 <td colspan="50" class="cajas"><b>Nit:</b>&nbsp;<?echo $filas["codmaestro"];?>-<?echo $filas["dvmaestro"];?><b>&nbsp;&nbsp;Empresa:</b>&nbsp;<?echo $filas["nomaestro"];?></td>
                               </tr>
                                <tr class="cajasletras">
                                 <td colspan="12" ><b>Sucursal:</b>&nbsp;<?echo $filas["sucursal"];?></td><td colspan="10" ><b>Cod_Periodo:</b>&nbsp;<?echo $filas["codigo"];?></td><td colspan="10" ><b>Salario:</b>&nbsp;$<?echo $basico;?></td>
                                 </tr>
                                 <tr class="cajasletras">
                                 <td colspan="12" ><b>Vlr_Periodo:</b>&nbsp;$<?echo $pagado;?></td><td colspan="10" ><b>Periodo_Pago:</b>&nbsp;<?echo $filas["periodo"];?></td><td colspan="13" ><b>Tipo_Proceso:</b>&nbsp;<?echo $filas["tiempo"];?></td>
                                 </tr>
                                 <tr class="cajasletras">
                                 <td colspan="12" ><b>Documento:</b>&nbsp;<?echo $filas["cedemple"];?></td><td colspan="18" ><b>Empleado:</b>&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td><td colspan="10" ><b>Cuenta:</b>&nbsp;<?echo $filas["cuenta"];?></td>
                                 </tr>
                                <tr class="cajasletras">
                                 <td colspan="12" ><b>ERS:</b>&nbsp;<?echo $filas["zona"];?></td>
								 <td colspan="10"><b>Cargo: </b><?php echo $filas["cargo"];?></td>
								 <td colspan="8"><b>Desde:</b>&nbsp;<?echo $filas["desde"];?></td>
								 <td colspan="10" ><b>Hasta:</b>&nbsp;<?echo $filas["hasta"];?></td>
                                 </tr>
                                 <tr class="cajasletras">
                                 <td colspan="12" ><b>Fecha_Proceso:</b>&nbsp;Medellín&nbsp;<?echo $filas["fechap"];?></td><td colspan="10" ><b>Fecha_Imp:</b>&nbsp;<?echo date("Y-m-d");?></td><td colspan="8"><b>Eps:</b>&nbsp;<?echo $filas["eps"];?></td><td colspan="8"><b>Pensión:</b>&nbsp;<?echo $filas["pension"];?></td>
                                 </tr>
                                      <?
                               $direccion=$filas["dirmaestro"];
                               $tele=$filas["telmaestro"];
                               $fax=$filas["faxmaestro"];
                                $consu="select denomina.* from salario,denomina,nomina
                             where salario.codsala=denomina.codsala and
                                    nomina.consecutivo=denomina.consecutivo and
                                   nomina.consecutivo='$codnomina' order by denomina.salario";
                        $resul=mysql_query($consu) or die("consulta incorrecta 1 ");
                        $reg=mysql_num_rows($resul);
                        if($reg==0):
                          ?>
                           <script language="javascript">
                             alert("No existen Detalles de Nomina ? ")
                             history.back()
                             </script>
                          <?
                        else:
                           ?>
                           <table border="1" aling="center" width="714">
                             <tr>
                             <td>
                             <table border="0" align="center" width="714" >
                                  <tr class="cajas">
                                    <td><b>Código</b></td>
                                    <td><b>Descripción</b></td>
                                    <th><b><div align="right">Nro_Horas</div></b></td>
                                    <th><b><div align="right">Vlr_Hora</div></b></td>
                                     <th><b><div align="right">Porcentaje</div></b></td>
                                    <th><b><div align="right">Deducción</div></b></td>
                                    <th><b><div align="right">Devengado</div></b></td>
                                    </tr>
                               <?
                               $a=0;
                               $b=0;
                               $c=0;
                               $con2=0;
                               $con3=0;
                               $con4=0;
                                while ($filas_s=mysql_fetch_array($resul)):
                                $con=number_format($filas_s["deduccion"],0);
                                $con1=number_format($filas_s["salario"],0);
                                $con6=number_format($filas_s["vlrhora"],0);
                                ?>
                                <tr class="cajasletras">
                                    <td><?echo $filas_s["codsala"];?></td>
                                    <td><?echo $filas_s["descripcion"];?></td>
                                    <td align="right"><?echo $filas_s["nrohora"];?></td>
                                    <td align="right"><?echo $con6;?></td>
                                    <td align="right"><?echo $filas_s["porcentaje"];?>%</td>
                                    <td align="right"><?echo $con;?></td>
                                   <td align="right">$<?echo $con1;?></td>
                                   <?
                                  $con2=$con2+$filas_s["deduccion"];
                                  $con3=$con3+$filas_s["salario"];
                                  $con4=$con3+$con2;
                               endwhile;
                               $a=number_format($con2,0);
                               $b=number_format($con3,0);
                               $c=number_format($con4,0);
                               ?>
                                </table>
                               </td></tr>
                               <tr class="cajasletras">
                               <td width="720" align="center"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deducciones:</b>&nbsp;$<?echo $a;?><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Devengado:</b>&nbsp;&nbsp;$<?echo $b;?><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Neto_Pagar:</b>&nbsp;&nbsp;$<?echo $c;?></td>
                               </tr>
                               </table>
                               <tr class="cajasletras">
                               <td width="720" align="center"><b>Dirección:</b>&nbsp;&nbsp;<?echo $direccion;?><b>&nbsp;Pbx:</b>&nbsp;<?echo $tele;?><b>&nbsp;Fax:</b>&nbsp;<?echo $fax;?></td>
                               </tr>
                               <?
                          endif;
                        }
                      else:
                      ?>
                         <script language="javascript">
                            alert("No hay registros con este rango de Fechas ?")
                            history.back()
                         </script>
                         <?
                      endif;
                           ?>
                          </table>
                          </td></tr>
                        </table>
       <?
 endif;
       ?>


</body>
</html>
