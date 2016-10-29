<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if(empty($datoN)):
   ?>
   <script language="javascript">
      alert("Debe de seleccionar al menos un registro del sistema.!")
      history.back()
   </script>
   <?
else:
	include("../conexion.php");
        $con=0;
	$lista=$_POST["datoN"];
	foreach($lista as $NroP){
	     $conB="select prestacion.*,empleado.cedemple,zona.zona,empleado.cuenta from prestacion,empleado,zona
	          where zona.codzona=empleado.codzona and
                       empleado.cedemple=prestacion.cedemple and
                       prestacion.nropresta='$NroP'";
	     $resB=mysql_query($conB) or die("Error al buscar prestaciones");
             $reg=mysql_num_rows($resB);
             $con=$con+1;
         }
       if($reg!=0):
          if($con==1):
 	        header("Content-type: application/vnd.ms-excel");
	        header("Content-Disposition: attachment; filename=Prestaciones.xls");
	        header("Pragma: no-cache");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Expires: 0");
	         ?>
               <table border="0" align="center">
                   <tr class="cajas">
	            <td style='font-weight:bold;font-size:1.1em;'>Item</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Nro_Presta.</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
	            <td style='font-weight:bold;font-size:1.1em;'>D_Financiero</td>
	            <td style='font-weight:bold;font-size:1.1em;'>D_Vestuario</td>
	            <td style='font-weight:bold;font-size:1.1em;'>D_Alianza</td>
	            <td style='font-weight:bold;font-size:1.1em;'>D_Caja</td>
	            <td style='font-weight:bold;font-size:1.1em;'>D_Jgefectivos</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Cesantia</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Interes</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Primas</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Vacaciones</td>
	            <td style='font-weight:bold;font-size:1.1em;'>T_Generado</td>
	            <td style='font-weight:bold;font-size:1.1em;'>T_Deduccion</td>
	            <td style='font-weight:bold;font-size:1.1em;'>T_Pagar</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Cuenta</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
	          </tr>
                <?
                   $i=1;
	        while($filas_s=mysql_fetch_array($resB)):
	           ?>
	            <tr  class="cajas">
	                 <td><?echo $i;?></td>
	                  <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["nropresta"];?></div></td>
	                 <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
	                 <td style='font-weight;font-size:0.8em;'><?echo $filas_s["nombres"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["prestamo"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["vestuario"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["otros"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["comfenalco"];?></td>
	                  <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["empresa"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["cesantia"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["interes"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["prima"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["vacacion"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["total"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["totald"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["totalp"];?></td>
	                 <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><?echo $filas_s["cuenta"];?></td>
	                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["zona"];?></td>
	            </tr><?
                endwhile;
             ?>
             </table>
             <?
          else:
             $sw=1;
             $lista=$_POST["datoN"];
             foreach($lista as $NroP){
	     $conB="select prestacion.*,empleado.cedemple,zona.zona,empleado.cuenta from prestacion,empleado,zona
	          where zona.codzona=empleado.codzona and
                       empleado.cedemple=prestacion.cedemple and
                       prestacion.nropresta='$NroP'order by prestacion.nropresta";
	     $resB=mysql_query($conB) or die("Error al buscar prestaciones");
             $reg=mysql_num_rows($resB);
             if($sw==1):
                   header("Content-type: application/vnd.ms-excel");
	           header("Content-Disposition: attachment; filename=Prestaciones.xls");
	           header("Pragma: no-cache");
	           header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	           header("Expires: 0");
                   $sw=$sw+1;
               ?>
               <table border="0" align="center">
                <tr class="cajas">
		            <td style='font-weight:bold;font-size:1.1em;'>Item</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Nro_Presta.</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
		            <td style='font-weight:bold;font-size:1.1em;'>D_Financiero</td>
		            <td style='font-weight:bold;font-size:1.1em;'>D_Vestuario</td>
		            <td style='font-weight:bold;font-size:1.1em;'>D_Alianza</td>
		            <td style='font-weight:bold;font-size:1.1em;'>D_Caja</td>
		            <td style='font-weight:bold;font-size:1.1em;'>D_Jgefectivos</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Cesantia</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Interes</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Primas</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Vacaciones</td>
		            <td style='font-weight:bold;font-size:1.1em;'>T_Generado</td>
		            <td style='font-weight:bold;font-size:1.1em;'>T_Deduccion</td>
		            <td style='font-weight:bold;font-size:1.1em;'>T_Pagar</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Cuenta</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
	              </tr>
                <?
              else:
                ?>
                   <table border="0" align="center">
                <?
               endif;
	       while($filas_s=mysql_fetch_array($resB)):
                  $a=1;
	           ?>
	            <tr  class="cajas">
	                 <td><?echo $a;?></td>
	                  <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["nropresta"];?></div></td>
	                 <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
	                 <td style='font-weight;font-size:0.8em;'><?echo $filas_s["nombres"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["prestamo"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["vestuario"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["otros"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["comfenalco"];?></td>
	                  <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["empresa"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["cesantia"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["interes"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["prima"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["vacacion"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["total"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["totald"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["totalp"];?></td>
	                 <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><?echo $filas_s["cuenta"];?></td>
	                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["zona"];?></td>
	            </tr>
	                <?
                        $a=$a+1;
	     endwhile;
            }
             ?>
	  </table>
     <?
        endif;
     else:
          ?>
              <script language="javascript">
                alert("No Existen registros para exportar.!")
                history.back()
             </script>
            <?
     endif;
endif;
?>
