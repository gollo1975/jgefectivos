<html>
<head>
  <title>Recordar Clave</title>
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
                        if (document.getElementById("valor").value.length <=0)
                        {
                            alert ("Digite el dato a consultar en sistema");
                            document.getElementById("valor").focus();
                            return;
                        }
                         document.getElementById("matricula").submit();
                      }

</script>
<body>
<?
  if (!isset($cedula)):

  ?>
  <center><h4><u>Recordar Clave</u></h4></center>
<form action="" method="post" id="matricula">
  <table border="0" align="center" width="350">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Documento de Identidad:</b></td>
     <td><input type="password" name="cedula" value="" size="20" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula">
     </tr>
     <tr>
     <td><b>Campo de Consulta:</b></td>
     <td><select name="campo" class="cajas">
        <option value="0">Seleccione la Opción
        <option value="1">Telefono
        <option value="2">Celular
        <option value="3">Email
        </select></td>
   </tr>
   <tr>
     <td><b>Digite el Dato:</b></td>
     <td><input type="password" name="valor" value="" size="20" maxlength="20" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="valor"></td>
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
</form>
<?
else:
       include("../conexion.php");
     $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where cedemple='$cedula'";
     $resulta=mysql_query($consulta)or die("Error al buscar empleado");
     $registros=mysql_num_rows($resulta);
     if($registros!=0):
        $con="select empleado.nomemple from empleado,contrato
              where empleado.codemple=contrato.codemple and
                   contrato.fechater='0000-00-00' and
                    empleado.cedemple='$cedula'";
        $res=mysql_query($con)or die("Error al validar contrato");
        $regi=mysql_num_rows($res);
        if ($regi!=0):
           $cons="select accesoasociado.* from accesoasociado
           where accesoasociado.usuario='$cedula'";
	   $resu=mysql_query($cons)or die("Error al buscar usuario");
	   $regis=mysql_num_rows($resu);
	   if ($regis!=0):
	           $opc=$campo;
		    switch($opc)
		    {
                      case 0:
                        ?>
		           <script language="javascript">
		             alert("Seleccione una opcion del sistema.!")
		             history.back()
		             </script>
		          <?
                        break;
		      case 1:
		        $consulta1="select accesoasociado.* from accesoasociado where accesoasociado.usuario='$cedula' and accesoasociado.telefono='$valor'";
                        
		        break;
		      case 2:
		        $consulta1="select accesoasociado.* from accesoasociado where accesoasociado.usuario='$cedula' and accesoasociado.celular='$valor'";
		        break;
		      case 3:
		       $consulta1="select accesoasociado.* from accesoasociado where accesoasociado.usuario='$cedula' and accesoasociado.email='$valor'";
		        break;

		       }
	              $re1=mysql_query($consulta1)or die ("Error al validar informacion");
		     $reg1=mysql_num_rows($re1);
                     $filas=mysql_fetch_array($re1);
		     if ($reg1!=0):
		             ?>
		             <center><h4><u>Datos del Usuario</u></h4></center>
		               <table border="0" align="center">
		               <tr><td><br></td></tr>
		                  <tr>
				     <th>Usuario</th>
		                     <th>Clave</th>
		                     <th>Asociado</th>
		                     <th>Telefono</th>
		                     <th>Email</th>
		                     <th>Celular</th>
				  </tr>
	                           <tr class="cajas">
	                              <td><?echo $filas["usuario"];?></td>
	                              <td><?echo $filas["clave"];?></td>
	                              <td><?echo $filas["nombre"];?></td>
	                              <td><?echo $filas["telefono"];?></td>
	                              <td><?echo $filas["email"];?></td>
	                              <td><?echo $filas["celular"];?></td>

	                           </tr>
		               </table>
		             <?
                   else:
		         ?>
		           <script language="javascript">
		             alert("La opción que seleccionó no conside con la información?")
		             history.back()
		             </script>
		          <?
	           endif;
            else:
                ?>
	           <script language="javascript">
	             alert("Este Asociado no presenta registros de validación de Clave?")
	             history.back()
	             </script>
	          <?
            endif;
         else:
         ?>
           <script language="javascript">
             alert("Este empleado aparace retirado en la Empresa.!")
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
<tr>
   <td><div align="center"><a href="accesoasociado.php"><img src="../image/regresar.png"  border="0" title="Regresar"></a></div></td>
</tr>
</body>
</html>
