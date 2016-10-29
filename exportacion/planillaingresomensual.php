<html>

<head>
  <title>Planilla de Nomina</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

 </head>

<?
if(!isset($desde)):
include("../conexion.php");
?>
 <center><h4><u>Planilla de nomina[Ingreso]</u> </h4></center>
                   <form action="" method="post">
                           <table border="0" align="center"
                            <tr>
                              <td colspan="9"></td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                              <td><b>Fecha Inicio:&nbsp;</b></td>
                              <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" size="13" maxlength="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><b>Fecha Final:&nbsp;</b></td>
                              <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="13" maxlength="10">&nbsp;</td>
                            </tr>
                            <tr>
         	      <td><b>Zona:</b></td>
                              <td colspan="12"><select name="codzona" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select * from zona where zona.nomina='SI' order by zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
  			  </tr>
                           <tr><td><br></td></tr>
                             <tr>
                               <td colspan="6"><input type="submit" value="Buscar" class="boton"> &nbsp;<input type="reset" value="Limpiar" class="boton"></td>
                             </tr>
                        </table>

                   </form>
                  <?
                elseif(empty($desde)):
                  ?>
                    <script language="javascript">
                       alert("Digite la fecha de Inicio" )
                       history.back()
                     </script>
              <?
               elseif(empty($codzona)):
                  ?>
                    <script language="javascript">
                       alert("Seleccione una zona de lista.?" )
                       history.back()
                     </script>
              <?
              else:
  include ("../conexion.php");
              $consulta="select  zona.zona, empleado.cedemple,
        concat(empleado.nomemple, ' ', empleado.nomemple1, ' ', empleado.apemple, ' ', empleado.apemple1) 'nombre',
        nomina.consecutivo, 
        sum(if(denomina.codsala = '01', denomina.salario, 0)) 'hod',
        sum(if(denomina.codsala = '01', denomina.nrohora, 0)) 'vlrhod',
        sum(if(denomina.codsala = '02', denomina.salario, 0)) 'hon',
        sum(if(denomina.codsala = '02', denomina.nrohora, 0)) 'vlrhon',
        sum(if(denomina.codsala = '03', denomina.salario, 0)) 'hed',
        sum(if(denomina.codsala = '03', denomina.nrohora, 0)) 'vlrhed',
        sum(if(denomina.codsala = '04', denomina.salario, 0)) 'rn',
        sum(if(denomina.codsala = '04', denomina.nrohora, 0)) 'vlrn',
        sum(if(denomina.codsala = '05', denomina.salario, 0)) 'ajuste',
        sum(if(denomina.codsala = '06', denomina.salario, 0)) 'heno',
        sum(if(denomina.codsala = '06', denomina.nrohora, 0)) 'vlrheno',
        sum(if(denomina.codsala = '07', denomina.salario, 0)) 'hfd',
        sum(if(denomina.codsala = '07', denomina.nrohora, 0)) 'vlrhfd',
        sum(if(denomina.codsala = '09', denomina.salario, 0)) 'henf',
        sum(if(denomina.codsala = '09', denomina.nrohora, 0)) 'vlrhenf',
        sum(if(denomina.codsala = '10', denomina.salario, 0)) 'rnfc',
        sum(if(denomina.codsala = '10', denomina.nrohora, 0)) 'vlrnfc',
        sum(if(denomina.codsala = '11', denomina.salario, 0)) 'hefd',
        sum(if(denomina.codsala = '11', denomina.nrohora, 0)) 'vlrhefd',
        sum(if(denomina.codsala = '12', denomina.salario, 0)) 'ig',
        sum(if(denomina.codsala = '12', denomina.nrohora, 0)) 'vlrig',
        sum(if(denomina.codsala = '13', denomina.salario, 0)) 'il',
        sum(if(denomina.codsala = '13', denomina.nrohora, 0)) 'vlril',
        sum(if(denomina.codsala = '16', denomina.salario, 0)) 'descansoC',
        sum(if(denomina.codsala = '16', denomina.nrohora, 0)) 'nroC',
        sum(if(denomina.codsala = '17', denomina.salario, 0)) 'descansoNC',
        sum(if(denomina.codsala = '17', denomina.nrohora, 0)) 'nroNC',
        sum(if(denomina.codsala = '20', denomina.salario, 0)) 'ayuda',
        sum(if(denomina.codsala = '24', denomina.salario, 0)) 'meta',
        sum(if(denomina.codsala = '25', denomina.salario, 0)) 'bonificacion',
        sum(if(denomina.codsala = '26', denomina.salario, 0)) 'movilizacion',
        sum(if(denomina.codsala = '27', denomina.salario, 0)) 'alimentacion',
        sum(if(denomina.codsala = '28', denomina.salario, 0)) 'educacion',
        sum(if(denomina.codsala = '29', denomina.salario, 0)) 'gastos',
        sum(if(denomina.codsala = '31', denomina.salario, 0)) 'bonificacionP',
        sum(if(denomina.codsala = '32', denomina.salario, 0)) 'comision'

        from	maestro 	inner join sucursal on maestro.codmaestro=sucursal.codmaestro
				inner join zona on sucursal.codsucursal=zona.codsucursal
				inner join periodo on zona.codzona=periodo.codzona
				inner join nomina on periodo.codigo=nomina.codigo
				inner join denomina on nomina.consecutivo = denomina.consecutivo
				inner join salario on salario.codsala = denomina.codsala
				inner join empleado on empleado.cedemple=nomina.cedemple

		where	periodo.desde>='$desde' and periodo.hasta<='$hasta' and
               	zona.codzona='$codzona'
		group by empleado.cedemple
		order by empleado.nomemple";
				 
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
				 
                  if($registros!=0):
                                      header("Content-type: application/vnd.ms-excel");
		                      header("Content-Disposition: attachment; filename=Planilla de Ingreso mensual.xls");
		                      header("Pragma: no-cache");
		                      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		                      header("Expires: 0");
                     ?>
                       <table border="0" align="center" >
                         <tr class="cajas">
                         <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Documento</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Empleado</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Hra.Ord.Diur.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>inc_General</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Acci_Laboral</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Hra.Ord.Ext.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Hra.Fes.Diur.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Hra.Ext.Fes.Diur</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Hra.Ext.Noc.Fest.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Rec.Noc.Fes.SC</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Hra.Ext.Noct.Ord.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Rec.Noct.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Rec.Noc.Fes.Comp.</td>  
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Domin.Comp.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Domin.No.Comp.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>A_Alimentación</td>
                           <td style='font-weight:bold;font-size:1.0em;'>A_Educación</td>
                           <td style='font-weight:bold;font-size:1.0em;'>A_Movilizacion</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Gastos_RL</td>
                            <td style='font-weight:bold;font-size:1.0em;'>C_Metas</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Aux.Trans.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Comisión</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Ajuste.Sal.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Bonificación</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Bonif_Produ.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Total Deven.</td>
						   </tr>
                          <?
						  $i = 0;
                         while ($filas=mysql_fetch_array($resultado)):
						 $i++;
                                  ?>
                                   <tr class="cajas">
                                        <td><?echo $i;?></td>
                                        <td><?echo $filas["cedemple"];?></td>
                                        <td><?echo $filas["nombre"];?></td>
										<td><?echo $filas["vlrhod"];?></td>
                                        <td><?echo $filas["hod"];?></td>
										<td><?echo $filas["vlrig"];?></td>
										<td><?echo $filas["ig"];?></td>
										<td><?echo $filas["vlril"];?></td>
										<td><?echo $filas["il"];?></td>
										<td><?echo $filas["vlrhed"];?></td>
										<td><?echo $filas["hed"];?></td>
										<td><?echo $filas["vlrhfd"];?></td>
										<td><?echo $filas["hfd"];?></td>
										<td><?echo $filas["vlrhefd"];?></td>
										<td><?echo $filas["hefd"];?></td>
										<td><?echo $filas["vlrhenf"];?></td>
										<td><?echo $filas["henf"];?></td>
										<td><?echo $filas["vlrhon"];?></td>
										<td><?echo $filas["hon"];?></td>
										<td><?echo $filas["vlrheno"];?></td>
										<td><?echo $filas["heno"];?></td>
										<td><?echo $filas["vlrn"];?></td>
										<td><?echo $filas["rn"];?></td>
                                        <td><?echo $filas["vlrnfc"];?></td>
										<td><?echo $filas["rnfc"];?></td>
										<td><?echo $filas["nroC"];?></td>
										<td><?echo $filas["descansoC"];?></td>
										<td><?echo $filas["nroNC"];?></td>
										<td><?echo $filas["descansoNC"];?></td>
										<td><?echo $filas["alimentacion"];?></td>
										<td><?echo $filas["educacion"];?></td>
										<td><?echo $filas["movilizacion"];?></td>
										<td><?echo $filas["gastos"];?></td>
										<td><?echo $filas["meta"];?></td>
										<td><?echo $filas["ayuda"];?></td>
										<td><?echo $filas["comision"];?></td>
										<td><?echo $filas["ajuste"];?></td>										
										<td><?echo $filas["bonificacion"];?></td>
										<td><?echo $filas["bonificacionP"];?></td>
										<td><? echo
										$totalingreso = ($filas["ajuste"] + $filas["alimentacion"] + $filas["educacion"] +  $filas["ayuda"] + $filas["movilizacion"] + $filas["bonificacionP"] + $filas["bonificacion"] + $filas["comision"] + $filas["meta"] + $filas["descansoC"] + $filas["descansoNC"] + $filas["gastos"] + $filas["hed"] + $filas["henf"] + $filas["heno"] + $filas["hfd"] + $filas["hod"] + $filas["hon"] + $filas["rn"] + $filas["hefd"] + $filas["ig"] + $filas["il"] + $filas["rnfc"]);
										?></td>
                                       </tr>
                               <?
                              endwhile;
                              ?>
                         ?>
                           </table>
                            <tr><td><br></td></tr>

                         <?
                   else:
                      ?>
                         <script language="javascript">
                            alert("No hay registros con este rango de Fechas ?")
                            history.back()
                         </script>
                         <?
                   endif;
                           ?>
                          </table>
                          </td></tr>
                        </table>
                    </form>
       <?
 endif;
       ?>


</body>
</html>
