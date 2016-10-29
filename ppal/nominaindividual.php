<html>
<head>
  <title>Nomina Por Empleado</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($dato)):
    ?>
  <center><h4><u>Collilas Por Empleado</u></h4></center>
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
         $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,zona where
                 zona.codzona=empleado.codzona and
                 zona.codzona='$codigo' and
                 empleado.nomina='SI' and
                 empleado.cedemple='$dato' ";
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
              $consu="select nomina.*,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,nomina where
              empleado.cedemple=nomina.cedemple and
              empleado.cedemple='$dato' order by nomina.fechap DESC";
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
                      <th class="cajas">Deducción</th>
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
                     <td><div align="right"><font color="red"><?echo $neto;?></font></div></td>
                     <td><div align="right"><?echo $devengado;?></div></td>
                     <td><div align="right"><?echo $deduccion;?></div></td>
                     <td><div align="right"><?echo $presta;?></div></td>
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
  ?>
</table>

</body>
</html>
