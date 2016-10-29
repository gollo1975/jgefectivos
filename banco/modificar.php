<?
 session_start();
?>
<html>
<head>
 <title>Modificar bancos</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>

<?
 if(session_is_registered("xsession")):
  include("../conexion.php");
     $consulta="select * from banco where codbanco='$codbanco'";
     $resultado=mysql_query($consulta)or die("Consulta incorrecta");
     $registros=mysql_num_rows($resultado);
       while($filas=mysql_fetch_array($resultado)):
?>
<center><h4><u>Modificar Datos</u></h4></center>
  <form action="guardarm.php" method="post">
  <table border="0" align="center">
  <tr><td><br></td></tr>
 <tr>
   <td><b>Cod_banco:</b></td>
   <td><input type="text" name="codbanco" value="<?echo $filas["codbanco"];?>" class="cajas" size="25"readonly></td>
 </tr>
 <tr>
   <td><b>Banco:</b></td>
   <td><input type="text" name="bancos" value="<?echo $filas["bancos"];?>"
      size="40" maxlength="40" class="cajas"></td>
 </tr>
 <tr>
   <td><b>Direccicón:</b></td>
   <td><input type="text" name="dirbanco" value="<?echo $filas["dirbanco"];?>"
      size="40" maxlength="40" class="cajas"></td>
 </tr>
 <tr>
   <td><b>Teléfono:</b></td>
   <td><input type="text" name="telbanco" value="<?echo $filas["telbanco"];?>"
      size="25" maxlength="7" class="cajas"></td>
 </tr>
 <tr>
   <td><b>Municipio:</b></td>
   <td><input type="text" name="municipio" value="<?echo $filas["municipio"];?>"
      size="25" maxlength="25" class="cajas"></td>
 </tr>
  <tr>
	<td><b>C_Nomina:</b></td>
	<td><select name="Convenio" class="cajas"  style="width: 170px" id="Convenio">
	<option value="<?echo $filas["nomina"];?>" selected><?echo $filas["nomina"];?>
	<option value="NO">NO	
	<option value="SI">SI
	</select></td>
 <tr><td><br></td></tr>
 <tr>
    <td colspan="2">
       <input type="submit" value="Guardar"class="boton">
    </th>
  </tr>
</table>
</form>
 <?
  endwhile;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;

 ?>
</body>
</html>
