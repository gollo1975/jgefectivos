<?php
if(empty($datoN)):
  ?>
   <script language="javascript">
      alert("Seleccione la empresa para Exportar la nómina.")
      history.back()
   </script>
  <?
else:
    include("../conexion.php");
    $con=0;
   $lista=$_POST["datoN"];
    foreach($lista as $Codigo){
    $consu="select decobrozona.* from decobrozona,cobrozona
    where cobrozona.codigo=decobrozona.codigo and
          cobrozona.desde='$Desde' and cobrozona.hasta='$Hasta' and
          cobrozona.codigo='$Codigo' order by cobrozona.zona,decobrozona.empleado";
    $resulta=mysql_query($consu)or die ("Error de busqueda del detalle Inicial");
    $reg=mysql_num_rows($resulta);
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
	      <td style='font-weight:bold;font-size:1.1em;'>Basico</td>
	      <td style='font-weight:bold;font-size:1.1em;'>T_Extra</td>
	      <td style='font-weight:bold;font-size:1.1em;'>T_No_Extra</td>
	      <td style='font-weight:bold;font-size:1.1em;'>Auxilio_T</td>
              <td style='font-weight:bold;font-size:1.1em;'>Arl</td>
              <td style='font-weight:bold;font-size:1.1em;'>Eps</td>
              <td style='font-weight:bold;font-size:1.1em;'>Pensión</td>
              <td style='font-weight:bold;font-size:1.1em;'>Caja</td>
              <td style='font-weight:bold;font-size:1.1em;'>Sena</td>
              <td style='font-weight:bold;font-size:1.1em;'>Icbf</td>
              <td style='font-weight:bold;font-size:1.1em;'>Cesa/Inte.</td>
              <td style='font-weight:bold;font-size:1.1em;'>Vacacion</td>
              <td style='font-weight:bold;font-size:1.1em;'>Admon</td>
              <td style='font-weight:bold;font-size:1.1em;'>Novedad</td>
	   </tr>
	   <?
	    $i=1;
	    while($filas_s=mysql_fetch_array($resulta)):
	          ?>
	          <tr  class="cajas">
	           <td><?echo $i;?></td>
	           <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
	            <td style='font-weight;font-size:0.8em;'><?echo $filas_s["empleado"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["basico"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["tiempo"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["tauxilio"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["ayuda"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["vlrarp"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["vlreps"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["vlrpension"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["cajac"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["vlrsena"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["vlricbf"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["ps"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["vacacion"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["admon"];?></td>
                     <td style='font-weight;font-size:0.8em;'><?echo $filas_s["nove"];?></td>
	            </tr>
	            <?
	            $i=$i+1;
	     endwhile;
          ?>
          </table>
          <?
      else:
         $sw=1;
       foreach($lista as $Codigo){
             $consu="select decobrozona.* from decobrozona,cobrozona
                  where cobrozona.codigo=decobrozona.codigo and
                  cobrozona.desde='$Desde' and cobrozona.hasta='$Hasta' and
                  cobrozona.codigo='$Codigo' order by cobrozona.zona,decobrozona.empleado";
	     $resulta=mysql_query($consu)or die ("Error de busqueda del detalle, segunda parte");
	     $reg=mysql_num_rows($resulta);
             if($sw==1):
               header("Content-type: application/vnd.ms-excel");
               header("Content-Disposition: attachment; filename=detalle factura.xls");
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
		      <td style='font-weight:bold;font-size:1.1em;'>Basico</td>
		      <td style='font-weight:bold;font-size:1.1em;'>T_Extra</td>
		      <td style='font-weight:bold;font-size:1.1em;'>T_No_Extra</td>
		      <td style='font-weight:bold;font-size:1.1em;'>Auxilio_T</td>
	              <td style='font-weight:bold;font-size:1.1em;'>Arl</td>
	              <td style='font-weight:bold;font-size:1.1em;'>Eps</td>
	              <td style='font-weight:bold;font-size:1.1em;'>Pensión</td>
	              <td style='font-weight:bold;font-size:1.1em;'>Caja</td>
	              <td style='font-weight:bold;font-size:1.1em;'>Sena</td>
	              <td style='font-weight:bold;font-size:1.1em;'>Icbf</td>
	              <td style='font-weight:bold;font-size:1.1em;'>Cesa/Inte.</td>
	              <td style='font-weight:bold;font-size:1.1em;'>Vacacion</td>
	              <td style='font-weight:bold;font-size:1.1em;'>Admon</td>
                      <td style='font-weight:bold;font-size:1.1em;'>Novedad</td>
                </tr>
                <?
              else:
              ?>
                
                <?
             endif;
	    $i=1;
	    while($filas_s=mysql_fetch_array($resulta)):
	          ?>
	          <tr  class="cajas">
	           <td><?echo $i;?></td>
                   <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
	            <td style='font-weight;font-size:0.8em;'><?echo $filas_s["empleado"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["basico"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["tiempo"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["tauxilio"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["ayuda"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["vlrarp"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["vlreps"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["vlrpension"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["cajac"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["vlrsena"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["vlricbf"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["ps"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["vacacion"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["admon"];?></td>
                    <td style='font-weight;font-size:0.8em;'><?echo $filas_s["nove"];?></td>
	            </tr>
	            <?
	            $i=$i+1;
              endwhile;
           }
          ?>
          </table>
          <?
        endif;
    else:
          ?>
              <script language="javascript">
                alert("No Existen detallados de pago para esta fecha")
                history.back()
             </script>
            <?
    endif;
 endif;
  ?>



