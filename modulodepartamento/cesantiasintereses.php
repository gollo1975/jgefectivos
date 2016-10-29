<html>

<head>
  <title>Consulta de Prestaciones</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
  ?>
 <center><h4>Consulta de  Prestaciones </h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr>
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Campo de Consulta:</b></td>
     <td><select name="campo">
        <option value="0">Seleccione una Opción
        <option value="1">Documento
        <option value="2">Nombres
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
          $consulta="select prestacion.* from prestacion,empleado,zona,sucursal where
        sucursal.codsucursal=zona.codsucursal and
        empleado.codzona=zona.codzona and
        empleado.cedemple=prestacion.cedemple and
        sucursal.codsucursal='$codigo' and
        empleado.cedemple = '$valor'";
        break;
      case 2:
         $consulta="select prestacion.* from prestacion,empleado,zona,sucursal where
          sucursal.codsucursal=zona.codsucursal and
        empleado.codzona=zona.codzona and
        empleado.cedemple=prestacion.cedemple and
        sucursal.codsucursal='$codigo' and
        empleado.nomemple like '%$valor%'";
        break;
       }
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
    ?>
    <script language="javascript">
    alert ("El dato consultado no existe en la bd. o no esta autorizado para ver este registro ?")
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
     <th>Nro_Prest.</th>
     <th>Documento</th>
     <th>Empleado</th>
     <th>Fecha_Proceso</th>
     <th>Fecha_Inicio</th>
     <th>Fecha_Term.</th>
     <th>Ibc</th>
     <th>Vlr_Generado</th>
      <th>Pagado</th>
    </tr>
    <?
     while($filas=mysql_fetch_array($resultado)):
     $aux1=number_format($filas["ibc"],0);
     $aux2=number_format($filas["total"],0);
   ?>
     <tr class="cajas align="center">
       <td><a href="../vacaciones/imprimirpresta.php?nropresta=<?echo $filas["nropresta"];?>"><?echo $filas["nropresta"];?></a></td>
       <td>&nbsp;&nbsp;<?echo $filas["cedemple"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["nombres"];?></td>
        <td>&nbsp;&nbsp;<?echo $filas["fechapro"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["fechaini"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["fechacor"];?></td>
        <td>&nbsp;&nbsp;<?echo $aux1;?></td>
       <td>&nbsp;&nbsp;<?echo $aux2;?></td>
         <td>&nbsp;&nbsp;<?echo $filas["estado"];?></td>

       </tr>
       <?
      endwhile;
    endif;
  endif;
  ?>
</table>
</body>
</html>
