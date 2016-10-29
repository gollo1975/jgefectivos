<html>
<head>
  <title>Registrar Usuario</title>
      <LINK  REL="stylesheet" HREF="../estiloa.css"  type="text/css">
</head>
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
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento de Identidad");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("matricula").submit();
                      }
                      function validar()
                       {
                        if (document.getElementById("contra").value.length <=0)
                        {
                            alert ("Digite la contraseña para el ingreso ingreso");
                            document.getElementById("contra").focus();
                            return;
                        }
                        if (document.getElementById("confirmar").value.length <=0)
                        {
                            alert ("Favor Confirmar la contraseña");
                            document.getElementById("confirmar").focus();
                            return;
                        }
                        if (document.getElementById("email").value.length <=0)
                        {
                            alert ("Digite el email? ");
                            document.getElementById("email").focus();
                            return;
                        }
                        if (document.getElementById("telefono").value.length <=0)
                        {
                            alert ("Favor digitar el telefono");
                            document.getElementById("telefono").focus();
                            return;
                        }
                         document.getElementById("matcontra").submit();

                    }
                </script>
<body>
<?
  if (!isset($cedula)):

  ?>
  <center><h4><u>Registrar Usuario</u></h4></center>
<form action="" method="post" id="matricula">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Documento de Identidad:</b></td>
     <td><input type="text" name="cedula" value="" size="15" maxlegth="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula">
     </tr>
     <tr><td></td></tr>
      <tr><td></td></tr>
      <tr><td></td></tr>
   <tr>
    <td colspan="2">
      <input type="button" value="Buscar" class="boton" Onclick="chequearcampos()">
      <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
   <tr><td></td></tr>
    <tr><td></td></tr>
</table>
<tr>
   <td><div align="center"><a href="http://www.jgefectivo.com"><img src="../image/regresar.png"  border="0" title="Regresar"></a></div></td>
</tr>
</form>
<?
else:
       include("../conexion.php");
     $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where cedemple='$cedula'";
     $resulta=mysql_query($consulta)or die("Consulta incorrecta");
     $registros=mysql_num_rows($resulta);
     if($registros!=0):
        $con="select empleado.nomemple from empleado,contrato
              where empleado.codemple=contrato.codemple and
                   contrato.fechater='0000-00-00' and
                    empleado.cedemple='$cedula'";
        $res=mysql_query($con)or die("Error al buscar datos del asociado");
        $regi=mysql_num_rows($res);
        $filas=mysql_fetch_array($resulta);
        if ($regi!=0):
             ?>
             <center><h4><u>Datos del Usuario</u></h4></center>
             <td><div align="center"><b>Todos los campos con * son Obligatorios.</b></div></td>
             <form action="grabarasociado.php"method="post" id="matcontra">
               <table align="center">
               <tr><td><br></td></tr>
                  <tr>
		     <td><b>Documento(*):</b></td>
		     <td><input type="text" name="cedula" value="<?echo $cedula;?>"size="15" class="cajas" readonly=yes>
		  </tr>
                  <tr>
		     <td><b>Asociado(*):</b></td>
		     <td><input type="text" name="asociado" value="<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?>"size="40" class="cajas" readonly=yes>
		  </tr>
                  <tr>
		     <td><b>Contraseña(*):</b></td>
		     <td><input type="password" name="contra" value="" class="cajas" size="15" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="contra">
		  </tr>
                  <tr>
		     <td><b>Confirmar Contraseña(*):</b></td>
		     <td><input type="password" name="confirmar" value="" class="cajas"  size="15" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="confirmar">
		  </tr>
                  <tr>
		     <td><b>Email(*):</b></td>
		     <td><input type="text" name="email" value="" class="cajas" size="40" maxlength="40" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="email">
		  </tr>
                  <tr>
		     <td><b>Teléfono(*):</b></td>
		     <td><input type="text" name="telefono" value="" class="cajas" size="15" maxlength="7" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telefono">
		  </tr>
                  <tr>
		     <td><b>Celular:</b></td>
		     <td><input type="text" name="celular" value="" class="cajas" size="15" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="celular">
		  </tr>
                   <tr><td><br></td></tr>
                  <tr>
		        <td colspan="2">
		         <input type="button" Value="Aceptar" class="boton" onclick="validar()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
		  </tr>
               </table>
             </form>
             <?
         else:
         ?>
           <script language="javascript">
             alert("Este asociado aparace retirado de la Cooperativa?")
             history.back()
             </script>
          <?
         endif;
      else:
       ?>
           <script language="javascript">
             alert("El documento digitado no existe en el sistema de la Cooperativa")
             history.back()
             </script>
          <?
      endif;
   endif;
  ?>
</table>

</body>
</html>
