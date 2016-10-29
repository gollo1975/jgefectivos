<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimircausacion.php?nrocausa=' + numero
                tiempo=60
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
<?
if(empty($Generar)){
	?>
	<script language="javascript">
			alert("Seleccione si va a generar la causacion en el sistema..!")
			history.back()
	</script>
	<?
}else{
	include("../conexion.php");
	   $consulta = "select count(*) from causacion";
	   $result = mysql_query ($consulta);
	   $sw = mysql_fetch_row($result);
	if ($sw[0]>0):
		 $consulta = "select max(cast(nrocausa as unsigned)) + 1  from causacion";
		 $result = mysql_query ($consulta);
		 $codec = mysql_fetch_row($result);
		 $codcausa = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
	else:
	   $codcausa="00001";
	endif;
	if($TipoFactura=='REEMBOLSO'){
	  $EstadoF='ACTIVA';
	}else{
	  $EstadoF='';
	}
	$nota=strtoupper("$nota");
	$fechap=date("Y-m-d");
	$consulta="insert into pagar(nrofactura,nitprove,fechaini,fechaven,fechagra,subtotal,porcre,basecre,dcto,valor,rfte,baserfte,ivapagado,total,nota,saldo,estado,tipofactura,estadofactura)
	values('$nrofactura','$nitprove','$fechaini','$fechaven','$fechagra','$subtotal','$porcre','$basecree','$dcto','$totalbase','$rfte','$baserfte','$ivapagado','$totalpagar','$nota','$totalpagar','$estado','$TipoFactura','$EstadoF')";
	$resultado=mysql_query($consulta)or die("Error al grabar compras $consulta");
	if($estado==1 and $Generar == 'SI'){
	    $conC="insert into causacion(nrocausa,nrofactura,fechac)
	    values('$codcausa','$nrofactura','$fechap')";
	    $resuC=mysql_query($conC)or die("Error al grabar causacion");
	    ?>
	    <script language="javascript">
			alert("El registro  se Guardó correctamente en sistema! ?")
	    </script>
	    <?
 	    echo ("<script language=\"javascript\">");
	    echo ("open (\"imprimircausacion.php?nrocausa=$codcausa\" ,\"\");");
	    echo ("</script>");
	}
	  ?>
	<script language="javascript">
		   open("agregar.php","_self")
	</script>
	<?
}	

