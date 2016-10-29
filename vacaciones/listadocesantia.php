<html>

<head>
  <title>Liquidacion Final</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($Cedula)):
  ?>
 <center><h4><u>Prestaciones Sociales</u></h4></center>
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
    alert ("Digite el Documento de Identidad del Empleado ?")
    history.back()
  </script>
 <?
 else:
    include("../conexion.php");
        $consulta="select contrato.*,tipocontrato.concepto,empleado.*,zona.zona from empleado,contrato,zona,tipocontrato where
         zona.codzona=empleado.codzona and
        empleado.codemple=contrato.codemple and
        empleado.nomina='SI' and
        tipocontrato.tipo=contrato.tipo and
        contrato.fechater='0000-00-00'and 
        empleado.cedemple='$Cedula'";
        $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
    ?>
    <script language="javascript">
    alert ("El dato consultado no existe en la bd. / o no Pertenece a Nomina  ?")
    history.back()
    </script>
   <?
     else:
     ?>
<center><h4>Datos del Contrato</h4></center>
<table border="0" align="center">
        <tr class="cajas">
          <td>Presione Click sobre el Codigo del Empleado Para Liquidar el Contrato..</td>
        </tr>
      </table>
<table border="0" align="center">
<tr>
    <td colspan="30"></td>
  </tr>
  <tr class="cajas">
     <th>Nro_Cont.</th>
	 <th>Documento</th>
	 <th>Empleado</th>
     <th>F._Inicio</th>
     <th>F._Final</th>
     <th>Salario</th>
	 <th>Tipo_Salario</th>
     <th>Tipo_Contrato</th>
     <th>Cargo</th>
     <th>Zona</th>
     <th>Nota</th>
   </tr>
    <?
     while($filas=mysql_fetch_array($resultado)):
   ?>
     <tr class="cajas align="center">
       <td><a href="buscar.php?codigo=<?echo $filas["contrato"];?>&Cedula=<?echo $Cedula;?>&salario=<?echo $filas["salario"];?>"><?echo $filas["contrato"];?></a></td>
	    <td><?echo $filas["cedemple"];?></td>
		 <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
        <td><?echo $filas["fechainic"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["fechater"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["salario"];?></td>
	   <td>&nbsp;&nbsp;<?echo $filas["tiposalario"];?></td>
        <td><?echo $filas["concepto"];?></td>
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
