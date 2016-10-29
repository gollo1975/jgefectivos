<html>

<head>
  <title>Modificar Novedad</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
      include("../conexion.php");
        $consulta="select periodo.*,zona.zona from zona,periodo where
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
	                    <td>Para ver los empleados por Zona, presiones Click sobre el Cod_Zona..</td>
	                  </tr>
	                </table>
	                 <table border="0" align="center">
	                  <tr class="fondo">
	                    <td colspan="20"></td>
	                  </tr>
	                <tr class="cajas">
	                <th>Nro</th>
	                   <th>Cod_Periodo</th>
	                   <th>Cod_Zona</th>
	                   <th>Zona</th>
	                   <th>Desde</th>
	                   <th>Hasta</th>
	                   <th>Usuario</th>
	                   </tr>
	                    <? $d=1;
	                     while($filas=mysql_fetch_array($resultado)):
	                   ?>
	                     <tr class="cajas">
	                         <th><?echo $d;?></th>
	                        <td><?echo $filas["codigo"];?></td>
	                       <td><a href="NovedadM.php?codzona=<?echo $filas["codzona"];?>&Auxiliar=<?echo $Auxiliar;?>&desde=<?echo $filas["desde"];?>&hasta=<?echo $filas["hasta"];?>"><?echo $filas["codzona"];?></a></td>
	                       <td><?echo $filas["zona"];?></td>
	                       <td>&nbsp;&nbsp;<?echo $filas["desde"];?></td>
	                       <td>&nbsp;&nbsp;<?echo $filas["hasta"];?></td>
	                       <td>&nbsp;&nbsp;<?echo $Auxiliar;?></td>

	                     </tr>

	                       <?  $d=$d+1;
	                    endwhile;
               endif;
  ?>
</table>

</body>
</html>
