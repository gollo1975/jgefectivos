<html>

<head>
  <title>Consulta de Prestaciones</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
    include("../conexion.php");
     $consulta="select prestacion.* from prestacion,empleado where
        empleado.cedemple=prestacion.cedemple and
        empleado.cedemple = '$valor'";
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
    ?>
    <script language="javascript">
    alert ("Este empleado no tiene prestaciones generadas.?")
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
     <th>Nro_Prest.</th>
     <th>Documento</th>
     <th>Empleado</th>
     <th>Fecha_Proceso</th>
     <th>Fecha_Inicio</th>
     <th>Fecha_Term.</th>
     <th>Ibc</th>
     <th>Vlr_Pagado</th>
    </tr>
    <?
     while($filas=mysql_fetch_array($resultado)):
   ?>
     <tr class="cajas align="center">
       <td><a href="imprimirpresta.php?nropresta=<?echo $filas["nropresta"];?>"><?echo $filas["nropresta"];?></a></td>
       <td>&nbsp;&nbsp;<?echo $filas["cedemple"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["nombres"];?></td>
        <td>&nbsp;&nbsp;<?echo $filas["fechapro"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["fechaini"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["fechacor"];?></td>
        <td>&nbsp;&nbsp;<?echo $filas["ibc"];?></td>
       <td>&nbsp;&nbsp;<?echo $filas["total"];?></td>

       </tr>
       <?
      endwhile;
  endif;
  ?>
  
</table>

</body>
</html>
