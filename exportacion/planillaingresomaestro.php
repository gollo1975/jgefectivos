<html>

<head>
  <title>Planilla de Nomina</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

 </head>

<?
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center><h5><u>Planilla de Nomina[Ingresos]</u></h5></center>
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
  <tr>
         <td><b>Zona:</b></td>
                              <td colspan="12"><select name="campo" class="cajas">
                              <option value="0">Seleccione la empresa
                                <?
                                 $consulta_z="select codmaestro,nomaestro from maestro ";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
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
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la zona ?")
    history.back()
  </script>
    <?
else:
include ("../conexion.php");
      $consu="select zona.tipofactura,zona.codzona,zona.zona,periodo.desde,periodo.hasta from maestro,sucursal,zona,periodo
                where maestro.codmaestro=sucursal.codmaestro and
                sucursal.codsucursal=zona.codsucursal and
                maestro.codmaestro='$canpo' and
                zona.codzona=periodo.codzona and
                periodo.desde='$desde' and periodo.hasta='$hasta'";
                 $resulta=mysql_query($consu) or die("consulta incorrecta  ");
                 while ($filas_s=mysql_fetch_array($resulta)):
                   $codzona=$filas_s["codzona"];
                   $zona=$filas_s["zona"];
                   $tipofactura=$filas_s["tipofactura"];
                    ?>
                    <center><h4>Planilla de Nomina [Ingresos]</h4></center>
                   <form name="" action="" method="post">
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
              $consulta="select maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,sucursal.sucursal,zona.zona,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,nomina.consecutivo from maestro,nomina,empleado,sucursal,zona,periodo
                where maestro.codmaestro=sucursal.codmaestro and
                 sucursal.codsucursal=zona.codsucursal and
                 zona.codzona=empleado.codzona and
                 zona.codzona=periodo.codzona and
                 empleado.cedemple=nomina.cedemple and
                 periodo.codigo=nomina.codigo and
                 periodo.desde='$desde' and periodo.hasta='$hasta' and
                 maestro.codmaestro='$campo' order by empleado.nomemple,empleado.apemple";
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
                       <?
                       if ($tipofactura=='MIXTA'):
                         ?>
                         <tr class="cajas">
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Documento</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Empleado</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Basico</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Ajuste Com.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Retorno</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Ayuda Trans.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Comp. Final</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Total Deven.</td>
                          </tr>
                          <?
                       else:
                         ?>
                         <tr class="cajas">
                         <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Documento</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Empleado</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Basico</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Ajuste Com.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>To.Hra.Ord.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>To.Hra.Ord.Fes.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Dom.Comp.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Dom.No.Comp.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Tot.Rec.Noct.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Tot.Hra.Ext.Noct.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Tot.Noct.Fest.</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Tot.Rec.Noct.Fest.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Retorno Coop.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>A_Alimento</td>
                           <td style='font-weight:bold;font-size:1.0em;'>A_Educación</td>
                           <td style='font-weight:bold;font-size:1.0em;'>A_Movilizacion</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Gastos_RL</td>
                            <td style='font-weight:bold;font-size:1.0em;'>C_Metas</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Ayuda Trans.</td>
                           <td style='font-weight:bold;font-size:1.0em;'>Total Deven.</td
                          </tr>
                          <?
                       endif;
                         $i=1;
                         $fechap=date("Y-m-d");
                         echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resultado) . "\">");
                        while ($filas=mysql_fetch_array($resultado)):
                            $ttiempo = 0;
                            $codigo=$filas["consecutivo"];
                            $consul="SELECT denomina.salario 'basico'
                            FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='510513' group by denomina.codsala";
                            $resulta=mysql_query($consul)or die ("Consulta incorrecta $consul");
                            $registro=mysql_num_rows($resulta);
                            $filas_s=mysql_fetch_array($resulta);
                            $suma=$suma+ $filas_s["basico"];
                            $consul1="SELECT  denomina.salario 'tiempo',denomina.nrohora 'nro'
                            FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='51051610') group by denomina.codsala";
                            $resulta1=mysql_query($consul1)or die ("Consulta incorrecta $consul");
                            $registro1=mysql_num_rows($resulta1);
                            $filas_s1=mysql_fetch_array($resulta1);
                            $suma1=$filas_s1["tiempo"];
                            $ted=$filas_s1["nro"];
                            $consul5="SELECT  denomina.salario 'tiempo',denomina.nrohora 'nro'
                            FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='510516')group by denomina.codsala";
                            $resulta5=mysql_query($consul5)or die ("Consulta incorrecta $consul");
                            $registro5=mysql_num_rows($resulta5);
                            $filas_s5=mysql_fetch_array($resulta5);
                            $suma5=$filas_s5["tiempo"];
                            $tedf=$filas_s5["nro"];
                            $consul6="SELECT  denomina.salario 'tiempo'
                           FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='007') group by denomina.codsala";
                            $resulta6=mysql_query($consul6)or die ("Consulta incorrecta $consul");
                            $registro6=mysql_num_rows($resulta6);
                            $filas_s6=mysql_fetch_array($resulta6);
                            $suma6=$filas_s6["tiempo"];
                             $consul7="SELECT  denomina.salario 'tiempo',denomina.nrohora 'nro'
                            FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='510550') group by denomina.codsala";
                            $resulta7=mysql_query($consul7)or die ("Consulta incorrecta $consul");
                            $registro7=mysql_num_rows($resulta7);
                            $filas_s7=mysql_fetch_array($resulta7);
                            $suma7=$filas_s7["tiempo"];
                             $consul8="SELECT  denomina.salario 'tiempo',denomina.nrohora 'nro'
                           FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='51055010') group by denomina.codsala";
                            $resulta8=mysql_query($consul8)or die ("Consulta incorrecta $consul");
                            $registro8=mysql_num_rows($resulta8);
                            $filas_s8=mysql_fetch_array($resulta8);
                            $suma8=$filas_s8["tiempo"];
                             $consul9="SELECT  denomina.salario 'tiempo',denomina.nrohora 'nro'
                           FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='51055016') group by denomina.codsala";
                            $resulta9=mysql_query($consul9)or die ("Consulta incorrecta $consul");
                            $registro9=mysql_num_rows($resulta9);
                            $filas_s9=mysql_fetch_array($resulta9);
                            $suma9=$filas_s9["tiempo"];
                             $consul10="SELECT  denomina.salario 'tiempo',denomina.nrohora 'nro'
                           FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='31102') group by denomina.codsala";
                            $resulta10=mysql_query($consul10)or die ("Consulta incorrecta $consul");
                            $registro10=mysql_num_rows($resulta10);
                            $filas_s10=mysql_fetch_array($resulta10);
                            $suma10=$filas_s10["tiempo"];
                            $consul11="SELECT  denomina.salario 'tiempo',denomina.nrohora 'nro'
                           FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='31101') group by denomina.codsala";
                            $resulta11=mysql_query($consul11)or die ("Consulta incorrecta $consul");
                            $registro11=mysql_num_rows($resulta11);
                            $filas_s11=mysql_fetch_array($resulta11);
                            $suma11=$filas_s11["tiempo"];
                            /*otro*/
                            $consul12="SELECT  denomina.salario 'tiempo',denomina.nrohora 'nro'
                           FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='520516') group by denomina.codsala";
                            $resulta12=mysql_query($consul12)or die ("Consulta incorrecta $consul");
                            $registro12=mysql_num_rows($resulta12);
                            $filas_s12=mysql_fetch_array($resulta12);
                            $suma12=$filas_s12["tiempo"];
                            /*otro*/
                            $consul13="SELECT  denomina.salario 'final'
                            FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and (denomina.codsala='282565') group by denomina.codsala";
                            $resulta13=mysql_query($consul13)or die ("Consulta incorrecta $consul");
                            $registro13=mysql_num_rows($resulta13);
                            $filas_s13=mysql_fetch_array($resulta13);
                            $suma13=$filas_s13["final"];
                            /*otro*/
                            $consul2="SELECT denomina.salario 'ayuda'
                          FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='510528' group by denomina.codsala";
                            $resulta2=mysql_query($consul2)or die ("Consulta incorrecta $consul");
                            $registro2=mysql_num_rows($resulta2);
                            $filas_s2=mysql_fetch_array($resulta2);
                            $tayuda=$tayuda+$filas_s2["ayuda"];
                            /* codigo*/
                            $consul13="SELECT denomina.salario 'ajuste'
                           FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='017' group by denomina.codsala";
                            $resulta13=mysql_query($consul13)or die ("Consulta incorrecta $consul");
                            $registro13=mysql_num_rows($resulta13);
                            $filas_s13=mysql_fetch_array($resulta13);
                            /* codigo*/
                            $consul14="SELECT denomina.salario 'ajuste'
                            FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='51052801' group by denomina.codsala";
                            $resulta14=mysql_query($consul14)or die ("Consulta incorrecta 51052801");
                            $registro14=mysql_num_rows($resulta14);
                            $filas_s14=mysql_fetch_array($resulta14);
                            $alimento=$filas_s14["ajuste"];
                             /* codigo*/
                            $consul15="SELECT denomina.salario 'ajuste'
                           FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='510545' group by denomina.codsala";
                            $resulta15=mysql_query($consul15)or die ("Consulta incorrecta 510545");
                            $registro15=mysql_num_rows($resulta15);
                            $filas_s15=mysql_fetch_array($resulta15);
                            $educacion=$filas_s15["ajuste"];
                            /* codigo*/
                            $consul16="SELECT denomina.salario 'ajuste'
                           FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='51052802' group by denomina.codsala";
                            $resulta16=mysql_query($consul16)or die ("Consulta incorrecta 51052802");
                            $registro16=mysql_num_rows($resulta16);
                            $filas_s16=mysql_fetch_array($resulta16);
                            $movilizacion=$filas_s16["ajuste"];
                            /* codigo*/
                            $consul17="SELECT denomina.salario 'ajuste'
                          FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='281030' group by denomina.codsala";
                            $resulta17=mysql_query($consul17)or die ("Consulta incorrecta 281030");
                            $registro17=mysql_num_rows($resulta17);
                            $filas_s17=mysql_fetch_array($resulta17);
                            $gastos=$filas_s17["ajuste"];
                            /* codigo*/
                            $consul18="SELECT denomina.salario 'ajuste'
                           FROM salario, denomina, nomina,zona,periodo,sucursal,maestro
                            WHERE salario.codsala = denomina.codsala
                            AND nomina.consecutivo = denomina.consecutivo and
                            maestro.codmaestro=sucursal.codmaestro and
                            sucursal.codsucursal=zona.codsucursal and
                            maestro.codmaestro='$campo' and
                            nomina.consecutivo='$codigo' and
                            zona.codzona=periodo.codzona and
                            periodo.codigo=nomina.codigo and
                            nomina.desde='$desde' and nomina.hasta='$hasta'  and denomina.codsala='510518' group by denomina.codsala";
                            $resulta18=mysql_query($consul18)or die ("Consulta incorrecta 510518");
                            $registro18=mysql_num_rows($resulta18);
                            $filas_s18=mysql_fetch_array($resulta18);
                            $metas=$filas_s18["ajuste"];
                            /*final de codigo*/
                            $th1=$th1+$filas_s1["nro"];
                            $total1=$total1+$filas_s1["tiempo"];
                            $th2=$th2+$filas_s5["nro"];
                            $total2=$total2+$filas_s5["tiempo"];
                            $th3=$th3+$filas_s8["nro"];
                            $total3=$total3+$filas_s8["tiempo"];
                            $th4=$th4+$filas_s9["nro"];
                            $total4=$total4+$filas_s9["tiempo"];
                            $th5=$th5+$filas_s11["nro"];
                            $total5=$total5+$filas_s11["tiempo"];
                            $th6=$th6+$filas_s10["nro"];
                            $thrnf=$thrnf+$filas_s7["nro"];
                            $total6=$total6+$filas_s10["tiempo"];
                            $total7=$total7+$filas_s6["tiempo"];
                            $total8=$total8+$filas_s12["tiempo"];
                            $tajuste=$tajuste+$filas_s13["ajuste"];
                            $total9=$total9+$filas_s14["ajuste"];
                            $total10=$total10+$filas_s15["ajuste"];
                            $total11=$total11+$filas_s16["ajuste"];
                            $total12=$total12+$filas_s17["ajuste"];
                            $total13=$total3+$filas_s18["ajuste"];
                            $total14=$total14+$filas_s7["tiempo"];
                            $th7=$th7+$filas_s12["nro"];
                            $ayuda=$filas_s2["ayuda"];
                            $tedf=$filas_s5["nro"];
                            $ted=$filas_s1["nro"];
                            $dc=$filas_s8["nro"];
                            $dnc=$filas_s9["nro"];
                            $en=$filas_s10["nro"];
                            $rn=$filas_s11["nro"];
                            $hnf=$filas_s12["nro"];
                            $trnf=$filas_s7["nro"];
                            $ajuste=$filas_s13["ajuste"];
                            $totalingreso=($filas_s["basico"]+$ajuste+$suma1+$suma5+$suma7+$suma8+$suma9+$suma11+$suma10+$suma6+$ayuda+$suma12+$suma13+$alimento+$educacion+$movilizacion+$gastos+$metas);
                            if($tipofactura=='MIXTA'):

                              ?>

                                           <tr class="cajas">
                                                  <td><?echo $i;?></td>
                                                  <td><? echo $filas["cedemple"];?></td>
                                                   <td><? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?></td>
                                                   <td><? echo $filas_s["basico"];?></td>
                                                   <td><? echo $ajuste;?></td>
                                                    <td><? echo $suma6;?></td>
                                                    <td><? echo round($ayuda,0);?></td>
                                                     <td><? echo $suma13;?></td>
                                                     <td><? echo $totalingreso;?></td>
                                         </tr>
                                          <?
                                          $xt=$xt+$totalingreso;
                                   else:
                                      ?>
                                       <tr class="cajas">
                                           <td><? echo $i;?></td>
                                          <td><? echo $filas["cedemple"];?></td>
                                           <td><? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?></td>
                                           <td><? echo $filas_s["basico"];?></td>
                                            <td><? echo $ajuste;?></td>
                                           <td><? echo $ted;?></td>
                                           <td><? echo $suma1;?></td>
                                           <td><? echo $tedf;?></td>
                                           <td><? echo $suma5;?></td>
                                           <td><? echo $dc;?></td>
                                           <td><? echo $suma8;?></td>
                                           <td><? echo $dnc;?></td>
                                           <td><? echo $suma9;?></td>
                                           <td><? echo $rn;?></td>
                                           <td><? echo $suma11;?></td>
                                           <td><? echo $en;?></td>
                                           <td><? echo $suma10;?></td>
                                           <td><? echo $hnf;?></td>
                                            <td><? echo $suma12;?></td>
                                            <td><? echo $trnf;?></td>
                                             <td><? echo $suma7;?></td>
                                            <td><? echo $suma6;?></td>
                                           <td><? echo $alimento;?></td>
                                           <td><? echo $educacion;?></td>
                                           <td><? echo $movilizacion;?></td>
                                           <td><? echo $gastos;?></td>
                                           <td><? echo $metas;?></td> 
                                           <td><? echo round($ayuda,0);?></td>
                                           <td><? echo $totalingreso;?></td>
                                         </tr>
                                          <?
                                          $xt=$xt+$totalingreso;
                                   endif;
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           