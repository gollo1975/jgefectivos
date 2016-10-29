
<html>

<head>
  <title>Dotación por empleado</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
  ?>
<center><h4>Dotación por empleado</h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr><td><br></td></tr>
   <tr>
     <td><b>Campo de Consulta:</b></td>
     <td><select name="campo" class="cajas">
        <option value="0">Seleccione la Opción
        <option value="1">Documento
        <option value="2">Nombres
        </select></td>
   </tr>
   <tr>
     <td><b>Digite el Dato:</b></td>
     <td><input type="text" name="valor" value="" size="20" maxlength="20"></td>
   </tr>
   <tr><td><br></td></tr>
  <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>

</table>

</form>
<?
elseif (empty($valor)):
?>
  <script language="javascript">
    alert ("Digite Dato a Consultar ?")
    history.back()
  </script>
 <?
  else:
    include("../conexion.php");
    $opc=$campo;
    switch($opc)
    {
      case 1:
        $consulta="select talla.* from talla
         where talla.cedemple='$valor'";
        break;
      case 2:
        $consulta="select talla.* from talla
        where talla.nombre like'%$valor%'";
        break;

     }
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
    ?>
    <script language="javascript">
    alert ("El dato consultado no existe en la bd. ?")
    history.back()
    </script>
   <?
     else:
     ?>
<center><h4>Registros de Busqueda</h></center>
<table border="0" align="center">
<tr class="fondo">
  <td colspan="9"></td>
</tr>
<tr class="cajas">
  <br>
     <th>Documento</th>
     <th>Nombre</th>
     <th>Camisa</th>
     <th>Pantalon</th>
     <th>Zapato</th>
     <th>Fecha_P.</th>
     <th>Fecha_M.</th>
    </tr>
    <?
     while($filas=mysql_fetch_array($resultado)):
   ?>
     <tr class="cajas">
       <td><div align="center"><?echo $filas["cedemple"];?></div></td>
       <td><?echo $filas["nombre"];?></td>
       <td><div align="center"><?echo $filas["camisa"];?></div></td>
       <td><div align="center"><?echo $filas["pantalon"];?></div></td>
       <td><div align="center"><?echo $filas["zapato"];?></div></td>
       <td><div align="center"><?echo $filas["fechap"];?></div></td>
       <td><div align="center"><?echo $filas["fecham"];?></div></td>
      </tr>
       <?
    endwhile;
    endif;
  endif;
  ?>
</table>

</body>
</html>
