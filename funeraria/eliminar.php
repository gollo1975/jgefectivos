<html>
<head>
  <title>retiro de Funeraria</title>
  <link rel="stylesheet" href="../estilo.css" type="text/css">
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
                            alert ("Digite el ducumento del Empleado");
                            document.getElementById("cedula").focus();
                            return;
                        }
                        document.getElementById("matelimi").submit();
                   }
    </script>
</head>
<body>
<?
if(!isset($cedula)):
?>
  <center><h5>Consulta de Empleados</h5></center>
  <form action="" method="post" id="matelimi" >
    <table border="0" align="center">
    <tr><td><br></td></tr>
      <tr>
        <td><b>Documento de Identidad:</b></td>
        <td class="cajas"><input type="text" name="cedula" value="" size="13" maxlength="13" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
      </tr>
        <tr><td><br></td></tr>
        <tr>
        <td colspan="5">
        <input type="button" value="Buscar" class="boton" onclick="chequearcampos()"></td>
        </tr>
    </table>
  </form>
<?
else:
  include("../conexion.php");
  $con="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where empleado.cedemple='$cedula'";
  $re=mysql_query($con)or die("Error de Busqueda");
  $reg=mysql_num_rows($re);
  $filas_s=mysql_fetch_array($re);
  $nombre=$filas_s["nomemple"];
  $nombre1=$filas_s["nomemple1"];
  $apellido=$filas_s["apemple"];
  $apellido1=$filas_s["apemple1"];
  if ($reg==0):
    ?>
    <script language="javascript">
     alert("Este Documento no existe en la base de datos?")
     open("eliminar.php","_self")
    </script>
    <?
  else:
     $con1="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,funeraria.* from funeraria,empleado
             where  empleado.cedemple=funeraria.cedemple and
             empleado.cedemple='$cedula'";
     $re1=mysql_query($con1)or die("Error de Busqueda en beneficiarios");
     $registro=mysql_affected_rows();
     if($registro!=0):

          ?>
          <form action="retiro.php" method="post">
          <td><input type="hidden" name="cedula" value="<?echo $cedula;?>"></td>
          <table border="0" align="center">
            <tr>
              <td><b>Empleado:</b>&nbsp;<? echo $nombre;?>&nbsp<? echo $nombre1;?>&nbsp;<? echo $apellido;?>&nbsp;<? echo $apellido1;?></td>
            </tr>
          </table>
          <tr><td><br></td></tr>
          <table border="0" align="center">
           <tr>
             <td><br></td><td><b>&nbsp;Documento</b></td><td><b>&nbsp;Beneficiario</b></td><td><b>&nbsp;Parentezco</b></td>
           </tr>
            <tr>
               <td><br></td>
            </tr>
             <?
             while($filas=mysql_fetch_array($re1)):
                ?>
                <tr>
                <td><input type="checkbox" name="buscar[]" value="<? echo $filas["documento"];?>"></td>
                <td class="cajas">&nbsp;<? echo $filas["documento"];?></td>
                <td class="cajas">&nbsp;<? echo $filas["nombres"];?> </td>
                <td class="cajas">&nbsp;<? echo $filas["parentezco"];?></td>
                </tr>
                <?
             endwhile;
             ?>
             <tr><td><br></td></tr>
             <tr>
               <td colspan="5"><input type="submit" value="Eliminar" class="boton"></td>
             </tr>
             </table>
            </form>
            <?
    else:
      ?>
      <script language="javascript">
             alert("Este empleado no tiene  Beneficiarios en la base de datos?")
             open("eliminar.php","_self")
      </script>
            <?
    endif;
  endif;
endif;
?>
</body>

</html>
