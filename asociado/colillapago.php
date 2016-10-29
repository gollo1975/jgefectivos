<html>
<head>
  <title>Nomina Por Empleado</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
       include("../conexion.php");
         $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where
                 empleado.nomina='SI' and
                 empleado.cedemple='$xcodigo'";
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
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
                  <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                  </tr>
                  <?
                endwhile;
                ?>
                </table>
                <?
              $consu="select nomina.*,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,zona.zona from empleado,nomina,zona where
                  zona.codzona=nomina.codzona and
				  empleado.cedemple=nomina.cedemple and
                  empleado.cedemple='$xcodigo'  order by nomina.consecutivo";
              $resulta=mysql_query($consu)or die ("Consulta incorrecta");
              $registro=mysql_num_rows($resulta);
              $registro=mysql_affected_rows();
              if ($registro!=0):
         ?>
                <center><h4>Listado de Colillas</h4></center>
                <table border="0" align="center">
                  <tr class="cajas">
                    <th>Para ver El Informe de las Colilla, Presione Click Sobre el Cod_Nómina.</th>
                  </tr>
                </table>
                  <table border="0" align="center">

                  <tr>
                       <th class="cajas">Item</th>
                      <th class="cajas">Cod_Nomina</th>
                      <th class="cajas">Cod_Periodo</th>
                       <th class="cajas">F_Proceso</th>
                      <th class="cajas">F_Inicio</th>
                      <th class="cajas">F_Corte</th>
                      <th class="cajas">Devengado</th>
                      <th class="cajas">Deducido</th>
                      <th class="cajas">Prestación</th>
					   <th class="cajas">Pagado</th>
                    </tr>
                <?
                $l=1;
                while($filas_s=mysql_fetch_array($resulta)):
                   $CodN=$filas_s["consecutivo"];
                   $neto=number_format($filas_s["neto"],0);
                  $devengado=number_format($filas_s["devengado"],0);
                   $deduccion=number_format($filas_s["deduccion"],0);
                   $presta=number_format($filas_s["presta"],0);
                   $consC="select nomina.estadoc from nomina where
                   nomina.consecutivo='$CodN' and nomina.estadoc='ACTIVA'  order by nomina.consecutivo";
                   $resulC=mysql_query($consC)or die ("Consulta incorrecta de colillas");
                   $regiC=mysql_num_rows($resulC);
                   if ($regiC!=0):
                            ?>
	                     <tr  class="cajas">
	                     <th><?echo $l;?></th>
	                     <td><a href="../nomina/imprimir.php?codigo=<?echo $filas_s["consecutivo"];?>"><?echo $filas_s["consecutivo"];?></a></td>
	                     <td><?echo $filas_s["codigo"];?></td>
	                     <td><?echo $filas_s["fechap"];?></td>
	                     <td><font color="red"><?echo $filas_s["desde"];?></td>
	                     <td><font color="blue"><?echo $filas_s["hasta"];?></td>
						 <td><?echo $filas_s["zona"];?></td>
	                    <td><div align="right"><?echo $devengado;?></div></td>
	                     <td><div align="right"><?echo $deduccion;?></div></td>
	                     <td><div align="right"><?echo $presta;?></div></td>
						  <td><div align="right"><?echo $neto;?></div></td>
                       </tr>

                           <?
	                   $l=$l+1;
	                   $aux=$aux+$filas_s["neto"];
	                   $aux1=$aux1+$filas_s["devengado"];
	                   $aux2=$aux2+$filas_s["deduccion"];
	                   $aux3=$aux3+$filas_s["presta"];
                     endif;
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
 ?>
</table>

</body>
</html>
