<html>

<head>
  <title>Listado de Empleados</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
    function ActualizarSaldo()
         {
         totalitem = 0
         pagado = 0
         totalitem =  document.getElementById("tActualizaciones").value
         var nEle = document.f1.elements.length;
               for (i=0; i<nEle; i++) {
                  if (document.f1.elements[i].type=="checkbox" &&
	                document.f1.elements[i].name.lastIndexOf('datoN')!=-1 ) {
			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
	          }
                }
      }

</script>
</head>
<body>
<?
include("../conexion.php");
$con1="select sucursal.codsucursal,sucursal.sucursal,maestro.codmaestro from maestro,sucursal
   where maestro.codmaestro=sucursal.codmaestro and
         sucursal.codsucursal='$CodSucursal'";
$re1=mysql_query($con1)or die("Error al buscar el periodo");
$filas_s=mysql_fetch_array($re1);
$NitEmpresa=$filas_s["codmaestro"];
$conP="select periodoprima.nrop,periodoprima.desde,periodoprima.hasta from periodoprima,maestro
   where maestro.codmaestro=periodoprima.codmaestro and
         maestro.codmaestro='$NitEmpresa' and
         periodoprima.estado='FALTA'";
$reP=mysql_query($conP)or die("Error al buscar el periodo");
$regP=mysql_num_rows($reP);
$filas_F=mysql_fetch_array($reP);
$Desde=$filas_F["desde"];
$Hasta=$filas_F["hasta"];
$Sucursal=$filas_s["sucursal"];
if($regP!=0):
	  ?>
	  <table border="0" align="center">
	    <tr>
	      <td class="cajas"><b>C�d_Sucursal:</b>&nbsp;<? echo $filas_s["codsucursal"];?></td>
	    </tr>
	    <tr>
	      <td class="cajas"><b>Sucursal:</b>&nbsp;<? echo $filas_s["sucursal"];?></td>
	    </tr>
             <tr class="cajas">
	      <td><b>Desde:</b>&nbsp;<? echo $Desde;?>
              <b>Hasta:</b>&nbsp;<? echo $Hasta;?></td>
	    </tr>
	  </table>
	  <?

	  $con="select empleado.cedemple,concat(empleado.nomemple, ' ' ,empleado.nomemple1) as Nombres,concat(empleado.apemple, ' ' ,empleado.apemple1) as Apellidos,contrato.fechainic,contrato.salario,zona.zona from sucursal,empleado,zona,contrato
	       where sucursal.codsucursal=zona.codsucursal and
                     zona.codzona=empleado.codzona and
	             empleado.codemple=contrato.codemple and
                     sucursal.codsucursal='$CodSucursal' and
                     contrato.fechainic <= '$Hasta' and
	             contrato.fechater='0000-00-00' order by zona.zona,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
	  $Re=mysql_query($con)or die("Error en la busqueda de Empleados por sucursal");
	  $regis=mysql_num_rows($Re);
	  if($regis==0):
	    ?>
	    <script language="javascript">
	       alert("No hay empleados activos en la Sucursal: <?echo $Sucursal;?>")
	       history.back()
	     </script>
	     <?
	  else:
	   ?>

           <form action="GenerarPrimaSemestral.php" name="f1"  method="post">
           <input type="hidden" name="Desde" value="<?echo $Desde;?>">
           <input type="hidden" name="Hasta" value="<?echo $Hasta;?>">
           <input type="hidden" name="Sucursal" value="<?echo $Sucursal;?>">
           <input type="hidden" name="AuxProceso" value="3">
            <table border="0" align="center">
              <tr>
		  <td><b>Validar:</b></td>
	          <td><select name="Validar" class="cajas">
                   <option value="0">Seleccione
		  <option value="MEDIO">MEDIO SALARIO
	          <option value="COMPLETO">SALARIO COMPLETO
                  <option value="MANUAL">DIAS
                  <option value="BASICO">BASICO
                  <option value="EXACTO">FECHA EXACTA
                  		  </select></td>
              </tr>
              </tr>
                    <td><b>Auxilio_Trans.:</b></td>
                    <td>  <select name="AuxilioT" class="cajasletra">
                          <?
                          $consulta_b="select parametroauxilio.* from parametroauxilio where estado='ACTIVO'";
                          $resultado_b=mysql_query($consulta_b) or die("eRRORR");
                          while ($filas_b=mysql_fetch_array($resultado_b))
                          {
                          ?>
                               <option value="<?echo $filas_b["valor"];?>"><?echo $filas_b["valor"];?>
                          <?
                          }
                          ?>
                    </select></td>
              </tr>
              	<tr>
		  <td><b>Dias:</b></td>
		  <td> <input type="text" value="" name="VlrManual"size="10" class="cajas"maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="VlrManual"></td>
		</tr>
              </table>
	    <table border="0" align="center">
             <tr class="cajas">
		       <th>Item</th><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Documento</b></th><th><b>Empleado</b></th><th><b>Desde</b></th><th><b>Hasta</b></th><th><b>Fecha_Ing</b></th> <th><b>Salario</b></th></th> <th><b>Zona</b></th>
		  </tr>
	   <?
           $i=1;
        //   echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($Re) . "\">");
	  while($filas=mysql_fetch_array($Re)):
             $aux=number_format($filas["salario"],0);
              $Cedula= $filas["cedemple"];
               $conP="select prima.cedemple from prima
	       where prima.cedemple='$Cedula' and
	       prima.fechai='$Desde' and
               prima.fechacorte='$Hasta'";
	  $ReP=mysql_query($conP)or die("Error en la busqueda de Empleados");
	  $regP=mysql_num_rows($ReP);
           if($regP==0):
	      ?>
              <tr  class="cajas">
	             <th><?echo $i;?></th><?
	                 echo ("<td><input type=\"checkbox\" id=name=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $filas['cedemple'] ."\"></td>");?>
	                  <td class="cajas"><?echo $filas["cedemple"];?></td>
	                  <td class="cajas"><?echo $filas["Nombres"];?>&nbsp;<?echo $filas["Apellidos"];?></td>
	                 <td class="cajas"><?echo $Desde;?></td>
	                 <td class="cajas"><?echo $Hasta;?></td>
	                 <td><div align="center"><?echo $filas["fechainic"];?></div></td>
	                 <td><div align="right">$<?echo $aux;?></div></td>
                         <td><?echo $filas["zona"];?></div></td>
	           </tr>
	      <?
               $i=$i+1;
            else:
              $Con=$Con+1;
            endif;
	  endwhile;
          $regis=$regis-$Con;
           echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . $regis . "\">");
	  ?>
           <tr><td><br></td></tr>
                <td colspan="5">
	          <input type="submit" value="Generar Prima" class="boton" ></td>
	  </table>
        </form>
	  <?
	 endif;
else:
    ?>
	    <script language="javascript">
	       alert("El periodo de corte de primas no esta generado, favor crearlo")
	       history.back()
	     </script>
	     <?
endif;
	?>
</body>

</html>