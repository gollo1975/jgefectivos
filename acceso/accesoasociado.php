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
                            alert ("Favor Digitar el documento de identidad!");
                            document.getElementById("usuario").focus();
                            return;
                        }
                        if (document.getElementById("clave").value.length <=0)
                        {
                            alert ("Digite el password o clave para el acceso  al sistema.");
                            document.getElementById("clave").focus();
                            return;
                        }
                         document.getElementById("matusuario").submit();

                    }
                </script>
<?
 if (!isset($usuario)):
?>

  <form action="" method="post" id="matusuario">
    <table border="0" align="center" width="350">
      <tr><td><br></td></tr>
      <div align="center"><img src="../image/LogoInicio.JPG" border="1" width="400" height="150" title="Cargando la Base de Datos Jgefectivos"></div>
      <u><div align="center"><h4>Conexión a la Base de Datos</h4></div></u>
      <tr>
        <td><b>Documento de Identidad:</b></td>
        <td><input type="text" name="usuario" value="" size="20" class="cajas" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="usuario"></td>
      </tr>
      <tr>
        <td><b>Password o Clave:</b></td>
        <td><input type="password" name="clave" value="" size="20" class="cajas" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="clave"></td>
      </tr>
       <tr><td><br></td></tr>
      <tr>
        <td colspan="1">
         <input type="button" Value="Aceptar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
       </tr>
       <tr><td><br></td></tr>
       <table border="0" align="center" width="300">
         <tr>
          <td class="cajas"><a href="recordarclave.php" target="_blank"><b><font color="blue">* Olvido su Clave...</font></b></a></td><td class="cajas"><a href="registrarse.php"target="_blank"><b><font color="blue">* Registrese...</b></font></a></td>

         <tr>
 </table>
  </table>
</form>
<table border="0" align="center" width="350">
   <tr>
   <td class="cajas"><b><u><font color="red">Nota Importante:</font></u></b>&nbsp;<p align="justify"><font color="green"><b>Una ves ingresado al Portal de JGEFECTIVOS SAS y su navegador de internet es 7.0 en adelante, se debe configurar las margenes para los respectivos informes. Izquierdo, Derecho, Superior e Inferior en tamaño 11, y el encabezado y pies de página debe de ser vacío.</b></font></p> <td/>
   </tr>
</table>
 <?
   else:
    include("../conexion.php");
     $pfecha=date("Y-m-d");
      $clave=strtoupper($clave);
     $consulta="select accesoasociado.* from accesoasociado where usuario='$usuario' and clave='$clave'";
     $resultado=mysql_query($consulta)or die ("Error al consultar usuarios");
     $registro=mysql_num_rows($resultado);
     $filas=mysql_fetch_array($resultado);
     $cedula=$filas["usuario"];
     if ($registro==0):
         ?>
        <script language="javascript">
          alert("El documento o Clave son incorrectos para el ingreso!. ")
           open("accesoasociado.php","_self")
        </script>
       <?
     else:
        $con="select accesoasociado.fechafinal from accesoasociado
           where usuario='$usuario' and clave='$clave' and
                accesoasociado.fechafinal < '$pfecha'";
        $res=mysql_query($con)or die("Error al buscar la fecha de vencimiento ?");
        $regi=mysql_affected_rows();
        $clave=strtoupper($clave);
         $fila=mysql_fetch_array($res);
        if($regi!=0):
           header("location: validarasociado.php?fechaven=$fechafinal&usuario=$usuario&clave=$clave");
        else:
          $_SESSION["xtemporal"]=$cedula;
           header("location: ../iniciomenuasociado.php");
        endif;
     endif;
endif;

?>
</body>

</html>
