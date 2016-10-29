<html>

<head>
<title>Exportar Novedades </title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if (!isset($desde)):
?>
<center><h4>Exportar Novedades </h4></center>
  <form action="" method="post">
    <table border="0" align="center">
     <tr><td><br></td></tr>
      <tr>
        <td colspan="2" class="fondo"></td>
      </tr>
       <tr>
        <td><b>Fecha_Inicio:</b></td>
         <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlength="10">&nbsp;</td>
       </tr>
       <tr>
        <td><b>Fecha Final:</b></td>
         <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10">&nbsp;</td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
           <input type="reset" value="Limpiar" class="boton"></td>
        </tr>
        
    </table>

  </form>
   <?
elseif (empty($desde)):
   ?>
   <script language="javascript">
     alert("Debe colocar la fecha inicio")
     history.back()
   </script>
   <?
   else:
     include("../conexion.php");
     $variable="select zona.zona from zona where
                 zona.codzona='$codzona'";
         $resultado=mysql_query($variable)or die("consulta incorrecta ");
        $registro=mysql_num_rows($resultado);
          ?>
          <table border="0" align="center">
              <?
             while($filas=mysql_fetch_array($resultado)):
             ?>
               <table border="0" align="center">
                <tr class="cajas">
                 <td colspan="10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas["zona"];?></td>
                </tr>
                <tr class="cajas">
                  <td colspan="1"><b>Desde:&nbsp;&nbsp;</b><?echo $desde;?></td>
                  <td colspan="1"><b>Hasta:&nbsp;&nbsp;</b><?echo $hasta;?></td>
                </tr>
               </table>

             <?
              endwhile;
               ?>
               </table>
              <?
              $variable1="select novedadnomina.*,costo.centro,empleado.nomemple from zona,novedadnomina,empleado,costo where
                    zona.codzona=novedadnomina.codzona and
                    zona.codzona=empleado.codzona and
                    empleado.cedemple=novedadnomina.cedemple and
                    empleado.codcosto=costo.codcosto and
                    novedadnomina.desde between '$desde'and'$hasta' and
                    zona.codzona='$codzona'order by costo.centro,empleado.nomemple";
        $resultado1=mysql_query($variable1)or die("consulta incorrecta $variable1");
        $registro=mysql_num_rows($resultado1);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("No hay novedades de Nomina en este rango de Fechas ?")
            history.back()
          </script>
         <?
         else:
             header("Content-type: application/vnd.ms-excel");
             header("Content-Disposition: attachment; filename=Novedadades de Nomina.xls");
             header("Pragma: no-cache");
             header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
             header("Expires: 0");
         ?>
          <table border="1" align="center">
           <tr >
              <td style='font-weight:bold;font-size:1.1em;'>Item</td>
              <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
               <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
               <td style='font-weight:bold;font-size:1.1em;'>Hora Extra Ordi.</td>
               <td style='font-weight:bold;font-size:1.1em;'>Hora Extra Diurna Festiva</td>
               <td style='font-weight:bold;font-size:1.1em;'>Domi_Compensatorio</td>
               <td style='font-weight:bold;font-size:1.1em;'>Domi No Comp.</td>
               <td style='font-weight:bold;font-size:1.1em;'>Hora_Nocturna</td>
               <td style='font-weight:bold;font-size:1.1em;'>Recargo_Nocturno</td>
               <td style='font-weight:bold;font-size:1.1em;'>Retorno_Coop.</td>
               <td style='font-weight:bold;font-size:1.1em;'>Hora Noctura Festiva</td>
               <td style='font-weight:bold;font-size:1.1em;'>Otros Dctos</td>
               <td style='font-weight:bold;font-size:1.1em;'>Observación</td>
              </tr>
              <?
              $i=$i+1;
             while($filas_s=mysql_fetch_array($resultado1)):
             $aux=number_format($filas_s["otros"],0);
             ?>
               <tr class="cajas">
                 <td><?echo $i;?></a></td>
                <td><?echo $filas_s["cedemple"];?></td>
                <td><?echo $filas_s["nombre"];?></td>
                 <td><?echo $filas_s["hed"];?></td>
                 <td><?echo $filas_s["hedf"];?></td>
                 <td><?echo $filas_s["dc"];?></td>
                 <td><?echo $filas_s["dnc"];?></td>
                 <td><?echo $filas_s["hn"];?></td>
                 <td><?echo $filas_s["rn"];?></td>
                 <td><?echo $filas_s["retorno"];?></td>
                 <td><?echo $filas_s["hnf"];?></td>
                 <td><?echo $aux;?></td>
                 <td><?echo $filas_s["nota"];?></td>
                 </tr>
                <?
                $i=$i+1;
              endwhile;
              endif;
         endif;
         ?>
       </body>

  </html>
