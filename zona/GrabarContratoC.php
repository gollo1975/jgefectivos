 <?
 session_start();
?>
<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='ReporteContratoComercial.php?Nro=' + numero
                tiempo=50
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
<?
//if(session_is_registered("xsession")):
   if (empty($CodMuni)):
       ?>
       <script language="javascript">
        alert("Seleccione el municipio donde esta ubicada la Empresa de la lista.!")
         history.back()
       </script>
       <?
   elseif (empty($CodMuniExpedicion)):
       ?>
       <script language="javascript">
        alert("Seleccione el lugar de Expedición del documento del Representante Legal de la Empresa.!")
         history.back()
       </script>
       <?
   else:
       /*INICIO DE VARIABLES*/
        $Empresa=strtoupper($Empresa);
		$FechaGrabado=date('Y-m-d');
        $Direccion=strtoupper($Direccion);
        $RepresentanteLegal=strtoupper($RepresentanteLegal);
        $Proceso=strtoupper($Proceso);
        $CotizacionLetra=strtoupper($CotizacionLetra);
       /*FIN DE VARIABLES*/
        include("../conexion.php");
       /*CODIGO QUE VALIDE EL MUNICIPIO DE LA EMPREAS*/
        $SqlME="select municipio.codmuni, municipio.municipio from municipio where codmuni='$CodMuni'";
        $Rs1=mysql_query($SqlME)or die("Error en la busqueda del municipio de la Empresa");
        $Fila_ME=mysql_fetch_array($Rs1);
        $MunicipioEmpresa = $Fila_ME["municipio"];
       /*FIN CODIGO*/
        /*CODIGO QUE VALIDE EL MUNICIPIO DE EXPEDICION DE LA CEDULA*/
        $SqlE="select municipio.codmuni, municipio.municipio from municipio where codmuni='$CodMuniExpedicion'";
        $Rs2=mysql_query($SqlE)or die("Error en la busqueda del municipio de la expedicion de la cedula.");
        $Fila_E=mysql_fetch_array($Rs2);
        $MunicipioExpedicion = $Fila_E["municipio"];
       /*FIN CODIGO*/
       $consulta = "select count(*) from contratocomercial";
       $result = mysql_query ($consulta);
       $sw = mysql_fetch_row($result);
       if ($sw[0]>0):
                      $consulta = "select max(cast(nroc as unsigned)) + 1 from contratocomercial";
                      $result = mysql_query($consulta) or die ("Fallo en la consulta");
                      $codco = mysql_fetch_row($result);
                      $CodC = str_pad ($codco[0], 5, "0", STR_PAD_LEFT);
       else:
                   $CodC="00001";
       endif;
	echo $consulta="insert into contratocomercial(nroc,nit,dv,cliente,direccion,codmuni,municipioempresa,representantelegal,proceso,cotizacionletra,textoadecuado,codmuniexpedicion,municipioexpedicion,documento,nrocotizacion,cotizacionnro,fechap,fechae)
	           values('$CodC','$Nit','$Dv','$Empresa','$Direccion','$CodMuni','$MunicipioEmpresa','$RepresentanteLegal','$Proceso','$CotizacionLetra','$TextoAdecuado','$CodMuniExpedicion','$MunicipioExpedicion','$Documento','$NroC','$CotizacionNro','$FechaGrabado','$FechaContrato')";
	$resultado=mysql_query($consulta)or die("insercción incorrecta de contratos");
	echo ("<script language=\"javascript\">");
	echo ("open (\"ReporteContratoComercial.php?Nro=$CodC\" ,\"\");");
	echo ("</script>");
	?>
	<script language="javascript">
	open("ContratoComercial.php","_self");
	</script>
	<?

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
endif;*/
  ?>
 </body>
</html>
