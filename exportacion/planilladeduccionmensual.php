<html>

<head>
  <title>Planilla de Nomina</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

 </head>

<?
if(!isset($desde)):
include("../conexion.php");
?>
 <center><h4><u>Planilla[Egreso]</u> </h4></center>
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
        sum(if(denomina.codsala = '64', denomina.deduccion, 0)) 'mercado',
        sum(if(denomina.codsala = '66', denomina.deduccion, 0)) 'odontologia',
        sum(if(denomina.codsala = '67', denomina.deduccion, 0)) 'optica',
        sum(if(denomina.codsala = '50', denomina.deduccion, 0)) 'pension',
        sum(if(denomina.codsala = '51', denomina.deduccion, 0)) 'salud',
        sum(if(denomina.codsala = '63', denomina.deduccion, 0)) 'fondo',
        sum(if(denomina.codsala = '61', denomina.deduccion, 0)) 'gmo',
        sum(if(denomina.codsala = '91', denomina.deduccion, 0)) 'laboral',
        sum(if(denomina.codsala = '65', denomina.deduccion, 0)) 'tercero',
        sum(if(denomina.codsala = '83', denomina.deduccion, 0)) 'vestuario',
        sum(if(denomina.codsala = '85', denomina.deduccion, 0)) 'alimento',
        sum(if(denomina.codsala = '44', denomina.deduccion, 0)) 'computo',
        sum(if(denomina.codsala = '08', denomina.deduccion, 0)) 'menorvlr',
        sum(if(denomina.codsala = '68', denomina.deduccion, 0)) 'caja',
        sum(if(denomina.codsala = '81', denomina.deduccion, 0)) 'cocredito',
        sum(if(denomina.codsala = '62', denomina.deduccion, 0)) 'copantex',
        sum(if(denomina.codsala = '82', denomina.deduccion, 0)) 'empresa',
        sum(if(denomina.codsala = '60', denomina.deduccion, 0)) 'pichincha',
        sum(if(denomina.codsala = '86', denomina.deduccion, 0)) 'funeraria',
        sum(if(denomina.codsala = '42', denomina.deduccion, 0)) 'sol',
        sum(if(denomina.codsala = '41', denomina.deduccion, 0)) 'fuente',
        sum(if(denomina.codsala = '35', denomina.deduccion, 0)) 'seguro',
        sum(if(denomina.codsala = '84', denomina.deduccion, 0)) 'segovia',
        sum(if(denomina.codsala = '87', denomina.deduccion, 0)) 'atm',
        sum(if(denomina.codsala = '88', denomina.deduccion, 0)) 'budapes'

        from zona inner join periodo on zona.codzona = periodo.codzona
				inner join nomina on periodo.codigo = nomina.codigo
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
                           <td style='font-weight:bold;font-size:1.0em;'>D_Mercado</td>
                            <td style='font-weight:bold;font-size:1.0em;'>D_Odontologia</td> 
                           <td style='font-weight:bold;font-size:1.0em;'>D_Optica</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D_Pensión</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D.Salud</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Aporte_Fondo</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D_Gmo</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Cert._Lab.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D_Tercero</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D_Vestuario</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Emb_Alimento</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D_Computo</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Men_Vlr_Paga.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D_Caja</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D_Cocredito</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D_Coopantex</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D_Empresa</td>
                            <td style='font-weight:bold;font-size:1.0em;'>D_Pichincha</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D_Funeraria</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D_Sol</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Rfte</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Seg_Vida</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D_Limocine</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D_Atm</td>
                           <td style='font-weight:bold;font-size:1.0em;'>D_Budapes</td>
                            <td style='font-weight:bold;font-size:1.0em;'>T_Deducción</td>
                          </tr>
                       <?
                        	$i = 0;
                       	 	while ($filas=mysql_fetch_array($resultado)):
							$i++;
                              ?>
                                        <tr class="cajas">
                                           <td><? echo $i;?></td>
                                           <td><? echo $filas["cedemple"];?></td>
                                           <td><? echo $filas["nombre"];?></td>
                                           <td><? echo $filas["mercado"];?></td>
                                           <td><? echo $filas["odontologia"];?></td>
                                           <td><? echo $filas["optica"];?></td>
                                           <td><? echo $filas["pension"];?></td>
                                           <td><? echo $filas["salud"];?></td>
                                           <td><? echo $filas["fondo"];?></td>
                                           <td><? echo $filas["gmo"];?></td>
                                           <td><? echo $filas["laboral"];?></td>
                                           <td><? echo $filas["tercero"];?></td>
                                           <td><? echo $filas["vestuario"];?></td>
                                           <td><? echo $filas["alimento"];?></td>
                                           <td><? echo $filas["computo"];?></td>
                                           <td><? echo $filas["menorvlr"];?></td>
                                           <td><? echo $filas["caja"];?></td>
                                           <td><? echo $filas["cocredito"];?></td>
                                           <td><? echo $filas["copantex"];?></td>
                                           <td><? echo $filas["empresa"];?></td>
                                           <td><? echo $filas["pichincha"];?></td>
                                           <td><? echo $filas["funeraria"];?></td>
                                           <td><? echo $filas["sol"];?></td>
                                           <td><? echo $filas["fuente"];?></td>
                                           <td><? echo $filas["seguro"];?></td>
                                           <td><? echo $filas["segovia"];?></td>
                                           <td><? echo $filas["atm"];?></td>
                                           <td><? echo $filas["budapes"];?></td>   
                                           <td><? echo $totaldeduccion;?></td>
										   <td><?
										   			echo $totaldeduccion = ($filas["mercado"] + $filas["odontologia"] + $filas["optica"] + $filas["pension"] + $filas["salud"] + $filas["fondo"] + $filas["gmo"] + $filas["laboral"] + $filas["tercero"] + $filas["vestuario"] + $filas["alimento"] + $filas["computo"] + $filas["menorvlr"] + $filas["caja"] + $filas["cocredito"] + $filas["copantex"] + $filas["empresa"] + $filas["pichincha"] + $filas["funeraria"] + $filas["sol"] + $filas["fuente"] + $filas["seguro"] + $filas["segovia"] + $filas["atm"] + $filas["budapes"]);
										   ?></td>
                                         </tr>
                                          <?
                              endwhile;
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
