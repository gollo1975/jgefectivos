<html>
        <head>
                <title>Crear Nonima</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
                <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
               </script>
        </head>
        <body>
        <?
include("../conexion.php");
$conP="select periodo.codigo,periodo.estado from periodo
where periodo.codzona='$codigo'and
periodo.estado='FALTA'";
$resP=mysql_query($conP)or die("Consulta");
$regP=mysql_num_rows($resP);
if($regP==0):
    $consulta="select zona.codzona,zona.zona,detalladozona.pnomina,detalladozona.ultimodia,detalladozona.ultimomes from zona,detalladozona where zona.codzona='$codigo' and zona.codzona=detalladozona.codzona";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    $Registro_d=mysql_fetch_array($resultado);
    $Periodo=$Registro_d["pnomina"];
    $UltimoD=$Registro_d["ultimodia"];
    $UltimoM=$Registro_d["ultimomes"];
    $FechaSistema=date("Y-m-d");
    if ($registro==0):
     ?>
     <script language="javascript">
       alert("Esta empresa no tiene los parametros establecidos para generar la nomina!")
       history.back()
     </script>
      <?
    else:
        $Mes=substr($FechaSistema,5,2);
        $Dia=substr($FechaSistema,8,2);
        $UltimoDia= date('d',(mktime(0,0,0,$month+1,1,$year)-1));
        if($UltimoD=='' and $UltimoM==''):
          $conA="update detalladozona set ultimomes='$Mes',ultimodia='$UltimoDia' where codzona='$codigo' ";
          $resA=mysql_query($conA)or die("Error al buscar dias");
        else:
           if($UltimoM=='$Mes'):
           else:
               $UltimoDia= date('d',(mktime(0,0,0,$month+1,1,$year)-1));
               $conA="update detalladozona set ultimomes='$Mes',ultimodia='$UltimoDia' where codzona='$codigo' ";
               $resA=mysql_query($conA)or die("Error al buscar dias");
           endif;
        endif;
            if($UltimoM !='$Mes'):
	          $conP="select periodo.hasta,zona.zona,zona.codzona from zona,periodo where zona.codzona='$codigo' and zona.codzona=periodo.codzona order by periodo.codigo DESC limit 1";
	          $resP=mysql_query($conP)or die("Consulta incorrecta");
                  $ConT=mysql_num_rows($resP);
	          $filas_p=mysql_fetch_array($resP);
	          $Final=$filas_p["hasta"];
                  if($ConT !=0):
                    if($Periodo=='SEMANAL'):
	              $fecha = $Final;
	              $nuevafecha = strtotime ( '+ 1 day' , strtotime ( $fecha ) ) ;
	              $FechaI = date ( 'Y-m-d' , $nuevafecha );
	              $FechaP=$FechaI;
                      $fechaD = $Final;
                      $nuevafechaI = strtotime ( '+ 7 day' , strtotime ( $fechaD ) ) ;
                      $FechaF = date ( 'Y-m-d' , $nuevafechaI );
	            else:
	              if($Periodo=='DECADAL'):
	                 $fecha = $Final;
	                 $nuevafecha = strtotime ( '+ 1 day' , strtotime ( $fecha ) ) ;
	                 $FechaI = date ( 'Y-m-d' , $nuevafecha );
	                 $FechaP=$FechaI;
                         if($UltimoD=='30'):
	                   $fechaD = $Final;
                           $nuevafechaI = strtotime ( '+ 10 day' , strtotime ( $fechaD ) ) ;
	                   $FechaF = date ( 'Y-m-d' , $nuevafechaI );
                         else:
                           $fechaD = $Final;
                           $nuevafechaI = strtotime ( '+ 10 day' , strtotime ( $fechaD ) ) ;
	                   $FechaF = date ( 'Y-m-d' , $nuevafechaI );
                         endif;
	              else:
	                  if($Periodo=='QUINCENAL'):
		              $fecha = $Final;
		              $nuevafecha = strtotime ( '+ 1 day' , strtotime ( $fecha ) ) ;
		              $FechaI = date ( 'Y-m-d' , $nuevafecha );
		              $FechaP=$FechaI;
		              if($UltimoD=='28'):
		                 $fechaD = $Final;
		                 $nuevafechaI = strtotime ( '+ 12 day' , strtotime ( $fechaD ) ) ;
		                 $FechaF = date ( 'Y-m-d' , $nuevafechaI );
		              else:
		                 if($UltimoD=='29'):
		                    $fechaD = $Final;
		                    $nuevafechaI = strtotime ( '+ 13 day' , strtotime ( $fechaD ) ) ;
		                    $FechaF = date ( 'Y-m-d' , $nuevafechaI );
	                         else:
	                             if($UltimoD=='30'):
		                        $fechaD = $Final;
		                        $nuevafechaI = strtotime ( '+ 14 day' , strtotime ( $fechaD ) ) ;
		                        $FechaF = date ( 'Y-m-d' , $nuevafechaI );
	                             else:
	                                $fechaD = $Final;
		                        $nuevafechaI = strtotime ( '+ 15 day' , strtotime ( $fechaD ) ) ;
		                        $FechaF = date ( 'Y-m-d' , $nuevafechaI );
	                             endif;
		                 endif;
		              endif;
                          else:
                              $fecha = $Final;
		              $nuevafecha = strtotime ( '+ 1 day' , strtotime ( $fecha ) ) ;
		              $FechaI = date ( 'Y-m-d' , $nuevafecha );
		              $FechaP=$FechaI;
		              if($UltimoD=='28'):
		                 $fechaD = $Final;
		                 $nuevafechaI = strtotime ( '+ 28 day' , strtotime ( $fechaD ) ) ;
		                 $FechaF = date ( 'Y-m-d' , $nuevafechaI );
		              else:
		                 if($UltimoD=='29'):
		                    $fechaD = $Final;
		                    $nuevafechaI = strtotime ( '+ 29 day' , strtotime ( $fechaD ) ) ;
		                    $FechaF = date ( 'Y-m-d' , $nuevafechaI );
	                         else:
	                             if($UltimoD=='30'):
		                        $fechaD = $Final;
		                        $nuevafechaI = strtotime ( '+ 30 day' , strtotime ( $fechaD ) ) ;
		                        $FechaF = date ( 'Y-m-d' , $nuevafechaI );
	                             else:
	                                $fechaD = $Final;
		                        $nuevafechaI = strtotime ( '+ 30 day' , strtotime ( $fechaD ) ) ;
		                        $FechaF = date ( 'Y-m-d' , $nuevafechaI );
	                             endif;
		                 endif;
		              endif;
                          endif;
                       endif;
	            endif;
                  else:
                       $conP="select zona.zona,zona.codzona from zona where zona.codzona='$codigo'";
	               $resP=mysql_query($conP)or die("Consulta incorrecta");
	               $filas_p=mysql_fetch_array($resP);
                       $FechaI=date("Y-m-d");
                       $FechaF=date("Y-m-d");
                  endif;
	           ?><center><h4><u>Crear Periodos</u></h4></center>
	                  <form action="guardar.php" method="post">
	                 <input type="hidden" value="<? echo $CodSucursal;?>"name="CodSucursal">
	                   <table border="0" align="center">
	                   <tr><td><br></td></tr>
	                     <tr>
	                       <td><b>Cod_Zona:</b></td>
	                       <td colspan=3><input type="text" value="<?echo $filas_p["codzona"];?>" size="3" class="cajas"name="codzona" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codzona"></td>
	                     </tr>
	                     <tr>
	                       <td><b>Zona:</b></td>
	                       <td colspan=3><input type="text" value="<?echo $filas_p["zona"];?>"name="zona" size="50" maxlength="50" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona" readonly></td>
	                     </tr>
	                     <tr>
	                       <td><b>Desde:</b></td>
	                       <td> <input type="text" value="<? echo $FechaI;?>" name="desde"size="10" class="cajas"maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde"></td>
	                       <td><b>Hasta:</b></td>
	                       <td><input type="text" value="<? echo $FechaF;?>"name="hasta" size="10"class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta"></td>
	                     </tr>
	                       <tr>
	                       <td><b>Estado:</b></td>
	                           <td><select name="estado" class="cajas">
	                               <option value="falta">FALTA
	                          </select></td>
	                       </td>
	                      </tr>
	                    <tr>
	                       <td><b>Nota:</b></td>
	                      <td colspan="5"><textarea  name="nota" cols="60" rows="6" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"></textarea></td>
	                    </tr>
	                     <tr><td><br></td></tr>
	                    <tr>
	                     <td colspan="2"><input type="submit" value="Guardar" class="boton"></td>
	                  </tr>
	                  </table>
	          </form>
	        <?
	    else:
                $conP="select periodo.hasta,zona.zona,zona.codzona from zona,periodo where zona.codzona='$codigo' and zona.codzona=periodo.codzona order by periodo.codigo DESC limit 1";
	        $resP=mysql_query($conP)or die("Consulta incorrecta");
                $ConT=mysql_num_rows($resP);
	        $filas_p=mysql_fetch_array($resP);
	        $Final=$filas_p["hasta"];
                if($ConT !=0):
                  if($Periodo=='SEMANAL'):
	              $fecha = $Final;
	              $nuevafecha = strtotime ( '+ 1 day' , strtotime ( $fecha ) ) ;
	              $FechaI = date ( 'Y-m-d' , $nuevafecha );
	              $FechaP=$FechaI;
                      $fechaD = $Final;
                      $nuevafechaI = strtotime ( '+ 7 day' , strtotime ( $fechaD ) ) ;
                      $FechaF = date ( 'Y-m-d' , $nuevafechaI );
	          else:
	              if($Periodo=='DECADAL'):
	                 $fecha = $Final;
	                 $nuevafecha = strtotime ( '+ 1 day' , strtotime ( $fecha ) ) ;
	                 $FechaI = date ( 'Y-m-d' , $nuevafecha );
	                 $FechaP=$FechaI;
                         if($UltimoD=='30'):
	                   $fechaD = $Final;
                           $nuevafechaI = strtotime ( '+ 10 day' , strtotime ( $fechaD ) ) ;
	                   $FechaF = date ( 'Y-m-d' , $nuevafechaI );
                         else:
                           $fechaD = $Final;
                           $nuevafechaI = strtotime ( '+ 10 day' , strtotime ( $fechaD ) ) ;
	                   $FechaF = date ( 'Y-m-d' , $nuevafechaI );
                         endif;
	              else:
	                  if($Periodo=='QUINCENAL'):
		              $fecha = $Final;
		              $nuevafecha = strtotime ( '+ 1 day' , strtotime ( $fecha ) ) ;
		              $FechaI = date ( 'Y-m-d' , $nuevafecha );
		              $FechaP=$FechaI;
		              if($UltimoD=='28'):
		                 $fechaD = $Final;
		                 $nuevafechaI = strtotime ( '+ 12 day' , strtotime ( $fechaD ) ) ;
		                 $FechaF = date ( 'Y-m-d' , $nuevafechaI );
		              else:
		                 if($UltimoD=='29'):
		                    $fechaD = $Final;
		                    $nuevafechaI = strtotime ( '+ 13 day' , strtotime ( $fechaD ) ) ;
		                    $FechaF = date ( 'Y-m-d' , $nuevafechaI );
	                         else:
	                             if($UltimoD=='30'):
		                        $fechaD = $Final;
		                        $nuevafechaI = strtotime ( '+ 14 day' , strtotime ( $fechaD ) ) ;
		                        $FechaF = date ( 'Y-m-d' , $nuevafechaI );
	                             else:
	                                $fechaD = $Final;
		                        $nuevafechaI = strtotime ( '+ 14 day' , strtotime ( $fechaD ) ) ;
		                        $FechaF = date ( 'Y-m-d' , $nuevafechaI );
	                             endif;
		                 endif;
		              endif;
                          else:
                              $fecha = $Final;
		              $nuevafecha = strtotime ( '+ 1 day' , strtotime ( $fecha ) ) ;
		              $FechaI = date ( 'Y-m-d' , $nuevafecha );
		              $FechaP=$FechaI;
		              if($UltimoD=='28'):
		                 $fechaD = $Final;
		                 $nuevafechaI = strtotime ( '+ 28 day' , strtotime ( $fechaD ) ) ;
		                 $FechaF = date ( 'Y-m-d' , $nuevafechaI );
		              else:
		                 if($UltimoD=='29'):
		                    $fechaD = $Final;
		                    $nuevafechaI = strtotime ( '+ 29 day' , strtotime ( $fechaD ) ) ;
		                    $FechaF = date ( 'Y-m-d' , $nuevafechaI );
	                         else:
	                             if($UltimoD=='30'):
		                        $fechaD = $Final;
		                        $nuevafechaI = strtotime ( '+ 30 day' , strtotime ( $fechaD ) ) ;
		                        $FechaF = date ( 'Y-m-d' , $nuevafechaI );
	                             else:
	                                $fechaD = $Final;
		                        $nuevafechaI = strtotime ( '+ 30 day' , strtotime ( $fechaD ) ) ;
		                        $FechaF = date ( 'Y-m-d' , $nuevafechaI );
	                             endif;
		                 endif;
		              endif;
                          endif;
                       endif;
	          endif;
                else:
                     $conP="select zona.zona,zona.codzona from zona where zona.codzona='$codigo'";
	             $resP=mysql_query($conP)or die("Consulta incorrecta");
	            $filas_p=mysql_fetch_array($resP);
                    $FechaI=date("Y-m-d");
                    $FechaF=date("Y-m-d");
                endif;
	           ?><center><h4><u>Crear Periodos</u></h4></center>
	                  <form action="guardar.php" method="post">
	                 <input type="hidden" value="<? echo $CodSucursal;?>"name="CodSucursal">
	                   <table border="0" align="center">
	                   <tr><td><br></td></tr>
	                     <tr>
	                       <td><b>Cod_Zona:</b></td>
	                       <td colspan=3><input type="text" value="<?echo $filas_p["codzona"];?>" size="3" class="cajas"name="codzona" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codzona"></td>
	                     </tr>
	                     <tr>
	                       <td><b>Zona:</b></td>
	                       <td colspan=3><input type="text" value="<?echo $filas_p["zona"];?>"name="zona" size="50" maxlength="50" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona" readonly></td>
	                     </tr>
	                     <tr>
	                       <td><b>Desde:</b></td>
	                       <td> <input type="text" value="<? echo $FechaI;?>" name="desde"size="10" class="cajas"maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde"></td>
	                       <td><b>Hasta:</b></td>
	                       <td><input type="text" value="<? echo $FechaF;?>"name="hasta" size="10"class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta"></td>
	                     </tr>
	                       <tr>
	                       <td><b>Estado:</b></td>
	                           <td><select name="estado" class="cajas">
	                               <option value="falta">FALTA
	                          </select></td>
	                       </td>
	                      </tr>
	                    <tr>
	                       <td><b>Nota:</b></td>
	                      <td colspan="5"><textarea  name="nota" cols="60" rows="6" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"></textarea></td>
	                    </tr>
	                     <tr><td><br></td></tr>
	                    <tr>
	                     <td colspan="2"><input type="submit" value="Guardar" class="boton"></td>
	                  </tr>
	                  </table>
	          </form>
	        <?
            endif;
   endif;
else:
    ?>
     <script language="javascript">
       alert("Error al generar el periodo, debe de cerrar el anterior que esta abierto!")
       history.back()
     </script>
      <?
endif;
        ?>
              </body>
</html>
