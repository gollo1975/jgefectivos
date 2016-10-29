<html>
<title>Listado documentos pendientes</title>
<head>
  
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
      function ColorFoco(obj)
      {
          document.getElementById(obj).style.background="#9DFF9D"

      }
      function QuitarFoco(obj)
      {
         document.getElementById(obj).style.background="white"
      }
</script>	  
</head>
<body>
<?php
if(!isset($CodEmpresa)){
   include("../conexion.php");
   ?>
   <div align="center"><h4><u>Documentos pendientes</u></h4></div>
    <form action="" method="post" id="f1">
       <table border="0" align="center">
                 <tr><td><br></td></tr>
				  <tr>
	               <td><b>Desde:&nbsp;</b></td>
	               <td><input type="text" name="Desde" value="<?echo date('Y-m-d');?>" size="12" maxlength="10" onFocus="ColorFoco(this.id)" class="cajas"onblur="QuitarFoco(this.id)" id="Desde"></td>
	             </tr>
				 <tr>
	               <td><b>Hasta:&nbsp;</b></td>
	               <td><input type="text" name="Hasta" value="<?echo date('Y-m-d');?>" size="12" maxlength="10" onFocus="ColorFoco(this.id)" class="cajas"onblur="QuitarFoco(this.id)" id="Hasta"></td>
	             </tr>
                 <tr>
                 <td><b>Empresa:</b></td>
                   <td><select name="CodEmpresa" class="cajasletra" id="CodEmpresa">
                         <option value="0">Seleccione la Empresa
                        <?
                        $consulta_b="select codmaestro,nomaestro from maestro ";
                       $resultado_b=mysql_query($consulta_b) or die("Error Al buscar empresa");
                       while ($filas_b=mysql_fetch_array($resultado_b)):
                           ?>
                          <option value="<?echo $filas_b["codmaestro"];?>"><?echo $filas_b["nomaestro"];?>
                          <?
                       endwhile;
                         ?>
                        </select></td>
                   </tr>
                 <tr><td><br></td></tr>
              <tr>
                 <td colspan="5">
                 <input type="submit" value="Aceptar" class="boton" ></td>
               </tr>
          </table>
    </form>
    <?	
}elseif(empty($CodEmpresa)){
	?>
	<script language="javascript">
	  alert("Seleccione la empresa de la lista.!")
	  history.back()
	</script>
	<?
}else{	
	
	include("../conexion.php");
	$ConH="select maestrorequisito.*,zona.zona from maestro,sucursal,zona,empleado,maestrorequisito
	where maestro.codmaestro=sucursal.codmaestro and
	sucursal.codsucursal=zona.codsucursal and
	zona.codzona=empleado.codzona and
	empleado.cedemple=maestrorequisito.cedula and
	maestrorequisito.fechap between '$Desde' and '$Hasta' and
	maestrorequisito.cerrado='NO' and
	maestro.codmaestro='$CodEmpresa'order by zona.zona";
	$ResH=mysql_query($ConH) or die ("Error al buscar documentos de empleados pendientes");
	$RegH=mysql_num_rows($ResH);
    if($RegH==0){
            ?>
	    <script language="javascript">
	      alert("No Hay Registros para mostrar en este rango de fechas.")
	      history.back()
	    </script>
	   <?
    }else{
             header("Content-type: application/vnd.ms-excel");
             header("Content-Disposition: attachment; filename=Documentos Pendientes.xls");
             header("Pragma: no-cache");
             header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
             header("Expires: 0");
             $i=1;
             $con=0;
              while ($filas=mysql_fetch_array($ResH)){
                 $Radicado=$filas["idRequisito"];
                  ?>
                  <div align="center"><h4>Documentos Pendientes</h4></div>
                 <table border="0" align="center">
                 <tr class="cajas">
                      <td style='font-weight:bold;font-size:1.1em;'>Nro</td>
	              <td style='font-weight:bold;font-size:1.1em;'>Cedula</td>
                      <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
					   <td style='font-weight:bold;font-size:1.1em;'>F_Proceso</td>
					    <td style='font-weight:bold;font-size:1.1em;'>Usuario_Creador</td>
                      <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
                 </tr>
                  <tr class="cajas">
                      <td><div align="left"><?echo $i;?></div></td>
	              <td><div align="left"><?echo $filas["cedula"];?></div></td>
                      <td><?echo $filas["nombre"];?></td>
					  <td><?echo $filas["fechap"];?></td>
					  <td><?echo $filas["usuarioproceso"];?></td>
                      <td><?echo $filas["zona"];?></td>
                  </tr>
                  <?
                    $ConD="select detalladomaestrorequisito.* from detalladomaestrorequisito,maestrorequisito
		               where detalladomaestrorequisito.idRequisito=maestrorequisito.idRequisito and
		               detalladomaestrorequisito.validacion='PENDIENTE' and
                       detalladomaestrorequisito.idRequisito='$Radicado'";
		           $ResD=mysql_query($ConD) or die ("Error al buscar documentos pendientes");
                   $Reg=mysql_num_rows($ResD);
                   if($Reg!=0){
	                   ?>
	                   <tr class="cajas">
	                      <td style='font-weight:bold;font-size:1.1em;'>Detalle Documento</td>
		              <td style='font-weight:bold;font-size:1.1em;'>Estado</td>
	                      <td style='font-weight:bold;font-size:1.1em;'><div align="center">Cantidad</div></td>
	                  </tr>
	                   <?
	                    while ($fila=mysql_fetch_array($ResD)){
	                       ?>
	                        <tr class="cajas">
	                           <td><div align="left"><?echo $fila["concepto"];?></div></td>
		                       <td><div align="left"><?echo $fila["validacion"];?></div></td>
	                           <td><?echo $fila["pendiente"];?></td>
	                        </tr>
	                       <?
	                    }
                    }
					?>
					<td colspan="40">*****************************************************************************************************************************************</td><?
                   $i=$i+1;
                   ?>
				 </table>
				 <?
               }
    }
}
?>
</body>

</html>
