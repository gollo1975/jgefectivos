<html>

<head>
<title>Consulta de incapacidades</title>
 <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
</head>
<body>
<?
     include("../conexion.php");
     $variable="select eps.eps,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,eps where
                    empleado.codeps=eps.codeps and
                    empleado.cedemple='$cedula'";
         $resultado=mysql_query($variable)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El dato No existe en la BD.")
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
             ?>
               <tr class="cajas">
                 <td><?echo $filas["cedemple"];?></td>
                 <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td> </td>
                 <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                 <td><?echo $filas["eps"];?></td>
                 </tr>
                <?
              endwhile;
              ?>
              </table>
              <?
            endif;
             include("../conexion.php");
            $variable="select incapacidad.*,empleado.*,eps.*,tipoinca.*,control.concepto as Descripcion,control.codigo from control,incapacidad,empleado,eps,tipoinca where
                    empleado.cedemple=incapacidad.cedemple and
                    empleado.codeps=eps.codeps and
                     incapacidad.tipoinca=tipoinca.tipoinca and
					 incapacidad.codigo=control.codigo and
                    empleado.cedemple='$cedula'";
        $resultado=mysql_query($variable)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El dato No existe en la BD.")
            history.back()
          </script>
         <?
         else:
         ?>
         <center><h4>Datos de la Incapacidad</h4></center>
         <table border="0" align="center">
           <tr>
             <td colspan="9"></td>
           </tr>
           <tr class="cajas">
              <th>Nro_Incapacidad</th>
              <th>Fecha_Inicio</th>
              <th>Fecha_Final</th>
              <th>Dias</th>
			  <th>Codigo</th>
			  <th>Diagnostico</th>
              <th>Tipo_Incapacidad</th>
              </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado)):
             ?>
               <tr class="cajas">

                 <td><?echo $filas_s["nroinca"];?></td>
                 <td><?echo $filas_s["fechaini"];?></td>
                 <td><?echo $filas_s["fechater"];?></td>
                 <td><?echo $filas_s["dias"];?></td>
				 <td><?echo $filas_s["codigo"];?></td>
				 <td><?echo $filas_s["Descripcion"];?></td>
                 <td><?echo $filas_s["concepto"];?></td>

                 </tr>
                <?
              endwhile;
              ?>
              </table>
               <td><center><a href="imprimirincapa.php?cedula=<?echo $cedula;?>" >Imprimir</a></center></td>
               <?
           endif;
           ?>

        </table>
       </body>
  </html>
