<html>

<head>
  <title>Editar Contrato</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
  ?>
 <center><h4>Editar Contrato<h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr>
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Campo de Consulta:</b></td>
     <td><select name="campo">
        <option value="0">Seleccione
        <option value="1">Nit/Cedula
        <option value="2">Cliente
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
        $consulta="select contratocomercial.* from contratocomercial where
        contratocomercial.nit='$valor'";
        break;
      case 2:
        $consulta="select contratocomercial.* from contratocomercial where
        contratocomercial.cliente like '%$valor%'";
        break;
     }
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
	    ?>
	    <script language="javascript">
	    alert ("No hay registros en el sistema para mostrar")
	    history.back()
	    </script>
	   <?
    else:
     ?>
	<center><h4><u>Contratos</u></h4></center>
	    <table border="0" align="center">
	        <tr class="cajas">
	          <td>Presione Click sobre el Nro_Contrato para editarlo.</td>
	        </tr>
	      </table>
	<table border="0" align="center">
	  <tr class="cajas">
          <th>Item</th>
	     <th>Nro_Cont.</th>
	     <th>Nit/Cédula</th>
	     <th>Empresa</th>
             <th>Representante_Legal</th>
	     <th>F_Radicado</th>
	     <th>Estado</th>
	   </tr>
	    <?
	    $a=1;
	     while($filas=mysql_fetch_array($resultado)):
	         ?>
	          <tr class="cajas align="center">
	              <th><?echo $a;?></th>
	              <td><a href="DetalladoEditar.php?NroC=<?echo $filas["nroc"];?>"><?echo $filas["nroc"];?></td>
		      <td><?echo $filas["nit"];?></td>
		      <td><?echo $filas["cliente"];?></td>
                      <td><?echo $filas["representantelegal"];?></td>
		      <td><?echo $filas["fechap"];?></td>
		      <td><?echo $filas["estado"];?></td>
	          </tr>
	      <?
	      $a=$a+1;
	    endwhile;
      endif;
  endif;
 ?>
</table>

</body>
</html>
