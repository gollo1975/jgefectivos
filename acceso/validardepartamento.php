<?
 session_start();
?>
<html>
<head>
  <title>JGEFECTIVOS S.A.S.-Cambio de Clave</title>
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
                        if (document.getElementById("actual").value.length <=0)
                        {
                            alert ("Digite la clave actual de ingreso ?");
                            document.getElementById("actual").focus();
                            return;
                        }
                        if (document.getElementById("nueva").value.length <=0)
                        {
                            alert ("Digite la nueva clave para el ingreso ?");
                            document.getElementById("nueva").focus();
                            return;
                        }
                         if (document.getElementById("confirmar").value.length <=0)
                        {
                            alert ("Debe de Confirmar la nueva clave ?");
                            document.getElementById("confirmar").focus();
                            return;
                        }
                         document.getElementById("matusuario").submit();

                    }
                </script>
<?
if (!isset($actual)):
  ?>
  <tr><td><br></td></tr>
  <center><h4><u>Cambio de Clave</u></h4></center>
    <form action="" method="post" id="matusuario">
     <td><input type="hidden" name="fechave" value="<?echo $fechaven;?>" </td>
     <td><input type="hidden" name="codigo" value="<?echo $codigo;?>" </td>
     <td><input type="hidden" name="usuario" value="<?echo $usuario;?>" </td>
     <td><input type="hidden" name="clave" value="<?echo $clave;?>" </td>
      <table border="0" align="center">
         <tr>
           <td  colspan="2"><br></td>
         </tr>
         <tr>
           <td><b>Clave Actual:</b></td>
           <td><input type="text" name="actual" value="" size="20" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="actual">&nbsp;</td>
         </tr>
         <tr>
           <td><b>Nueva Clave:</b></td>
           <td><input type="password" name="nueva" value="" size="20" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nueva">&nbsp;</td>
         </tr>
         <tr>
           <td><b>Confirmar Clave:</b></td>
           <td><input type="password" name="confirmar" value="" size="20" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="confirmar">&nbsp;</td>
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
  $fechaven=date("Y-m-d");
  if($clave == $actual):
     if($nueva == $confirmar):
         if($clave != $nueva):
                 include("../conexion.php");
                 $nueva=strtoupper($nueva);
                  $con="update acceso set clave='$nueva',fechaven='$fechaven' + interval 45 day where usuario='$usuario'";
                  $resultado=mysql_query($con)or die("Error al actualizar datos de la clave $con");
                  $consulta="select * from acceso where usuario='$usuario' and clave='$nueva'";
                  $resultado=mysql_query($consulta)or die ("Error al validar el usuario ?");
                  $registro=mysql_num_rows($resultado);
                  $filas=mysql_fetch_array($resultado);
                  $menu=$filas["menu"];
                  if($registro!=0):
                      $_SESSION["xdepto"]=$codigo;
                      header("location: $menu");
                  else:
                    ?>
                    <script language="javascript">
                      alert("Los cambios no se actualizaron en sistema  ?")
                      open("agregardepartamento.php","_self")
                    </script>
                    <?
                  endif;
          else:
            ?>
            <script language="javascript">
               alert("Digite una nueva clave para el Ingreso al sistema ?")
               history.back()
            </script>
       <?
          endif;
     else:
       ?>
       <script language="javascript">
         alert("Error al confirmar la nueva Clave ?")
           history.back()
       </script>
       <?
     endif;
   else:
     ?>
      <script language="javascript">
         alert("La Clave Actual digitada o existe en sistema ?")
         history.back()
     </script>
     <?
   endif;
endif;
 ?>
</body>

</html>
