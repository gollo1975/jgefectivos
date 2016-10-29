<html>
<head>
<title>Crear Parámetros</title>
   <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
   <script language="javascript">
      function ColorFoco(obj)
        {
       document.getElementById(obj).style.background="#9DFF9D"
        }
      function QuitarFoco(obj)
        {
        document.getElementById(obj).style.background="white"
        }
      function chequearcampos()
        {
        if (document.getElementById("codigo").value.length <=0)
            {
            alert ("Digite código de la Compensación ?");
            document.getElementById("codigo").focus();
            return;
            }
         if (document.getElementById("concepto").value.length <=0)
            {
            alert ("Digite la descripción del código ?");
            document.getElementById("concepto").focus();
            return;
            }
             document.getElementById("matpara").submit();
          }
         function valide()
        {
        if (document.getElementById("cedula").value.length <=0)
            {
            alert ("Digite el documento de identidad ?");
            document.getElementById("cedula").focus();
            return;
            }
          document.getElementById("matc").submit();
          }

   </script>
</head>
<body>
<?
if(!isset($estado)):
   ?>
  <center><h5><u>Parámetros de Nómina</u></h5></center>
   <form action="" method="post">
     <table border="0" align="center">
       <tr><td><br></td></tr>
       <tr>
       <td><b>Tipo de Busqueda:</b></td>
       <td><input type="radio" name="estado" value="1">Aporte Social</td><td colspan="3"><input type="radio" name="estado" value="2">Colillas de Pago&nbsp;</td>
     </tr>
       <tr><td><br></td></tr>
      <tr>
        <td colspan="2"><input type="submit" Value="Enviar Dato" class="boton"></th>
      </tr>
    </table>
  </form>
  <?
else:
    if($estado==1):
      ?>
          <center><h5><u>Aporte Social</u></h5></center>
           <form action="grabarp.php" post="method" id="matpara">
              <table border="0" align="center">
                  <tr><td></br></td></tr>
                  <tr>
                       <td><b>Codigo:</b></td>
                       <td><input type="text" name="codigo" value=""size="10" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codigo"></td>
                  </tr>
                  <tr>
                       <td><b>Descripción:</b></td>
                       <td><input type="text" name="concepto" value=""size="40" maxlength="40" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="concepto"></td>
                  </tr>
                  <tr><td><br></td></tr>
	      <tr>
	        <td colspan="2"><input type="button" Value="Grabar" class="boton" onclick="chequearcampos()"></th>
	      </tr>
              </table>
           </form>
          <?
   else:
     if($estado==2):
        if(!isset($cedula)):
              ?>
              <center><h5><u>Colillas de pago</u></h5></center>
              <form action="" post="method" id="matc">
                <table border="0" align="center">
                  <tr><td></br></td></tr>
                  <tr>
                       <td><b>Documento de Identidad:</b></td>
                       <td><input type="text" name="cedula" value="" size="15" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
                  </tr>
                  <tr><td><br></td></tr>
	          <tr>
	             <td colspan="2"><input type="button" Value="Buscar Dato" class="boton" onclick="valide()"></th>
	          </tr>
                </table>
              </form>
              <?
         else:
                    include("../conexion.php");
	            $con="select concat(nomemple,' ',nomemple1,' ',apemple,' ',apemple1) as nombre from empleado where empleado.cedemple='$cedula'";
	            $res=mysql_query($con)or die ("error al buscar dato");
	            $reg=mysql_num_rows($res);
	            $filas=mysql_fetch_array($res);
	            if($reg!=0):
		              ?>
                       <center><h5><u>Colillas de pago</u></h5></center>
                       <form action="grabarc.php" post="method" id="matc">
	                <table border="0" align="center">
	                  <tr><td></br></td></tr>
	                  <tr>
	                       <td><b>Documento:</b></td>
	                       <td><input type="text" name="cedula" value="<?echo $cedula;?>" size="15" maxlength="15" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
	                  </tr>
                          <tr>
	                       <td><b>Empleado:</b></td>
	                       <td><input type="text" name="nombres" value="<?echo $filas["nombre"];?>" size="40" maxlength="40" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombres"></td>
	                  </tr>
	                  <tr><td><br></td></tr>
		          <tr>
		             <td colspan="2"><input type="submit" Value="Grabar dato" class="boton" ></th>
		          </tr>
	                </table>
	              </form>
                      <?
                   else:
                     ?>
		       <script language="javascript">
		          alert("El Documento digitado no existe ?")
		          history.back()
		       </script>
		       <?
                  endif;
        endif;
      endif;
   endif;
endif;
?>

 </body>
</html>
