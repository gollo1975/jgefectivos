<html>

<head>
  <title>Modificar Datos</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
include("../conexion.php");
$con="select observacion.numero,observacion.descripcion from observacion where numero='$codigo'";
$resu=mysql_query($con)or die ("Error de Consulta");
while($filas=mysql_fetch_array($resu)):
  ?>
  <center><h4><u>Modificar Datos</u></h4></center>
   <form action="grabar.php" method="post">
     <table border="0" align="center">
     <tr><td><br></td></tr>
       <tr>
         <td><b>Nro_Obser.:</b></td>
         <td><input type="text" name="numero" value="<? echo $filas["numero"];?>" size="2" readonly></td>
       </tr>
       <tr>
         <td><b>Observación:</b></td>
         <td colspna="5"><textarea name="nota" cols="50" rows="5" class="cajas"><? echo $filas["descripcion"];?>"</textarea></td>
       </tr>
       <tr>
         <td colspan="5">
         <input type="submit" value="Enviar Dato" class="boton"></td></tr>
       <tr>
     </table>
   </form>
  <?
endwhile;
?>

</body>

</html>
