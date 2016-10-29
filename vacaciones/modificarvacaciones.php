<html>

<head>
  <title>Vacaciones</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($Cedula)):
  ?>
 <center>
   <h4><u>Modificar Vacaciones </u></h4>
 </center>
<form action="" method="post">
  <table border="0" align="center">
  <tr>
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Documento de Identidad:</b></td>
     <td><input type="text" name="Cedula" value="" size="20" maxlength="15"></td>
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
elseif(empty($Cedula)):
?>
  <script language="javascript">
    alert ("Digite el documento del Empleado ?")
    history.back()
  </script>
<?
  else:
    include("../conexion.php");
       $consulta="select vacacion.* from vacacion where vacacion.cedemple = '$Cedula' and vacacion.control='ACTIVA'";
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
    ?>
    <script language="javascript">
    alert ("No hay registros en la busqueda de este documento.!")
    history.back()
    </script>
   <?
     else:
     ?>
	<center>
	  <h4>Datos de Vacaciones </h4>
	</center>
	<table border="0" align="center">
	        <tr class="cajas">
	          <td>Presione Click en el campo [CodVaca] para modificar el archivo..</td>
	        </tr>
</table>
	<table width="800" border="0" align="center">
	<tr>
	    <td colspan="30"></td>
	  </tr>
	  <tr class="cajas">
	     <th>Item</th>
	     <th>Cod_Vaca</th>
	     <th>Documento</th>
	     <th>Empleado</th>
	     <th>F_Proceso</th>
	     <th>F_Inicio</th>
	     <th>F_Final</th>
	     <th>Basico</th>
	     <th>Vlr_Pagar</th>
      </tr>
	    <?
	    $s=1;
	     while($filas=mysql_fetch_array($resultado)):
	     $salario=number_format($filas["ibc"],0);
	     $vaca=number_format($filas["valor"],0);
	   ?>
	       <tr class="cajas align="center">
	       <th><?echo $s;?></th>
	       <td><a href="modificarvacacionesdetallado.php?codvaca=<?echo $filas["codvaca"];?>"><div align="center"><?echo $filas["codvaca"];?></div></a></td>
	       <td><?echo $filas["cedemple"];?></td>
	       <td><?echo $filas["nombre"];?></td>
	       <td><?echo $filas["fechap"];?></td>
	       <td><?echo $filas["fechai"];?></td>
	       <td><?echo $filas["fechac"];?></td>
	       <td><?echo $salario;?></td>
	        <td><div align="center"><?echo $vaca;?></div></td>
	       </tr>
	       <?
	       $s=$s+1;
	       $total=$total+$filas["valor"];
	      endwhile;
	      $total=number_format($total,0);
            ?>
</table>
	<div align="center"><b>Total_Pagado:&nbsp;$<?echo $total;?></b></div>
    <?
    endif;
endif;
?>
</body>
</html>
