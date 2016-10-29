<?
 session_start();
?>
<html>

<head>
  <title>Consultade ingreso por zona</title>
     <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
</head>
<body>
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='fechaingreso.php'
                tiempo=50
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
<?
 if(session_is_registered("xsession")):
  if (!isset($desde)):
     include("../conexion.php");
  ?>
   <center><h4><u>Empleados Por Zona</u></h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr>
    <td colspan="2"><br></td>
  </tr>
  <tr>
    <td><b>Desde:</b></td>
    <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlength="10" id="desde"></td>
  </tr>
  <tr>
    <td><b>Hasta:</b></td>
    <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10" id="hasta"></td>
  </tr>
   <tr>
     <td><b>Zona:</b></td>
     <td><select name="campo" class="cajas" id="campo">
        <option value="0">Seleccione la zona
        <?
         $consulta_z="select * from zona where zona.nomina='SI' order by zona";
         $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
        while($filas_z=mysql_fetch_array($resultado_z)):
           ?>
           <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
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
    alert ("Despliegue la vista para eligir la zona ?")
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
      $consulta="select zona.zona from zona where
            zona.codzona='$campo'";
     $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
         $registro=mysql_num_rows($resultado);
         if ($registro==0):
    ?>
         <script language="javascript">
          alert ("La zona no existe en la b.d ?")
          history.back()
         </script>
         <?
         else:
         ?>
           <center><h4><u>Empleados Por Zona</u></h4></center>
         <table border="0" align="center">
         <tr>
         </tr>
          <?
            while($filas=mysql_fetch_array($resultado)):
            ?>
            <tr>
             <td><?echo $filas["zona"];?></td>
            </tr>
              <?
            endwhile;
         include("../conexion.php");
         $consulta="select empleado.codemple,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,eps.eps,pension.pension,zona.zona,contrato.fechainic,contrato.salario,contrato.cargo from empleado,zona,contrato,eps,pension where
         zona.codzona=empleado.codzona and
		 empleado.codemple=contrato.codemple and
         empleado.codeps=eps.codeps and
         empleado.codpension=pension.codpension and
         contrato.fechainic between '$desde'and'$hasta' and
         zona.codzona='$campo' order by empleado.nomemple,empleado.nomemple1,empleado.apemple";
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
	    <th><b>#</b></td>
          <th><b>Código</b></td>
          <th><b>Ducumento</b></td>
          <th><b>Nombres</b></td>
          <th><b>Apellidos</b></td>
          <th><b>Eps</b></td>
          <th><b>Pensión</b></td>
          <th><b>Zona</b></td>
          <th><b>Fecha Ing</b></td>
          <th><b>Salario</b></td>
          <th><b>Cargo</b></td>
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
	   $a +=1;
    endwhile;
    ?>
    </table>
    <td><center><a href="imprimirfecha.php?campo=<?echo $campo;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>" target="_blank" onclick="volver()" class="fondo">Imprimir</a></center></td>
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
