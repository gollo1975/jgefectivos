<?
 session_start();
?>
<html>
        <head>
                <title>Crear Relación</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <script language="javascript">
 						function tick()
 						{
							  var hours, minutes, seconds, ap;
							  var intHours, intMinutes, intSeconds;
							  var today;

							  today = new Date();

							  intHours = today.getHours();
							  intMinutes = today.getMinutes();
							  intSeconds = today.getSeconds();

							  switch(intHours){
								   case 0:
									   intHours = 12;
									   hours = intHours+":";
									   ap = "A.M.";
									   break;
								   case 12:
									   hours = intHours+":";
									   ap = "P.M.";
									   break;
								   case 24:
									   intHours = 12;
									   hours = intHours + ":";
									   ap = "A.M.";
									   break;
								   default:
									   if (intHours > 12)
									   {
										 intHours = intHours - 12;
										 hours = intHours + ":";
										 ap = "P.M.";
										 break;
									   }
									   if(intHours < 12)
									   {
										 hours = intHours + ":";
										 ap = "A.M.";
									   }
								}


							  if (intMinutes < 10) {
								 minutes = "0"+intMinutes+":";
							  } else {
								 minutes = intMinutes+":";
							  }

							  if (intSeconds < 10) {
								 seconds = "0"+intSeconds+" ";
							  } else {
								 seconds = intSeconds+" ";
							  }

							  timeString = hours+minutes+seconds+ap;
							  mifactura.fechahora.value = timeString;
							  //Clock.innerHTML = timeString;

							  window.setTimeout("tick();", 100);
							}

							window.onload = tick;
                </script>
<?
if(session_is_registered("xsession")):
    include("../conexion.php");
    $consulta="select zona.zona,empleado.cedemple from zona,empleado,contrato
    where empleado.codzona=zona.codzona and
           empleado.codemple=contrato.codemple and
           contrato.fechater='0000-00-00' and
    zona.codzona='$codzona'";
    $resultado=mysql_query($consulta)or die("Error al buscar zonas");
    $Contador=mysql_num_rows($resultado);
    /*codigo de zona*/
    $conZ="select zona.zona from zona
    where zona.codzona='$codzona'";
    $resZ=mysql_query($conZ)or die("Error al buscar zonas");
    $regZ=mysql_num_rows($resZ);
    $filas=mysql_fetch_array($resZ);
    if ($regZ==0):
	     ?>
	     <script language="javascript">
	       alert("No existe el registro en la bd ?")
	       history.back()
	     </script>
	    <?
    else:
           $conT="select zona.zona from zona,procesonomina where zona.codzona=procesonomina.codzona and procesonomina.estado='ABIERTO' and zona.codzona='$codzona'";
	    $resT=mysql_query($conT)or die("Error al buscar zonas");
	    $regT=mysql_num_rows($resT);
	    if ($regT==0):
               ?>
	       <center><h4><u>Abrir Proceso</u></h4></center>
	         <form action="GrabarProceso.php" name="mifactura"method="post">
	         <input type="hidden" value="<?echo $Auxiliar;?>" name="Auxiliar">
	          <input type="hidden" value="<?echo $Documento;?>" name="Documento">
                  <input type="hidden" value="<?echo $Contador;?>" name="Contador">
	           <table border="0" align="center"width="310">
	           <tr><td><br></td></tr>
	             <tr>
	              <td><b>Cod_Zona:</b></td>
	             <td><input type="text" name="codzona"  value="<?echo $codzona;?>" size="4" readonly class="cajas" ></td>
	             </tr>
	             <tr>
	              <td><b>Zona:</b></td>
	             <td><input type="text" name="zona"  value="<?echo $filas["zona"];?>" size="50" readonly class="cajas" ></td>
	          <tr>
	              <td> <b>Estado:</b></td>
	               <td ><select name="estado" class="cajasletra">
	                 <option value="ABIERTO">ABIERTO
	                  <option value="CERRADO">CERRADO
	                  </select>
	                <b>Hora:</b>
	                  <input type="text" name="fechahora"  value="" size="12" readonly class="cajas" ></td>
	              </tr>

		         <tr><td><br></td></tr>
		            <td colspan="2"><input type="submit" value="Guardar" class="boton">&nbsp;<input type="reset" value="Limpiar" class="boton"></td>
		        </tr>
			<tr><td><br></td></tr>
			</table>

			  </form>
                  <?
                else:
                   ?>
		     <script language="javascript">
		       alert("Esta zona ya tiene el proceso para nómina abierto.")
		       history.back()
		     </script>
		    <?
                endif;
        endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
        ?>
 </body>
</html>
