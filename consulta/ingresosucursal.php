<?
 session_start();
?>
<html>

<head>
  <title>Consultade ingreso por sucursal</title>
     <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
</head>
<body>
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='ingresosucursal.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
<?
 if(session_is_registered("xsession")):
  if (!isset($desde)):
     include("../conexion.php");
  ?>
   <center><h4>Consulta de Ingreso por Sucursal</h4></center>
<form action="" method="post">
 <table border="0" align="center">
  <tr>
    <td colspan="2"><br></td>
  </tr>
  <tr>
    <td><b>Desde:</b></td>
    <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
  </tr>
  <tr>
    <td><b>Hasta:</b></td>
    <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
  </tr>
   <tr>
     <td><b>Sucursal:</b></td>
     <td><select name="campo" class="cajas">
        <option value="0">Seleccione la sucursal
        <?
         $consulta_z="select * from sucursal order by sucursal ";
         $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
        while($filas_z=mysql_fetch_array($resultado_z)):
           ?>
           <option value="<?echo $filas_z["codsucursal"];?>"> <?echo $filas_z["sucursal"];?>
          <?
          endwhile;
          ?>
          </select></td>
        </tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
  <tr><td><br></td></tr>
</table>
</form>
<?
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la sucursal ?")
    history.back()
  </script>
  <?
elseif (empty($desde)):
?>
  <script language="javascript">
    alert ("Digite la fecha de inicio de busqueda ?")
    history.back()
  </script>
    <?
     else:
     include("../conexion.php");
      $consulta="select sucursal.sucursal from sucursal where
            sucursal.codsucursal='$campo'";
     $resultado=mysql_query($consulta)or die ("Consulta incorrecta sucursal");
         $registro=mysql_num_rows($resultado);
         if ($registro==0):
    ?>
         <script language="javascript">
          alert ("La sucursal seleccionada no existe en la bd?")
          history.back()
         </script>
         <?
         else:
         ?>
           <center><h4><u>Empleados por sucursal</u></h4></center>
         <table border="0" align="center">
         <tr>
         </tr>
          <?
            while($filas=mysql_fetch_array($resultado)):
            ?>
            <tr class="cajas">
             <td><?echo $filas["sucursal"];?></td>
            </tr>
              <?
            endwhile;
         include("../conexion.php");
         $consulta="select sucursal.sucursal,empleado.codemple,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,eps.eps,pension.pension,zona.zona,contrato.fechainic,contrato.salario,contrato.cargo from sucursal,empleado,zona,contrato,eps,pension where
         sucursal.codsucursal=zona.codsucursal and
         zona.codzona=empleado.codzona and
         empleado.codemple=contrato.codemple and
         empleado.codeps=eps.codeps and
         empleado.codpension=pension.codpension and
         contrato.fechater='0000-00-00'and
         contrato.fechainic between '$desde'and'$hasta' and
         sucursal.codsucursal='$campo'";
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
         $registro=mysql_num_rows($resultado);
         if ($registro==0):
    ?>
         <script language="javascript">
          alert ("No existen empleados en este rango de Fechas ?")
          history.back()
         </script>
   <?
       else:
     ?>

      <table border="0" align="center">
       
       <tr  class="cajas">
	      <th><b>#</b></th>
          <th><b>Cod_Empleado</b></th>
          <th><b>Ducumento</b></th>
          <th><b>Nombres</b></th>
          <th><b>Apellidos</b></th>
          <th><b>Eps</b></th>
          <th><b>Pensión</b></th>
          <th><b>Zona</b></th>
          <th><b>Fecha Ing.</b></th>
          <th><b>Salario</b></th>
          <th><b>Cargo</b></th>
       </tr>
    <?
	$a=1;
       while($filas=mysql_fetch_array($resultado)):
   ?>
       <tr  class="cajas">
	      <th><?echo $a;?></th>
         <td><?echo $filas["codemple"];?></td>
         <td> <a href="auxiliar.php?cedemple=<?echo $filas["cedemple"];?>"><?echo $filas["cedemple"];?></a></td>
         <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
         <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
         <td><?echo $filas["eps"];?></td>
         <td><?echo $filas["pension"];?></td>
         <td><?echo $filas["zona"];?></td>
         <td><?echo $filas["fechainic"];?></td>
         <td><?echo $filas["salario"];?></td>
         <td><?echo $filas["cargo"];?></td>
       </tr>
       <?
	   $a += 1;
    endwhile;
    ?>

    </table>
    <th><center><a href="imprimirsucursal.php?campo=<?echo $campo;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>" target="_blank" onclick="volver()" class="fondo">Imprimir</a></center></th>
    <?
    endif;
  endif;
  endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;  
  ?>

</table>

</body>
</html>
