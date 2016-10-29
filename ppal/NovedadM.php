        <html>

<head>
  <title>Empleados por Zona</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

</body>
<?
 include("../conexion.php");
$Pos="select pnovedad.* from pnovedad,zona
  where zona.codzona=pnovedad.codzona and
  zona.codzona='$codigo' and
  pnovedad.estado='FALTA'";
  $resuP = mysql_query ($Pos) or die ("Error de Busqueda de Novedades");
  $regP = mysql_num_rows($resuP);
  $filasP=mysql_fetch_array($resuP);
  $desde=$filasP["desde"];
  $hasta=$filasP["hasta"];
 $consu="select zona.zona from zona where zona.codzona='$codigo'";
 $resu=mysql_query($consu);
 $reg=mysql_num_rows($resu);
 if ($reg!=0):
   ?>
   <table border="0" align="center">
  <?
    while($filas_s=mysql_fetch_array($resu)):
      ?>
      <tr  class="cajas">
             <td><?echo $filas_s["zona"];?></td>
      </tr>
      <?
    endwhile;
    ?>
    </table>
    <table border="0" align="center">
  <tr class="cajas">
    <td>Para Modificar Novedades de Nomina, presiones Click sobre el campo (DOCUMENTO)..</td>
  </tr>
</table>
    <?
   $consulta="select novedadnomina.* from novedadnomina,zona where
    zona.codzona=novedadnomina.codzona and
    zona.codzona='$codigo' and
    novedadnomina.desde='$desde' and novedadnomina.hasta='$hasta' order by novedadnomina.nombre";
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
       ?>

       <script language="javascript">
       alert("Este periodo ya fue cerrado por el departamento de Nómina!")
       history.back()
       </script>
       <?
    else:
        ?>
	<tr><td><br></td></tr>
	<table border="0" align="center">
	<tr  class="fondo">
	<td colspan="9"></td>
	</tr>
           <tr  class="cajas">
	   <th>Nro</th>
	   <th>Ducumento</th>
	   <th>Empleado</th>
	   <th>Desde</th>
	   <th>Hasta</th>
	</tr>
	<?
	$a=1;
	while($filas=mysql_fetch_array($resultado)):
	 ?>
           <tr  class="cajas">
                     <th><?echo $a;?></th>
	                 <td><a href="ModificarM.php?cedula=<?echo $filas["cedemple"];?>&codzona=<?echo $codigo;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>"><?echo $filas["cedemple"];?></a></td>
	                 <td><?echo $filas["nombre"];?></td>
	                 <td><?echo $filas["desde"];?></td>
	                 <td><?echo $filas["hasta"];?></td>
           </tr>
	   <?
	   $a=$a+1;
	   endwhile;
	   ?>
         </table>
	   <tr><td><br></td></tr>
	   <?
      endif;
    endif;
 ?>
 </body>
</html>
