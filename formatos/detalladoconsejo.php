<html>
<head>
<title> Datos del Empleado</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>

<?
     include("../conexion.php");
       ?>
            <table border="0" align="center">
             <tr>
              <td><?echo $empresa;?></td>
               </tr>
            </table>
            <?
            include("../conexion.php");
             $consu="select deconsejo.* from consejo,deconsejo
                where  consejo.radicado=deconsejo.radicado and
                consejo.radicado='$radicado' order by deconsejo.empleado";
             $resu=mysql_query($consu)or die("Consulta incorrecta");
             $registros=mysql_num_rows($resu);
             ?>
              <center><h4>Listado de Miembros</h4></center>
              <table border="0" align="center">
              <tr  class="cajas">
               <th>Item</th>
                  <th>Documento</th>
                  <th>Nombres</th>
              </tr>
              <?
              $i=1;
               while($filas_s=mysql_fetch_array($resu)):
                ?>

              <tr  class="cajas">
                 <th><?echo $i;?></th>
                 <td><?echo $filas_s["cedemple"];?></td>
                 <td><?echo $filas_s["empleado"];?></td>
              </tr>
              <?
              $i=$i+1;
            endwhile;
            ?>
            </table>
            <?
?>
 </table>

</body>
</html>
