<html>

<head>
  <title>Consulta de Zonas</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
 include("../conexion.php");
         $con="select sucursal.sucursal from sucursal where
                sucursal.codsucursal='$CodSucursal'";
       $resulta=mysql_query($con)or die ("Consulta incorrecta");
        while($fila=mysql_fetch_array($resulta)):
        ?>
        <table border="0" align="center">
          <tr class="cajas">
            <td><?echo $fila["sucursal"];?></td>
          </tr>
       </table>
       <?
       endwhile;
       include("../conexion.php");
         $consulta="select zona.* from zona,sucursal where
                zona.codsucursal=sucursal.codsucursal and
                zona.nomina='SI' and
                        sucursal.codsucursal='$CodSucursal' and
                        zona.estado='ACTIVA' order by zona";
               $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
            $registro=mysql_num_rows($resultado);
            if ($registro==0):
            ?>
            <script language="javascript">
            alert ("El Código de la Sucursal, No existe en la bd. ?")
            history.back()
            </script>
           <?
             else:
             ?>
                <center><h4><u>ERS</u></h4></center>
                <table border="0" align="center">
                  <tr class="cajas">
                    <td>Para Crear Los periodos de Nomina por Zona, Presiones Click sobre el Cod_Zona..</td>
                  </tr>
                </table>
                 <table border="0" align="center">
                  <tr class="fondo">
                    <td colspan="20"></td>
                  </tr>
                <tr class="cajas">
                  <br>
                   <th>Item</th>
                   <th>Cod_Zona</th>
                   <th>Zona</th>
                   <th>Teléfono</th>
                   <th>Fax</th>
                   <th>Dirección</th>
                  </tr>
                    <? $a=1;
                     while($filas=mysql_fetch_array($resultado)):
                   ?>
                     <tr class="cajas">
                     <th><?echo $a;?></th>
                       <td><a href="subir.php?codigo=<?echo $filas["codzona"];?>&CodSucursal=<?echo $CodSucursal;?>"><?echo $filas["codzona"];?></a></td>
                       <td><?echo $filas["zona"];?></td>
                       <td><?echo $filas["telzona"];?></td>
                       <td><?echo $filas["faxzona"];?></td>
                       <td><?echo $filas["dirzona"];?></td>
                      </tr>

                       <?$a=$a+1;
                    endwhile;
         endif;
  ?>
</table>

</body>
</html>
