<html>

<head>
  <title>Consulta de Contratos</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
  ?>
 <center><h4><u>Historial de Contratos</u><h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr>
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Campo de Consulta:</b></td>
     <td><select name="campo">
        <option value="0">Seleccione
        <option value="1">Documento
        <option value="2">Nombres
        <option value="3">Apellidos
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
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Seleccione la opcion a consultar.!")
    history.back()
  </script>
 <?
elseif (empty($valor)):
?>
  <script language="javascript">
    alert ("Digite un valor a Consultar:")
    history.back()
  </script>
 <?
  else:
    include("../conexion.php");
    $opc=$campo;
    switch($opc)
    {
      case 1:
        $consulta="select contrato.*,tipocontrato.concepto,empleado.* from empleado,contrato,tipocontrato where
        empleado.codemple=contrato.codemple and
        tipocontrato.tipo=contrato.tipo and
        empleado.cedemple='$valor'";
        break;
      case 2:
        $consulta="select contrato.*,tipocontrato.concepto,empleado.* from empleado,contrato,tipocontrato where
        empleado.codemple=contrato.codemple and
        tipocontrato.tipo=contrato.tipo and
        empleado.nomemple like'%$valor%'";
        break;
      case 3:
        $consulta="select contrato.*,tipocontrato.concepto,empleado.* from empleado,contrato,tipocontrato where
        empleado.codemple=contrato.codemple and
        tipocontrato.tipo=contrato.tipo and
        empleado.apemple like'%$valor%'";
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
<center><h4><u>Contratos</u></h4></center>
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
     <th>F._Retiro</th>
     <th>Salario</th>
     <th>T_Contrato</th>
     <th>Cargo</th>
     <th>Zona</th>
     <th>Nota</th>
   </tr>
    <?
     while($filas=mysql_fetch_array($resultado)):
      $Cedula=$filas["cedemple"];
      $aux=$filas["salario"];
      $aux1=number_format($aux,2);
      $Dato="select novedad.* from empleado,novedad where
          empleado.cedemple = novedad.cedemple and
          novedad.estado='ACTIVO' and
          empleado.cedemple='$Cedula'";
      $Res=mysql_query($Dato)or die ("erro de Novedad");
      $Reg=mysql_num_rows($Res);
      if($Reg==0):
           ?>
	     <tr class="cajas align="center">
		       <td><a href="auxiliaretiro.php?nrocontrato=<?echo $filas["contrato"];?>"><?echo $filas["contrato"];?></td>
		        <td><a href="DetallePD.php?Cedula=<?echo $Cedula;?>"><?echo $filas["cedemple"];?></a></td>
		       <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
		       <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
		       <td><?echo $filas["fechainic"];?></td>
		       <td><?echo $filas["fechater"];?></td>
		       <td><?echo $aux1;?></td>
		        <td><?echo $filas["concepto"];?></td>
		       <td><?echo $filas["cargo"];?></td>
		        <td><?echo $filas["zona"];?></td>
		        <td><?echo $filas["nota"];?></td>
	       </tr>
       <?
       endif;
    endwhile;
    endif;
  endif;
 ?>
</table>

</body>
</html>
