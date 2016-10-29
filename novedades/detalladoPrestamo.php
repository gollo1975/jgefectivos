 <head>
                <title>Crear Centro de Costo</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
 <?
include("../conexion.php");
$con1="select prestamoempresa.estado from prestamoempresa where
prestamoempresa.nroprestamo='$nroprestamo'";
$resu1=mysql_query($con1)or die ("Consulta Incorrecta 1");
$reg1=mysql_num_rows($resu1);
$filas = mysql_fetch_array($resu1);
?>
    <div align="center"><b><h4><u>Actualizar</u></h4></b></div>
    <form action="actualizar.php" method="post">
    <input type="hidden" name="nroprestamo" value="<?echo $nroprestamo;?>">
    <input type="hidden" name="desde" value="<?echo $desde;?>">
    <input type="hidden" name="hasta" value="<?echo $hasta;?>">
    <input type="hidden" name="campo" value="<?echo $campo;?>">
       <table border="0" align="center">
          <tr><td><br></td></tr>
       <tr>
                <td><b>Forma_Pago:</b></td>
                   <td><select name="estado" class="cajas">
                   <option value="<?echo $filas["estado"];?>" selected><?echo $filas["estado"];?>
                   <option value="ACTIVO">ACTIVO
                  <option value="INACTIVO">INACTIVO
               </select></td>
       <tr>
          <tr><td><br></td></tr>
          <tr>
	    <td colspan="2">
	      <input type="submit" value="Actualizar" class="boton">
	    </td>
	  </tr>
      </table>
   </form>

</body>
</html>
