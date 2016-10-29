<?
 session_start();
?>
<?
//if(session_is_registered("xsession")):
	if(empty($FechaF)):
	 ?>
	   <script language="javascript">
		 alert("Digite la fecha de finalizacion del contrato..!")
		 history.back()
	   </script>
	  <?  
	elseif (empty($salario)):
	  ?>
	   <script language="javascript">
		 alert("Debe de digitar el salario del Empleado ?")
		 history.back()
	   </script>
	  <?  
	elseif(empty($salario_ibc)):
	 ?>
	   <script language="javascript">
		 alert("Debe de digitar el salario para la cotizacion de la seguridad social.!")
		 history.back()
	   </script>
	  <?
	elseif(empty($cargo)):
	  ?>
	   <script language="javascript">
		 alert("Debe de digitar el cargo del Empleado ?")
		 history.back()
	   </script>
	  <?
	elseif(empty($CodCaja)):
	  ?>
	   <script language="javascript">
		 alert("Seleccione la caja de compensacion de la lista.!")
		 history.back()
	   </script>
	  <?
	elseif(($Aporteps=='SI')and($PorSalud == '')):
		 ?>
		 <script language="javascript">
			  alert("Digite el porcentaje de la deduccion de Salud.! <?echo $PorSalud;?> <?echo $Aporteps;?>" )
			  history.back()
		  </script>
		 <?
	else:
		include("../conexion.php");
	        $Sql="select contrato.codemple FROM contrato where contrato.codemple='$codemple' and contrato.fechater='0000-00-00'";
                $Rs=mysql_query($Sql)or die ("Error al validar los contratos.");
                $Contador = mysql_num_rows($Rs);
                if($Contador==0){
			$FechaDia=date("Y-m-d");
			$consulta = "select count(*) from contrato";
			$result = mysql_query ($consulta);
			$sw = mysql_fetch_row($result);
			$cargo=strtoupper($cargo);
			$nota=strtoupper($nota);
			if ($sw[0]>0):
				$consulta = "select max(cast(contrato as unsigned)) + 1 from contrato";
				$result = mysql_query($consulta) or die ("Fallo en la consulta");
				$codco = mysql_fetch_row($result);
				$codcontrato = str_pad ($codco[0], 5, "0", STR_PAD_LEFT);
			else:
				$codcontrato="00001";
			endif;
			$consulta="insert into contrato(contrato,codemple,fechainic,fechater,fechafinalizacion,salario,salario_ibc,tiposalario,nivel,eps,pension,tipo,cargo,codigo_caja_pk,codigo_tipo_cotizante_fk,codigo_subtipo_cotizante_fk,codzona,zona,nota,salario_anterior,salario_fecha_desde,fechaproceso)
			values('$codcontrato','$codemple','$fechainic','$fechater','$FechaF','$salario','$salario_ibc','$TipoS','$nivelarl','$PorSalud','$PorPension','$tipo','$cargo','$CodCaja','$TipoCotizante','$SubTipoCotizante','$CodZona','$zona','$nota','$salario_ibc','$fechainic','$FechaDia')";
			$resultado=mysql_query($consulta)or die("inserección incorrecta");
			?>
			<script language="javascript">
			alert("Registro Grabado Con Exito ?")
			open("agregar.php","_self");
			</script>
			<?
                }else{
                     ?>
			<script language="javascript">
			    alert("Este Empleado ya tiene contrato generado en sistema, favor validar.!")
                            history.back()
			</script>
		     <?
                }

	endif;
/*else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif; */
  ?>
 </body>
</html>
