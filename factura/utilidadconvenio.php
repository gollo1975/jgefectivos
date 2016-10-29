<html>

<head>
  <title>Ingresos por Convenio</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
        function volver()// para declara funcion
        {
                pagina='reingreso.php'
                tiempo=90
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
 </head>

<?
  if (!isset($auxcodigo)):
     include("../conexion.php");
  ?>
  <center><h4><u>Ingreso por convenio</u></h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>
   <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
  <tr>
         <td><b>Servicios:</b></td>
                              <td colspan="5"><select name="codigo" class="cajas">
                              <option value="0">Seleccion el servicio
	                      <?
		               $consulta_s="select codsala,desala from salario order by desala";
		               $resultado_s=mysql_query($consulta_s)or die ("Error en la busqueda de Items");
		                  while($filas_s=mysql_fetch_array($resultado_s))
		                  {
		                   ?>
		                   <option value="<?echo $filas_s["codsala"];?>"> <?echo $filas_s["desala"];?>
		                   <?
		                  }
		                ?></select></td>
    </tr>
  <tr>
         <td><b>Empresa:</b></td>
                              <td colspan="12"><select name="auxcodigo" class="cajas">
                              <option value="0">Seleccione la empresa
                                <?
                                 $consulta_z="select maestro.codmaestro,maestro.nomaestro from maestro ";
                                 $resultado_z=mysql_query($consulta_z)or die ("Error en la busqueda de empresa");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codmaestro"];?>"> <?echo $filas_z["nomaestro"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
    </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($auxcodigo)):
  ?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la empresa ?")
    history.back()
  </script>
  <?
elseif(empty($codigo)):
  ?>
  <script language="javascript">
    alert ("Despliegue la vista para el consecutivo del servicio?")
    history.back()
  </script>
    <?
else:
  include ("../conexion.php");
  $con="select salario.desala from salario where  codsala='$codigo'";
  $resu=mysql_query($con) or die ("Error al buscar codigos");
  $re=mysql_affected_rows();
  $fila=mysql_fetch_array($resu);
  $salarios=$fila["desala"];
  $con1="select maestro.nomaestro from maestro where  maestro.codmaestro='$auxcodigo'";
  $resu1=mysql_query($con1) or die ("Error al buscar empresas");
  $re1=mysql_affected_rows();
  $filas_e=mysql_fetch_array($resu1);
  $empresa=$filas_e["nomaestro"];
  $consulta="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,zona.zona,nomina.desde,nomina.hasta,denomina.deduccion from maestro,sucursal,zona,empleado,nomina,denomina,salario
   where  maestro.codmaestro=sucursal.codmaestro and
         sucursal.codsucursal=zona.codsucursal and
          zona.codzona=empleado.codzona and
          empleado.cedemple=nomina.cedemple and
          nomina.desde between '$desde'and'$hasta' and
          nomina.consecutivo=denomina.consecutivo and
          denomina.codsala=salario.codsala and
          maestro.codmaestro='$auxcodigo' and
          salario.codsala='$codigo' order by zona.zona";
          $resultado=mysql_query($consulta) or die ("Error en la busquedas de convenios de asociacion ");
          $registros=mysql_num_rows($resultado);
          if($registros!=0):
	                  ?>
	                    <table border="0" align="center">
	                     <tr>
	                       <td class="cajas"><b>Empresa:</b>&nbsp;<? echo $empresa;?></td>
	                     </tr>
	                     <tr>
	                       <td class="cajas"><b>Servicio:</b>&nbsp;<? echo $salarios;?></td>
	                     </tr>
                           </table>
                            <tr><td><br></td></tr>       
	                   <table border="0" align="center" >
	                         <tr class="cajas">
	                            <th>Item</th>
	                            <th>Documento</th>
	                            <th>Asociado</th>
                                    <th>Zona</th>
	                            <th>Desde</th>
	                            <th>Hasta</th>
	                            <th>Vlr_Convenio</th>
	                         <?
                                 $a=1;
	                          while ($filas=mysql_fetch_array($resultado)):
                                    $total=number_format($filas["deduccion"]*-1,0);

	                            ?>
	                              <tr class="cajas">
                                      <th><? echo $a;?></th>
	                              <td><? echo $filas["cedemple"];?></td>
	                              <td><? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>&nbsp;</td>
                                      <td><? echo $filas["zona"];?></td>
                                      <td><? echo $filas["desde"];?></td>
	                               <td><? echo $filas["hasta"];?></td>
	                              <td><div align="right">$<? echo $total;?></div></td>
                             </tr>
	                            <?
                                    $con=$con-$filas["deduccion"];
                                    $a=$a+1;
	                          endwhile;
                                  $con=number_format($con,2);
	                            ?>
	                        </table>
                                <div align="center"><b>Vlr_Admon:&nbsp;<? echo $con;?></div>
                            <?
	  else:
	        ?>
	           <script language="javascript">
	              alert("No hay registros de convenios en este rango de fechas ?")
	              history.back()
	             </script>
	           <?
	  endif;
endif;
?>
</body>
</html>
