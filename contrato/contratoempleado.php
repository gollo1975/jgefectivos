<html>

<head>
  <title>Consulta de Contratos</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
  ?>
 <center><h4>Consulta de Selección<h4></center>
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
        <option value="2">Primer Nombre
        <option value="3">Segundo Nombre
        </select></td>
   </tr>
   <tr>
     <td><b>Valor de Consulta:</b></td>
     <td><input type="text" name="valor" value="" size="20" maxlength="20"></td>
   </tr>
   <tr><td><br></td></tr>
  <tr>
    <td colspan="2">
      <input type="submit" value="busca" class="boton">
      <input type="reset" value="limpiar" class="boton">
    </td>
  </tr>
</table>

</form>
<?
elseif (empty($valor)):
?>
  <script language="javascript">
    alert ("Digite un valor a Consultar:")
    history.back()
  </script>
 <?
  elseif(empty($campo)):

?>
  <script language="javascript">
    alert ("Seleccion una cpcion de consulta")
    history.back()
  </script>
 <?
else:
    include("../conexion.php");
    $opc=$campo;
    switch($opc)
    {
      case 1:
        $consulta="select contrato.*,tipocontrato.concepto,empleado.* from empleado,contrato,tipocontrato,zona,sucursal where
        sucursal.codsucursal=zona.codsucursal and
        zona.codzona=empleado.codzona and
        sucursal.codsucursal='$codigo' and
        empleado.codemple=contrato.codemple and
        tipocontrato.tipo=contrato.tipo and
        empleado.cedemple='$valor'";
        break;
      case 2:
        $consulta="select contrato.*,tipocontrato.concepto,empleado.* from empleado,contrato,tipocontrato,zona,sucursal where
        sucursal.codsucursal=zona.codsucursal and
        zona.codzona=empleado.codzona and
        sucursal.codsucursal='$codigo' and 
        empleado.codemple=contrato.codemple and
        tipocontrato.tipo=contrato.tipo and
        empleado.nomemple like'%$valor%'";
        break;
      case 3:
       $consulta="select contrato.*,tipocontrato.concepto,empleado.* from empleado,contrato,tipocontrato,zona,sucursal where
       sucursal.codsucursal=zona.codsucursal and
        zona.codzona=empleado.codzona and
        sucursal.codsucursal='$codigo' and
        empleado.codemple=contrato.codemple and
        tipocontrato.tipo=contrato.tipo and
        empleado.nomemple1 like'%$valor%'";
        break;
     }
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
    ?>
    <script language="javascript">
    alert ("El dato consultado no existe en la bd o no pertenece a esta sucursal. ?")
    history.back()
    </script>
   <?
     else:
     ?>
<center><h4>Resultado de la Consulta</h4></center>
    <table border="0" align="center">
        <tr class="cajas">
          <td>Para ver las observaciones del contrato, Presione Click sobre el Nro_Contrato</td>
        </tr>
      </table>
<table border="0" align="center">
  <tr class="cajas">
     <th>Nro_Cont.</th>
       <th>Documento</th>
     <th>Nombres</th>
     <th>Apellidos</th>
     <th>F._Inicio</th>
     <th>F._Final</th>
     <th>Salario</th>
     <th>Tipo_Contrato</th>
     <th>Cargo</th>
     <th>Zona</th>
     <th>Nota</th>
   </tr>
    <?
     while($filas=mysql_fetch_array($resultado)):
      $aux=$filas["salario"];
      $aux1=number_format($aux,2);
   ?>
     <tr class="cajas align="center">
       <td><a href="auxiliaretiro.php?nrocontrato=<?echo $filas["contrato"];?>"><?echo $filas["contrato"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["cedemple"];?></td>
       <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["fechainic"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["fechater"];?></td>
       <td>&nbsp;&nbsp;<?echo $aux1;?></td>
        <td>&nbsp;&nbsp;<?echo $filas["concepto"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["cargo"];?></td>
        <td>&nbsp;&nbsp;<?echo $filas["zona"];?></td>
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
