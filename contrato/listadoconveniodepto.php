<html>

<head>
  <title>Consulta de Contratos</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
  ?>
 <center><h4><u>Contrato Temporal</u><h4></center>
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
        <option value="2">Documento
        <option value="3">Empleado
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
  else:
    include("../conexion.php");
    $opc=$campo;
    switch($opc)
    {
      case 1:
        $consulta="select convenio.* from convenio where
        convenio.nroconvenio='$valor'";
        break;
      case 2:
        $consulta="select convenio.* from convenio where
        convenio.cedemple='$valor'";
        break;
      case 3:
        $consulta="select convenio.* from convenio where
        convenio.nombres like'%$valor%'";
        break;
     }
    $resultado=mysql_query($consulta)or die ("Error la Buscar datos");
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
<center><h4><u>Listado de Contratos</u></h4></center>
    <table border="0" align="center">
        <tr class="cajas">
          <td>Para ver el contrato, Presione Click sobre el Nro_Contrato</td>
        </tr>
      </table>
<table border="0" align="center">
   <tr class="cajas">
      <th>Item</th>
     <th>Nro_Contrato</th>
     <th>Documento</th>
     <th>Empleado</th>
	 <th>Salario</th>
     <th>Tipo</th>
     <th>F._Radicado</th>
   </tr>
    <?
    $l=1;
     while($filas=mysql_fetch_array($resultado)):
	 $ValidarTipo= $filas["tipocontrato"]; 
     ?>
     <tr class="cajas align="center">
     <th><?echo $l;?></th>
	 <?if ($ValidarTipo ==''){ ?>
         <td><a href="imprimeconvenio.php?codigo=<?echo $filas["nroconvenio"];?>"><?echo $filas["nroconvenio"];?></a></td>
     <?}else{?>	
         <td><a href="ReporteContratoNuevo.php?CodReporte=<?echo $filas["nroconvenio"];?>"><?echo $filas["nroconvenio"];?></a></td>	 
     <?}?>		 
       <td><?echo $filas["cedemple"];?></td>
       <td><?echo $filas["nombres"];?></td>
	    <td><?echo $filas["salario"];?></td>
       <td><?echo $filas["tipo"];?></td>
       <td><?echo $filas["fechac"];?></td>
         </tr>

       <?
       $l=$l+1;
    endwhile;
    endif;
  endif;
 ?>
</table>

</body>
</html>
