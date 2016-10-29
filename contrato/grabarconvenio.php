<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='ReporteContratoNuevo.php?CodReporte=' + numero
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
<?
$Sw=0;
if($estado=='FIJO'){
    if (empty($CodMuni)){
      ?>
      <script language="javascript">
          alert("Seleccion el lugar de expedicion de la cedula.")
          history.back()
      </script>
      <?
   }elseif(empty($Direccion)){
     ?>
      <script language="javascript">
          alert("Digite la dirección del empleado.!")
          history.back()
      </script>
      <?
   }elseif(empty($Barrio)){
     ?>
      <script language="javascript">
          alert("Digite el barrio donde queda la dirección del empleado.!")
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
   }elseif(empty($Salario)){
     ?>
      <script language="javascript">
          alert("Digite el salario del trabajador autorizado.!")
          history.back()
      </script>
      <?
     }elseif(empty($FechaNacimiento)){
       ?>
      <script language="javascript">
          alert("Digite la fecha de nacimiento del Empleado.!")
          history.back()
      </script>
      <?
     }elseif(empty($FechaNacimiento)){
       ?>
      <script language="javascript">
          alert("Digite la fecha de nacimiento del Empleado.!")
          history.back()
      </script>
      <?
    }elseif(empty($NroDias)){
       ?>
      <script language="javascript">
          alert("Digite los dias de contratacion.!")
          history.back()
      </script>
      <?
    }elseif(empty($Municipio)){
        ?>
      <script language="javascript">
          alert("Digite la ciudad de contratacion del trabajador.!")
          history.back()
      </script>
      <?
    }else{
      $Sw=1;
    }
}
if($estado=='INDEFINIDO'){
   if (empty($CodMuni)){
      ?>
      <script language="javascript">
          alert()
      </script>
      <?
   }else{
      $Sw=1;
   }
}
if($estado=='LABOR'){
   if (empty($CodMuni)){
      ?>
      <script language="javascript">
          alert("Seleccion el municipio de la lista.")
          history.back()
      </script>
      <?
   }elseif(empty($Salario)){
     ?>
      <script language="javascript">
          alert("Digite el salario del trabajador autorizado.!")
          history.back()
      </script>
      <?
    }elseif(empty($DiaPago)){
       ?>
      <script language="javascript">
          alert("Digite los dias en que se le paga al trabajador.!")
          history.back()
      </script>
      <?
    }elseif(empty($Horario)){
        ?>
      <script language="javascript">
          alert("Digite el horario o turno de trabajo del trabajador.!")
          history.back()
      </script>
      <?
    }elseif(empty($Proceso)){
         ?>
      <script language="javascript">
          alert("Digite el proceso a desempeñar en la Empresa.!")
          history.back()
      </script>
      <?
    }else{
      $Sw=1;
    }
}
if($estado=='ADICCION'){
   if (empty($SalarioNoPrestacional)){
      ?>
      <script language="javascript">
          alert("Digite el salario no Prestacional.!!")
          history.back()
      </script>
      <?
   }elseif(empty($CodigoConcepto)){
     ?>
      <script language="javascript">
          alert("Seleccione de la lista el concepto no prestacional.!")
          history.back()
      </script>
      <?
    }else{
      $Sw=1;
    }
}
if($Sw==1){
	include("../numeros.php");
	   $letras=num2letras($Salario);
	   $Letras=strtoupper($letras);
	  $ValorNoSalarial=num2letras($SalarioNoPrestacional);
	   $ValorNoSalarial=strtoupper($ValorNoSalarial);
	include("../conexion.php");
        /*codigo que busca el codigo del salario*/
	$SrS="select conceptonosalarial.concepto from conceptonosalarial where conceptonosalarial.codsala='$CodigoConcepto'";
	$RsS=mysql_query($SrS)or die("Error al buscar conceptos");
	$fila_S=mysql_fetch_array($RsS);
	$Concepto = $fila_S["concepto"];
        /*codigo para buscar la fecha de expedicion de la cedula*/
	$SrMunicipio="select municipio.municipio from municipio where municipio.codmuni='$CodMuni'";
	$RsMunicipio=mysql_query($SrMunicipio)or die("Error al buscar municipio");
	$fila_M=mysql_fetch_array($RsMunicipio);
	$LugarExpedicion = $fila_M["municipio"];
	$OtroLugarExpedicion = $Expedicion;
	$fechap=date("Y-m-d");
	$Empleado=strtoupper($cliente);
	$Cargo = strtoupper($Cargo);
	$DiaPago = strtolower($DiaPago);
	$Horario = strtoupper($Horario);
	$Proceso = strtoupper($Proceso);
      	$Direccion = strtoupper($Direccion);
      	$Barrio = strtoupper($Barrio);
	$ConceptoNoSalarial= strtoupper($ConceptoNoSalarial);
	$UsuarioPreparador=strtoupper($UsuarioPreparador);
	$Tipo=strtoupper($tipo);
	$consulta = "select count(*) from convenio";
	$result = mysql_query ($consulta);
	$sw = mysql_fetch_row($result);
	if ($sw[0] > 0):
	   $consulta1 = "select max(cast(nroconvenio as unsigned)) + 1 from convenio";
	   $result1 = mysql_query ($consulta1) or die ("Fallo en la consulta");
	   $codc = mysql_fetch_row($result1);
	   $CodigoN= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
	else:
	   $CodigoN="000001";
	endif;

 	if($estado=='FIJO'){
              $nuevafecha = strtotime ( '+'.$NroDias.'  day' , strtotime ( $FechaContratacion ) ) ;
              $FechaVencimiento = date ( 'Y-m-d' , $nuevafecha );
              $consulta="insert into convenio(nroconvenio,cedemple,nombres,codmuni,lugarexpedicion,direccion,barrio,cargo,salario,letra,fechanacimiento,fechacontratacion,nrodias,fechavencimiento,formapago,codzona,zona,municipiocontratacion,tipo,tipocontrato,fechac,usuarioadmon,horaproceso,nro)
	             values ('$CodigoN','$cedula','$Empleado','$CodMuni','$LugarExpedicion','$Direccion','$Barrio','$Cargo','$Salario','$Letras','$FechaNacimiento','$FechaContratacion','$NroDias','$FechaVencimiento','$FormaPago','$CodZona','$Zona','$Municipio','$Tipo','$estado','$fechap','$UsuarioPreparador','$FechaHora','$NroExamen')";
	      $resultado=mysql_query($consulta)or die("Inserccion incorrecta de contrato por FIJO");
              echo ("<script language=\"javascript\">");
	      echo ("open (\"ReporteContratoNuevo.php?CodReporte=$CodigoN\" ,\"\");");
	      echo ("</script>");
	      ?>
	      <script language="javascript">
                  open("convenio.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>&codigo=<?echo $codigo;?>","_self");
	      </script>
	      <?
	}else{
	     if($estado=='INDEFINIDO'){
                 $consulta="insert into convenio(nroconvenio,cedemple,nombres,codmuni,lugarexpedicion,direccion,barrio,cargo,salario,letra,fechanacimiento,fechacontratacion,formapago,codzona,zona,municipiocontratacion,tipo,tipocontrato,fechac,usuarioadmon,horaproceso,nro)
	             values ('$CodigoN','$cedula','$Empleado','$CodMuni','$LugarExpedicion','$Direccion','$Barrio','$Cargo','$Salario','$Letras','$FechaNacimiento','$FechaContratacion','$FormaPago','$CodZona','$Zona','$Municipio','$Tipo','$estado','$fechap','$UsuarioPreparador','$FechaHora','$NroExamen')";
	         $resultado=mysql_query($consulta)or die("Inserccion incorrecta de contrato por INDEFINIDO");
                  echo ("<script language=\"javascript\">");
	          echo ("open (\"ReporteContratoNuevo.php?CodReporte=$CodigoN\" ,\"\");");
	          echo ("</script>");
		  ?>
		  <script language="javascript">
                          open("convenio.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>&codigo=<?echo $codigo;?>","_self");
		  </script>
		  <?
	     }else{
	          if($estado=='LABOR'){
	              $consulta="insert into convenio(nroconvenio,cedemple,nombres,codmuni,lugarexpedicion,cargo,salario,letra,diapago,fechacontratacion,formapago,horariotrabajo,codzona,zona,tipo,tipocontrato,proceso,fechac,usuarioadmon,horaproceso,nro)
	              values ('$CodigoN','$cedula','$Empleado','$CodMuni','$LugarExpedicion','$Cargo','$Salario','$Letras','$DiaPago','$FechaContratación','$FormaPago','$Horario','$CodZona','$Zona','$Tipo','$estado','$Proceso','$fechap','$UsuarioPreparador','$FechaHora','$NroExamen')";
	              $resultado=mysql_query($consulta)or die("Inserccion incorrecta de contrato por labor");
                      echo ("<script language=\"javascript\">");
		      echo ("open (\"ReporteContratoNuevo.php?CodReporte=$CodigoN\" ,\"\");");
		      echo ("</script>");
		      ?>
		      <script language="javascript">
		         open("convenio.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>&codigo=<?echo $codigo;?>","_self");
		      </script>
		      <?
	          }else{
                        $ValorSalario = 0; $TotalSalario = 0;  $ValorDato = 0;
                       $Parametro="select parametronosalarial.valor from parametronosalarial where parametronosalarial.estado='ACTIVO'";
						$RsP=mysql_query($Parametro)or die("Error al buscar el parametro");
						$fila_P=mysql_fetch_array($RsP);
						$ValorDato = $fila_P["valor"];
                        $ValorSalario = ($Salario + $SalarioNoPrestacional);
                        $TotalSalario = round(($ValorSalario * $ValorDato)/100);
                        if($SalarioNoPrestacional > $TotalSalario){
                             ?>
							  <script language="javascript">
								  alert("El valor digitado como salario no Prestacional supera la norma en Colombia, Favor revisar. !")
								  history.back()
							  </script>
							  <?
                        }else{
	                     $consulta="insert into convenio(nroconvenio,cedemple,nombres,lugarexpedicion,salario,letra,fechacontratacion,tipo,tipocontrato,codsala,conceptonosalarial,pagonosalarial,letranosalarial,fechac,usuarioadmon,horaproceso,nro)
	                               values ('$CodigoN','$cedula','$Empleado','$OtroLugarExpedicion','$Salario','$Letras','$FechaContratación','$Tipo','$estado','$CodigoConcepto','$Concepto','$SalarioNoPrestacional','$ValorNoSalarial','$fechap','$UsuarioPreparador','$FechaHora','$NroExamen')";
	                     $resultado=mysql_query($consulta)or die("Inserccion incorrecta en anexo al contrato");
			     $registro=mysql_affected_rows();
			     echo ("<script language=\"javascript\">");
		   	     echo ("open (\"ReporteContratoNuevo.php?CodReporte=$CodigoN\" ,\"\");");
			     echo ("</script>");
			     ?>
			     <script language="javascript">
				    open("convenio.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>&codigo=<?echo $codigo;?>","_self");
			     </script>
			     <?
                        }
	          }
	     }
	}
 }

 ?>
</body>
</html>

