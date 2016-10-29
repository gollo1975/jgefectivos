<html>
<head>
  <title>Modificar Periodo de Nomina</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
include ("../conexion.php");
$consulta="select periodo.* from periodo where codigo='$codP'";
$resultado=mysql_query($consulta)or die("Consulta incorrecta");
$registro=mysql_affected_rows();
while($filas=mysql_fetch_array($resultado)):
  ?>
  <center><h4><u>Modificar Dato</u></h4></center>
  <form action="guardarmodificado.php" method="post">
  <input type="hidden" value="<? echo $Documento;?>"name="Documento">
  <input type="hidden" value="<? echo $Auxiliar;?>" name="Auxiliar">
    <table border="0" align="center" width="100">
    <tr><td><br></td></tr>
       <tr>
         <td><b>Código:</b></td>
         <td><input type="text" value="<? echo $filas["codigo"];?>" name="codigo" size="6" maxlength="6" class="cajas" readonly></td>
       </tr>
       <tr>
         <td><b>Cod_Zona:</b></td>
         <td><input type="text" value="<? echo $filas["codzona"];?>" name="codzona" size="3" maxlength="3" class="cajas" readonly></td>
         <td><b>Zona:</b></td>
         <td colspan="3"><input type="text" value="<? echo $zona;?>" name="zona" size="50" class="cajas" readonly></td>
       </tr>
       <td><b>Desde:</b></td>
         <td><input type="text" value="<? echo $filas["desde"];?>" name="desde" size="10" maxlength="10" class="cajas"></td>
         <td><b>Hasta:</b></td>
         <td><input type="text" value="<? echo $filas["hasta"];?>" name="hasta" size="10" maxlength="10" class="cajas"></td>
       </tr>
       <td><b>Estado:</b></td>
        <td><select name="estado" class="cajas">
          <option value="<?echo $filas["estado"];?>" selected><?echo $filas["estado"];?>
          <option value="falta">FALTA
          <option value="listo">LISTO
        </select></td>
       <tr>
       <td><b>Nota:</b></td>
        <td colspan="5"><textarea  value="<? echo $filas["nota"];?>"name="nota" cols="70" rows="6" class="cajas"></textarea></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td><input type="submit" Value="Guardar" class="boton"></td>
       </tr>
       <tr><td><br></td></tr>
      </table>
  </form>
<?
endwhile;
?>
</body>
</html>
