<html>

<head>
  <title>Consulta de Nomina por Zona</title>
      <LINK  REL="stylesheet" HREF="../formato.css"  type="text/css">

</head>

<?
  if (!isset($campo)):
     include ("../conexion.php");
  ?>
  <center><h4><u>Novedades de N�mina</u></h4></center>
<form action="" method="post" width="150">
  <table border="1" align="center">
  <tr><td>
   <table border="0" align="center">
  <tr class="fondo">
       <th colspan="8"><br></th>
  </tr>
  <tr>
    <td><b>Desde:&nbsp;</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td> <b>Hasta:&nbsp;</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
   <tr>
     <td><b>Zona:</b></td>
         <td colspan="5"><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select * from zona where zona.nomina='SI' order by zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
         </select></td>
     </tr>
  <tr><td><br></td></tr>
   <tr>
    <th colspan="2">
      <input type="submit" value="Buscar">
    </th>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Digite la fecha de inicio ?")
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
      $consulta="select novedadnomina.* from zona,novedadnomina where
                    zona.codzona=novedadnomina.codzona and
                    novedadnomina.desde between '$desde'and'$hasta' and
                    zona.codzona='$campo'order by novedadnomina.nombre";
                   $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                   $registros=mysql_num_rows($resultado);
                   if($registros!=0):
                       $T=1;  
                        while ($filas=mysql_fetch_array($resultado)):
                        $codigo=$filas["codnovedad"];
                        $basico=number_format($filas["basico"],0);
                        $pagado=number_format($filas["pagado"],0);
                      ?>
                             <table border="1" align="center" width="719">
                              <tr>
                              <td>
                              <div align="center"></h5>Detallado de Novedades</h5></div>
                              <table border="0" align="center"width="719">
                                 <tr class="cajasletras">
                                 <td colspan="12" ><b>Documento:</b>&nbsp;<?echo $filas["cedemple"];?></td><td colspan="18"><b>Asociado:</b>&nbsp;<?echo $filas["nombre"];?></td><td colspan="12"><b>Fecha_Proceso:</b>&nbsp;<?echo $filas["fechap"];?></td>
                                 </tr>
                                 <tr class="cajasletras">
                                 <td colspan="22"><b>ERS:</b>&nbsp;<?echo $filas["zona"];?></td><td colspan="8"><b>Desde:</b>&nbsp;<?echo $filas["desde"];?></td><td colspan="10"><b>Hasta:</b>&nbsp;<?echo $filas["hasta"];?></td>
                                 </tr>
                                 <tr class="cajasletras">
                                 <td colspan="10" ><b>Fecha_Imp:</b>&nbsp;<?echo date("Y-m-d");?></td><td colspan="30"><b>Nota:</b>&nbsp;<?echo $filas["nota"];?></td>
                                 </tr>
                                      <?
                               $direccion=$filas["dirmaestro"];
                               $tele=$filas["telmaestro"];
                               $fax=$filas["faxmaestro"];
                                $consu="select denovedanomina.* from denovedanomina,novedadnomina
                             where novedadnomina.codnovedad=denovedanomina.codnovedad and
                                   novedadnomina.codnovedad='$codigo' order by denovedanomina.porcentaje";
                        $resul=mysql_query($consu) or die("consulta incorrecta 1 ");
                        $reg=mysql_num_rows($resul);
                        if($reg==0):
                          ?>
                           <script language="javascript">
                             alert("No existen Detalles de Nomina ? ")
                             </script>
                          <?
                        else:
                           ?>
                           <table border="0" aling="center" width="714">
                             <tr>
                             <td>
                             <table border="0" align="center" width="714" >
                                  <tr class="cajas">
                                    <td><b>C�d_Comp.</b></td>
                                    <td><b>Descripci�n</b></td>
                                    <td><b><div align="right">Vlr_Hora</div></b></td>
                                    <td><b><div align="right">Nro_Horas</div></b></td>
                                    <td><b><div align="right">Deducci�n</div></b></td>
                                    <td><b><div align="right">Salarios</div></b></td>
                                    </tr>
                               <?
                               $Thora=0;$Td=0;$Ts=0;$Tp=0;
                                while ($filas_s=mysql_fetch_array($resul)):
                                $con=number_format($filas_s["deduccion"],0);
                                if($filas_s["salario"]==0):
                                   $Total= round($filas_s["vlrhora"] * $filas_s["nrohora"]);
                                    $con1=number_format($Total,0);
                                else:
                                   $Total= $filas_s["salario"];
                                   $con1=number_format($Total,0);
                                endif;

                                ?>
                                <tr class="cajasletras">
                                    <td><?echo $filas_s["codsala"];?></td>
                                    <td><?echo $filas_s["concepto"];?></td>
                                    <td align="right">$<?echo $filas_s["vlrhora"];?></td>
                                    <td align="right">$<?echo $filas_s["nrohora"];?></td>
                                    <td align="right">$<?echo $con;?></td>
                                   <td align="right">$<?echo $con1;?></td>
                                   <?
                                   $Thora=$Thora+$filas_s["nrohora"];
                                   $Td=$Td+$filas_s["deduccion"];
                                   $Ts=$Ts+$Total;
                               endwhile;
                                $Tp=$Ts+$Td;
                                $Td=number_format($Td,0);
                                $Ts=number_format($Ts,0);
                                $Tp=number_format($Tp,0);
                               ?>
                                </table>
                                </td></tr>
                                <td class="cajasletras"><div align="left"><b>Pag.:&nbsp;<?echo $T;?></div><div align="center"><b>Nro_Horas:</b>&nbsp;<?echo $Thora;?>&nbsp;&nbsp;&nbsp;<b>Deducci�n:</b>&nbsp;<?echo $Td;?>&nbsp;<b>Devengado:</b>&nbsp;$<?echo $Ts;?>&nbsp;<b>Neto:</b>&nbsp;$<?echo $Tp;?></div></td>
                               </table>

                               </tr>
                               <?
                          endif;
                         $T=$T+1;
                        endwhile;
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
