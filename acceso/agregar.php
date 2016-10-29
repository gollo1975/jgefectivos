<?
 session_start();
?>
<html>
<head>
  <title>Conexión a la Base de datos</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
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
                        if (document.getElementById("usuario").value.length <=0)
                        {
                            alert ("Digite el usuario del sistema");
                            document.getElementById("usuario").focus();
                            return;
                        }
                        if (document.getElementById("clave").value.length <=0)
                        {
                            alert ("Digite la clave para el acceso  al sistema ?");
                            document.getElementById("clave").focus();
                            return;
                        }
                         if (document.getElementById("documento").value.length <=0)
                        {
                            alert ("Digite el documento del usuario del sistema ?");
                            document.getElementById("documento").focus();
                            return;
                        }
                         document.getElementById("matusuario").submit();

                    }
                </script>
<?
 if (!isset($usuario)):
 include ("../conexion.php");
?>

  <form action="" name="ingreso" method="post" id="matusuario">
   <div align="center"><img src="../image/logocompleto.png" border="1" width="450" height="170" title="Cargando la Base de Datos Jgefectivos"></div>
   <tr><td><br></td></tr>
    <table border="0" align="center">
      <tr><td><br></td></tr>

      <tr>
      <u><div align="center"><h4>Conexión a la Base de Datos</h4></div></u>
      <td><b>Digite el Usuario:&nbsp;&nbsp;</b></td>
        <td><input type="text" name="usuario" value="" size="20" maxlength="20" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="usuario">&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td><b>Digite el Password:&nbsp;&nbsp;</b></td>
        <td><input type="password" name="clave" value="" size="20" class="cajas" maxlength="20"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="clave">&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td><b>Documento Identidad:&nbsp;&nbsp;</b></td>
        <td><input type="password" name="documento" value="" size="20" class="cajas" maxlength="20"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="documento">&nbsp;&nbsp;</td>
      </tr>
            <tr>
                <td><b>Hora Fija:</b></td>
                  <td colspan="1"><select name="hora" class="cajasletra">
                            <?
                                                                $consulta_z="select hora from parametrohora ";
                                                                $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
                                                                while ($filas_z=mysql_fetch_array($resultado_z))
                                                                {
                                                        ?>
                                                                <option value="<?echo $filas_z["hora"];?>"><?echo $filas_z["hora"];?>
                                                        <?
                                                                }
                                                        ?>
                                                </select></td>
      <tr>
       <tr><td><br></td></tr>
      <tr>
        <td colspan="2">
         <input type="button" Value="Aceptar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
       </tr>
       <tr><td><br></td></tr>
  </table>
  <tr>

 </tr>
</form>

 <?
  else:
  $usuario = strtoupper($usuario);
     include("../conexion.php");
     $conE="select * from acceso where acceso.estado='ACTIVO' and acceso.clave='$clave' and acceso.usuario='$usuario'";
     $resulE=mysql_query($conE)or die ("Consulta incorrecta");
     $regiE=mysql_num_rows($resulE);
     if($regiE!=0):
	     $pfecha=date("Y-m-d");
	     $clave=strtoupper($clave);
	     $consulta="select * from acceso where usuario='$usuario' and clave='$clave'";
	     $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
	     $registro=mysql_num_rows($resultado);
	     $filas=mysql_fetch_array($resultado);
	     $menu=$filas["menu"];
	     $fechaven=$filas["fechaven"];
	     if ($registro==0):
	         ?>
	        <script language="javascript">
	          alert("El Usuario o Clave, son Incorrectos Para el Ingreso ?")
	           open("agregar.php","_self")
	        </script>
	       <?
	     else:
	            $grabarD="update acceso set fechaingreso='$pfecha' where usuario='$usuario'";
	            $resD=mysql_query("$grabarD")or die ("Error al actualizar fechas");
	             mysql_affected_rows();
		     $consD="select * from acceso where cedula='$documento'";
		     $resuD=mysql_query($consD)or die ("Error al buscar documento del usuario");
		     $regisD=mysql_num_rows($resuD);
		     $filas_d=mysql_fetch_array($resuD);
	             $HoraIngreso=$filas_d["horaingreso"];
	             $FechaIngreso=$filas_d["fechaingreso"];
	              if ($regisD==0):
	                   ?>
		        <script language="javascript">
		          alert("Error al validar el documento de identidad ?")
		           open("agregar.php","_self")
		        </script>
		       <?
	              else:
	               if ($pfecha == $FechaIngreso):
	                  if ($hora >= $HoraIngreso):
		                $con="select acceso.fechaven from acceso
		                 where usuario='$usuario' and clave='$clave' and
		                '$fechaven' < '$pfecha'";
			        $res=mysql_query($con)or die("Error al buscar la fecha de vencimiento ?");
			        $regi=mysql_affected_rows();
			        $clave=strtoupper($clave);
			        if($regi!=0):
			          header("location: validar.php?fechaven=$fechaven&usuario=$usuario&clave=$clave");
			        else:
			          $_SESSION["xsession"]=$usuario;
			           header("location: $menu");
			        endif;

	                  else:
	                     ?>
			        <script language="javascript">
			          alert("Usted llego tarde a laborar en la empresa, por este motivo no puede ingresar a sistema ?")
			           open("agregar.php","_self")
			        </script>
			       <?
	                  endif;
	               else:
	                   ?>
			        <script language="javascript">
			          alert("Usted no se hizo el registro de ingreso en la recepcion, por tal motivo no hay acceso?")
			           open("agregar.php","_self")
			        </script>
			       <?
	               endif;
	          endif;
               endif;
       else:
           ?>
			        <script language="javascript">
			          alert("Este Usuario se incuentra INACTIVO en el sistema de Ingreso!")
			           open("agregar.php","_self")
			        </script>
			       <?
       endif;
 endif;
?>
</body>

</html>
