<html>

<head>
  <title>Extracto de Nomina</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($cedula)):
  ?>
  <center><h4>Extracto de Nomina</h4></center>
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
  <tr>
    <td><b>Documento de Identidad:&nbsp;</b></td>
    <td colspan="3"><input type="text" name="cedula" value="" size="15" maxlegth="15"></td>
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
elseif (empty($cedula)):
?>
  <script language="javascript">
    alert ("Digite el documento del Asociado ?")
    history.back()
  </script>
    <?
     else:
       include("../conexion.php");
         $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where
                 empleado.cedemple='$cedula'";
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
         $registro=mysql_num_rows($resultado);
         if ($registro==0):
    ?>
          <script language="javascript">
            alert ("Este digitado no existe en sistema ?")
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

          include("../conexion.php");
          $consu="select nomina.*,empleado.nomemple,empleado.apemple from empleado,nomina where
          empleado.cedemple=nomina.cedemple and
          nomina.desde between '$desde' and '$hasta' and
          empleado.cedemple='$cedula'order by nomina.desde DESC";
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
              
              <tr  class="cajas">
                   <th>Item</th>
                  <th>Cod_Nomina</th>
                  <th>Cod_Periodo</th>
                  <th>Desde</th>
                  <th>Hasta</th>
                  <th>Pagado</th>
                  <th>Devengado</th>
                  <th>Deducido</th>
                  <th>Prestación</th>
                </tr>
    <?
           $i=$i+1;
            while($filas_s=mysql_fetch_array($resulta)):
            $neto=number_format($filas_s["neto"],0);
            $devengado=number_format($filas_s["devengado"],0);
            $deduccion=number_format($filas_s["deduccion"],0);
            $presta=number_format($filas_s["presta"],0);

                        ?>
         <tr  class="cajas">
                   <th><?echo $i;?></th>
                 <td><a href="imprimir.php?codigo=<?echo $filas_s["consecutivo"];?>"><?echo $filas_s["consecutivo"];?></a></td>
                 <td><?echo $filas_s["codigo"];?></td>
                  <td>&nbsp;&nbsp;<?echo $filas_s["desde"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["hasta"];?></td>
                 <td>&nbsp;&nbsp;<?echo $neto;?></td>
                 <td>&nbsp;&nbsp;<?echo $devengado;?></td>
                 <td>&nbsp;&nbsp;<?echo $deduccion;?></td>
                 <td>&nbsp;&nbsp;<?echo $presta;?></td>

               </tr>

           <?
           $i=$i+1;
           $con=$con+$filas_s["neto"];
           $con1=$con1+$filas_s["devengado"];
           $con2=$con2+$filas_s["deduccion"];
           $con3=$con3+$filas_s["presta"];
            endwhile;
            $con=number_format($con,0);
            $con1=number_format($con1,0);
            $con2=number_format($con2,0);
            $con3=number_format($con3,0);
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
             <center><td class="cajas"><b>Vlr_Pagado:</b>&nbsp;&nbsp;<?echo $con;?>&nbsp;&nbsp;<b>Vlr_Devengado:</b>&nbsp;&nbsp;<?echo $con1;?>&nbsp;&nbsp;<b>Vlr_Deducido:</b>&nbsp;&nbsp;<?echo $con2;?>&nbsp;&nbsp;<b>Vlr_Presta.:</b>&nbsp;&nbsp;<?echo $con3;?></td></center>
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
  endif;
  ?>
</table>

</body>
</html>
