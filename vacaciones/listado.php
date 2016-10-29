<html>
<head>
  <title>Consulta de Contratos</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($Cedula)):
  ?>
 <center><h4><u>Pago de Vacaciones</u></h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr>
       <td colspan="2"><br></td>
  </tr>

   <tr>
     <td><b>Documento de Identidad:</b></td>
     <td><input type="text" name="Cedula" value="" size="15" maxlength="20"></td>
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
    alert ("Digite el documento del empleado.!")
    history.back()
  </script>
 <?
 else:
    include("../conexion.php");
    $consulta="select contrato.*,tipocontrato.concepto,empleado.*,zona.zona from empleado,contrato,tipocontrato,zona where
        zona.codzona=empleado.codzona and
        empleado.codemple=contrato.codemple and
        empleado.nomina='SI' and
        tipocontrato.tipo=contrato.tipo and
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
<center><h4><u>Datos del Contrato</u></h4></center>
<table border="0" align="center">
        <tr class="cajas">
          <td>Presione Click sobre el Codigo del Empleado Para Liquidar las vacaciones..</td>
        </tr>
      </table>
<table border="0" align="center">
<tr>
    <td colspan="30"></td>
  </tr>
  <tr class="cajas">
     <th>Nro_Contrato</th>
     <th>Documento</th>
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
   ?>
     <tr class="cajas align="center">
       <td><a href="buscarvaca.php?codigo=<?echo $filas["contrato"];?>&salario=<?echo $filas["salario"];?>"><div align="center"><?echo $filas["contrato"];?></div></a></td>
       <td><?echo $Cedula;?></td>
        <td><?echo $filas["fechainic"];?></td>
       <td><?echo $filas["fechater"];?></td>
       <td><?echo $filas["salario"];?></td>
        <td><?echo $filas["concepto"];?></td>
       <td><?echo $filas["cargo"];?></td>
       <td><?echo $filas["zona"];?></td>
       <td><?echo $filas["nota"];?></td>
       </tr>
       <?
       $con=$con+1;
    endwhile;
    endif;
  endif;
  ?>
  
</table>

</body>
</html>
