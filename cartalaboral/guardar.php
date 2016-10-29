	 <script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='ImprimirCarta.php?NroCarta=' + numero
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
                </script>
<?
if (empty($Departamento)){
?>
  <script language="javascript">
    alert("Digite el departamento de la empresa que genera la carta.!")
    history.back()
  </script>
<?
}elseif(empty($Cargo)){
?>
  <script language="javascript">
    alert("Digite el cargo del empleado.!")
    history.back()
  </script>
<?
}else{
     include("../conexion.php");
     $con="select acceso.firmadigital,acceso.nivel from acceso where acceso.usuario='$FirmaDigital' and acceso.firmadigital != ''";
     $resp=mysql_query($con)or die("Error al buscar usuario");
     $filas_F=mysql_fetch_array($resp);
     $FirmaDocumento=$filas_F["firmadigital"];
     $NivelUsuario=$filas_F["nivel"];
     $regi=mysql_num_rows($resp);
     if($regi!=0){
	     $Dirigida=strtoupper($Dirigida);
             $Cargo=strtoupper($Cargo);
	     $Empresa=strtoupper($Empresa);
	     $Departamento=strtoupper($Departamento);
	     $FechaP = date('Y-m-d');
	     if($FechaFinalContrato=='0000-00-00'){
	        $EstadoEmpleado= 'ACTIVO';
	     }else{
	        $EstadoEmpleado= 'INACTIVO';
	     }
	     /*CODIGO PARA VALIR LA NOMINA*/
	      $SumaVector = 0; $Aux = 0; $TotalIbc = 0; $Calculo = 0;
	     if($Periodo=='SEMANAL'){
	        $SumaVector = 4;
	     }else{
	         if($Periodo=='DECADAL'){
	             $SumaVector = 3;
	         }else{
	              if($Periodo=='CATORCENAL' or $Periodo =='QUINCENAL'){
	                 $SumaVector = 2;
	              }else{
	                   $SumaVector = 1;
	              }
	         }
	     }
	     $Sql="select nomina.consecutivo,nomina.ibc_tiempo_suple as Total from nomina where nomina.cedemple='$Documento' ORDER BY nomina.consecutivo DESC limit $SumaVector";
	     $Sr=mysql_query($Sql)or die("Error al Colillas de Pago");
	     $Cont=mysql_num_rows($Sr);
             $OtroTiempo = 0;
	     if($Cont != 0){
                  while ($fila_N = mysql_fetch_array($Sr)){
                        $CodigoNomina=$fila_N ["consecutivo"];
                         $Aux= $fila_N["Total"];
                         $Calculo = $Calculo + $Aux;
                         $AuxTiempo = 0;
                         $SqOther="select denomina.codsala,denomina.salario as OtroTotal from denomina where denomina.consecutivo='$CodigoNomina'";
	                 $SrOther=mysql_query($SqOther)or die("Error al buscar otro valor de nomina");
                         while ($filaOther = mysql_fetch_array($SrOther)){
                             $CodSala =  $filaOther["codsala"];
                             $Valor = $filaOther["OtroTotal"];
                             /*ciclo para que busca el codsala*/
                             for ($k=1 ; $k <= $TotalR; $k ++){
                                 if($CodSala == $CodSalario[$k]){
                                     $AuxTiempo = $AuxTiempo + $Valor;
                                 }
                             }
                         }
                          $OtroTiempo += $AuxTiempo;
                  }
	          $TotalIbc= $Calculo;
                  $OtroTiempo = $OtroTiempo;
             }else{
                 $TotalIbc = 0;
                 $OtroTiempo = 0;
             }
         include("../numeros.php");
          $letras = num2letras($Salario);
          $Letras = strtoupper($letras);
          $letratiempo = num2letras($TotalIbc);
          $LetraTiempo = strtoupper($letratiempo);
          $letraOtroTiempo = num2letras($OtroTiempo);
          $letraOtroTiempo = strtoupper($letraOtroTiempo);
 	   $consulta = "select count(*) from carta";
	  $result = mysql_query ($consulta);
	  $sw = mysql_fetch_row($result);
	  if ($sw[0] > 0):
	      $consulta1 = "select max(cast(codigo as unsigned)) + 1 from carta";
	      $result1 = mysql_query ($consulta1) or die ("Fallo en la consulta");
	      $codc = mysql_fetch_row($result1);
	      $codigo= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
	  else:
	      $codigo="00001";
          endif;
         if($ValidarTipo=='Personalizada'){
              if($NivelUsuario==10){
	         $consul="insert into carta(codigo,cedemple,nombres,asunto,nrocontrato,salario,letrasalario,salariotiempo,letratiempo,otrotiempo,letraotrotiempo,cargotrabajador,fechainiciocontrato,fechafinalcontrato,zonalaborada,tipocontrato,tipoempleado,estadoempleado,firma,cargo,tipocarta,fecha,firmadigital)
	         values('$codigo','$Documento','$Nombres','$Departamento','$NroContrato','$Salario','$Letras','$TotalIbc','$LetraTiempo','$OtroTiempo','$letraOtroTiempo','$Cargo','$FechaInicioContrato','$FechaFinalContrato','$Zona','$TipoContrato','$TipoEmpleado','$EstadoEmpleado','$Firma','$CargoT','$ValidarTipo','$FechaP','$FirmaDocumento')";
	         $res=mysql_query($consul)or die("Error al grabar los datos para la carta laboral");
	         $regis=mysql_affected_rows();
	         echo ("<script language=\"javascript\">");
	         echo ("open (\"ImprimirCarta.php?NroCarta=$codigo\" ,\"\");");
	         echo ("</script>");
	         ?>
	         <script language="javascript">
	           open("agregar.php?FirmaDigital=<?echo $FirmaDigital;?>","_self");
	         </script>
	         <?
	      }else{
	           ?>
		   <script language="javascript">
		          alert("Este Usuario no esta autorizado para hacer este tipo de cartas laborales?")
		          history.back()
		   </script>
		   <?
	      }
	  }else{
	         $consul="insert into carta(codigo,cedemple,nombres,asunto,nrocontrato,salario,letrasalario,salariotiempo,letratiempo,otrotiempo,letraotrotiempo,cargotrabajador,fechainiciocontrato,fechafinalcontrato,zonalaborada,tipocontrato,tipoempleado,estadoempleado,firma,cargo,tipocarta,fecha,firmadigital)
	         values('$codigo','$Documento','$Nombres','$Departamento','$NroContrato','$Salario','$Letras','$TotalIbc','$LetraTiempo','$OtroTiempo','$letraOtroTiempo','$Cargo','$FechaInicioContrato','$FechaFinalContrato','$Zona','$TipoContrato','$TipoEmpleado','$EstadoEmpleado','$Firma','$CargoT','$ValidarTipo','$FechaP','$FirmaDocumento')";
	         $res=mysql_query($consul)or die("Error al grabar los datos para la carta laboral");
	         $regis=mysql_affected_rows();
	         echo ("<script language=\"javascript\">");
	         echo ("open (\"ImprimirCarta.php?NroCarta=$codigo\" ,\"\");");
	         echo ("</script>");
	         ?>
	         <script language="javascript">
	           open("agregar.php?FirmaDigital=<?echo $FirmaDigital;?>","_self");
	         </script>
	         <?
         }
    }else{
     ?>
       <script language="javascript">
          alert("Este Usuario no esta autorizado para hacer cartas laborales?")
          history.back()
       </script>
     <?
    }
}
?>

</body>
</html>
