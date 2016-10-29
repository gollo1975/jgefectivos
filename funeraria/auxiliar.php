<html>
<head>
<title> Datos del Empleado</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>

<?
     include("../conexion.php");
     $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where cedemple='$cedemple'";
     $resultado=mysql_query($consulta)or die("Consulta incorrecta");
     $registros=mysql_num_rows($resultado);
     if($registros!=0):
       ?>
            <table border="0" align="center">
                <?
            while($filas=mysql_fetch_array($resultado)):
             ?>
             <tr>
              <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
               </tr>
              <?
            endwhile;
            ?>
            </table>
            <?
            include("../conexion.php");
             $consu="select funeraria.* from empleado,funeraria where
                empleado.cedemple=funeraria.cedemple and
                empleado.cedemple='$cedemple'";
             $resu=mysql_query($consu)or die("Consulta incorrecta");
             $registros=mysql_num_rows($resu);
             ?>
              <center><h3>Listado de Beneficiarios</h3></center>
              <table border="0" align="center">
               <tr  class="fondo">
                <td colspan="9"><br></td>
              </tr>
              <tr  class="cajas">
               <th>Item</th>
                  <th>Tipo Doc:</th>
                  <th>Ducumento:</th>
                  <th>Nombres</th>
                  <th>Parentezco</th>
                   <th>Fecha_Proceso</th>
              </tr>
              <?
              $i=1;
               while($filas_s=mysql_fetch_array($resu)):
                ?>

              <tr  class="cajas">
              <th><?echo $i;?></th>
                 <td><?echo $filas_s["tipo"];?></td>
                 <td><?echo $filas_s["documento"];?></td>
                 <td><?echo $filas_s["nombres"];?></td>
                 <td><?echo $filas_s["parentezco"];?></td>
                  <td><?echo $filas_s["fecha"];?></td>
               </tr>
              <?
              $i=$i+1;
            endwhile;
            ?>
            </table>
            <?
     endif;

 ?>
 </table>

</body>
</html>
