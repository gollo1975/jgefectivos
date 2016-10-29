<html>

<head>
  <title></title>
</head>
<body>
<input type="hidden" name="CodUnico" value="<?echo $CodUnico;?>">
<?
if(empty($datoN)):
   ?>
   <script language="javascript">
      alert("Favor chequear todas las cajas de verificacion para la respectiva actualizaciòn.!")
      history.back()
   </script>
   <?
else:
    $FechaP=date("Y-m-d");
    include("../conexion.php");
    $conM="select parametroauxilio.maximo,parametroauxilio.porincapacidad,parametroauxilio.minimo,parametroauxilio.valor from parametroauxilio
         where parametroauxilio.estado='ACTIVO'";
         $ReM=mysql_query($conM)or die("Error al buscar salario maximo");
         $filas_M=mysql_fetch_array($ReM);
         $Maximo=$filas_M["maximo"];
         $PorIncapa=$filas_M["porincapacidad"];
         $Minimo=$filas_M["minimo"];
         $AyudaT=$filas_M["valor"];
    for ($k=1 ; $k<=$TotalV; $k ++):
         /*CODIGO QUE BUESCA EL SALARIO*/
         $conS="select empleado.basico from empleado
         where empleado.cedemple='$datoN[$k]'";
         $Res=mysql_query($conS)or die("Error al buscar salario");
         $filas=mysql_fetch_array($Res);
         $Basico=$filas["basico"];
         /*CODIGO QUE ACTUALIZA EL AUXILIO DE TRANSPORTE*/
         $conT="select decentro.*,empleado.basico,centro.codcentro,salario.ayuda,salario.formapago,salario.totalhoras from empleado,centro,decentro,salario
            where empleado.cedemple=centro.cedemple and
            centro.codcentro=decentro.codcentro and
            decentro.codsala=salario.codsala and
            salario.codsala='$CodUnico' and
            empleado.cedemple='$datoN[$k]'";
	 $resuT=mysql_query($conT)or die ("eRROR al buscar el auxilio de trasnporte");
	 $filas_T = mysql_fetch_array($resuT);
	 $CodC=$filas_T["codcentro"];
	 $AyudaTP=$filas_T["ayuda"];
	 $FormaP=$filas_T["formapago"];
	 $TotalH=$filas_T["totalhoras"];
	 if($FormaP=='DIAS' and $TotalH=='NO'){
	           $AuxH= $AyudaTP/30;
		   $conA="update decentro set vlrhora='$AuxH' where decentro.codcentro='$CodC' and decentro.codsala='$CodUnico'";
		   $ResA=mysql_query($conA)or die("Error al actualizar el centro de Nomina sexto");
		   $datos=mysql_affected_rows();
	 }
        /*FIN CODIGO DE AUXILIO DE TRANSPORTE*/
        /*CODIGO QUE BUSCA EL CENTRO DE NOMINA*/
        $conE="select decentro.*,empleado.basico,centro.codcentro from empleado,centro,decentro
         where empleado.cedemple=centro.cedemple and
               centro.codcentro=decentro.codcentro and
               decentro.prestacion='SI' and
               empleado.cedemple='$datoN[$k]'";
         $resuE=mysql_query($conE)or die ("Error al validar la Empleado");
         while ($filas_E=mysql_fetch_array($resuE)){
             $CodSala=$filas_E["codsala"];
             $CodCentro=$filas_E["codcentro"];
             $conB="select salario.codsala,salario.formapago,salario.totalhoras,salario.porcentaje from salario
             where  salario.estado='ACTIVO' and
                   salario.codsala='$CodSala'";
              $ResB=mysql_query($conB)or die("Error al buscar codigos de salario");
              $filas_S=mysql_fetch_array($ResB);
              $FormaPago=$filas_S["formapago"];
              $TotalHora=$filas_S["totalhoras"];
              $Porcentaje=$filas_S["porcentaje"];
              if($FormaPago=='HORAS' and $TotalHora=='SI'){
                 $Aux01=($Basico/30/8);
                 $conA="update decentro set vlrhora='$Aux01' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSala'";
                 $ResA=mysql_query($conA)or die("Error al actualizar el centro de Nomina Uno");
                 $datos=mysql_affected_rows();
              }else{
                  if($FormaPago=='HORAS' and $TotalHora=='NO'){
                     $AuxH= $Basico/30/8;
                     $AuxTiempo=($AuxH * $Porcentaje)/100;
                     $conA="update decentro set vlrhora='$AuxTiempo' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSala'";
                     $ResA=mysql_query($conA)or die("Error al actualizar el centro de Nomina Dos");
                     $datos=mysql_affected_rows();
                  }else{
                       if($FormaPago=='HORAS' and $TotalHora=='IGUAL'){
                             $AuxH=($Basico/30/8);
	                     $AuxTiempo=($AuxH * $Porcentaje)/100;
	                     $conA="update decentro set vlrhora='$AuxTiempo' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSala'";
	                     $ResA=mysql_query($conA)or die("Error al actualizar el centro de Nomina Tres");
	                     $datos=mysql_affected_rows();
                       }else{
                            if($FormaPago=='HORAS' and $TotalHora=='ING'){
                                  $VarT=round($Minimo * $PorIncapa);
                                 if($Basico <= $VarT){
                                    $AuxH = $Minimo/30/8;
		                    $conA = "update decentro set vlrhora='$AuxH' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSala'";
		                    $ResA = mysql_query($conA)or die("Error al actualizar el centro de Nomina cuatro");
		                    $datos = mysql_affected_rows();
                                }else{
                                   $AuxH = $Basico/30/8;
                                    $AuxIncapa=($AuxH * $Porcentaje)/100;
		                    $conA="update decentro set vlrhora='$AuxIncapa' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSala'";
		                    $ResA=mysql_query($conA)or die("Error al actualizar el centro de Nomina quinto");
		                    $datos=mysql_affected_rows();
                                }
                            }else{
                                 if($FormaPago=='NINGUNA' and $TotalHora=='ING'){
                                      $AuxH= $Basico/30/8;
		                      $conA="update decentro set vlrhora='$AuxH' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSala'";
		                      $ResA=mysql_query($conA)or die("Error al actualizar el centro de Nomina sexto");
		                      $datos=mysql_affected_rows();
                                 }else{
                                      if($FormaPago=='DIAS' and $TotalHora=='NO'){
                                          $AuxH= $AyudaT/30;
		                          $conA="update decentro set vlrhora='$AuxH' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSala'";
		                          $ResA=mysql_query($conA)or die("Error al actualizar el centro de Nomina sexto");
		                          $datos=mysql_affected_rows();
                                       } 
  
                                 }
                            }
                       }
                 }
              }
         }/*cierra ciclo del mientras*/
      endfor;
    ?>
           <script language="javascript">
                 alert("Se grabaron : <?echo ($k-1);?> registros de la Empresa : <?echo $Zona;?> .!")
                 open("ActualizarCentro.php?>","_self")
	     </script>
            <?
endif;
?>
</body>

</html>



