    <html>
        <head>
                <title>Incapacidad zona</title>
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
         $variable="select sucursal.sucursal from sucursal where
                   sucursal.codsucursal='$codigo'";
        $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("La Zona no existe en la base de datos.")
            history.back()
          </script>
         <?
        else:
            while ($filas=mysql_fetch_array($resultado)):
             ?>
               <table border="0" align="center" width="700">
                <tr>
                  <th colspan="30"></th><td class="cajas"><b>Sucursal:</b>&nbsp;<?echo $filas["sucursal"];?></td>
                </tr>
                 </table>
             <?
           endwhile;
           endif;

           include("../conexion.php");
          $variable1="select zona.zona,incapacidad.nroinca,incapacidad.fechaini,incapacidad.fechater,incapacidad.dias,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,
                              eps.eps,tipoinca.concepto from zona,incapacidad,empleado,eps,tipoinca,sucursal where
                              sucursal.codsucursal=zona.codsucursal and
                              zona.codzona=empleado.codzona and
                              empleado.cedemple=incapacidad.cedemple and
                              empleado.codeps=eps.codeps and
                              incapacidad.tipoinca=tipoinca.tipoinca and
                              incapacidad.fechaini between '$desde' and '$hasta' and
                              sucursal.codsucursal='$codigo'";

       $resultado1=mysql_query($variable1)or die("consulta incorrecta");
        $registro1=mysql_num_rows($resultado1);
        if ($registro1==0):
          ?>
          <script language="javascript">
            alert("No existen incapacidades en esta zona ?")
            history.back()
          </script>
         <?
         else:
         ?>
         <br>
         <table border="1" align="center">
         <td>
          <table border="0" align="center">
           <tr>
             <th colspan="9" >Listado de Incapacidades</th>
             </tr>
             <tr class="cajas">
              <th>Nro_Incap</th>
              <th>Cedula</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>F_Inicio</th>
              <th>F_Final</th>
              <th>Dias</th>
              <th>Descripción</th>
              </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado1)):
             ?>
               <tr class="cajas">

                 <td><?echo $filas_s["nroinca"];?></td>
                 <td><?echo $filas_s["cedemple"];?></td>
                 <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?></td>
                 <td><?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                 <td><?echo $filas_s["fechaini"];?></td>
                 <td><?echo $filas_s["fechater"];?></td>
                 <td><?echo $filas_s["dias"];?></td>
                 <td><?echo $filas_s["concepto"];?></td>
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
