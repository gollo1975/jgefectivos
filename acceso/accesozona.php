<?
 session_start();
?>
<html>
<head>
  <title>Conexión a la Base de datos</title>
  <LINK  REL="stylesheet" HREF="../estiloa.css"  type="text/css">
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
                        if (document.getElementById("Documento").value.length <=0)
                        {
                            alert ("Digite la clave para el acceso  al sistema ?");
                            document.getElementById("Documento").focus();
                            return;
                        }
                         document.getElementById("matusuario").submit();

                    }
                </script>
<?
 if (!isset($usuario)):
?>

  <form action="" method="post" id="matusuario">
    <table border="0" align="center">
      <tr>
        <td  colspan="2"><br></td>
      </tr>
      <tr>
       <div align="center"><img src="../image/password.png" border="0" width="130" height="100" title="Cargando la Base de Datos de JGEFEVTIVOS SAS"></div>
      <u><div align="center"><h4>Conexión a la Base de Datos</h4></div></u>
        <td><b>Digite Nit/Cedula:</b></td>
        <td><input type="text" name="usuario" value="" size="20" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="usuario"></td>
      </tr>
      <tr>
        <td><b>Digite el Password:</b></td>
        <td><input type="password" name="clave" value="" size="20" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="clave"></td>
      </tr>
       <tr>
        <td><b>Documento Admon:</b></td>
        <td><input type="text" name="Documento" value="" size="20" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Documento"></td>
      </tr>
       <tr><td><br></td></tr>
       <tr>
          <td class="cajas"><a href="recordarclavezona.php" target="_blank"><b><font color="blue"><u>Olvido su Clave...</u></font></b></a></td>

       </tr>
        <tr><td><br></td></tr>
      <tr>
        <td colspan="2">
         <input type="button" Value="Aceptar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
       </tr>
       <tr><td><br></td></tr>
  </table>
</form>
 <?
   else:
    include("../conexion.php");
/*CODIGO QUE VALIDA EL ESTADO DEL USUARIO*/
    $conE="select * from accesozona where accesozona.estado='ACTIVO' and accesozona.usuario='$usuario' and accesozona.clave='$clave'";
     $resulE=mysql_query($conE)or die ("Consulta incorrecta");
     $regiE=mysql_num_rows($resulE);
     if($regiE!=0):
        /*CODIGO QUE VALIDA EL DOCUMENTO*/
        $pfecha=date("Y-m-d");
        $conD="select accesozona.* from accesozona where cedula='$Documento'";
        $resD=mysql_query($conD)or die ("Error al buscar datos Documento");
        $regD=mysql_num_rows($resD);
        if($regD!=0):
	     $consulta="select accesozona.* from accesozona where accesozona.usuario='$usuario' and clave='$clave'";
	     $resultado=mysql_query($consulta)or die ("Error al buscar datos del usuario");
	     $registro=mysql_num_rows($resultado);
	     $filas=mysql_fetch_array($resultado);
	     $codzona=$filas["codzona"];
	     $fechaven=$filas["fechaven"];
	     if ($registro==0):
	         ?>
	        <script language="javascript">
	          alert("El Nit/Cedula o Clave, son Incorrectos Para el Ingreso ?")
	           open("accesozona.php","_self")
	        </script>
	       <?
	     else:
	      $con="select accesozona.fechaven from accesozona
	           where usuario='$usuario' and clave='$clave' and '$fechaven' < '$pfecha'";
	        $res=mysql_query($con)or die("Error al buscar la fecha de vencimiento ?");
	        $regi=mysql_affected_rows();
	        $clave=strtoupper($clave);
	        if($regi!=0):
	           header("location: validarzona.php?fechaven=$fechaven&usuario=$usuario&clave=$clave&codzona=$codzona&Documento=$Documento");
	        else:
	           $_SESSION["xzona"]=$codzona;
	           header("location: ../iniciomenuzona.php");
	        endif;
	     endif;
        else:
        ?>
	 <script language="javascript">
	     alert("El documento administrativo que digitó no esta validado en el sistema de la empresa.!")
	     open("accesozona.php","_self")
	</script>
	<?
        endif;
    else:
         ?>
	 <script language="javascript">
	     alert("Este usuario se encuentra INACTIVO en sistema, favor notificar al administrador!")
	     open("accesozona.php","_self")
	</script>
	<?
    endif;
endif;
?>
</body>

</html>
