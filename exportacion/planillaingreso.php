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
                   <input type="hidden" name="CodZ" value="<? echo $CodZ;?>">
                           <table border="0" align="center"
                            <tr>
                              <td colspan="9"></td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                              <td><b>Fecha Inicio:&nbsp;</b></td>
                              <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" class="cajas" size="12" maxlength="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><b>Fecha Final:&nbsp;</b></td>
                              <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="12" class="cajas" maxlength="10">&nbsp;</td>
                            </tr>
                             <?if($CodZ==''){?>
                               <tr>
         	                 <td><b>Zona:</b></td>
                                 <td colspan="12"><select name="CodZ" class="cajas">
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
                             <?}?>
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
               elseif(empty($CodZ)):
                  ?>
                    <script language="javascript">
                       alert("Seleccione una zona de lista.?" )
                       history.back()
                     </script>
              <?
              else:
  include ("../conexion.php");
              $consulta="select zona.zona, empleado.cedemple, empleado.nomemple, empleado.nomemple1, empleado.apemple, empleado.apemple1, nomina.consecutivo from 							nomina, empleado, zona, periodo
                where   zona.codzona=periodo.codzona and
                 empleado.cedemple=nomina.cedemple and
                 periodo.codigo=nomina.codigo and
                 periodo.desde='$desde' and periodo.hasta='$hasta' and
                 zona.codzona='$CodZ' order by empleado.nomemple,empleado.apemple";
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                                      header("Content-type: application/vnd.ms-excel");
		                      header("Content-Disposition: attachment; filename=Planilla de Ingreso.xls");
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
                           <td style='font-weight:bold;font-size:1.0em;'>Inc_General</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Incao._Laboral</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Hra.Ord.Ext.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Hra.Fes.Diur.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Hra.Ext.Fes.Diur</td>
						   <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
						   <td style='font-weight:bold;font-size:1.0em;'>AJUSTE DOMINGO HABITUAL</td>
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
                           <td style='font-weight:bold;font-size:1.0em;'>Fest.Labor.Diurno</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Hra.Ext.Domi.Diurna</td>
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
                           <td style='font-weight:bold;font-size:1.0em;'>Aux.Bancario</td>
                           <td style='font-weight:bold;font-size:1.0em;'>L.Materni.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>L.Remunerada</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Total Deven.</td>
                          </tr>
                          <?
                         $i=1;
                         $fechap=date("Y-m-d");
                         echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resultado) . "\">");
                        while ($filas=mysql_fetch_array($resultado)):
                           $ttiempo = 0;
                            $codigo=$filas["consecutivo"];
                            $consul="SELECT denomina.salario 'ajuste'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='05' group by denomina.codsala";
                            $resulta=mysql_query($consul)or die ("Consulta incorrecta $consul");
                            $registro=mysql_num_rows($resulta);
                            $filas_s=mysql_fetch_array($resulta);
                            $suma1=$filas_s["ajuste"];
                            $consul1="SELECT  denomina.salario 'alimentacion'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                           zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='27') group by denomina.codsala";
                            $resulta1=mysql_query($consul1)or die ("Consulta incorrecta $consul");
                            $registro1=mysql_num_rows($resulta1);
                            $filas_s1=mysql_fetch_array($resulta1);
                            $suma2=$filas_s1["alimentacion"];
                            /*FIN CODIGO*/
                            $consul5="SELECT  denomina.salario 'educacion'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='28')group by denomina.codsala";
                            $resulta5=mysql_query($consul5)or die ("Consulta incorrecta $consul");
                            $registro5=mysql_num_rows($resulta5);
                            $filas_s5=mysql_fetch_array($resulta5);
                            $suma3=$filas_s5["educacion"];
                              /*FIN CODIGO*/
                            $consul6="SELECT  denomina.salario 'ayuda'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='20') group by denomina.codsala";
                            $resulta6=mysql_query($consul6)or die ("Consulta incorrecta $consul");
                            $registro6=mysql_num_rows($resulta6);
                            $filas_s6=mysql_fetch_array($resulta6);
                            $suma4=$filas_s6["ayuda"];
                            $consul7="SELECT  denomina.salario 'movilizacion'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='26') group by denomina.codsala";
                            $resulta7=mysql_query($consul7)or die ("Consulta incorrecta $consul");
                            $registro7=mysql_num_rows($resulta7);
                            $filas_s7=mysql_fetch_array($resulta7);
                            $suma5=$filas_s7["movilizacion"];
                            /*FIN CODIGO*/
							
							$consul70="SELECT  denomina.salario 'AJUSTEDOMINGOHABITUAL', denomina.nrohora 'nrohorasadh'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='15') group by denomina.codsala";
                            $resulta70=mysql_query($consul70)or die ("Consulta incorrecta $consul");
                            $registro70=mysql_num_rows($resulta70);
                            $filas_s70=mysql_fetch_array($resulta70);
                            $suma50=$filas_s70["AJUSTEDOMINGOHABITUAL"];
							$valor50=$filas_s70["nrohorasadh"];
							/*FIN CODIGO*/
							
                             $consul8="SELECT  denomina.salario 'bonificacionP'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='31') group by denomina.codsala";
                            $resulta8=mysql_query($consul8)or die ("Consulta incorrecta $consul");
                            $registro8=mysql_num_rows($resulta8);
                            $filas_s8=mysql_fetch_array($resulta8);
                            $suma6=$filas_s8["bonificacionP"];
                             $consul9="SELECT  denomina.salario 'bonificacion'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='25') group by denomina.codsala";
                            $resulta9=mysql_query($consul9)or die ("Consulta incorrecta $consul");
                            $registro9=mysql_num_rows($resulta9);
                            $filas_s9=mysql_fetch_array($resulta9);
                            $suma7=$filas_s9["bonificacion"];
                            /*FIN CODIGO*/
                            $consul10="SELECT  denomina.salario 'comision'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='32') group by denomina.codsala";
                            $resulta10=mysql_query($consul10)or die ("Consulta incorrecta $consul");
                            $registro10=mysql_num_rows($resulta10);
                            $filas_s10=mysql_fetch_array($resulta10);
                            $suma8=$filas_s10["comision"];
                            /*FIN CODIGO*/
                            $consul11="SELECT  denomina.salario 'meta'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='24') group by denomina.codsala";
                            $resulta11=mysql_query($consul11)or die ("Consulta incorrecta $consul");
                            $registro11=mysql_num_rows($resulta11);
                            $filas_s11=mysql_fetch_array($resulta11);
                            $suma9=$filas_s11["meta"];
                            /*otro*/
                            $consul12="SELECT  denomina.salario 'descansoC',denomina.nrohora 'nroC'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='16') group by denomina.codsala";
                            $resulta12=mysql_query($consul12)or die ("Consulta incorrecta $consul");
                            $registro12=mysql_num_rows($resulta12);
                            $filas_s12=mysql_fetch_array($resulta12);
                            $suma10=$filas_s12["descansoC"];
                            $Valor1=$filas_s12["nroC"];
                            /*otro*/
                            $consul2="SELECT denomina.salario 'descansoNC',denomina.nrohora 'nroNC'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='17' group by denomina.codsala";
                            $resulta2=mysql_query($consul2)or die ("Consulta incorrecta $consul");
                            $registro2=mysql_num_rows($resulta2);
                            $filas_s2=mysql_fetch_array($resulta2);
                            $suma11=$filas_s2["descansoNC"];
                            $Valor2=$filas_s2["nroNC"];
                             /*otro*/
                            $consul13="SELECT denomina.salario 'gastos'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                           zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='29' group by denomina.codsala";
                            $resulta13=mysql_query($consul13)or die ("Consulta incorrecta 29");
                            $registro13=mysql_num_rows($resulta13);
                            $filas_s13=mysql_fetch_array($resulta13);
                            $suma12=$filas_s13["gastos"];
                            /*fin codigo*/
                            $consul14="SELECT denomina.salario 'hed',denomina.nrohora 'vlrhed'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                           zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='03' group by denomina.codsala";
                            $resulta14=mysql_query($consul14)or die ("Consulta incorrecta 03");
                            $registro14=mysql_num_rows($resulta14);
                            $filas_s14=mysql_fetch_array($resulta14);
                            $suma13=$filas_s14["hed"];
                            $Valor3=$filas_s14["vlrhed"];
                             /* codigo*/
                            $consul15="SELECT denomina.salario 'henf',denomina.nrohora 'vlrhenf'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='09' group by denomina.codsala";
                            $resulta15=mysql_query($consul15)or die ("Consulta incorrecta 09");
                            $registro15=mysql_num_rows($resulta15);
                            $filas_s15=mysql_fetch_array($resulta15);
                            $suma14=$filas_s15["henf"];
                            $Valor4=$filas_s15["vlrhenf"];
                            /* codigo*/
                            $consul16="SELECT denomina.salario 'heno',denomina.nrohora 'vlrheno'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='06' group by denomina.codsala";
                            $resulta16=mysql_query($consul16)or die ("Consulta incorrecta 06");
                            $registro16=mysql_num_rows($resulta16);
                            $filas_s16=mysql_fetch_array($resulta16);
                            $suma15=$filas_s16["heno"];
                            $Valor5=$filas_s16["vlrheno"];
                            /*fin codigo*/
                            $consul18="SELECT denomina.salario 'hod',denomina.nrohora 'vlrhod'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='01' group by denomina.codsala";
                            $resulta18=mysql_query($consul18)or die ("Consulta incorrecta 01");
                            $registro18=mysql_num_rows($resulta18);
                            $filas_s18=mysql_fetch_array($resulta18);
                            $suma17=$filas_s18["hod"];
                            $Valor7=$filas_s18["vlrhod"];
                            /*fin codigo*/
                            $consul19="SELECT denomina.salario 'hon',denomina.nrohora 'vlrhon'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='02' group by denomina.codsala";
                            $resulta19=mysql_query($consul19)or die ("Consulta incorrecta 02");
                            $registro19=mysql_num_rows($resulta19);
                            $filas_s19=mysql_fetch_array($resulta19);
                            $suma18=$filas_s19["hon"];
                            $Valor8=$filas_s19["vlrhon"];
                            /*fin codigo*/
                            $consul20="SELECT denomina.salario 'rn',denomina.nrohora 'vlrn'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='04' group by denomina.codsala";
                            $resulta20=mysql_query($consul20)or die ("Consulta incorrecta 04");
                            $registro20=mysql_num_rows($resulta20);
                            $filas_s20=mysql_fetch_array($resulta20);
                            $suma19=$filas_s20["rn"];
                            $Valor9=$filas_s20["vlrn"];
                            /*fin codigo*/
                            $consul21="SELECT denomina.salario 'hefd',denomina.nrohora 'vlrhefd'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='11' group by denomina.codsala";
                            $resulta21=mysql_query($consul21)or die ("Consulta incorrecta 11");
                            $registro21=mysql_num_rows($resulta21);
                            $filas_s21=mysql_fetch_array($resulta21);
                            $suma20=$filas_s21["hefd"];
                            $Valor10=$filas_s21["vlrhefd"];
                            /*codigo*/
                             $consul22="SELECT denomina.salario 'ig',denomina.nrohora 'vlrig'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='12' group by denomina.codsala";
                            $resulta22=mysql_query($consul22)or die ("Consulta incorrecta 12");
                            $registro22=mysql_num_rows($resulta22);
                            $filas_s22=mysql_fetch_array($resulta22);
                            $suma21=$filas_s22["ig"];
                            $Valor11=$filas_s22["vlrig"];
                            /*fin codigo*/
                            $consul23="SELECT denomina.salario 'il',denomina.nrohora 'vlril'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='13' group by denomina.codsala";
                            $resulta23=mysql_query($consul23)or die ("Consulta incorrecta 13");
                            $registro23=mysql_num_rows($resulta23);
                            $filas_s23=mysql_fetch_array($resulta23);
                            $suma22=$filas_s23["il"];
                            $Valor12=$filas_s23["vlril"];
                            /*final de codigo*/
                            $consul24="SELECT denomina.salario 'rnfc',denomina.nrohora 'vlrnfc'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='10' group by denomina.codsala";
                            $resulta24=mysql_query($consul24)or die ("Consulta incorrecta 10");
                            $registro24=mysql_num_rows($resulta24);
                            $filas_s24=mysql_fetch_array($resulta24);
                            $suma23=$filas_s24["rnfc"];
                            $Valor13=$filas_s24["vlrnfc"];
                            $consul25="SELECT denomina.salario 'fld',denomina.nrohora 'vlrfld'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='18' group by denomina.codsala";
                            $resulta25=mysql_query($consul25)or die ("Consulta incorrecta 18");
                            $registro25=mysql_num_rows($resulta25);
                            $filas_s25=mysql_fetch_array($resulta25);
                            $suma24=$filas_s25["fld"];
                            $Valor14=$filas_s25["vlrfld"];
                            $consul26="SELECT denomina.salario 'hedd',denomina.nrohora 'vlrhedd'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='19' group by denomina.codsala";
                            $resulta26=mysql_query($consul26)or die ("Consulta incorrecta 19");
                            $registro26=mysql_num_rows($resulta26);
                            $filas_s26=mysql_fetch_array($resulta26);
                            $suma25=$filas_s26["hedd"];
                            $Valor15=$filas_s26["vlrhedd"];
                            /*codigo*/
                            $consul27="SELECT denomina.salario 'ab',denomina.nrohora 'vlrab'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='96' group by denomina.codsala";
                            $resulta27=mysql_query($consul27)or die ("Consulta incorrecta 96");
                            $registro27=mysql_num_rows($resulta27);
                            $filas_s27=mysql_fetch_array($resulta27);
                            $suma26=$filas_s27["ab"];
                            $Valor16=$filas_s27["vlrab"];
                             /*codigo*/
                            $consul28="SELECT denomina.salario 'Lma',denomina.nrohora 'vlrLma'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='07' group by denomina.codsala";
                            $resulta28=mysql_query($consul28)or die ("Consulta incorrecta 07");
                            $registro28=mysql_num_rows($resulta28);
                            $filas_s28=mysql_fetch_array($resulta28);
                            $suma27=$filas_s28["Lma"];
                            $Valor17=$filas_s28["vlrLma"];
                             /*codigo*/
                            $consul29="SELECT denomina.salario 'LRe',denomina.nrohora 'vlrLRe'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$CodZ' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='92' group by denomina.codsala";
                            $resulta29=mysql_query($consul29)or die ("Consulta incorrecta 92");
                            $registro29=mysql_num_rows($resulta29);
                            $filas_s29=mysql_fetch_array($resulta29);
                            $suma28=$filas_s29["LRe"];
                            $Valor18=$filas_s29["vlrLRe"];
                           /*final de codigo*/
                            $totalingreso=($suma1+$suma2+$suma3+$suma4+$suma5+$suma6+$suma7+$suma8+$suma9+$suma10+$suma11+$suma12+$suma13+$suma14+$suma15+$suma16+$suma17+$suma18+$suma19+$suma20+$suma21+$suma22+$suma23+$suma24+$suma25+$suma26+$suma27+$suma28+$suma50);
                              ?>
                                       <tr class="cajas">
                                           <td><? echo $i;?></td>
                                          <td><? echo $filas["cedemple"];?></td>
                                           <td><? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?></td>
                                           <td><? echo $Valor7;?> </td>
                                           <td><? echo $suma17;?></td>
                                           <td><? echo $Valor11;?></td>
                                           <td><? echo $suma21;?></td>
                                           <td><? echo $Valor12;?></td>
                                           <td><? echo $suma22;?></td>
                                           <td><? echo $Valor3;?></td>
                                           <td><? echo $suma13;?></td>
                                           <td><? echo $Valor6;?></td>
                                           <td><? echo $suma16;?></td>
                                           <td><? echo $Valor10;?></td>
                                           <td><? echo $suma20;?></td>
										   <td><? echo $valor50;?></td>
										   <td><? echo $suma50;?></td>
                                           <td><? echo $Valor4;?></td>
                                           <td><? echo $suma14;?></td>
                                           <td><? echo $Valor8;?></td>
                                           <td><? echo $suma18;?></td>
                                           <td><? echo $Valor5;?></td>
                                           <td><? echo $suma15;?></td>
                                           <td><? echo $Valor9;?></td>
                                           <td><? echo $suma19;?></td>
                                           <td><? echo $Valor13;?></td>
                                           <td><? echo $suma23;?></td>
                                           <td><? echo $Valor14;?></td>
                                           <td><? echo $suma24;?></td>
                                           <td><? echo $Valor15;?></td>
                                           <td><? echo $suma25;?></td>
                                           <td><? echo $Valor1;?></td>
                                           <td><? echo $suma10;?></td>
                                           <td><? echo $Valor2;?></td>
                                           <td><? echo $suma11;?></td>
                                           <td><? echo $suma2;?></td>
                                           <td><? echo $suma3;?></td>
                                           <td><? echo $suma5;?></td>
                                           <td><? echo $suma12;?></td>
                                           <td><? echo $suma9;?></td>
                                           <td><? echo $suma4;?></td>
                                           <td><? echo $suma8;?></td>
                                           <td><? echo $suma1;?></td>
                                           <td><? echo $suma7;?></td>
                                           <td><? echo $suma6;?></td>
                                           <td><? echo $suma26;?></td>
                                           <td><? echo $suma27;?></td>
                                           <td><? echo $suma28;?></td>
                                           <td><? echo $totalingreso;?></td>
                                         </tr>
                                          <?
                              $i=$i+1;
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
