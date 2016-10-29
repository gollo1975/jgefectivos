
<html>

<head>
  <title>Consulta de Empleados</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
  ?>
<center><h4>Consulta de Empleados</h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"></td>
  </tr>
  <tr><td><br></td></tr>
   <tr>
     <td><b>Campo de Consulta:</b></td>
     <td><select name="campo" class="cajas">
        <option value="0">Seleccione la Opción
        <option value="1">Documento
        <option value="2">Primer Nombre
        <option value="3">Segundo Nombre
        </select></td>
   </tr>
   <tr>
     <td><b>Digite el Dato:</b></td>
     <td><input type="text" name="valor" value="" size="20" maxlength="20"></td>
   </tr>
   <tr><td><br></td></tr>
  <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>

</table>

</form>
<?
elseif (empty($valor)):
?>
  <script language="javascript">
    alert ("Digite Dato a Consultar ?")
    history.back()
  </script>
 <?
  else:
    include("../conexion.php");
    $opc=$campo;
    switch($opc)
    {
      case 1:
        $consulta="select empleado.*,eps.eps,pension.pension,costo.centro,zona.zona from empleado,eps,pension,costo,zona where
        empleado.codzona=zona.codzona and
        empleado.codpension=pension.codpension and
        empleado.codeps=eps.codeps and
        empleado.codcosto=costo.codcosto and
        empleado.cedemple='$valor' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
        break;
      case 2:
        $consulta="select empleado.*,eps.eps,pension.pension,costo.centro,zona.zona from empleado,eps,pension,costo,zona where
        empleado.codzona=zona.codzona and
        empleado.codpension=pension.codpension and
        empleado.codeps=eps.codeps and
        empleado.codcosto=costo.codcosto and
        empleado.nomemple like'%$valor%' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
        break;
      case 3:
       $consulta="select empleado.*,eps.eps,pension.pension,costo.centro,zona.zona from empleado,eps,pension,costo,zona where
        empleado.codzona=zona.codzona and
        empleado.codpension=pension.codpension and
         empleado.codeps=eps.codeps and
        empleado.codcosto=costo.codcosto and
        empleado.nomemple1 like'%$valor%' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
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
<center><h4>Datos del Empleado</h></center>
<table boder="0" align="center">
  <tr class="cajas">
    <td>Para ver La información del Empleado, presione Click sobre el Documento de Identidad..</td>
  </tr>
</table>
<table border="0" align="center">
<tr class="fondo">
  <td colspan="9"></td>
</tr>
<tr class="cajas">
  <br>
     <th>Código</th>
     <th>Ducumento</th>
     <th>Nombres</th>
     <th>Apellidos</th>
     <th>Eps</th>
     <th>Pensión</th>
     <th>C_Costo</th>
     <th>Zona</th>
    </tr>
    <?
     while($filas=mysql_fetch_array($resultado)):
   ?>
     <tr class="cajas">
       <td><?echo $filas["codemple"];?></td>
      <td>&nbsp;&nbsp;<a href="auxiliar.php?cedemple=<?echo $filas["cedemple"];?>"><?echo $filas["cedemple"];?></a></td>
       <td>&nbsp;&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["eps"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["pension"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["centro"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["zona"];?></td>
      </tr>
       <?
    endwhile;
    endif;
  endif;
  ?>
</table>

</body>
</html>
