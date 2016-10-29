<html>

<head>
  <title>Cesantias e Intereses</title>
  <LINK  REL="stylesheet" HREF="../estiloa.css"  type="text/css">
</head>

<body>
<?
 include("../conexion.php");
 $opcion=" select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where empleado.cedemple='$xcodigo'";
 $re=mysql_query($opcion)or die ("Eror de consulta $opcion");
 $reg= mysql_num_rows($re);
 if ($reg!=0):

      $consulta="select cesantiainteres.* from empleado,cesantiainteres where
           empleado.cedemple=cesantiainteres.cedemple and
           cesantiainteres.cedemple='$xcodigo'";
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
         ?>
        <script language="javascript">
        alert ("Este empleado no tiene archivos generados en Sistema.!")
        history.back()
        </script>
        <?
       else:
        ?>
        <td><h4><div align="center"><u>Cesantias e Intereses</u></div></h4></td>
           <table border="0" align="center">
                    <tr class="cajas">
                      <th>Presione Click sobre el Nro_Cesan para Ver el Reporte.</th>
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
                  <th>F_Contrato</th>
                 <th>Dias</th>
                 <th>Ibc</th>
                 <th>Vlr_Cesantia</th>
                 <th>Vlr_Interes</th>
                  </tr>
                <? $a=1;
                 while($filas_s=mysql_fetch_array($resultado)):
                 $ibc=number_format($filas_s["salario"],0);
                 $valorC=number_format($filas_s["pagocesantia"],0);
                 $valorI=number_format($filas_s["pagointeres"],0);
                           ?>
                     <tr class="cajas align="center">
                     <th><?echo $a;?></th>
                       <td><a href="../vacaciones/ImpCesantiaInteres.php?NroC=<?echo $filas_s["nrocesantia"];?>"><?echo $filas_s["nrocesantia"];?></a></td>
                        <td><?echo $filas_s["fechap"];?></td>
                       <td><?echo $filas_s["inicioperiodo"];?></td>
                       <td><?echo $filas_s["fechafinal"];?></td>
                        <td><?echo $filas_s["fechainicio"];?></td>
                       <td><?echo $filas_s["dias"];?></td>
                       <td><div align="right"><?echo $ibc;?></div></td>
                        <td><div align="right"><?echo $valorC;?></div></td>
                        <td><div align="right"><?echo $valorI;?></div></td>
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
             history.back()
          </script>
        <?
     endif;
 ?>
</body>
</html>
