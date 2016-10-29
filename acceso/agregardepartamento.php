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
                         document.getElementById("matusuario").submit();

                    }
                </script>
<?
 if (!isset($usuario)):
 include("../conexion.php");
?>
<div align="center"><img src="../image/logocompleto.png" border="1" width="450" height="170" title="Cargando la Base de Datos Jgefectivos"></div>
<center><h4><u>Conexión a la Base de Datos</u></h4></center>
<form action="" method="post" id="matusuario">
<table border="0" align="center">

    <table border="0" align="center">
      <tr>
        <td  colspan="2"><br></td>
      </tr>
      <tr>
        <td><b>Digite el Usuario:</b></td>
        <td><input type="text" name="usuario" value="" size="20" maxlength="20" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="usuario"></td>
      </tr>
      <tr>
        <td><b>Digite el Password:</b></td>
        <td><input type="password" name="clave" value="" class="cajas" size="20" maxlength="20"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="clave"></td>
      </tr>
      <tr>
          <td><b>Departamento:</b></td>
          <td colspan="3"><select name="variable" class="cajas">
             <option value="0">Seleccione la sucursal
              <?
                $con="select sucursal.codsucursal,sucursal.sucursal from sucursal
                   where estadosucu='NO' order by sucursal";
                $res=mysql_query($con)or die("Error en la busqueda de cuetas");
                while($filas=mysql_fetch_array($res)):
                   ?>
                   <option value="<? echo $filas["codsucursal"];?>"><? echo $filas["sucursal"];?>
                   <?
                endwhile;
                   ?>
         </select></td>
      </tr>
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
 </table>

 <?
  elseif(empty($variable)):
    ?>
     <script language="javascript">
       alert("Debe de Seleccionar la sucursal para la conexión ?")
       history.back()
     </script>
    <?
  else:
     include("../conexion.php");
	 $usuario = strtoupper($usuario);
     $pfecha=date("Y-m-d");
     $consulta="select * from acceso where usuario='$usuario' and clave='$clave'";
     $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
     $registro=mysql_num_rows($resultado);
     $filas=mysql_fetch_array($resultado);
     $fechaven=$filas["fechaven"];
     $DatoUSuario=$filas["usuario"];
     if ($registro==0):
         ?>
        <script language="javascript">
          alert("El Usuario o Clave, son Incorrectos Para el Ingreso ?")
           open("agregardepartamento.php","_self")
        </script>
       <?
     else:
      $con="select acceso.fechaven from acceso
           where usuario='$usuario' and clave='$clave' and
                '$fechaven' < '$pfecha'";
        $res=mysql_query($con)or die("Error al buscar la fecha de vencimiento ?");
        $regi=mysql_affected_rows();
        if($regi!=0):
           header("location: validardepartamento.php?fechaven=$fechaven&usuario=$usuario&clave=$clave&codigo=$variable");
        else:
           $con="select sucursal.codsucursal,sucursal.sucursal from sucursal
                where sucursal.codsucursal='$variable'";
             $res=mysql_query($con)or die ("Consulta incorrecta");
             $reg=mysql_num_rows($res);
             $fila=mysql_fetch_array($res);
             if($reg!=0):
                 $codaux=$fila["codsucursal"];
                $_SESSION["xdepto"]=$codaux;
                $_SESSION["DatoUsuario"]=$usuario;
                header("location: ../iniciomenudepartamento.php");
             else:
                ?>
                <script language="javascript">
                  alert("No hay conexión con  la base de datos del servidor ?")
                   open("agregardepartamento.php","_self")
                </script>
               <?
             endif;
        endif;
     endif;
endif;
?>
</body>

</html>
