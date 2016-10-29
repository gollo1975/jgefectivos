<html>

<head>
  <title>Consulta de Primas</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>

<body>
<?
    include("../conexion.php");
    $opcion=" select empleado.cedemple,empleado.nomemple,empleado.apemple from empleado where empleado.cedemple='$cedula'";
    $re=mysql_query($opcion)or die ("Eror de consulta $opcion");
    $reg= mysql_num_rows($re);
     while($filas=mysql_fetch_array($re)):
         ?>
         <tr class="cajas">
         <center><td><b>&nbsp;&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["apemple"];?></b></td></center>
           </tr>
         <?
      endwhile;
      $consulta="select prima.* from empleado,prima where
           empleado.cedemple=prima.cedemple and
           empleado.cedemple='$cedula'";
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
         ?>
        <script language="javascript">
        alert ("Este empleado no tiene Primas Generadas  ?")
       open("prueba.php","_self")  
        </script>
        <?
       else:
        ?>
          <tr><td><br></td></tr>
           <table border="0" align="center">
                    <tr class="cajas">
                      <td>Presione Click sobre el Nro_Prima para Ver el Reporte ..</td>
                    </tr>
                  </table>
            <table border="0" align="center">
               <tr>
                 <td colspan="30"></td>
               </tr>
               <tr class="cajas">
                 <th>Nro_Prima</th>
                 <th>F._Proceso</th>
                 <th>F._Inicio</th>
                 <th>Fecha_Final</th>
                 <th>Dias</th>
                 <th>Ibc</th>
                 <th>Vlr_Pagado</th>
                  </tr>
                <?
                 while($filas_s=mysql_fetch_array($resultado)):
                           ?>
                     <tr class="cajas align="center">
                       <td>&nbsp;&nbsp;<a href="imprimirprima.php?nroprima=<?echo $filas_s["nroprima"];?>"><?echo $filas_s["nroprima"];?></a></td>
                        <td>&nbsp;&nbsp;<?echo $filas_s["fechap"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["fechainicio"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["fechacorte"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["dias"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["salario"];?></td>
                        <td>&nbsp;&nbsp;<?echo $filas_s["total"];?></td>
                        </tr>
                       <?
                       $con=$con+1;
                  endwhile;
                  ?>
                   </table>
                  <?
           endif;
 ?>
</body>
</html>
