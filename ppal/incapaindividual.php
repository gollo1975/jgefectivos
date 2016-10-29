<html>

<head>
<title>Consulta de incapacidades</title>
 <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
</head>
<body>
<?
if (!isset($cedula)):
?>
<center><h4>Consulta de incapacidades</h4></center>
  <form action="" method="post">
    <table border="0" align="center">
      <tr>
        <td colspan="2"></td>
      </tr>
      <tr><td><br></td></tr>
       <tr>
        <td><b>Documento Empleado:<b></td>
         <td><input type="text" name="cedula" value="" size="15" maxlength="15"></td>
        </tr>
        <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
           <input type="reset" value="Limpiar" class="boton">
           </td>

       </tr>
    </table>
    <br>

  </form>
  <?
elseif (empty($cedula)):
   ?>
   <script language="javascript">
     alert("Debe de Digitar un valor a consultar")
     history.back()
   </script>
   <?
   else:
     include("../conexion.php");
     $variable="select eps.eps,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,eps,zona where
                     zona.codzona=empleado.codzona and
                     zona.codzona='$codigo' and
                     empleado.codeps=eps.codeps and
                    empleado.cedemple='$cedula'";
         $resultado=mysql_query($variable)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("No esta Autorizado para ver las incapacidades de este ")
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

            $variable="select incapacidad.*,tipoinca.*,control.concepto as Descripcion,control.codigo from control,incapacidad,empleado,eps,tipoinca where
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
            alert("No existen incapacidades para este empleado ?")
            history.back()
          </script>
         <?
         else:
         ?>
         <center><h4>Datos de la Incapacidad</h4></center>
         <table border="0" align="center">
           <tr><td class="cajas">Para ver el Seguimiento dela incapacidad, presione click en el "Nro de Incap."</td></tr>
         </table>
         <table border="0" align="center">
          <tr class="cajas">
              <th>Nro_Incap.</th>
              <th>F_Inicio</th>
              <th>F_Final</th>
              <th>Dias</th>
			  <th>Codigo</th>
			  <th>Diagnostico</th>
              <th>Tipo_Incapacidad</th>
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
				 <td><?echo $filas_s["codigo"];?></td>
				 <td><?echo $filas_s["Descripcion"];?></td>
                 <td><?echo $filas_s["concepto"];?></td>
                 <td><?echo $filas_s["estado"];?></td>

                 </tr>
                <?
              endwhile;
              ?>
              </table>
               <td><center><a href="imprimirincapa.php?cedula=<?echo $cedula;?>">Imprimir</a></center></td>
               <?
           endif;
         endif;
         ?>

        </table>
       </body>
  </html>
