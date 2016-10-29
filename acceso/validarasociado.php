<?
 session_start();
?>
<html>
<head>
  <title>JGEFECTIVO SAS-Cambio de Clave</title>
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
     <td><input type="hidden" name="usuario" value="<?echo $usuario;?>" </td>
     <td><input type="hidden" name="clave" value="<?echo $clave;?>" </td>
      <table border="0" align="center">
         <tr>
           <td  colspan="2"><br></td>
         </tr>
         <tr>
           <td><b>Documento:</b></td>
           <td><input type="text" name="cedula" value="<?echo $usuario;?>" size="20" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula">&nbsp;</td>
         </tr>
         <tr>
           <td><b>Clave Actual:</b></td>
           <td><input type="password" name="actual" value="" size="20" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="actual">&nbsp;</td>
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
     include("../conexion.php");
     $cons="select empleado.cedemple from empleado,contrato
      where empleado.codemple=contrato.codemple and
      empleado.cedemple='$cedula' and
      contrato.fechater='0000-00-00'";
     $res=mysql_query($cons)or die ("Error al consultar de empleados");
     $regis=mysql_num_rows($res);
     if($regis!=0):
	  $fechaven=date("Y-m-d");
	  $nueva=strtoupper($nueva);
	  $confirmar=strtoupper($confirmar);
	  $actual=strtoupper($actual);
	  if($clave == $actual):
	     if($nueva == $confirmar):
	         if($clave != $nueva):
	                 $nueva=strtoupper($nueva);
	                  $con="update accesoasociado set clave='$nueva',fechafinal='$fechaven' + interval 45 day where usuario='$cedula'";
	                  $resultado=mysql_query($con)or die("Error al actualizar datos de la clave $con");
	                  $consulta="select * from accesoasociado where usuario='$cedula' and clave='$nueva'";
	                  $resultado=mysql_query($consulta)or die ("Error al validar el usuario ?");
	                  $registro=mysql_num_rows($resultado);
	                  $filas=mysql_fetch_array($resultado);
	                  if($registro!=0):
                           $_SESSION["xtemporal"]=$cedula;
                           header("location: ../iniciomenuasociado.php");
	                  else:
	                    ?>
	                    <script language="javascript">
	                      alert("Los cambios no se actualizaron en sistema  ?")
	                      open("accesoasociado.php","_self")
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
               alert("La Clave Actual digitada no existe en sistema ?")
               history.back()
            </script>
           <?
        endif;
    else:
       ?>
       <script language="javascript">
          alert("Lo siento, usted ya no es Empleado de JGEFECTIVOS SAS.!")
         history.go(-2)
       </script>
       <?
    endif;
endif;
 ?>
</body>

</html>
