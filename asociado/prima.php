<html>

<head>
  <title>Consulta de Primas</title>
  <LINK  REL="stylesheet" HREF="../estiloa.css"  type="text/css">
</head>

<body>
<?
   include("../conexion.php");
    $opcion=" select empleado.cedemple,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1  from empleado where empleado.cedemple='$xcodigo'";
    $re=mysql_query($opcion)or die ("Eror de consulta $opcion");
    $reg= mysql_num_rows($re);
    if ($reg!=0):
        while($filas=mysql_fetch_array($re)):
         ?>
         <tr class="cajas">
         <center><td><b>&nbsp;&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></b></td></center>
           </tr>
         <?
      endwhile;
      $consulta="select prima.* from empleado,prima where
           empleado.cedemple=prima.cedemple and
           empleado.cedemple='$xcodigo'";
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
         ?>
        <script language="javascript">
        alert ("Este empleado no tiene Primas Generadas  ?")
          history.back()
        </script>
        <?
       else:
        ?>
          <tr><td><br></td></tr>
           <table border="0" align="center">
                    <tr class="cajas">
                      <th>Presione Click sobre el Nro_Prima para Ver el Reporte ..</th>
                    </tr>
                  </table>
            <table border="0" align="center">
               <tr>
                 <td colspan="30"></td>
               </tr>
               <tr class="cajas">
                 <th>#</th>
                 <th>Nro_Prima</th>
                 <th>F._Proceso</th>
                 <th>F._Inicio</th>
                 <th>Fecha_Final</th>
                 <th>Dias</th>
                 <th>Ibc</th>
                 <th>Vlr_Pagar</th>
                  </tr>
                <?
                $p=1;
                 while($filas_s=mysql_fetch_array($resultado)):
                 $salario=number_format($filas_s["salario"],0);
                 $total=number_format($filas_s["total"],0);
                           ?>
                     <tr class="cajas align="center">
                        <th><?echo $p;?></th>
                       <td>&nbsp;&nbsp;<a href="../vacaciones/imprimirprima.php?nroprima=<?echo $filas_s["nroprima"];?>"><?echo $filas_s["nroprima"];?></a></td>
                        <td>&nbsp;&nbsp;<?echo $filas_s["fechap"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["fechainicio"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["fechacorte"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["dias"];?></td>
                       <td>&nbsp;&nbsp;<?echo $salario;?></td>
                        <td>&nbsp;&nbsp;<?echo $total;?></td>
                        </tr>
                       <?
                       $p=$p+1;
                  endwhile;
                  ?>
                   </table>
                  <?
           endif;
     else:
        ?>
          <script language="javascript">
             alert("El documento digitado no existe en Sistema ?")
            open("conprimaindi.php","_self") 
          </script>
        <?
     endif;
 ?>
</body>
</html>
