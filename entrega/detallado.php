<html>

<head>
<title>Aporte Social por Sucursal</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
    include("../conexion.php");
     $variable="select zona.zona from zona where
                 zona.codzona='$codzona'";
         $resultado=mysql_query($variable)or die("consulta incorrecta uno $variable");
        $registro=mysql_num_rows($resultado);
        ?>
         <table border="0" align="center">
              <tr class="cajas">
                <th class="fondo" align="center">Zona</td>
              </tr>
              <?
             while($filas=mysql_fetch_array($resultado)):
             ?>
               <tr class="cajas">
                 <td><?echo $filas["zona"];?></td>
               </tr>
                <?
              endwhile;
            include("../conexion.php");
            $variable1="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,entrega.nroentrega,entrega.fechainic,entrega.fechafinal,entrega.fechagra,entrega.valor from zona,empleado,entrega where
                    zona.codzona=empleado.codzona and
                    empleado.cedemple=entrega.cedemple and
                    zona.codzona='$codzona' order by empleado.nomemple ";
            $resultado1=mysql_query($variable1)or die("consulta incorrecta dos");
            $registro=mysql_num_rows($resultado1);
              if ($registro==0):
              ?>
              <script language="javascript">
                alert("No existen aportes sociales por esta zona ?")
                history.back()
              </script>
             <?
             else:
             ?>
               <table border="0" align="center">
           <tr class="cajas">
             <td>Para ver Informe del aporte, Presione Click sobre el [Nro_Entrega]..</td>
           </tr>
         </table>
              <table border="0" align="center">
               <tr>
                 <td colspan="30"></td>
               </tr>
               <tr class="cajas">
                  <th>Nro_Entrega</th>
                   <th>Empleado</th>
                  <th>Fecha_Inicio</th>
                  <th>Fecha_Final</th>
                  <th>Fecha_Proceso</th>
                  <th>Total</th>

                  </tr>
                  <?
                 while($filas_s=mysql_fetch_array($resultado1)):
                 ?>
                   <tr class="cajas">
                 <td> <a href="imprimir.php?nroentrega=<?echo $filas_s["nroentrega"];?>"><?echo $filas_s["nroentrega"];?></a></td>
                      <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                     <td><?echo $filas_s["fechainic"];?></td>
                     <td><?echo $filas_s["fechafinal"];?></td>
                     <td><?echo $filas_s["fechagra"];?></td>
                     <td><?echo $filas_s["valor"];?></td>
                      </tr>
                    <?
                      $suma1=$suma1+$filas_s["valor"];
                  endwhile;
                  ?>
                  </table>
                  <tr><td><br></td></tr>
                <tr>
                  <center><td><b>Total Aporte:</b>&nbsp;&nbsp;<?echo $suma1?></td></center>
                </tr>

               <?
           endif;
         ?>

        </table>

       </body>
  </html>
