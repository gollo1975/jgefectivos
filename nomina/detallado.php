<html>

<head>
  <title>Consulta de Zonas</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
      include("../conexion.php");
   if($Auxiliar==''):
        $consulta="select periodo.*,zona.zona from zona,sucursal,periodo where
                sucursal.codsucursal=zona.codsucursal and
                sucursal.codsucursal='$codigo'and
                zona.codzona=periodo.codzona and
                periodo.estado='FALTA'";
                 $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
                $registro=mysql_num_rows($resultado);
                if ($registro==0):
            ?>
            <script language="javascript">
            alert ("No hay zonas con periodo de Nomina registrado?")
            history.back()
            </script>
           <?
             else:
             ?>
                <center><h4>Listado de Zonas</h4></center>
                <table border="0" align="center">
                  <tr class="cajas">
                    <td>Para Ver el listado de Empleado por Zona, Presiones Click sobre el Cod_Zona..</td>
                  </tr>
                </table>
                <table border="0" align="center">
                  <tr class="cajas">
                    <td>Para Modificar el periodo, Presiones Click sobre el Campo [Codigo_Periodo]..</td>
                  </tr>
                </table>
                 <table border="0" align="center">
                  <tr class="fondo">
                    <td colspan="20"></td>
                  </tr>
                <tr class="cajas">
                   <th>Cod_Periodo</th>
                   <th>Cod_Zona</th>
                   <th>Zona</th>
                   <th>Desde</th>
                   <th>Hasta</th>
                   <th>Usuario</th>
                   </tr>
                    <?
                     while($filas=mysql_fetch_array($resultado)):
                   ?>
                     <tr class="cajas">
                        <td><a href="modificar.php?codP=<?echo $filas["codigo"];?>&zona=<?echo $filas["zona"];?>"><?echo $filas["codigo"];?></td>
                       <td><a href="ListadoP.php?codzona=<?echo $filas["codzona"];?>&CodPeriodo=<?echo $filas["codigo"];?>&desde=<?echo $filas["desde"];?>&hasta=<?echo $filas["hasta"];?>&Zona=<?echo $filas["zona"];?>"><?echo $filas["codzona"];?></a></td>
                       <td><?echo $filas["zona"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas["desde"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas["hasta"];?></td>
                       <td>&nbsp;&nbsp;<?echo $Auxiliar;?></td>

                     </tr>

                       <?
                    endwhile;
         endif;
    else:
         $consulta="select periodo.*,zona.zona from zona,sucursal,periodo,comisionomina,acceso where
                sucursal.codsucursal=zona.codsucursal and
                sucursal.codsucursal='$codigo'and
                zona.codzona=periodo.codzona and
                periodo.codzona=comisionomina.codzona and
                comisionomina.cedemple=acceso.cedula and
                acceso.cedula='$Documento' and
                periodo.estado='FALTA'";
             $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
            $registro=mysql_num_rows($resultado);
            if ($registro==0):
            ?>
            <script language="javascript">
            alert ("No hay zonas con periodo de Nomina registrado?")
            history.back()
            </script>
           <?
             else:
             ?>
                <center><h4>Listado de Zonas</h4></center>
                <table border="0" align="center">
                  <tr class="cajas">
                    <td>Para Ver el listado de Empleado por Zona, Presiones Click sobre el Cod_Zona..</td>
                  </tr>
                </table>
                <table border="0" align="center">
                  <tr class="cajas">
                    <td>Para Modificar el periodo, Presiones Click sobre el Campo [Codigo_Periodo]..</td>
                  </tr>
                </table>
                 <table border="0" align="center">
                  <tr class="fondo">
                    <td colspan="20"></td>
                  </tr>
                <tr class="cajas">
                   <th>Cod_Periodo</th>
                   <th>Cod_Zona</th>
                   <th>Zona</th>
                   <th>Desde</th>
                   <th>Hasta</th>
                    <th>Usuario</th>
                   </tr>
                    <?
                     while($filas=mysql_fetch_array($resultado)):
                   ?>
                     <tr class="cajas">
                        <td><a href="modificar.php?codP=<?echo $filas["codigo"];?>&zona=<?echo $filas["zona"];?>&Documento=<?echo $Documento;?>&Auxiliar=<?echo $Auxiliar;?>"><?echo $filas["codigo"];?></td>
                         <td><a href="ListadoP.php?codzona=<?echo $filas["codzona"];?>&CodPeriodo=<?echo $filas["codigo"];?>&desde=<?echo $filas["desde"];?>&hasta=<?echo $filas["hasta"];?>&Zona=<?echo $filas["zona"];?>&Auxiliar=<?echo $Auxiliar;?>"><?echo $filas["codzona"];?></a></td>
                       <td><?echo $filas["zona"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas["desde"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas["hasta"];?></td>
                        <td>&nbsp;&nbsp;<?echo $Auxiliar;?></td>
                     </tr>

                       <?
                    endwhile;
         endif;
    endif;
  ?>
</table>

</body>
</html>
