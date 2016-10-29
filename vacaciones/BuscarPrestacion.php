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
    $ConT=0;
     for ($l=1 ; $l<=$tActualizaciones; $l ++){
         $conP="select detallepagoprestacion.* from detallepagoprestacion
	  where detallepagoprestacion.nropresta='$datoN[$l]'";
    $resP=mysql_query($conP) or die("Error al buscar prestaciones duplicadas");
    $RegP=mysql_num_rows($resP);
    if($RegP==1){
      $ConT = 1;
    }
    }
    if($ConT==0){
        $FechaP=date("Y-m-d");
        /*permite grabar la programacion*/
         $consulta = "select count(*) from programarprestacion";
	 $result = mysql_query ($consulta);
	 $sw = mysql_fetch_row($result);
	 if ($sw[0] > 0):
	      $consulta1 = "select max(cast(idprogramapresta as unsigned)) + 1 from programarprestacion";
	      $result1 = mysql_query ($consulta1) or die ("Fallo en la consulta");
	      $codc = mysql_fetch_row($result1);
	      $CodPresta= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
	 else:
	      $CodPresta="00001";
	 endif;
          $grabar="insert into programarprestacion(idprogramapresta,codmaestro,fechap)
         values('$CodPresta','$NitEmpresa','$FechaP')";
         $Res=mysql_query($grabar)or die("Error al grabar datos de la programacion");
         for ($k=1 ; $k<=$tActualizaciones; $k ++):
           if   ($datoN[$k] != ""){
                 $ConD="insert into detallepagoprestacion (nropresta,cedemple,empleado,total,codzona,zona,fechap,cuenta,codbanco,banco,idprogramapresta)
                 values ('$datoN[$k])','$Documento[$k]','$empleado[$k]','$pagado[$k]','$CodZona[$k]','$zona[$k]','$FechaP','$CtaBancaria[$k]','$CodBanco[$k]','$NombreBanco[$k]','$CodPresta')";
                 $ResD=mysql_query($ConD)or die("Error al grabar detallado de la programacion de las prestaciones ");
                 $registro=mysql_affected_rows();
                 $Contador=$Contador + $pagado[$k];
          }
       endfor;
       $ConA="update programarprestacion set vlrpagado='$Contador' where programarprestacion.idprogramapresta='$CodPresta'";
       $resuA = mysql_query ($ConA) or die ("Error al actualizar la tabla maestro ");
        $con=0;
	$lista=$_POST["datoN"];
	foreach($lista as $NroP){
	     $conB="select prestacion.*,empleado.cedemple,zona.zona,banco.bancos,empleado.cuenta from prestacion,empleado,zona,banco
	          where zona.codzona=prestacion.codzona and
                       empleado.cedemple=prestacion.cedemple and
                       empleado.codbanco=banco.codbanco and
                       prestacion.nropresta='$NroP'";
	     $resB=mysql_query($conB) or die("Error al buscar prestaciones");
             $reg=mysql_num_rows($resB);
             $con=$con+1;

         }

       if($reg!=0):
          if($con==1):
 	        header("Content-type: application/vnd.ms-excel");
	        header("Content-Disposition: attachment; filename=Prestacions.xls");
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
	            <td style='font-weight:bold;font-size:1.1em;'>T_Pagar</td>
	            <td style='font-weight:bold;font-size:1.1em;'>Cuenta</td>
                    <td style='font-weight:bold;font-size:1.1em;'>Banco</td>
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
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["totalp"];?></td>
	                 <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><?echo $filas_s["cuenta"];?></td>
                         <td style='font-weight;font-size:0.9em;'><?echo $filas_s["bancos"];?></td>   
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
	     $conB="select prestacion.*,empleado.cedemple,zona.zona,banco.bancos,empleado.cuenta from prestacion,empleado,zona,banco
	          where zona.codzona=prestacion.codzona and
                       empleado.cedemple=prestacion.cedemple and
                       empleado.codbanco=banco.codbanco and
                       prestacion.nropresta='$NroP'";
	     $resB=mysql_query($conB) or die("Error al buscar prestadiciones dos");
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
		            <td style='font-weight:bold;font-size:1.1em;'>T_Pagar</td>
		            <td style='font-weight:bold;font-size:1.1em;'>Cuenta</td>
                            <td style='font-weight:bold;font-size:1.1em;'>Banco</td>
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
	                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["totalp"];?></td>
	                 <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><?echo $filas_s["cuenta"];?></td>
                          <td style='font-weight;font-size:0.9em;'><?echo $filas_s["bancos"];?></td>  
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
    }else{
        ?>
              <script language="javascript">
                alert("Los registros no se pueden duplicar en el sistema.!")
                history.back()
             </script>
            <?
    }
endif;
?>
