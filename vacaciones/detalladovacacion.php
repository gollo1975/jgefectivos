<html>

<head>
  <title>Consulta de Vacaciones</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>

<body>
<?
   include("../conexion.php");
    $opcion=" select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where empleado.cedemple='$cedula'";
    $re=mysql_query($opcion)or die ("Eror de consulta $opcion");
    $reg= mysql_num_rows($re);
    while($filas=mysql_fetch_array($re)):   
         ?>
         <table border="0" align="center">
         <tr class="cajas">
           <center><td><b>&nbsp;&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></b></td></center>
           </tr>
         <?
      endwhile;
      $consulta="select vacacion.* from empleado,vacacion where
           empleado.cedemple=vacacion.cedemple and
           vacacion.cedemple='$cedula'";
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
         ?>
        <script language="javascript">
        alert ("Este empleado no tiene vacaciones Generadas  ?")
       open("prueba.php","_self")
        </script>
        <?
       else:
        ?>
          <tr><td><br></td></tr>
           <table border="0" align="center">
                    <tr class="cajas">
                      <td>Presione Click sobre el Nro_Vacacion para Ver el Reporte de Vacaciones..</td>
                    </tr>
                  </table>
            <table border="0" align="center">
               <tr>
                 <td colspan="30"></td>
               </tr>
               <tr class="cajas">
                 <th>Nro_Vacacón</th>
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
                       <td>&nbsp;&nbsp;<a href="imprimir.php?codvaca=<?echo $filas_s["codvaca"];?>"><?echo $filas_s["codvaca"];?></a></td>
                        <td>&nbsp;&nbsp;<?echo $filas_s["fechap"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["fechai"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["fechac"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["dias"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["ibc"];?></td>
                        <td>&nbsp;&nbsp;<?echo $filas_s["valor"];?></td>
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
