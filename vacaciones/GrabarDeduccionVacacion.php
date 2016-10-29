<input type="hidden" name="Cedula" value="<? echo $Cedula;?>">
<input type="hidden" name="NroVacacion" value="<? echo $NroVacacion;?>">
 <input type="hidden" name="TotalV" value="<? echo $TotalV;?>">
 <input type="hidden" name="TotalPagado" value="<? echo $TotalPagado;?>">
<input type="hidden" name="Sw" value="<? echo $Sw;?>">
<input type="text" name="EstadoModificado" value="<? echo $EstadoModificado;?>">
<?
if($Deduccion==0):
  ?>
  <script language="javascript">
           alert("Seleccione el la deduccion a debitar del sistema!")
           history.back()
        </script>
  <?
else:
     include("../conexion.php");
 $fechaP=date("Y-m-d");
  $conC="select decentro.codcentro from decentro,centro
               where centro.codcentro=decentro.codcentro and
                     centro.cedemple='$Cedula'";
  $resuC=mysql_query($conC)or die ("Error al buscar eel centro de nomina");
  $filaC=mysql_fetch_array($resuC);
  $CodCentro = $filaC["codcentro"];
  if($Estado=='' and $OtroValor==''){
      /*codigo que busca el credito*/
      if($Sw==0){
          $ConC="SELECT credito.nuevo as Nuevo,credito.codsala,salario.desala FROM credito,salario  WHERE credito.nrocredito = '$Deduccion' and credito.codsala=salario.codsala";
          $ResC=mysql_query($ConC)or die("Error al buscar creditos");
      }else{
          $ConC="SELECT mercado.nsaldo as Nuevo,mercado.codsala,salario.desala FROM mercado,salario  WHERE mercado.codmerca = '$Deduccion' and mercado.codsala=salario.codsala";
          $ResC=mysql_query($ConC)or die("Error al buscar creditos");
      }
      $filas_C=mysql_fetch_array($ResC);
      $CodSala=$filas_C["codsala"];
      $Saldo=$filas_C["Nuevo"];
      $NuevoSaldo=$Saldo-$Saldo;
      $Concepto=$filas_C["desala"];
      if ($Saldo >= $TotalPagado){
        ?>
        <script language="javascript">
           alert("las deducciones son mayores al pago de prestaciones sociales.!")
           history.back()
        </script>
        <?
    }else{
	    /*codigo de grabado*/
	     $conH="insert into detallevacacion(codsala,concepto,valorpago,codvaca,fechap,nrocredito)
	      values('$CodSala','$Concepto','$Saldo','$NroVacacion','$fechaP','$Deduccion')";
	     $resuH=mysql_query($conH)or die ("Error al grabar deducciones en la tabla vacaciones");
	     /*codigo de grabado en la tabla abono*/
	     $Nota='POR MEDIO DE LA VACACIONES';
	     if($Sw==0){
	            include("../conexion.php");
		     $consulta = "select count(*) from abono";
		     $result = mysql_query ($consulta);
		     $answ = mysql_fetch_row($result);
		     if($answ[0]>0):
		             $consulta = "select max(cast(codabono as unsigned)) + 1 from abono";
		             $result = mysql_query ($consulta) or die ("Fallo en la consulta");
		             $codc = mysql_fetch_row($result);
		             $codigo= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
		     else:
		         $codigo='000001';
		     endif;
		     $consulta="insert into abono(codabono,cedemple,nrocredito,nuevo,abono,fecha,nota)
		               values('$codigo','$Cedula','$Deduccion','$NuevoSaldo','$Saldo','$fechaP','$Nota')";
		     $resultado=mysql_query($consulta) or die("Error de Grabado en la tabla abono");
		     /*codigo que actualiza la tabla credito*/
		    $ConA="update credito set nuevo='$NuevoSaldo' where credito.nrocredito='$Deduccion'";
		     $resuA = mysql_query ($ConA) or die ("Error al actualizar");
		     $regH=mysql_affected_rows();
                     if($NuevoSaldo <= 0){
                          $ConC="update decentro set deduccion='0', permanente='NO',estado='NO' where decentro.codsala='$CodSala' and decentro.codcentro='$CodCentro'";
		          $resuC = mysql_query ($ConC) or die ("Error al actualizar");
                     }
		     header("location: CrearDeduccionVacacion.php?Cedula=$Cedula&NroVacacion=$NroVacacion&Sw=$Sw&EstadoModificado=$EstadoModificado");
             }else{
	         include("../conexion.php");
	          $consulta = "select count(*) from debitomercado";
		  $result = mysql_query ($consulta);
		  $sw = mysql_fetch_row($result);
		  if ($sw[0] > 0):
		      $calculo=$nsaldo-$abono;
		      $consulta1 = "select max(cast(numero as unsigned)) + 1 from debitomercado";
		      $result1 = mysql_query ($consulta1) or die ("Fallo en la consulta");
		      $codc = mysql_fetch_row($result1);
		      $codca= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
	          else:
	              $codca="00001";
	          endif;
	          $consul="insert into debitomercado(numero,cedemple,codmerca,nsaldo,fechabono,abono,nota)
	          values('$codca','$Cedula','$Deduccion','$NuevoSaldo','$fechaP','$Saldo','$Nota')";
	          $res=mysql_query($consul)or die("Error al grabar el abono a mercado");
	          /*codigo que actualiza la tabla mercado*/
	         $ConA="update mercado set nsaldo='$NuevoSaldo' where mercado.codmerca='$Deduccion'";
		  $resuA = mysql_query ($ConA) or die ("Error al actualizar");
	          $regH=mysql_affected_rows();
                  if($NuevoSaldo <= 0){
                          $ConC="update decentro set deduccion='0', permanente='NO',estado='NO' where decentro.codsala='$CodSala' and decentro.codcentro='$CodCentro'";
		          $resuC = mysql_query ($ConC) or die ("Error al actualizar");
                     }
		  header("location: CrearDeduccionVacacion.php?Cedula=$Cedula&NroVacacion=$NroVacacion&Sw=$Sw&EstadoModificado=$EstadoModificado");
             }
      }
  }else{
     if($Estado!='' and $OtroValor !=''){
        include("../conexion.php");
        /*codigo que busca el credito*/
         if($Sw==0){
            $ConC="SELECT credito.nuevo as Nuevo,credito.codsala,salario.desala FROM credito,salario  WHERE credito.nrocredito = '$Deduccion' and credito.codsala=salario.codsala";
            $ResC=mysql_query($ConC)or die("Error al buscar creditos");
         }else{
            $ConC="SELECT mercado.nsaldo as Nuevo,mercado.codsala,salario.desala FROM mercado,salario  WHERE mercado.codmerca = '$Deduccion' and mercado.codsala=salario.codsala";
            $ResC=mysql_query($ConC)or die("Error al buscar creditos");
         }
	 $filas_C=mysql_fetch_array($ResC);
	 $CodSala=$filas_C["codsala"];
	 $Saldo=$filas_C["Nuevo"];
	 $NuevoSaldo=$Saldo-$OtroValor;
	 $Concepto=$filas_C["desala"];
          if ($OtroValor > $TotalPagado){
	        ?>
	        <script language="javascript">
	           alert("Las deducciones son mayores al pago de las vacaciones.!")
	           history.back()
	        </script>
	        <?
       }else{
	    /*codigo de grabado*/
	     $conH="insert into detallevacacion(codsala,concepto,valorpago,codvaca,fechap,nrocredito)
	      values('$CodSala','$Concepto','$OtroValor','$NroVacacion','$fechaP','$Deduccion')";
	     $resuH=mysql_query($conH)or die ("Error al grabar deducciones en la tabla detalle de deducciones");
	     /*codigo de grabado en la tabla abono*/
	     $Nota='POR MEDIO DE LAS VACACIONES';
	     if($Sw==0){
	            include("../conexion.php");
		     $consulta = "select count(*) from abono";
		     $result = mysql_query ($consulta);
		     $answ = mysql_fetch_row($result);
		     if($answ[0]>0):
		             $consulta = "select max(cast(codabono as unsigned)) + 1 from abono";
		             $result = mysql_query ($consulta) or die ("Fallo en la consulta");
		             $codc = mysql_fetch_row($result);
		             $codigo= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
		     else:
		         $codigo='000001';
		     endif;
		     $consulta="insert into abono(codabono,cedemple,nrocredito,nuevo,abono,fecha,nota)
		               values('$codigo','$Cedula','$Deduccion','$NuevoSaldo','$OtroValor','$fechaP','$Nota')";
		     $resultado=mysql_query($consulta) or die("Error de Grabado en la tabla abono");
		     /*codigo que actualiza la tabla credito*/
		     $ConA="update credito set nuevo='$NuevoSaldo',estado='NO' where credito.nrocredito='$Deduccion'";
		     $resuA = mysql_query ($ConA) or die ("Error al actualizar");
		     $regH=mysql_affected_rows();
                     if($NuevoSaldo <= 0){
                          $ConC="update decentro set deduccion='0', permanente='NO' where decentro.codsala='$CodSala' and decentro.codcentro='$CodCentro'";
		          $resuC = mysql_query ($ConC) or die ("Error al actualizar");
                     }
		     header("location: CrearDeduccionVacacion.php?Cedula=$Cedula&NroVacacion=$NroVacacion&Sw=$Sw&EstadoModificado=$EstadoModificado");
	     }else{
	         include("../conexion.php");
	          $consulta = "select count(*) from debitomercado";
		  $result = mysql_query ($consulta);
		  $sw = mysql_fetch_row($result);
		  if ($sw[0] > 0):
		      $calculo=$nsaldo-$abono;
		      $consulta1 = "select max(cast(numero as unsigned)) + 1 from debitomercado";
		      $result1 = mysql_query ($consulta1) or die ("Fallo en la consulta");
		      $codc = mysql_fetch_row($result1);
		      $codca= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
	          else:
	              $codca="00001";
	          endif;
	          $consul="insert into debitomercado(numero,cedemple,codmerca,nsaldo,fechabono,abono,nota)
	          values('$codca','$Cedula','$Deduccion','$NuevoSaldo','$fechaP','$OtroValor','$Nota')";
	          $res=mysql_query($consul)or die("Error al grabar el abono a mercado");
	          /*codigo que actualiza la tabla mercado*/
	          $ConA="update mercado set nsaldo='$NuevoSaldo',estado='NO' where mercado.codmerca='$Deduccion'";
		  $resuA = mysql_query ($ConA) or die ("Error al actualizar");
	          $regH=mysql_affected_rows();
                  if($NuevoSaldo <= 0){
                          $ConC="update decentro set deduccion='0', permanente='NO' where decentro.codsala='$CodSala' and decentro.codcentro='$CodCentro'";
		          $resuC = mysql_query ($ConC) or die ("Error al actualizar");
                     }
		  header("location: CrearDeduccionVacacion.php?Cedula=$Cedula&NroVacacion=$NroVacacion&Sw=$Sw&EstadoModificado=$EstadoModificado");
             }
        }
     }else{
	        ?>
	        <script language="javascript">
	           alert("Se deben de seleccionar y llenar los datos en la caja de texto!")
	           history.back()
	        </script>
	        <?
     }
  }
endif;
?>

