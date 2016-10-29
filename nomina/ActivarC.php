<html>

<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script type="text/javascript">
function ActualizarSaldo()
         {
         var totalitem = 0
         var pagado = 0
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
<?php
 if($datos==''):
  ?>
   <script language="javascript">
      alert("Debe de seleccionar al menos una empresa del sistema.")
      history.back()
   </script>
  <?
else:
   ?>
     <center><h4><u>Activar Colilla</u></h4></center>
	<form action="GrabarActivar.php" method="post" name="f1">
            <input type="hidden" name="Desde" value="<?echo $Desde;?>">
            <input type="hidden" name="Hasta" value="<?echo $Hasta;?>">

	      <table border="0" align="center" width="200">
               <tr>
		  <td><b>Estado:</b></td>
	          <td><select name="Validar" class="cajas">
                   <option value="0">Seleccione
		  <option value="ACTIVA">ACTIVA
	          <option value="FALTA">DESACTIVAR
		  </select></td>
              </tr>
               </table>
                <table border="0" align="center" width="552">
                 <tr class="cajas">
	             <th><b>Item</b></td><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Cedula</b></th><th><b>Empleado</b></th><th><b>EstadoC</b></th><th><b>Zona</b></th>
	          </tr>
		<?
		include("../conexion.php");
		$lista=$_POST["datos"];
                 $i=1;
		foreach($lista as $Codzona){
		     $conB="select zona.zona,nomina.cedemple,nomina.neto,concat(nomemple, ' ' ,nomemple1,  ' ' ,apemple, ' ' ,apemple1) as Empleado,nomina.estadoc,zona.nitzona from empleado,nomina,zona,periodo
				         where zona.codzona=empleado.codzona and
		                        zona.codzona=periodo.codzona and
		                         nomina.cedemple=empleado.cedemple and
                                         nomina.estadoc='FALTA' and
		                         periodo.codigo=nomina.codigo and
				        zona.codzona='$Codzona' and
				        periodo.desde='$Desde' and periodo.hasta='$Hasta' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
		     $resB=mysql_query($conB) or die("Error al buscar zonas");
		     $regZ=$regZ + mysql_num_rows($resB);
		     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . $regZ . "\">");
		     while ($filas_s = mysql_fetch_array($resB)):
		          ?>
		          <tr class="cajas">
		              <th><?echo $i;?></th>
		              <?
		              echo ("<td><input type=\"checkbox\" id=name=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $filas_s['cedemple'] ."\" onClick=\"ActualizarSaldo()\"></td>");?>
		              <td><input type="text" value="<?echo $filas_s["cedemple"];?>"  size="13" readonly class="cajas"></td>
		              <td><input type="text" value="<?echo $filas_s["Empleado"];?>" name="empleado[<? echo $i;?>]"id="empleado[<? echo $i;?>]" size="45" readonly class="cajas"></td>
		              <td><input type="text" value="<?echo $filas_s["estadoc"];?>" name="Estadoc[<? echo $i;?>]"id="Estadoc[<? echo $i;?>]"size="11"  class="cajas"></td>
		              <td><input type="text" value="<?echo $filas_s["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]"size="40" class="cajas" readonly></td>
		          <tr>
			     <?
			     $i=$i+1;
		    endwhile;
		}
		?>
		<td><input type="hidden" value="<?echo $suma;?>" name="totalpagado" size="15" class="cajas" readonly></td>
		   <tr><td><br></td></tr>
		   <td colspan="5">
		   <input type="submit" value="Enviar Dato" class="boton" ></td>
    </table>
</form>
 <?
 endif;
 ?>
</body>
</html>

</body>

</html>
