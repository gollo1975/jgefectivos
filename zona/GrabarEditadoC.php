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
        $fechaM=date("Y-m-d");
        $Empresa=strtoupper($Empresa);
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
        $consulta="update contratocomercial set nit='$Nit',dv='$Dv',cliente='$Empresa',direccion='$Direccion',
                   codmuni='$CodMuni',municipioempresa='$MunicipioEmpresa',representantelegal='$RepresentanteLegal',
                   proceso='$Proceso',cotizacionletra='$CotizacionLetra',textoadecuado='$TextoAdecuado',
                   codmuniexpedicion='$CodMuniExpedicion',municipioexpedicion='$MunicipioExpedicion',
                   documento='$Documento', nrocotizacion='$NroCotizacion', cotizacionnro='$CotizacionNro',fechap='$FechaContrato',fechae='$fechaM' where contratocomercial.nroc='$NroC'";
        $resultado=mysql_query($consulta)or die("Error al actualizar contratos");
        $registro=mysql_affected_rows();
        echo ("<script language=\"javascript\">");
        echo ("open (\"ReporteContratoComercial.php?Nro=$NroC\" ,\"\");");
        echo ("</script>");
        ?>
	      <script language="javascript">
	        open("EditarC.php","_self");
	      </script>
	<?
endif;
?>

