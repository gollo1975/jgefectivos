<html>

<head>
  <title>Consulta de Contratos</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
  ?>
 <center><h4><u>Consulta de Selección</u><h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr>
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Campo de Consulta:</b></td>
     <td><select name="campo">
        <option value="0">Seleccione una Opción
        <option value="1">Nro_Contrato
        <option value="2">Código_Empleado
        <option value="3">Documento
        <option value="4">Nombres
        <option value="5">Apellidos
        </select></td>
   </tr>
   <tr>
     <td><b>Valor de Consulta:</b></td>
     <td><input type="text" name="valor" value="" size="20" maxlength="20"></td>
   </tr>
   <tr>
   <td><b>Tipo_Proceso:</b></td>
       <td><input type="radio" value="Modificar"  name="TipoP" id="TipoP"><b>Modificar</b><input type="radio" value="Variacion_Salario" name="TipoP" id="TipoP"><b>Variación Salario</b></td>
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
elseif (empty($TipoP)):
?>
  <script language="javascript">
    alert ("Seleeccione el tipo de proceso a realizar.!")
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
        contrato.contrato='$valor'";
        break;
      case 2:
        $consulta="select contrato.*,tipocontrato.concepto,empleado.* from empleado,contrato,tipocontrato where
        empleado.codemple=contrato.codemple and
        tipocontrato.tipo=contrato.tipo and empleado.codemple='$valor'";
        break;
      case 3:
        $consulta="select contrato.*,tipocontrato.concepto,empleado.* from empleado,contrato,tipocontrato where
        empleado.codemple=contrato.codemple and
        tipocontrato.tipo=contrato.tipo and
        empleado.cedemple='$valor'";
        break;
      case 4:
        $consulta="select contrato.*,tipocontrato.concepto,empleado.* from empleado,contrato,tipocontrato where
        empleado.codemple=contrato.codemple and
        tipocontrato.tipo=contrato.tipo and
        empleado.nomemple like'%$valor%'";
        break;
      case 5:
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
<center><h4><u>Datos a Modificar</u></h4></center>
    <table border="0" align="center">
        <tr class="cajas">
          <td>Para modificar el contrato, Presione Click sobre el Nro_Contrato</td>
        </tr>
      </table>
<table border="0" align="center">
  <tr class="cajas">
     <th>Nro_Cont.</th>
     <th>Nombres</th>
     <th>Apellidos</th>
     <th>F._Inicio</th>
     <th>F._Final</th>
     <th>Salario</th>
	 <th>C_Salario</th>
	 <th>F_Cambio</th>
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
       <td><a href="modificar.php?con=<?echo $filas["contrato"];?>&TipoP=<?echo $TipoP;?>"><?echo $filas["contrato"];?></a></td>
       <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["fechainic"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["fechater"];?></td>
       <td>&nbsp;&nbsp;<?echo $aux1;?></td>
	   <td>&nbsp;&nbsp;<?echo $filas["cambio"];?></td>
	   <?if($filas["cambio"]=='SI'){?>
	   	   <td>&nbsp;&nbsp;<?echo $filas["salario_fecha_desde"];?></td>
	   <?}else{?>
		   <td>&nbsp;&nbsp;<?echo '0000-00-00';?></td>
	   <?}?>	   
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
