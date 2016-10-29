<html>

<head>
  <title>Consulta de Prestaciones</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
  ?>
 <center><h4>Consulta de  Prestaciones Pagadas </h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr>
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Campo de Consulta:</b></td>
     <td><select name="campo">
        <option value="0">Seleccione una Opción
        <option value="1">Nombres
        <option value="2">Documento
        </select></td>
   </tr>
   <tr>
     <td><b>Documento de Identidad:</b></td>
     <td><input type="text" name="valor" value="" size="20" maxlength="20"></td>
   </tr>
   <tr><td><br></td></tr>
  <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="limpiar" class="boton">
    </td>
  </tr>
</table>
</form>
<?
elseif(empty($campo)):
?>
  <script language="javascript">
    alert ("Seleccione una opción de la Listar ?")
    history.back()
  </script>
 <?
elseif (empty($valor)):
?>
  <script language="javascript">
    alert ("Digite un valor a Consultar ?")
    history.back()
  </script>
 <?
  else:
    include("../conexion.php");
    $opc=$campo;
    switch($opc)
    {
      case 1:
        $consulta="select controlpresta.* from controlpresta,empleado where
        empleado.cedemple=controlpresta.cedemple and
        controlpresta.emple like '%$valor%'";
        break;
      case 2:
        $consulta="select controlpresta.* from controlpresta,empleado where
        empleado.cedemple=controlpresta.cedemple and
        empleado.cedemple = '$valor'";
        break;
       }
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
    ?>
    <script language="javascript">
    alert ("El dato consultado no existe en la bd.?")
    history.back()
    </script>
   <?
     else:
     ?>
<center><h4>Datos Encontrados</h4></center>
<table border="0" align="center">
        <tr class="cajas">
          <td>Presione Click sobre el Número de la Prestación Para ver el Informe..</td>
        </tr>
      </table>
<table border="0" align="center">
<tr>
    <td colspan="30"></td>
  </tr>
  <tr class="cajas">
     <th>Nro_Prestación</th>
     <th>Documento</th>
     <th>Empleado</th>
     <th>Fecha_Pagado</th>
     <th>Nota</th>
    </tr>
    <?
     while($filas=mysql_fetch_array($resultado)):
   ?>
     <tr class="cajas align="center">
       <td><a href="imprimirpresta.php?nropresta=<?echo $filas["nropresta"];?>"><?echo $filas["nropresta"];?></a></td>
       <td>&nbsp;&nbsp;<?echo $filas["cedemple"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["emple"];?></td>
        <td>&nbsp;&nbsp;<?echo $filas["fechacontrol"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["nota"];?></td>

       </tr>
       <?
      endwhile;
    endif;
  endif;
  ?>
</table>
</body>
</html>
