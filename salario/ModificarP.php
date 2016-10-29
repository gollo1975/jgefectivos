<html>
        <head>
                <title>Modificacion de Salario</title>
                 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
<?
include("../conexion.php");
$consulta="select * from parametro where codigo='$Codigo'";
$resultado=mysql_query($consulta) or die("consulta incorrecta");
$registros=mysql_num_rows($resultado);
$filas=mysql_fetch_array($resultado);
if ($registros==0):
   ?>
   <script language="javascript">
           alert("No Existen Registros")
           history.back()
   </script>
   <?
else:
   ?>
    <center><h4><u>Datos a Modificar</u></h4></center>
    <form action="GuardarP.php" method="post">
    <table border="0" align="center">
        <tr>
        <td><b>Codigo:</b></td>
        <td><input type="text" name="Codigo" value="<?echo $Codigo;?>"size="10" class="cajas" readonly></td>
        </tr>
        <tr>
        <td><b>Concepto:</b></td>
        <td><input type="text" name="concepto" value="<?echo $filas["concepto"];?>" size="50" class="cajas"maxlength="45"></td>
        </tr>
        <tr>
        <td><b>Nivel:</b></td>
        <td><input type="text" name="nivel" value="<?echo $filas["nivel"];?>" size="10" class="cajas"maxlength="5"></td>
        </tr>
        <tr>
        <td><b>Estado:</b></td>
        <td><select name="Estado" class="cajas">
        <option value="<?echo $filas["estado"];?>" selected><?echo $filas["estado"];?>
        <option value="ACTIVO">ACTIVO
        <option value="INACTIVO">INACTIVO
        </select></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
        <td colspan="2"><input type="submit" value="Guardar" class="boton"></td>
        </tr>
        </table>
        </form>

        <?
endif;
        ?>
       </body>
</html>
