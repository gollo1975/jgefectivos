<html>
<head>
  <title>Consulta de colilla de pago</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($dato)):
    ?>
  <center><h4>Colilla de pago</h4></center>
<form action="" method="post" width="200">
  <table border="0" align="center">
  <tr><td><br></td></tr>
  <tr>
    <td><b>Documento de Identidad:</b></td>
    <td colspan="3"><input type="text" name="dato" value="" size="15" maxlegth="15"></td>
    </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      </td>
  </tr>
</table>
</form>
<?
elseif (empty($dato)):
?>
  <script language="javascript">
    alert ("Digite el documento del Empleado ?")
    history.back()
  </script>
    <?
 else:
    include("../conexion.php");
    $res="select empleado.cedemple from empleado,acceso
          where  empleado.cedemple=acceso.usuario and
          empleado.cedemple='$dato'";
     $respue=mysql_query($res)or die ("Error de busqueda");
     $cont=mysql_affected_rows();
     if($cont!=0):
         $consu="select nomina.*,empleado.nomemple,empleado.apemple from empleado,nomina where
	              empleado.cedemple=nomina.cedemple and
	              empleado.cedemple='$dato' order by nomina.consecutivo";
	              $resulta=mysql_query($consu)or die ("Consulta incorrecta");
	              $registro=mysql_num_rows($resulta);
	              $registro=mysql_affected_rows();
	              if ($registro!=0):
	                ?>
	                <center><h4>Listado de Colillas</h4></center>
	                <table border="0" align="center">
	                  <tr class="cajas">
	                    <td>Para ver El Informe de las Colilla, Presione Click Sobre el Cod_Nómina.</td>
	                  </tr>
	                </table>
	                  <table border="0" align="center">

	                  <tr >
	                       <th class="cajas">Item</th>
	                      <th class="cajas">Cod_Nomina</th>
	                      <th class="cajas">Cod_Periodo</th>
	                       <th class="cajas">Fecha_Pro.</th>
	                      <th class="cajas">Desde</th>
	                      <th class="cajas">Hasta</th>
	                      <th class="cajas">Pagado</th>
	                      <th class="cajas">Devengado</th>
	                      <th class="cajas">Deducido</th>
	                      <th class="cajas">Prestación</th>
	                    </tr>
	                <?
	                $l=1;
	                while($filas_s=mysql_fetch_array($resulta)):
	                   $neto=number_format($filas_s["neto"],0);
	                  $devengado=number_format($filas_s["devengado"],0);
	                   $deduccion=number_format($filas_s["deduccion"],0);
	                   $presta=number_format($filas_s["presta"],0);
	                            ?>
	                     <tr  class="cajas">
	                     <th><?echo $l;?></th>
						 
						 <!--prueba-->
	                     <td><a href="../nomina/imprimir.php?codigo=<?echo $filas_s["consecutivo"];?>"><?echo $filas_s["consecutivo"];?></a></td>
	                     <td><?echo $filas_s["codigo"];?></td>
	                     <td>&nbsp;&nbsp;<?echo $filas_s["fechap"];?></td>
	                     <td>&nbsp;&nbsp;<?echo $filas_s["desde"];?></td>
	                     <td>&nbsp;&nbsp;<?echo $filas_s["hasta"];?></td>
	                     <td>&nbsp;&nbsp;<?echo $neto;?></td>
	                     <td>&nbsp;&nbsp;<?echo $devengado;?></td>
	                     <td>&nbsp;&nbsp;<?echo $deduccion;?></td>
	                     <td>&nbsp;&nbsp;<?echo $presta;?></td>
	                       </tr>
	                   <?
	                   $l=$l+1;
	                   $aux=$aux+$filas_s["neto"];
	                   $aux1=$aux1+$filas_s["devengado"];
	                   $aux2=$aux2+$filas_s["deduccion"];
	                   $aux3=$aux3+$filas_s["presta"];
	                     endwhile;
	                     $aux=number_format($aux,0);
	                     $aux1=number_format($aux1,0);
	                     $aux2=number_format($aux2,0);
	                     $aux3=number_format($aux3,0);
	                    ?>
	                    </table>
	                    <tr><td>&nbsp;</td></tr>
	                     <center><td class="cajas"><b>Pagado:</b>&nbsp;<?echo $aux;?>&nbsp;<b>Devengado:</b>&nbsp;<?echo $aux1;?>&nbsp;<b>Deducción:</b>&nbsp;<?echo $aux2;?>&nbsp;<b>Prestación:</b>&nbsp;<?echo $aux3;?></td></center>
	                <?
	              else:
	               ?>
	                <script language="javascript">
	                  alert("Este Empleado no Tiene Colillas Generadas ..")
	                  history.back()
	                </script>
	               <?
	              endif;

    else:
	         $consulta="select empleado.nomemple,empleado.apemple from empleado,zona,sucursal where
	                sucursal.codsucursal=zona.codsucursal and
	                zona.codzona=empleado.codzona and
	                 sucursal.codsucursal='$codigo' and
	                 empleado.nomina='SI' and
	                 empleado.cedemple='$dato'";
	         $resultado=mysql_query($consulta)or die ("error al buscar colillas");
	         $registro=mysql_num_rows($resultado);
	         if ($registro==0):
	    ?>
	          <script language="javascript">
	            alert ("Lo siento, no esta autorizado para ver las colillas de este Empleado ?")
	            history.back()
	          </script>
	   <?
	         else:
	             ?>
	              <table border="0" align="center">
	                <?
	                while($filas=mysql_fetch_array($resultado)):
	                  ?>
	                 <tr>
	                  <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["apemple"];?></td>
	                  </tr>
	                  <?
	                endwhile;
	                ?>
	                </table>
	                <?
	              $consu="select nomina.*,empleado.nomemple,empleado.apemple from empleado,nomina where
	              empleado.cedemple=nomina.cedemple and
	              empleado.cedemple='$dato' order by nomina.consecutivo";
	              $resulta=mysql_query($consu)or die ("Consulta incorrecta");
	              $registro=mysql_num_rows($resulta);
	              $registro=mysql_affected_rows();
	              if ($registro!=0):
	                ?>
	                <center><h4>Listado de Colillas</h4></center>
	                <table border="0" align="center">
	                  <tr class="cajas">
	                    <td>Para ver El Informe de las Colilla, Presione Click Sobre el Cod_Nómina.</td>
	                  </tr>
	                </table>
	                  <table border="0" align="center">

	                  <tr >
	                       <th class="cajas">Item</th>
	                      <th class="cajas">Cod_Nomina</th>
	                      <th class="cajas">Cod_Periodo</th>
	                       <th class="cajas">Fecha_Pro.</th>
	                      <th class="cajas">Desde</th>
	                      <th class="cajas">Hasta</th>
	                      <th class="cajas">Pagado</th>
	                      <th class="cajas">Devengado</th>
	                      <th class="cajas">Deducido</th>
	                      <th class="cajas">Prestación</th>
	                    </tr>
	                <?
	                $l=1;
	                while($filas_s=mysql_fetch_array($resulta)):
	                   $neto=number_format($filas_s["neto"],0);
	                  $devengado=number_format($filas_s["devengado"],0);
	                   $deduccion=number_format($filas_s["deduccion"],0);
	                   $presta=number_format($filas_s["presta"],0);
	                            ?>
	                     <tr  class="cajas">
	                     <th><?echo $l;?></th>
	                     <td><a href="../nomina/imprimir.php?codigo=<?echo $filas_s["consecutivo"];?>"><?echo $filas_s["consecutivo"];?></a></td>
	                     <td><?echo $filas_s["codigo"];?></td>
	                     <td>&nbsp;&nbsp;<?echo $filas_s["fechap"];?></td>
	                     <td>&nbsp;&nbsp;<?echo $filas_s["desde"];?></td>
	                     <td>&nbsp;&nbsp;<?echo $filas_s["hasta"];?></td>
	                     <td>&nbsp;&nbsp;<?echo $neto;?></td>
	                     <td>&nbsp;&nbsp;<?echo $devengado;?></td>
	                     <td>&nbsp;&nbsp;<?echo $deduccion;?></td>
	                     <td>&nbsp;&nbsp;<?echo $presta;?></td>
	                       </tr>
	                   <?
	                   $l=$l+1;
	                   $aux=$aux+$filas_s["neto"];
	                   $aux1=$aux1+$filas_s["devengado"];
	                   $aux2=$aux2+$filas_s["deduccion"];
	                   $aux3=$aux3+$filas_s["presta"];
	                     endwhile;
	                     $aux=number_format($aux,0);
	                     $aux1=number_format($aux1,0);
	                     $aux2=number_format($aux2,0);
	                     $aux3=number_format($aux3,0);
	                    ?>
	                    </table>
	                    <tr><td>&nbsp;</td></tr>
	                     <center><td class="cajas"><b>Pagado:</b>&nbsp;<?echo $aux;?>&nbsp;<b>Devengado:</b>&nbsp;<?echo $aux1;?>&nbsp;<b>Deducción:</b>&nbsp;<?echo $aux2;?>&nbsp;<b>Prestación:</b>&nbsp;<?echo $aux3;?></td></center>
	                <?
	              else:
	               ?>
	                <script language="javascript">
	                  alert("Este Empleado no Tiene Colillas Generadas ..")
	                  history.back()
	                </script>
	               <?
	              endif;
                   endif;

       endif;
   endif;
  ?>
</table>

</body>
</html>
