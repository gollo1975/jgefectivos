<?
 session_start();
?>
<html>
<head>
  <title>Consulta de Empleados</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
 if(session_is_registered("validar")):
  if (!isset($campo1)):
    include("../conexion.php");
  ?>
 <center><h4>Consulta de Empleados Por Fondo</h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"></td>
  </tr>
  <tr><td><br></td></tr>
   <tr>
     <td><b>Fondo de Pensión:</b></td>
     <td><select name="campo1" class="cajas">
        <option value="0">Despliegue la Vista
        <?
        $consulta_t="select * from pension order by pension";
        $resultado_t=mysql_query($consulta_t)or die ("Consulta de eps incorrecta ");
         while($filas_t=mysql_fetch_array($resultado_t)):
         ?>
           <option value="<?echo $filas_t["codpension"];?>"> <?echo $filas_t["pension"];?>
         <?
         endwhile;
         ?> </select>
     </td>
   </tr>
   <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar"class="boton">
    </td>

  </tr>
</table>

</form>
<?
elseif (empty($campo1)):
?>
  <script language="javascript">
    alert ("Digite Dato a Consultar ?")
    history.back()
  </script>
 <?
  else:
     include("../conexion.php");
     $con="select pension.pension from pension where pension.codpension='$campo1'";
    $resu=mysql_query($con);
     while($filas_s=mysql_fetch_array($resu)):
        ?>
       <table border="0" align="center">
         <tr>
          <td>&nbsp;&nbsp;<?echo $filas_s["pension"];?></td>
         </tr>
        </table>
        <?
      endwhile;
        $consulta="select empleado.*,zona.zona,contrato.*,pension.pension from empleado,pension,zona,contrato where
        empleado.codzona=zona.codzona and
        empleado.codpension=pension.codpension and
        empleado.codemple=contrato.codemple and
        contrato.fechater='0000-00-00' and
        pension.codpension='$campo1'";
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
    ?>
    <script language="javascript">
    alert ("No hay empleados en este Fondo ?")
    history.back()
    </script>
   <?
     else:
     ?>

        <center><h4>Empleados Consultados</h4></center>
        <table border="0" align="center">
        <tr class="cajas">
            <td>Para ver La información del Empleado, presione Click sobre el Documento de Identidad..</td>
          </tr>
        </table>
        <table border="0" align="center">
        <tr class="fondo">
          <td colspan="9"></td>
        </tr>
        <tr class="cajas">

         <th>Cod_Empleado</th>
         <th>Ducumento:</th>
         <th>Nombre</th>
         <th>Apellido</th>
         <th>zona</th>
         <th>Dirección</th>
         <th>Teléfono</th>
         <th>Salario</th>
         <th>Fecha_Ing.</th>
         </tr>
        <?
         while($filas=mysql_fetch_array($resultado)):
       ?>
         <tr class="cajas">
           <td><?echo $filas["codemple"];?></td>
          <td>&nbsp;&nbsp;<a href="auxiliar.php?cedemple=<?echo $filas["cedemple"];?>"><?echo $filas["cedemple"];?></a></td>
           <td>&nbsp;&nbsp;<?echo $filas["nomemple"];?></td>
           <td>&nbsp;&nbsp;<?echo $filas["apemple"];?></td>
           <td>&nbsp;&nbsp;<?echo $filas["zona"];?></td>
           <td>&nbsp;&nbsp;<?echo $filas["diremple"];?></td>
           <td>&nbsp;&nbsp;<?echo $filas["telemple"];?></td>
           <td>&nbsp;&nbsp;<?echo $filas["salario"];?></td>
           <td>&nbsp;&nbsp;<?echo $filas["fechainic"];?></td>
          </tr>
           <?
           $suma=$suma + 1;
    endwhile;
    ?>
    </table>
  <tr>
     <center><td>Total:&nbsp;<?echo $suma;?></td></center>
  </tr>
    <?

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

</body>
</html>
