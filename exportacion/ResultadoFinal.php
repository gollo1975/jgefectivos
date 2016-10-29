<?

if($datoN==''):
  ?>
   <script language="javascript">
      alert("Seleccione la empresa para Exportar la nómina.")
      history.back()
   </script>
  <?
else:
    include("../conexion.php");
    $con=0;
        $i=1;
     for ($k=1 ; $k<=$Contador; $k ++):
           $conT="select salario.codsala from salario
           where salario.formapago='NINGUNA'and
           salario.totalhoras='NO' order by codsala";
           $resul=mysql_query($conT) or die("consulta incorrecta 1 ");
           while($filas=mysql_fetch_array($resul)):
               $CodSalario=$filas["codsala"];
               $consu="select concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as Empleado,nomina.cedemple,denomina.* from empleado,nomina,denomina where
	       empleado.cedemple=nomina.cedemple and
	       nomina.consecutivo=denomina.consecutivo and
	       denomina.codsala='$CodSalario' and
	       denomina.consecutivo='$datoN[$k]' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
	       $resulta=mysql_query($consu)or die ("Error de busqueda de nomina");
	       $reg=mysql_num_rows($resulta);
	       $con=$con+1;
           endwhile;
     endfor;
     if($reg!=0):
         if($con==1):
               /*  header("Content-type: application/vnd.ms-excel");
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
		      <td style='font-weight:bold;font-size:1.1em;'>Deducción</td>
		   </tr>

		   <?
		    $i=1;
		    while($filas_s=mysql_fetch_array($resulta)):
		          ?>
		          <tr  class="cajas">
		           <td><?echo $i;?></td>
		           <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
		            <td style='font-weight;font-size:0.8em;'><?echo $filas_s["Empleado"];?></td>
		            <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["deduccion"];?></td>
		            </tr>
		            <?
		            $i=$i+1;
		     endwhile;
	          ?>
	          </table>
	          <? */
          else:
	      $sw=1;
	       for ($k=1 ; $k<=$Contador; $k ++):
	           $conT="select salario.codsala from salario
	           where salario.formapago='NINGUNA' and
                   salario.totalhoras='NO' order by codsala";
	           $resul=mysql_query($conT) or die("consulta incorrecta 1 ");
	           while($filas=mysql_fetch_array($resul)):
	               $CodSalario=$filas["codsala"];
	               $consu="select concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as Empleado,nomina.cedemple,denomina.* from empleado,nomina,denomina where
		       empleado.cedemple=nomina.cedemple and
		       nomina.consecutivo=denomina.consecutivo and
		       denomina.codsala='$CodSalario' and
		       denomina.consecutivo='$datoN[$k]' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
		       $resulta=mysql_query($consu)or die ("Error de busqueda de nomina");
		       $reg=mysql_num_rows($resulta);
    	               if($sw==1):
	                   header("Content-type: application/vnd.ms-excel");
	                   header("Content-Disposition: attachment; filename=Deducciones.xls");
	                   header("Pragma: no-cache");
	                   header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	                   header("Expires: 0");
	                   $sw=$sw+1;
	                   ?>
	                   <table border="0" align="center">
                            <tr class="cajas">
			      <td style='font-weight:bold;font-size:1.1em;'>Item</td>
			      <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
			      <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
			      <td style='font-weight:bold;font-size:1.1em;'>Deducción</td>
			   </tr>
	                   <?
	              else:
	                 ?>
	                <?
	       endif;
	        while($filas_s=mysql_fetch_array($resulta)):
		          ?>
		          <tr  class="cajas">
		           <td><?echo $i;?></td>
                           <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
		            <td style='font-weight;font-size:0.8em;'><?echo $filas_s["Empleado"];?></td>
		            <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["deduccion"];?></td>
		            </tr>
		            <?
		            $i=$i+1;

		 endwhile;
               endwhile;
	       endfor;
	      ?>
	          </table>
	   <?
	   endif;
    else:
          ?>
              <script language="javascript">
                alert("No Existen deducciones para este empleado!")
                history.back()
             </script>
            <?
    endif;
 endif;
  ?>



