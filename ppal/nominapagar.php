<html>

<head>
  <title>Consulta de Nomina por Zona</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($desde)):
  ?>
  <center><h4>Consulta de Nomina por Fecha</h4></center>
<form action="" method="post" width="200">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
  <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
      <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
</table>
</form>
<?
elseif (empty($desde)):
?>
  <script language="javascript">
    alert ("Error en la fecha de inicio ?")
    history.back()
  </script>
    <?
     else:
       include("../conexion.php");
         $consulta="select zona.zona from zona where
                 zona.codzona='$codigo'";
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
         $registro=mysql_num_rows($resultado);
           ?>
            <table border="0" align="center">
                <?
            while($filas=mysql_fetch_array($resultado)):
             ?>
             <tr>
              <td><?echo $filas["zona"];?></td>
              </tr>
              <?
            endwhile;
            ?>
            </table>
            <?
          include("../conexion.php");
          $consu="select nomina.*,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,periodo.desde 'inicio',periodo.hasta 'final' from empleado,periodo,zona,nomina where
          zona.codzona=periodo.codzona and
          zona.codzona=empleado.codzona and
          empleado.cedemple=nomina.cedemple and
          periodo.codigo=nomina.codigo and
          periodo.desde='$desde' and periodo.hasta='$hasta' and
          zona.codzona='$codigo'order by empleado.nomemple,empleado.apemple";
          $resulta=mysql_query($consu)or die ("Consulta incorrecta");
          $registro=mysql_num_rows($resulta);
          $registro=mysql_affected_rows();
          if ($registro!=0):
     ?>
            <center><h4>Listado de Empleados</h4></center>
            <table border="0" align="center">
              <tr class="cajas">
                <td>Para ver El Informe de las colilla, Presione Click Sobre el Cod_Nómina..</td>
              </tr>
            </table>
              <table border="0" align="center">

              <tr >
                  <th class="cajas">Item</th>
                  <th class="cajas">Cod_Nomina</th>
                  <th class="cajas">Documento</th>
                  <th class="cajas">Empleado</th>
                  <th class="cajas">Desde</th>
                  <th class="cajas">Hasta</th>
                  <th class="cajas">&nbsp;Devengado</th>
                  <th class="cajas">Deducción</th>
                   <th class="cajas">Pagado</th>
                </tr>
    <?
          $l=1;
           while($filas_s=mysql_fetch_array($resulta)):
            $devengado=number_format($filas_s["devengado"],0);
            $deduccion=number_format($filas_s["deduccion"],0);
            $neto=number_format($filas_s["neto"],0);
            ?>
         <tr  class="cajas">
                  <th><?echo $l;?></th>
                 <td><a href="imprimirnomina.php?codnomina=<?echo $filas_s["consecutivo"];?>"><?echo $filas_s["consecutivo"];?></a></td>
                 <td><?echo $filas_s["cedemple"];?></td>
                 <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["inicio"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["final"];?></td>
                 <td>&nbsp;&nbsp;<?echo $devengado;?></td>
                 <td>&nbsp;&nbsp;<?echo $deduccion;?></td>
                 <td>&nbsp;&nbsp;<?echo $neto;?></td>
                 </tr>

           <?
           $l=$l+1;
           $aux=$aux+$filas_s["neto"];
           $aux1=$aux1+$filas_s["devengado"];
           $aux2=$aux2+$filas_s["deduccion"];
            endwhile;
            $aux=number_format($aux,0);
            $aux1=number_format($aux1,0);
            $aux2=number_format($aux2,0);
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
             <center><td class="cajas"><b>Devengado:</b>&nbsp;&nbsp;<?echo $aux1;?>&nbsp;<b>Deducción:</b>&nbsp;&nbsp;<?echo $aux2;?>&nbsp;<b>Vlr_Nómina:</b>&nbsp;&nbsp;<?echo $aux;?></td></center>
            <?
          else:
            ?>
              <script language="javascript">
                alert("No Existen empleados con nomina en este Rango de Fechas Zona")
                history.back()
             </script>
            <?

         endif;
  endif;
  ?>
</table>

</body>
</html>
