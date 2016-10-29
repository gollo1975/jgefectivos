<html>

<head>
  <title>Planilla de Nomina</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

 </head>

<?
if(!isset($desde)):
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
              else:
  include ("../conexion.php");

              $consulta="select zona.zona,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,nomina.consecutivo from nomina,empleado,zona,periodo
                where   zona.codzona=empleado.codzona and
                  zona.codzona=periodo.codzona and
                 empleado.cedemple=nomina.cedemple and
                 periodo.codigo=nomina.codigo and
                 periodo.desde='$desde' and periodo.hasta='$hasta' and
                 zona.codzona='$codzona' order by empleado.nomemple,empleado.apemple";
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
                           <td style='font-weight:bold;font-size:1.0em;'>D_Caja_Comp.</td>
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
                            <td style='font-weight:bold;font-size:1.0em;'>T_Deducción</td>
                          </tr>
                       <?
                        $i=1;
                         $fechap=date("Y-m-d");
                         echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resultado) . "\">");
                        while ($filas=mysql_fetch_array($resultado)):
                           $ttiempo = 0;
                            $codigo=$filas["consecutivo"];
                            $consul="SELECT denomina.deduccion 'mercado'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='64' group by denomina.codsala";
                            $resulta=mysql_query($consul)or die ("Consulta incorrecta $consul");
                            $registro=mysql_num_rows($resulta);
                            $filas_s=mysql_fetch_array($resulta);
                            $suma1=$filas_s["mercado"];
                            $consul1="SELECT  denomina.deduccion 'odontologia'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                           zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='66') group by denomina.codsala";
                            $resulta1=mysql_query($consul1)or die ("Consulta incorrecta $consul");
                            $registro1=mysql_num_rows($resulta1);
                            $filas_s1=mysql_fetch_array($resulta1);
                            $suma2=$filas_s1["odontologia"];
                            /*FIN CODIGO*/
                            $consul5="SELECT  denomina.deduccion 'optica'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='67')group by denomina.codsala";
                            $resulta5=mysql_query($consul5)or die ("Consulta incorrecta $consul");
                            $registro5=mysql_num_rows($resulta5);
                            $filas_s5=mysql_fetch_array($resulta5);
                            $suma3=$filas_s5["optica"];
                              /*FIN CODIGO*/
                            $consul6="SELECT  denomina.deduccion 'pension'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='50') group by denomina.codsala";
                            $resulta6=mysql_query($consul6)or die ("Consulta incorrecta $consul");
                            $registro6=mysql_num_rows($resulta6);
                            $filas_s6=mysql_fetch_array($resulta6);
                            $suma4=$filas_s6["pension"];
                            $consul7="SELECT  denomina.deduccion 'salud'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='51') group by denomina.codsala";
                            $resulta7=mysql_query($consul7)or die ("Consulta incorrecta $consul");
                            $registro7=mysql_num_rows($resulta7);
                            $filas_s7=mysql_fetch_array($resulta7);
                            $suma5=$filas_s7["salud"];
                            /*FIN CODIGO*/
                             $consul8="SELECT  denomina.deduccion 'fondo'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='63') group by denomina.codsala";
                            $resulta8=mysql_query($consul8)or die ("Consulta incorrecta $consul");
                            $registro8=mysql_num_rows($resulta8);
                            $filas_s8=mysql_fetch_array($resulta8);
                            $suma6=$filas_s8["fondo"];
                             $consul9="SELECT  denomina.deduccion 'gmo'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='61') group by denomina.codsala";
                            $resulta9=mysql_query($consul9)or die ("Consulta incorrecta $consul");
                            $registro9=mysql_num_rows($resulta9);
                            $filas_s9=mysql_fetch_array($resulta9);
                            $suma7=$filas_s9["gmo"];
                            /*FIN CODIGO*/
                            $consul10="SELECT  denomina.deduccion 'laboral'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='91') group by denomina.codsala";
                            $resulta10=mysql_query($consul10)or die ("Consulta incorrecta $consul");
                            $registro10=mysql_num_rows($resulta10);
                            $filas_s10=mysql_fetch_array($resulta10);
                            $suma8=$filas_s10["laboral"];
                            /*FIN CODIGO*/
                            $consul11="SELECT  denomina.deduccion 'tercero'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='65') group by denomina.codsala";
                            $resulta11=mysql_query($consul11)or die ("Consulta incorrecta $consul");
                            $registro11=mysql_num_rows($resulta11);
                            $filas_s11=mysql_fetch_array($resulta11);
                            $suma9=$filas_s11["tercero"];
                            /*otro*/
                            $consul12="SELECT  denomina.deduccion 'vestuario'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='83') group by denomina.codsala";
                            $resulta12=mysql_query($consul12)or die ("Consulta incorrecta $consul");
                            $registro12=mysql_num_rows($resulta12);
                            $filas_s12=mysql_fetch_array($resulta12);
                            $suma10=$filas_s12["vestuario"];
                            /*otro*/
                            $consul2="SELECT denomina.deduccion 'alimento'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='85' group by denomina.codsala";
                            $resulta2=mysql_query($consul2)or die ("Consulta incorrecta $consul");
                            $registro2=mysql_num_rows($resulta2);
                            $filas_s2=mysql_fetch_array($resulta2);
                            $suma11=$filas_s2["alimento"];
                             /*otro*/
                            $consul13="SELECT denomina.deduccion 'computo'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                           zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='44' group by denomina.codsala";
                            $resulta13=mysql_query($consul13)or die ("Consulta incorrecta 29");
                            $registro13=mysql_num_rows($resulta13);
                            $filas_s13=mysql_fetch_array($resulta13);
                            $suma12=$filas_s13["computo"];
                            /*fin codigo*/
                            $consul14="SELECT denomina.deduccion 'menorvlr'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                           zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='08' group by denomina.codsala";
                            $resulta14=mysql_query($consul14)or die ("Consulta incorrecta 62");
                            $registro14=mysql_num_rows($resulta14);
                            $filas_s14=mysql_fetch_array($resulta14);
                            $suma13=$filas_s14["menorvlr"];
                             /* codigo*/
                            $consul15="SELECT denomina.deduccion 'caja'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='68' group by denomina.codsala";
                            $resulta15=mysql_query($consul15)or die ("Consulta incorrecta 68");
                            $registro15=mysql_num_rows($resulta15);
                            $filas_s15=mysql_fetch_array($resulta15);
                            $suma14=$filas_s15["caja"];
                            /* codigo*/
                            $consul16="SELECT denomina.deduccion 'cocredito'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='81' group by denomina.codsala";
                            $resulta16=mysql_query($consul16)or die ("Consulta incorrecta 82");
                            $registro16=mysql_num_rows($resulta16);
                            $filas_s16=mysql_fetch_array($resulta16);
                            $suma15=$filas_s16["cocredito"];
                            /* codigo*/
                            $consul17="SELECT denomina.deduccion 'copantex'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='62' group by denomina.codsala";
                            $resulta17=mysql_query($consul17)or die ("Consulta incorrecta 83");
                            $registro17=mysql_num_rows($resulta17);
                            $filas_s17=mysql_fetch_array($resulta17);
                            $suma16=$filas_s17["copantex"];
                            /*fin codigo*/
                            $consul18="SELECT denomina.deduccion 'empresa'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='82' group by denomina.codsala";
                            $resulta18=mysql_query($consul18)or die ("Consulta incorrecta 83");
                            $registro18=mysql_num_rows($resulta18);
                            $filas_s18=mysql_fetch_array($resulta18);
                            $suma17=$filas_s18["empresa"];
                            /*fin codigo*/
                            $consul19="SELECT denomina.deduccion 'pichincha'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='60' group by denomina.codsala";
                            $resulta19=mysql_query($consul19)or die ("Consulta incorrecta 86");
                            $registro19=mysql_num_rows($resulta19);
                            $filas_s19=mysql_fetch_array($resulta19);
                            $suma18=$filas_s19["pichincha"];
                            /*fin codigo*/
                            $consul20="SELECT denomina.deduccion 'funeraria'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='86' group by denomina.codsala";
                            $resulta20=mysql_query($consul20)or die ("Consulta incorrecta 86");
                            $registro20=mysql_num_rows($resulta20);
                            $filas_s20=mysql_fetch_array($resulta20);
                            $suma19=$filas_s20["funeraria"];
                            /*fin codigo*/
                            $consul21="SELECT denomina.deduccion 'sol'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='42' group by denomina.codsala";
                            $resulta21=mysql_query($consul21)or die ("Consulta incorrecta 41");
                            $registro21=mysql_num_rows($resulta21);
                            $filas_s21=mysql_fetch_array($resulta21);
                            $suma20=$filas_s21["sol"];
                            /*final de codigo*/
                             $consul22="SELECT denomina.deduccion 'fuente'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='41' group by denomina.codsala";
                            $resulta22=mysql_query($consul22)or die ("Consulta incorrecta 41");
                            $registro22=mysql_num_rows($resulta22);
                            $filas_s22=mysql_fetch_array($resulta22);
                            $suma21=$filas_s22["fuente"];
                            /*final de codigo*/
                             $consul23="SELECT denomina.deduccion 'seguro'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='35' group by denomina.codsala";
                            $resulta23=mysql_query($consul23)or die ("Consulta incorrecta 35");
                            $registro23=mysql_num_rows($resulta23);
                            $filas_s23=mysql_fetch_array($resulta23);
                            $suma22=$filas_s23["seguro"];
                            /*final de codigo*/
                             $consul24="SELECT denomina.deduccion 'segovia'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='84' group by denomina.codsala";
                            $resulta24=mysql_query($consul24)or die ("Consulta incorrecta 84");
                            $registro24=mysql_num_rows($resulta24);
                            $filas_s24=mysql_fetch_array($resulta24);
                            $suma23=$filas_s24["segovia"];
                            /*final de codigo*/
                            $consul25="SELECT denomina.deduccion 'atm'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='87' group by denomina.codsala";
                            $resulta25=mysql_query($consul25)or die ("Consulta incorrecta 87");
                            $registro25=mysql_num_rows($resulta25);
                            $filas_s25=mysql_fetch_array($resulta25);
                            $suma24=$filas_s25["atm"];
                            /*final de codigo*/
                            $totaldeduccion=($suma1+$suma2+$suma3+$suma4+$suma5+$suma6+$suma7+$suma8+$suma9+$suma10+$suma11+$suma12+$suma13+$suma14+$suma15+$suma16+$suma17+$suma18+$suma19+$suma20+$suma21+$suma22+$suma23+$suma24);
                              ?>
                                        <tr class="cajas">
                                           <td><? echo $i;?></td>
                                          <td><? echo $filas["cedemple"];?></td>
                                           <td><? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?></td>
                                           <td><? echo $suma1;?></td>
                                           <td><? echo $suma2;?></td>
                                           <td><? echo $suma3;?></td>
                                           <td><? echo $suma4;?></td>
                                           <td><? echo $suma5;?></td>
                                           <td><? echo $suma6;?></td>
                                           <td><? echo $suma7;?></td>
                                           <td><? echo $suma8;?></td>
                                           <td><? echo $suma9;?></td>
                                           <td><? echo $suma10;?></td>
                                           <td><? echo $suma11;?></td>
                                           <td><? echo $suma12;?></td>
                                           <td><? echo $suma13;?></td>
                                           <td><? echo $suma14;?></td>
                                           <td><? echo $suma15;?></td>
                                           <td><? echo $suma16;?></td>
                                           <td><? echo $suma17;?></td>
                                           <td><? echo $suma18;?></td>
                                           <td><? echo $suma19;?></td>
                                           <td><? echo $suma20;?></td>
                                           <td><? echo $suma21;?></td>
                                           <td><? echo $suma22;?></td>
                                           <td><? echo $suma23;?></td>
                                           <td><? echo $suma24;?></td>
                                           <td><? echo $totaldeduccion;?></td>
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              