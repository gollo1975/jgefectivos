<input type="hidden" name="fechapago" value="<?echo $fechapago;?>">
<input type="hidden" name="ValidarPago" value="<?echo $ValidarPago;?>">
<input type="hidden" value="<?echo $Usuario;?>" name="Usuario" id="Usuario">
<?
if(empty($datos)){
   ?>
   <script language="javascript">
      alert("Debe de chequear todas las cajas de verificacion para generar el Documento.")
      history.back()
   </script>
   <?

}elseif($ValidarPago != $VlrPagado){
    ?>
   <script language="javascript">
      alert("Existen difrencias en los valores programados con los valores pagados!. ")
      history.back()
   </script>
   <?
}else{
   include("../numeros.php");
   $letras=num2letras($VlrPagado);
   $letras=strtoupper($letras);
   $FechaV=date("Y-m-d");
   include("../conexion.php");
   $consulta = "select count(*) from maestrocomprobante";
        $result = mysql_query ($consulta);
        $sw = mysql_fetch_row($result);
        if ($sw[0]>0):
           $consulta = "select max(cast(nro as unsigned)) + 1 from maestrocomprobante";
           $result = mysql_query($consulta) or die ("Fallo en la consulta");
           $codco = mysql_fetch_row($result);
           $Nroc = str_pad ($codco[0], 6, "0", STR_PAD_LEFT);
        else:
          $Nroc="000001";
        endif;
        $consulta="insert into maestrocomprobante(nro,codmaestro,codmuni,fechaRa,fechapago,vlrpagado,letras,id,usuario)
                   values('$Nroc','$NitEmpresa','$municipio','$FechaV','$fechapago','$VlrPagado','$letras','$TipoComprobante','$Usuario')";
        $resultado=mysql_query($consulta)or die("inserección incorrecta $consulta");
        $registro=mysql_affected_rows();
         for ($k=1 ; $k<=$tActualizaciones; $k ++):
           if   ($datos[$k] != ""){
                 $con="insert into comprobante(nro,nrofactura,nitprove,cliente,fecha,valor,pago,codbanco,cuenta,concepto,nitzona,zona)
                 values('$Nroc','$datos[$k]','$Documento[$k]','$empleado[$k]','$fechapago[$k]','$TotalV[$k]','$FormaPago','$codbanco','$TipoCta','$Nota','$NitZona[$k]','$Zona[$k]')";
                 $resulta=mysql_query($con)or die("Error al grabar el detalle del comprobante de prestaciones ");
                 $registro=mysql_affected_rows();
		echo $Act="update prestacion set control='PAGADO' where prestacion.nropresta='$datos[$k]'";
		 $RegA=mysql_query($Act)or die("Error al actualizar la tabla prestaciones");
           }
       endfor;
        echo "<script language=\"javascript\">";
        echo ("open (\"imprimircomprobante.php?NroComprobante=$Nroc\" ,\"\");");
        echo "</script>";
            ?>
              <script language="javascript">
                open("PagoGrupal.php?Usuario=<?echo $Usuario;?>","_self");
             </script>
          <?  
}
?>
