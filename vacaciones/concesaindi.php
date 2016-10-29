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
        $consulta="select prestacion.* from prestacion,empleado where
        empleado.cedemple=prestacion.cedemple and
        empleado.nomemple like '%$valor%'";
        break;
      case 2:
        $consulta="select prestacion.* from prestacion,empleado where
        empleado.cedemple=prestacion.cedemple and
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
  <th>#</th>
     <th>Nro_Prest.</th>
     <th>Documento</th>
     <th>Empleado</th>
     <th>F_Proceso</th>
     <th>F_Inicio</th>
     <th>F_Term.</th>
     <th>Ibc</th>
     <th>Dias</th>
     <th>Deducción</th>
     <th>Total</th>
     <th>T_Pagar</th>
     <th>Present.</th>
	 <th>F_Present.</th>
	 <th>Observacion</th>
	 </tr>
    <? $a=1;
     while($filas=mysql_fetch_array($resultado)):
     $aux1=number_format($filas["ibc"],0);
     $aux2=number_format($filas["total"],0);
     $aux3=number_format($filas["totald"],0);
     $aux4=number_format($filas["totalp"],0);
   ?>
     <tr class="cajas align="center">
     <th><?echo $a;?></th>
       <td><a href="imprimirpresta.php?nropresta=<?echo $filas["nropresta"];?>"><div align="center"><?echo $filas["nropresta"];?></div></a></td>
       <td><?echo $filas["cedemple"];?></td>
       <td><?echo $filas["nombres"];?></td>
        <td><?echo $filas["fechapro"];?></td>
       <td><?echo $filas["fechaini"];?></td>
       <td><?echo $filas["fechacor"];?></td>
       <td><?echo $aux1;?></td>
       <td><?echo $filas["dias"];?></td>
       <td><div align="center"><?echo $aux3;?></div></td>
        <td><?echo $aux2;?></td>
         <td><div align="right"><?echo $aux4;?></div></td>
       <td><div align="center"><?echo $filas["estado"];?></div></td>
       <td><div align="center"><?echo $filas["fecharadicado"];?></div></td>
	   <td><div align="center"><?echo $filas["notatrabajador"];?></div></td>
	   
       </tr>
       <? $a=$a+1;
      endwhile;
    endif;
  endif;
  ?>
</table>
</body>
</html>
