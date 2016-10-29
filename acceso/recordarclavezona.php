<html>
<head>
  <title>Recordar Clave Zona</title>
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
                        if (document.getElementById("nit").value.length <=0)
                        {
                            alert ("Digite el Nit/Cedula de la empresa");
                            document.getElementById("nit").focus();
                            return;
                        }
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento de administrador del sistema");
                            document.getElementById("cedula").focus();
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
     <td><b>Nit/Cedula:</b></td>
     <td><input type="password" name="nit" value="" size="15" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nit">
     </tr>
   <tr>
     <td><b>Documento Administrador:</b></td>
     <td><input type="password" name="cedula" value="" size="15" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula">
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
     $consulta="select zona.zona,zona.codzona,zona.permiso from zona where zona.nitzona='$nit' and zona.estado='ACTIVA'";
     $resulta=mysql_query($consulta)or die("Consulta incorrecta");
     $registros=mysql_num_rows($resulta);
     $filas=mysql_fetch_array($resulta);
     $codzona=$filas["codzona"];
     $zona=$filas["zona"];
     if($registros!=0):
        $con="select accesozona.* from accesozona where accesozona.cedula='$cedula' and usuario='$nit'";
        $res=mysql_query($con)or die("Error al buscar de usuarios");
        $regi=mysql_num_rows($res);
        $filas_s=mysql_fetch_array($res);
        if ($regi!=0):
            ?>
	             <center><h4><u>Datos de la Zona</u></h4></center>
	               <table border="0" align="center">
	               <tr><td><br></td></tr>
	                  <tr>
			     <th>Cod_Zona</th>
	                     <th>Zona</th>
	                     <th>Administrador</th>
                             <th>Usuario</th>
                            <th>Clave</th>
                     </tr>
                           <tr class="cajas">
                              <td><?echo $codzona;?></td>
                              <td><?echo $zona;?></td>
                              <td><?echo $filas_s["nombre"];?></td>
                              <td><?echo $filas_s["usuario"];?></td>
                              <td><font color="red"><b><?echo $filas_s["clave"];?></b></font></td>
                           </tr>
	               </table>
	             <?
        else:
	         ?>
	           <script language="javascript">
	             alert("Este documento administrativo no existe en sistema ?")
	             history.back()
	             </script>
	          <?
        endif;
     else:
                ?>
	           <script language="javascript">
	             alert("Este Nit/Cedula no esta matriculado en sistema?")
	             history.back()
	             </script>
	          <?
     endif;
endif;
  ?>
</table>

</body>
</html>
