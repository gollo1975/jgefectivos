<html>
        <head>
                <title>Incapacidad por Empleado</title>
                <link rel="stylesheet" href="../formato.css" type="text/css">
                <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
                </script>
        </head>
        <body onload="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
               <?

        include("../conexion.php");
         $variable="select eps.eps,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,eps where
                    empleado.codeps=eps.codeps and
                    empleado.cedemple='$cedula'";
        $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El dato No existe en la BD.")
            history.back()
          </script>
         <?
        else:
            while ($filas=mysql_fetch_array($resultado)):
             ?>
               <table border="0" align="center" width="700">
                <tr>
                  <th colspan="45"></th><td class="cajas">Nombre:&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                </tr>
                  <tr>
                  <th colspan="45"></th><td class="cajas">Cedula:&nbsp;<?echo $filas["cedemple"];?></td>
                </tr>
                <tr>
                  <th colspan="45"></th><td class="cajas">Eps:&nbsp;<?echo $filas["eps"];?></td>
                </tr>
               </table>
             <?
           endwhile;
           endif;

           include("../conexion.php");
          $variable="select incapacidad.*,tipoinca.* from incapacidad,empleado,eps,tipoinca where
                    empleado.cedemple=incapacidad.cedemple and
                    empleado.codeps=eps.codeps and
                     incapacidad.tipoinca=tipoinca.tipoinca and
                    empleado.cedemple='$cedula'";
       $resultado=mysql_query($variable)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("No existen incapacidades para este empleado.")
            history.back()
          </script>
         <?
         else:
         ?>
         <table border="1" align="center">
         <td>
          <table border="0" align="center">
           <tr>
             <th colspan="9" >Incapacidades por Empleado</th>
             </tr>
             <tr class="cajas">
              <th>Nro_Incap.</th>
              <th>F_Inicio</th>
              <th>F_Final</th>
              <th>Dias</th>
              <th>Descripción</th>
              <th>Estado</th>
              </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado)):
             ?>
               <tr class="cajas">

                 <td><?echo $filas_s["nroinca"];?></td>
                 <td><?echo $filas_s["fechaini"];?></td>
                 <td><?echo $filas_s["fechater"];?></td>
                 <td><?echo $filas_s["dias"];?></td>
                 <td><?echo $filas_s["concepto"];?></td>
                 <td><?echo $filas_s["estado"];?></td>
                  </tr>
                <?
              endwhile;
              ?>
             </table>
             </td>
             </table>
             <?
         endif;
            ?>

                   </body>
</html>
