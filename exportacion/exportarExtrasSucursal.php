<html>

<head>
  <title>Primas por Sucursal</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?php 
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center>
    <h4>Extras por  Sucursal</h4>
  </center>
<form action="" method="post" width="200">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
  <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<?php  echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<?php  echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
  <tr>
         <td><b>Sucursal:</b></td>
                              <td colspan="12"><select name="campo" class="cajas">
                              <option value="0">Seleccione la Sucursal
                                <?php 
                                 $consulta_z="select sucursal.codsucursal,sucursal.sucursal from sucursal order by sucursal";
                                 $resultado_z=mysql_query($consulta_z)or die ("Error de busqueda de sucursales");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?php echo $filas_z["codsucursal"];?>"> <?php echo $filas_z["sucursal"];?>
                                  <?php 
                                  endwhile;
                                  ?>
                                  </select></td>
    </tr>
    <tr>
         <td>&nbsp;</td>
                              <td>&nbsp;</td>
    </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar"class="boton">    </td>
  </tr>
</table>
</form>
<?php 
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la Sucursal ?")
    history.back()
  </script>
    <?php 
    elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir el banco ?")
    history.back()
  </script>
  <?php 
     else:
       include("../conexion.php");
         $consu="select decobrozona.conse, decobrozona.cedemple, decobrozona.empleado, decobrozona.tiempo, zona.zona, empleado.basico from zona,cobrozona,decobrozona,empleado,sucursal
					where 	zona.codzona=cobrozona.codzona and decobrozona.cedemple=empleado.cedemple and cobrozona.codigo=decobrozona.codigo and
							sucursal.codsucursal = zona.codsucursal  and sucursal.codsucursal='$campo' and cobrozona.desde = '$desde' and
							cobrozona.hasta = '$hasta' order by zona.zona, decobrozona.empleado";
          $resulta=mysql_query($consu)or die ("Error de busqueda de nomina");
          $registro=mysql_affected_rows();
          if ($registro!=0):
             header("Content-type: application/vnd.ms-excel");
             header("Content-Disposition: attachment; filename=TiempoExtraSucursal.xls");
             header("Pragma: no-cache");
             header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
             header("Expires: 0");
           ?>
                     ?>
                        <table border="0" align="center" >
                         <tr class="cajas">
                            <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Documento</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Empleado</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Tiempo Extra</td>
							<td style='font-weight:bold;font-size:1.0em;'>Salario</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Zona</td>
                         </tr>
                            <?php 
                            $l=1;
                          while ($filas=mysql_fetch_array($resulta)):
                           /* $aux=number_format($filas["basico"],0);
                            $aux1=number_format($filas["tiempo"],0);
                            $aux2=number_format($filas["ayuda"],0);
                            $aux3=number_format($filas["ss"],0);
                            $aux4=number_format($filas["vlreps"],0);
                            $aux5=number_format($filas["vlrpension"],0);
                            $aux6=number_format($filas["cp"],0);
                            $aux7=number_format($filas["ps"],0);
                            $aux8=number_format($filas["admon"],0);
                            $aux9=number_format($filas["iva"],0);*/
                            ?>
                            <tr class="cajas">
                              <td><?php  echo $l;?></td>
                              <td><?php  echo $filas["cedemple"];?></td>
                              <td><?php  echo $filas["empleado"];?></td>
                              <td><?php  echo $filas["tiempo"];?></td>
							  <td><?php  echo $filas["basico"];?></td>
                              <td><?php  echo $filas["zona"];?></td>  
                            </tr>
                            <?php 
                            $l=$l+1;
                          endwhile;
                            ?>
                            </table>
                           <?php 
                   else:
                      ?>
                         <script language="javascript">
                            alert("No hay registros De Facturacion para esta Zona ?")
                            history.back()
                         </script>
                         <?php 
                   endif;
				 endif;
?>
</body>
</html>
