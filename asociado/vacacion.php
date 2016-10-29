<html>

<head>
  <title>Consulta de vacaciones</title>
  <LINK  REL="stylesheet" HREF="../estiloa.css"  type="text/css">
</head>

<body>
<?
 include("../conexion.php");
 $opcion=" select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where empleado.cedemple='$xcodigo'";
 $re=mysql_query($opcion)or die ("Eror de consulta $opcion");
 $reg= mysql_num_rows($re);
 if ($reg!=0):

      $consulta="select vacacion.* from empleado,vacacion where
           empleado.cedemple=vacacion.cedemple and
           vacacion.cedemple='$xcodigo'";
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
         ?>
        <script language="javascript">
        alert ("Este empleado no tiene vacaciones Generadas  ?")
        history.back()
        </script>
        <?
       else:
        ?>
        <td><h4><div align="center"><u>Vacaciones</u></div></h4></td>
           <table border="0" align="center">
                    <tr class="cajas">
                      <th>Presione Click sobre el Nro_Vacacion para Ver el Reporte.</th>
                    </tr>
                  </table>
                  <tr><td><br></td></tr>
            <table border="0" align="center">
               <tr>
                 <td colspan="30"></td>
               </tr>
               <tr class="cajas">
                  <th>#</th>
                 <th>Número</th>
                 <th>F._Proceso</th>
                 <th>F._Inicio</th>
                 <th>F_Corte</th>
                 <th>Dias</th>
                 <th>Ibc</th>
                 <th>Vlr_Pagado</th>
                  </tr>
                <? $a=1;
                 while($filas_s=mysql_fetch_array($resultado)):
                 $ibc=number_format($filas_s["ibc"],0);
                 $valor=number_format($filas_s["valor"],0);
                           ?>
                     <tr class="cajas align="center">
                     <th><?echo $a;?></th>
                       <td><a href="../vacaciones/imprimir.php?codvaca=<?echo $filas_s["codvaca"];?>"><?echo $filas_s["codvaca"];?></a></td>
                        <td><?echo $filas_s["fechap"];?></td>
                       <td><?echo $filas_s["fechai"];?></td>
                       <td><?echo $filas_s["fechac"];?></td>
                       <td><?echo $filas_s["dias"];?></td>
                       <td><div align="right"><?echo $ibc;?></div></td>
                        <td><div align="right"><?echo $valor;?></div></td>
                        </tr>
                       <?
                       $a=$a+1;
                  endwhile;
                  ?>
                   </table>
                  <?
           endif;
     else:
        ?>
          <script language="javascript">
             alert("El documento digitado no existe en Sistema ?")
             open("prueba.php","_self")
          </script>
        <?
     endif;
 ?>
</body>
</html>
