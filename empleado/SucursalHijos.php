<html>

<head>
  <title></title>
</head>
<body>
<?php
if($Sucursal==0):
 ?>
	    <script language="javascript">
	      alert("Seleccione la Sucursal para la busqueda")
	      history.back()
	    </script>
	   <?
else:
	include("../conexion.php");
	$ConH="select detallempleado.*,zona.zona from sucursal,zona,empleado,detallempleado,contrato
	where sucursal.codsucursal=zona.codsucursal and
	zona.codzona=empleado.codzona and
	empleado.cedemple=detallempleado.cedemple and
	empleado.codemple=contrato.codemple and
	contrato.fechater='0000-00-00' and
	sucursal.codsucursal='$Sucursal'order by zona.zona";
	$ResH=mysql_query($ConH) or die ("Error al buscar Empleados");
	$RegH=mysql_num_rows($ResH);
       if($RegH==0):
            ?>
	    <script language="javascript">
	      alert("No Hay Registros para mostrar?")
	      history.back()
	    </script>
	   <?
        else:
             header("Content-type: application/vnd.ms-excel");
             header("Content-Disposition: attachment; filename=Detallado de Hijos.xls");
             header("Pragma: no-cache");
             header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
             header("Expires: 0");
             $i=1;
             $con=0;
              while ($filas=mysql_fetch_array($ResH)):
                 $Documento=$filas["cedemple"];
                  ?>
                  <div align="center"><h4>Registro Empleado</h4></div>
                 <table border="0" align="center">
                 <tr class="cajas">
                      <td style='font-weight:bold;font-size:1.1em;'>Nro</td>
	              <td style='font-weight:bold;font-size:1.1em;'>Cedula</td>
                      <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
                      <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
                 </tr>
                  <tr class="cajas">
                      <td><div align="left"><?echo $i;?></div></td>
	              <td><div align="left"><?echo $filas["cedemple"];?></div></td>
                      <td><?echo $filas["empleado"];?></td>
                      <td><?echo $filas["zona"];?></td>
                  </tr>
                  <?
                   $ConD="select detallehijo.* from detallehijo,detallempleado
		   where detallempleado.cedemple=detallehijo.cedemple and
                   detallempleado.cedemple='$Documento'";
		   $ResD=mysql_query($ConD) or die ("Error al buscar Hijos");
                   $Reg=mysql_num_rows($ResD);
                   if($Reg!=0):
	                   ?>
	                   <tr class="cajas">
	                      <td style='font-weight:bold;font-size:1.1em;'>Tipo_Doc.</td>
		              <td style='font-weight:bold;font-size:1.1em;'>Nro_Documento</td>
	                      <td style='font-weight:bold;font-size:1.1em;'>Nombres</td>
	                      <td style='font-weight:bold;font-size:1.1em;'>Parentezco</td>
                              <td style='font-weight:bold;font-size:1.1em;'>F_Nac.</td>  
	                   </tr>
	                   <?
	                    while ($fila=mysql_fetch_array($ResD)):
	                       ?>
	                        <tr class="cajas">
	                           <td><div align="left"><?echo $fila["tipo"];?></div></td>
		                   <td><div align="left"><?echo $fila["documento"];?></div></td>
	                           <td><?echo $fila["nombre"];?></td>
	                           <td><?echo $fila["parentezco"];?></td>
                                   <td><?echo $fila["fechanac"];?></td> 
	                        </tr>
	                       <?
                               if($fila["parentezco"]=='HIJO(A)' or $fila["parentezco"]=='HIJASTRO'):
                                 $con=$con+1;
                               endif;
	                    endwhile;
                     else:
                     endif;
                    $i=$i+1;
                   ?></table><?
              endwhile;
              ?><div align="center"><b>Total Hijos:</b>&nbsp;<?echo $con;?></div><?
        endif;
 endif;
?>
</body>

</html>
