<html>
<head>
  <title>Consulta de Empleados por Eps</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
     include("../conexion.php");
     $con="select eps.eps from eps
         where eps.codeps='$campo'";
     $resu=mysql_query($con)or die("Error de Busqueda");
     while($filas_s=mysql_fetch_array($resu)):
     ?>
     <table border="0" align="center">
       <tr>
         <td><b>Nombre Eps:</b>&nbsp;&nbsp;<? echo $filas_s["eps"];?></td>
       </tr>
     </table>
     <?
     endwhile;
        $consulta="select empleado.*,zona.zona,contrato.*,eps.eps from empleado,eps,zona,contrato where
        empleado.codzona=zona.codzona and
        empleado.codeps=eps.codeps and
        empleado.codemple=contrato.codemple and
        contrato.fechater='0000-00-00' and
        eps.codeps='$campo'order by zona.zona,contrato.fechainic";
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
        ?>
        <script language="javascript">
        alert ("La eps No tiene empleados activos ?")
        history.back()
        </script>
       <?
     else:
      ?>
     <center><h4>Listado de Empleados</h4></center>
      <table border="0"align="center">
                                <tr class="cajas">
                                  <td>Para Ver el registro del Empleados, Presione Click sobre el documento de identidad...</td>
                                </tr>
                              </table>
        <table border="0" align="center">
        <tr>
          <td colspan="2"></td>
         </tr>
        <tr class="cajas">

             <th>Cod_Empleado</th>
             <th>Ducumento</th>
             <th>Nombre</th>
             <th>Apellido</th>
             <th>zona</th>
             <th>Dirección</th>
             <th>Teléfono</th>
             <th>Salario</th>
             <th>Cargo</th>
             <th>Fecha_Ing.</th>
             </tr>

            <?
             while($filas=mysql_fetch_array($resultado)):
           ?>
             <tr class="cajas">
               <td><?echo $filas["codemple"];?></td>
              <td> <a href="auxiliar.php?cedemple=<?echo $filas["cedemple"];?>"><?echo $filas["cedemple"];?></a></td>
               <td><?echo $filas["nomemple"];?></td>
               <td><?echo $filas["apemple"];?></td>
               <td><?echo $filas["zona"];?></td>
               <td><?echo $filas["diremple"];?></td>
              <td><?echo $filas["telemple"];?></td>
              <td><?echo $filas["salario"];?></td>
              <td><?echo $filas["cargo"];?></td>
              <td><?echo $filas["fechainic"];?></td>
               </tr>
               <?
               $con=$con+1;
             endwhile;
             ?>
             </table>
              <tr>
                <center><td>Total_Registros:&nbsp;<? echo $con;?></td></center>
             </tr>
             <?
    endif;
  ?>
</table>

</body>
</html>
