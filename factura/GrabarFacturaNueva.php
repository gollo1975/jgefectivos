<?
if(empty($Vector)){
   ?>
   <script language="javascript">
      alert("Debe de chequear las cajas de verificacion para generar la Factura.!")
      history.back()
   </script>
   <?
}elseif(empty($SubtotalServicio)){
   ?>
   <script language="javascript">
      alert("Favor digite el subtotal para los tributos.!")
      history.back()
   </script>
   <?
}else{
   include("../numeros.php");
   $FechaG=date("Y-m-d");
   $EstadoF = 'ACTIVA';
   include("../conexion.php");
   $consulta = "select count(*) from factura";
        $result = mysql_query ($consulta);
        $sw = mysql_fetch_row($result);
        if ($sw[0]>0):
           $consulta = "select max(cast(nrofactura as unsigned)) + 1 from factura";
           $result = mysql_query($consulta) or die ("Fallo en la consulta");
           $codco = mysql_fetch_row($result);
           $NroF = str_pad ($codco[0], 6, "0", STR_PAD_LEFT);
        else:
          $NroF="000001";
        endif;
        if($ValorFuente==0){
           $PorcentajeRetencionFuente = 0;
        }
        if($ValorReteIva==0){
           $PorcentajeRetencionIva = 0;
        }
       $consulta="insert into factura(nrofactura, codigo, codzona, fechaini, fechaven, fechagra, subtotal,rfte,rteiva,porcentaje, porfuente, poreteiva, porcre,vlrcre,iva,grantotal,observacion, estado, resolucion, inicio, final, nsaldo,nroservicio, base)
                   values('$NroF','$NroServicio','$CodZona','$Fecha_Inicio','$Fecha_Vcto','$FechaG','$SubtotalServicio','$ValorFuente','$ValorReteIva','$IvaFacturado','$PorcentajeRetencionFuente','$PorcentajeRetencionIva','$PorcentajeCree','$ValorCree','$ValorIva','$ValorTotal',
                   '$observacion','$EstadoF','$ResolucionDian','$InicioResolucion','$FinalResolucion','$ValorTotal','$TipoFactura','$TipoBaseVenta')";
        $resultado=mysql_query($consulta)or die("inserección incorrecta $consulta");
        $registro=mysql_affected_rows();
        for ($m=1 ; $m <= $TotalRegistro; $m ++){
			if($Vector[$m] != ""){ 
				 $con="insert into defactura(nrofactura,codcom,cantidad,vlruni,descuento,total)
				 values('$NroF','$Vector[$m]','$Cantidad[$m]','$VlrUnitario[$m]','$Dcto[$m]','$Total[$m]')";
				 $resulta=mysql_query($con)or die("Error al grabar el detalle de la factura.");
				 $registro=mysql_affected_rows();
			}	 
        }
        echo "<script language=\"javascript\">";
        echo ("open (\"imprimir.php?nrofactura=$NroF\" ,\"\");");
        echo "</script>";
        if($TipoProceso=='GENERAL'){
            ?>
              <script language="javascript">
                open("ProcesoFacturacion.php","_self");
             </script>
            <?
        }else{
             $SqlA="update zonacosto set facturado='SI', cerrado='SI' where zonacosto.codigo='$NroServicio'";
             $RsA=mysql_query($SqlA)or die("Error al actualzar la tabla zona costo.");
             ?>
              <script language="javascript">
               open("DetalleBusquedacentro.php?TipoFactura=<?echo $TipoFactura;?>&CodZona=<?echo $CodZona;?>&TipoVlr=<?echo $TipoVlr;?>&TipoProceso=<?echo $TipoProceso;?>&Desde=<?echo $Desde;?>&Hasta=<?echo $Hasta;?>","_self");
             </script>
            <?
        }
}
?>
