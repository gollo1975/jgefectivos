<html>

<head>
<title>Consulta de incapacidades</title>
 <LINK  REL="stylesheet" HREF="../estiloa.css" type="text/css">
</head>
<body>
<?
     include("../conexion.php");
     $variable="select eps.eps,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,eps where
                     empleado.codeps=eps.codeps and
                    empleado.cedemple='$xcodigo'";
         $resultado=mysql_query($variable)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("No esta Autorizado para ver las incapacidades  ")
            history.back()
          </script>
         <?
         else:
         ?>

         <table border="0" align="center">
              <tr class="cajas">
              <th class="fondo">Documento</th>
              <th class="fondo">Nombres</th>
              <th class="fondo">Apellidos</th>
              <th class="fondo">Eps</th>
            </tr>
              <?
             while($filas=mysql_fetch_array($resultado)):
             $nombre=$filas["nomemple"];
             $nombre1=$filas["nomemple1"];
             $apellido=$filas["apemple"];
             $apellido1=$filas["apemple1"];
             ?>
               <tr class="cajas">
                 <td><?echo $filas["cedemple"];?></td>
                 <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
                 <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                 <td><?echo $filas["eps"];?></td>
                 </tr>
                <?
              endwhile;
              ?>
              </table>
              <?
            endif;

            $variable="select incapacidad.*,tipoinca.* from incapacidad,empleado,eps,tipoinca where
                    empleado.cedemple=incapacidad.cedemple and
                    empleado.codeps=eps.codeps and
                     incapacidad.tipoinca=tipoinca.tipoinca and
                    empleado.cedemple='$xcodigo'";
        $resultado=mysql_query($variable)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("No existen incapacidades para este empleado ?")
            history.back()
          </script>
         <?
         else:
         ?>
         <center><h4>Datos de la Incapacidad</h4></center>
         <table border="0" align="center">
           <tr><th class="cajas">Para ver el Seguimiento dela incapacidad, presione click en el "Nro de Incap."</th></tr>
         </table>
         <table border="0" align="center">
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

                 <td><a href="../incapacidad/auxiliar.php?nro=<?echo $filas_s["nroinca"];?>&nombre=<?echo $nombre;?>&nombre1=<?echo $nombre1;?>&apellido=<?echo $apellido;?>&apellido1=<?echo $apellido1;?>"><?echo $filas_s["nroinca"];?></a></td>
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
               <td><center><a href="imprimirincapacidad.php?cedula=<?echo $xcodigo;?>">Imprimir</a></center></td>
               <?
           endif;
        ?>

        </table>
       </body>
  </html>
