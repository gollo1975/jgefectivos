<?
if(empty($Banco)):
  ?>
   <script language="javascript">
      alert("Seleccione el banco de la lista")
      history.back()
   </script>
  <?
elseif($datos==''):
  ?>
   <script language="javascript">
      alert("Seleccione la empresa para Exportar la nómina.")
      history.back()
   </script>
  <?
else:
    include("../conexion.php");
    $con=0;
   $lista=$_POST["datos"];
    foreach($lista as $Codzona){
    $consu="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,banco.bancos,nomina.cedemple,nomina.neto,empleado.cuenta,zona.zona from empleado,banco,periodo,zona,nomina where
    zona.codzona=periodo.codzona and
    empleado.codbanco=banco.codbanco and
    banco.codbanco='$Banco' and
    nomina.neto > 0 and
    empleado.cedemple=nomina.cedemple and
    periodo.codigo=nomina.codigo and
    periodo.pagado='' and
    periodo.desde='$desde' and periodo.hasta='$hasta' and
    zona.codzona='$Codzona' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
    $resulta=mysql_query($consu)or die ("Error de busqueda de nomina");
    $reg=mysql_num_rows($resulta);
    $con=$con+1;
      }
    if($reg!=0):
         if($con==1):
          header("Content-type: application/vnd.ms-excel");
          header("Content-Disposition: attachment; filename=Pago de Nomina.xls");
          header("Pragma: no-cache");
          header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
          header("Expires: 0");
	  ?>
          <table border="0" align="center">
	   <tr class="cajas">
	      <td style='font-weight:bold;font-size:1.1em;'>Item</td>
	      <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
	      <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
	      <td style='font-weight:bold;font-size:1.1em;'>Vlr_Pagar</td>
	      <td style='font-weight:bold;font-size:1.1em;'>Cuenta</td>
	      <td style='font-weight:bold;font-size:1.1em;'>Entidad</td>
	      <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
	   </tr>

	   <?
	    $i=1;
	    while($filas_s=mysql_fetch_array($resulta)):
	          ?>
	          <tr  class="cajas">
	           <td><?echo $i;?></td>
	           <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
	            <td style='font-weight;font-size:0.8em;'><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
	            <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["neto"];?></td>
	            <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><?echo $filas_s["cuenta"];?></td>
	            <td style='font-weight;font-size:0.9em;'><?echo $filas_s["bancos"];?></td>
	            <td style='font-weight;font-size:0.9em;'><?echo $filas_s["zona"];?></td>
	            </tr>
	            <?
	            $i=$i+1;
	     endwhile;
	      /*proceso de guardado*/
		  if($CerrarPago=='SI'){
	          $Con="update periodo set pagado='SI' where periodo.desde='$desde' and periodo.codzona='$Codzona' and periodo.hasta='$hasta'";
	          $resu=mysql_query($Con)or die("Error al actualizar");
	          $reg=mysql_affected_rows();
		  }	  
	      /*fin proceso*/
          ?>
          </table>
          <?
      else:
         $sw=1;
       foreach($lista as $Codzona){
	     $consu="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,banco.bancos,nomina.cedemple,nomina.neto,empleado.cuenta,zona.zona from empleado,banco,periodo,zona,nomina where
	     zona.codzona=periodo.codzona and
	     empleado.codbanco=banco.codbanco and
	     banco.codbanco='$Banco' and
	     nomina.neto > 0 and
             periodo.pagado='' and
	     empleado.cedemple=nomina.cedemple and
	     periodo.codigo=nomina.codigo and
	     periodo.desde='$desde' and periodo.hasta='$hasta' and
	     zona.codzona='$Codzona' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
	     $resulta=mysql_query($consu)or die ("Error de busqueda de nomina");
	     $reg=mysql_num_rows($resulta);
             if($sw==1):
               header("Content-type: application/vnd.ms-excel");
               header("Content-Disposition: attachment; filename=Pago de Nomina.xls");
               header("Pragma: no-cache");
               header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
               header("Expires: 0");
               $sw=$sw+1;
               ?>
               <table border="0" align="center">
                <?
              else:
              ?>
                 <table border="0" align="center">
	          <tr class="cajas">
	          <td style='font-weight:bold;font-size:1.1em;'></td>
	          <td style='font-weight:bold;font-size:1.1em;'></td>
	          <td style='font-weight:bold;font-size:1.1em;'></td>
	          <td style='font-weight:bold;font-size:1.1em;'></td>
	          <td style='font-weight:bold;font-size:1.1em;'></td>
	          <td style='font-weight:bold;font-size:1.1em;'></td>
	          <td style='font-weight:bold;font-size:1.1em;'></td>
	          </tr>
                <?
             endif;
	    $i=1;
	    while($filas_s=mysql_fetch_array($resulta)):
	          ?>
	          <tr  class="cajas">
	           <td><?echo $i;?></td>
	           <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
	            <td style='font-weight;font-size:0.8em;'><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                   <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["neto"];?></td>
	            <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><?echo $filas_s["cuenta"];?></td>
	            <td style='font-weight;font-size:0.9em;'><?echo $filas_s["bancos"];?></td>
	            <td style='font-weight;font-size:0.9em;'><?echo $filas_s["zona"];?></td>
	            </tr>
	            <?
	            $i=$i+1;
				/*proceso de guardado*/
				if($CerrarPago=='SI'){
                    $Con="update periodo set pagado='SI' where periodo.desde='$desde' and periodo.codzona='$Codzona' and periodo.hasta='$hasta'";
	                $resu=mysql_query($Con)or die("Error al actualizar");
	                $reg=mysql_affected_rows();
				}	
	           /*fin proceso*/
	     endwhile;
           }
          ?>
          </table>
          <?
        endif;
    else:
          ?>
              <script language="javascript">
                alert("No Existen empresas pendientes por pago de nomina!")
                history.back()
             </script>
            <?
    endif;
 endif;
  ?>



