<html>

<head>
  <title>Prestaciones sociales</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($Cedula)):
  ?>
 <center><h4><u>Modificar Registro</u></h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr>
       <td colspan="2"><br></td>
  </tr>
  <tr>
     <td><b>Documento Identidad:</b></td>
     <td><input type="text" name="Cedula" value="" size="18" maxlength="15"></td>
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
    alert ("Digite el documento del empleado?")
    history.back()
  </script>
 <?
  else:
    include("../conexion.php");
     $consulta="select prestacion.* from prestacion
        where prestacion.control='ACTIVA' and
              prestacion.cedemple='$Cedula'";
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
	    ?>
	    <script language="javascript">
	    alert ("No hay registro en sistema para Modificar o no esta autorizado para ello.!")
	    history.back()
	    </script>
	   <?
    else:
      ?>
      <center><h4><u>Consulta de Prestaciones</u></h4></center>
      <table border="0" align="center">
        <tr class="cajas">
          <td>Presione Click en el campo [Nro_Presta] para modificar el archivo..</td>
        </tr>
      </table>
      <table border="0" align="center">
         <tr>
	    <td colspan="30"></td>
	 </tr>
	 <tr class="cajas">
	     <th>Item</th>
	     <th>Nro_Presta</th>
	     <th>Documento</th>
	     <th>Empleado</th>
	     <th>F_Proceso</th>
	      <th>F_Inicio</th>
	     <th>F_Retiro</th>
	     <th>Vrl_Inicial</th>
	     <th>Vlr_Deduccion</th>
	     <th>Vlr_Pagar</th>
	 </tr>
        <?  
      while ($filas=mysql_fetch_array($resultado)):?>
        <tr class="cajas align="center">
       <th><?echo $s;?></th>
       <td><a href="modificardetallado.php?nropresta=<?echo $filas["nropresta"];?>&SalarioB=<?echo $filas["salario"];?>&Cedula=<?echo $filas["cedemple"];?>"><?echo $filas["nropresta"];?></a></td>
       <td><?echo $filas["cedemple"];?></td>
       <td><?echo $filas["nombres"];?></td>
       <td><?echo $filas["fechapro"];?></td>
       <td><?echo $filas["fechaini"];?></td>
       <td><?echo $filas["fechacor"];?></td>
       <td><div align="center"><?echo $filas["total"];?></div></td>
       <td><div align="center"><?echo $filas["totald"];?></div></td>
       <td><div align="center"><?echo $filas["totalp"];?></div></td>
       </tr>
       <?
     endwhile;
    endif;
  endif;
  ?>
  
</table>

</body>
</html>
