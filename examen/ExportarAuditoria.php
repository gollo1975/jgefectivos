<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if(empty($datos)):
   ?>
   <script language="javascript">
      alert("Seleccione la caja de Checkeo para la importación!")
      history.back()
   </script>
   <?
else:
	include("../conexion.php");
        $con=0;
	$lista=$_POST["datos"];
	foreach($lista as $NroP){
	     $conB="select auditoriaexamen.* from auditoriaexamen
               where auditoriaexamen.id='$NroP'";
	     $resB=mysql_query($conB) or die("Error al buscar prestaciones");
             $reg=mysql_num_rows($resB);
             $con=$con+1;
         }
        $i=1;
       if($reg!=0):
          if($con==1):
 	        header("Content-type: application/vnd.ms-excel");
	        header("Content-Disposition: attachment; filename=Auditoria de Examenes.xls");
	        header("Pragma: no-cache");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Expires: 0");
	         ?>
               <table border="0" align="center">
                   <tr class="cajas">
	            <td style='font-weight:bold;font-size:1.1em;'>Item</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Nro_Examen.</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Valor</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
	          </tr>
                <?
	        while($filas_s=mysql_fetch_array($resB)):
                 $NroI=$filas_s["id"]; 
	           ?>
	            <tr  class="cajas">
	                 <td><?echo $a;?></td>
	                  <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["nro"];?></div></td>
	                 <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
	                 <td style='font-weight;font-size:0.8em;'><?echo $filas_s["empleado"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["diferencia"];?></td>
	                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["zona"];?></td>
	            </tr>
                    <?
                     $i=$i+1;
                     $conC="update auditoriaexamen set estado='OK' where id='$NroI'";
                    $ResC=mysql_query($conC)or die ("Error al actualizar..");
                endwhile;
             ?>
             </table>
             <?
          else:
           $i=1;
             $sw=1;
             $lista=$_POST["datos"];
             foreach($lista as $NroP){
	     $conB="select auditoriaexamen.* from auditoriaexamen
               where auditoriaexamen.id='$NroP'";
	     $resB=mysql_query($conB) or die("Error al buscar prestaciones");
             $reg=mysql_num_rows($resB);
             if($sw==1):
                   header("Content-type: application/vnd.ms-excel");
	           header("Content-Disposition: attachment; filename=Auditoria de Examenes.xls");
	           header("Pragma: no-cache");
	           header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	           header("Expires: 0");
                   $sw=$sw+1;
               ?>
               <table border="0" align="center">
                   <tr class="cajas">
                            <td style='font-weight:bold;font-size:1.1em;'>Item</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Nro_Examen.</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Valor</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
	           </tr>
                <?
              else:
                ?>
                   <table border="0" align="center">
                <?
               endif;
	       while($filas_s=mysql_fetch_array($resB)):
                   $NroI=$filas_s["id"];
                  ?>
	            <tr  class="cajas">
	                 <td><?echo $i;?></td>
	                  <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["nro"];?></div></td>
	                 <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
	                 <td style='font-weight;font-size:0.8em;'><?echo $filas_s["empleado"];?></td>
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["diferencia"];?></td>
	                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["zona"];?></td>
	            </tr>
                    <?
                    $i=$i+1;
                    $conC="update auditoriaexamen set estado='OK' where id='$NroI'";
                    $ResC=mysql_query($conC)or die ("Error al actualizar..");
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
