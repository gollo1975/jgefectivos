<html>

<head>
  <title>Planilla de Nomina</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

 </head>

<?
if(!isset($desde)):
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
      $consu="select zona.codzona,zona.zona,periodo.desde,periodo.hasta from zona,periodo
                where zona.codzona=periodo.codzona and
                   periodo.desde='$desde' and periodo.hasta='$hasta' and
                  zona.codzona='$codzona'";
                 $resulta=mysql_query($consu) or die("consulta incorrecta  ");
                 while ($filas_s=mysql_fetch_array($resulta)):
                   $zona=$filas_s["zona"];
                    ?>
                    <center><h4><u>Planilla [Ingresos]</u></h4></center>
                    <td><input type="hidden" name="iva" value="<? echo $filas_s["iva"];?>"></td>
                   <table border="0" align="center">
                     <tr>
                       <td class="cajas"><b>Zona:</b>&nbsp;&nbsp;<? echo $filas_s["zona"];?></td>
                     </tr>
                       <tr class="cajas">
                       <td colspan="2"><b>Desde:</b>&nbsp;&nbsp;<? echo $filas_s["desde"];?><b>&nbsp;&nbsp;&nbsp;&nbsp;Hasta:</b>&nbsp;&nbsp;<? echo $filas_s["hasta"];?></td>
                     </tr>
                    </table>
                 <?
                endwhile;
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
                     ?>
                       <table border="0" align="center" >
                         <tr class="cajas">
                           <td class="cajas"><b>Item</b></td><td class="cajas"><b>Cedula</b></td> <td class="cajas"><b>Empleado</b></td><td class="cajas"><b>Nro</b></td><td class="cajas"><b>H.o.d.</b></td><td class="cajas"><b>Nro</b></td><td class="cajas"><b>H.o.e.</b></td><td class="cajas"><b>Nro</b></td><td class="cajas"><b>H.f.d.</b></td><td class="cajas"><b>Nro</b></td><td class="cajas"><b>H.e.f.d</b></td><td class="cajas"><b>Nro</b></td><td class="cajas"><b>H.e.n.f.</b></td> <td class="cajas"><b>Nro</b></td><td class="cajas"><b>H.o.n.</b></td><td class="cajas"><b>Nro</b></td><td class="cajas"><b>H.e.n.o.</b></td><td class="cajas"><b>Nro</b></td><td class="cajas"><b>R.n.</b></td><td class="cajas"><b>Nro</b></td><td class="cajas"><b>D.c.</b></td><td class="cajas"><b>Nro</b></td><td class="cajas"><b>D.n.c.</b></td><td class="cajas"><b>A_Alime.</b></td><td class="cajas"><b>A.Educa.</b></td><td class="cajas"><b>A.Movili.</b></td><td class="cajas"><b>Gastos_RL.</b></td><td class="cajas"><b>C.Metas</b></td><td class="cajas"><b>Trans.</b></td><td class="cajas"><b>Comisión</b></td><td class="cajas"><b>Ajuste_S.</b></td><td class="cajas"><b>Bonifi.</b></td><td class="cajas"><b>B_Producción</b></td><td class="cajas"><b>T_Salario</b></td>
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
                            zona.codzona='$codzona' and
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
                           zona.codzona='$codzona' and
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
                            zona.codzona='$codzona' and
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
                            zona.codzona='$codzona' and
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
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='26') group by denomina.codsala";
                            $resulta7=mysql_query($consul7)or die ("Consulta incorrecta $consul");
                            $registro7=mysql_num_rows($resulta7);
                            $filas_s7=mysql_fetch_array($resulta7);
                            $suma5=$filas_s7["movilizacion"];
                            /*FIN CODIGO*/
                             $consul8="SELECT  denomina.salario 'bonificacionP'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
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
                            zona.codzona='$codzona' and
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
                            zona.codzona='$codzona' and
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
                            zona.codzona='$codzona' and
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
                            zona.codzona='$codzona' and
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
                            zona.codzona='$codzona' and
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
                           zona.codzona='$codzona' and
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
                           zona.codzona='$codzona' and
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
                            zona.codzona='$codzona' and
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
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='06' group by denomina.codsala";
                            $resulta16=mysql_query($consul16)or die ("Consulta incorrecta 06");
                            $registro16=mysql_num_rows($resulta16);
                            $filas_s16=mysql_fetch_array($resulta16);
                            $suma15=$filas_s16["heno"];
                            $Valor5=$filas_s16["vlrheno"];
                            /* codigo*/
                            $consul17="SELECT denomina.salario 'hfd',denomina.nrohora 'vlrhfd'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='07' group by denomina.codsala";
                            $resulta17=mysql_query($consul17)or die ("Consulta incorrecta 07");
                            $registro17=mysql_num_rows($resulta17);
                            $filas_s17=mysql_fetch_array($resulta17);
                            $suma16=$filas_s17["hfd"];
                            $Valor6=$filas_s17["vlrhfd"];
                            /*fin codigo*/
                            $consul18="SELECT denomina.salario 'hod',denomina.nrohora 'vlrhod'
                            FROM salario, denomina, nomina,zona,periodo
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            zona.codzona='$codzona' and
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
                            zona.codzona='$codzona' and
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
                            zona.codzona='$codzona' and
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
                            zona.codzona='$codzona' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='11' group by denomina.codsala";
                            $resulta21=mysql_query($consul21)or die ("Consulta incorrecta 11");
                            $registro21=mysql_num_rows($resulta21);
                            $filas_s21=mysql_fetch_array($resulta21);
                            $suma20=$filas_s21["hefd"];
                            $Valor10=$filas_s21["vlrhefd"];
                            /*final de codigo*/
                            $totalingreso=($suma1+$suma2+$suma3+$suma4+$suma5+$suma6+$suma7+$suma8+$suma9+$suma10+$suma11+$suma12+$suma13+$suma14+$suma15+$suma16+$suma17+$suma18+$suma19+$suma20);
                              ?>
                                       <tr class="cajas">
                                           <td><input type="text" value="<? echo $i;?>" class="cajas" size="3" readonly></td>
                                          <td><input type="text" name="cedula" value="<? echo $filas["cedemple"];?>" class="cajas" size="12" readonly></td>
                                           <td><input type="text"  value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>"name="empleado[<? echo $i;?>]" id="empleado[<? echo $i;?>]" class="cajas" size="28" readonly></td>
                                           <td><input type="text"  value="<? echo $Valor7;?>" class="cajas" size="3"></td>
                                           <td><input type="text"  value="<? echo $suma17;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $Valor3;?>" class="cajas" size="3"></td>
                                           <td><input type="text"  value="<? echo $suma13;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $Valor6;?>" class="cajas" size="3"></td>
                                           <td><input type="text"  value="<? echo $suma16;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $Valor10;?>" class="cajas" size="3"></td>
                                           <td><input type="text"  value="<? echo $suma20;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $Valor4;?>" class="cajas" size="3"></td>
                                           <td><input type="text"  value="<? echo $suma14;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $Valor8;?>" class="cajas" size="3"></td>
                                           <td><input type="text"  value="<? echo $suma18;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $Valor5;?>" class="cajas" size="3"></td>
                                           <td><input type="text"  value="<? echo $suma15;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $Valor9;?>" class="cajas" size="3"></td>
                                           <td><input type="text"  value="<? echo $suma19;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $Valor1;?>" class="cajas" size="3"></td>
                                           <td><input type="text"  value="<? echo $suma10;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $Valor2;?>" class="cajas" size="3"></td>
                                           <td><input type="text"  value="<? echo $suma11;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $suma2;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $suma3;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $suma5;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $suma12;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $suma9;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $suma4;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $suma8;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $suma1;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $suma7;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $suma6;?>" class="cajas" size="9"></td>
                                           <td><input type="text"  value="<? echo $totalingreso;?>" class="cajas" size="11"></td>
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          