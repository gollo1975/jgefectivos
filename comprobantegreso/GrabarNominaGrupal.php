<input type="hidden" name="fechapago" value="<?echo $fechapago;?>">
<input type="hidden" value="<?echo $Usuario;?>" name="Usuario" id="Usuario">
<?
if(empty($datoN)):
   ?>
   <script language="javascript">
      alert("Debe de chequear todas las cajas de verificacion para generar el Documento.")
      history.back()
   </script>
   <?
else:
   include("../numeros.php");
   $letras=num2letras($vlrpagado);
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
                   values('$Nroc','$nit','$municipio','$FechaV','$fechapagoN','$vlrpagado','$letras','$TipoComprobante','$Usuario')";
        $resultado=mysql_query($consulta)or die("inserección incorrecta $consulta");
        $registro=mysql_affected_rows();
         for ($k=1 ; $k<=$TotalR; $k ++):
           if   ($datoN[$k] != ""):
              if   ($pagado[$k] != '0'):
                 $con="insert into comprobante(nro,nitprove,cliente,fecha,valor,pago,codbanco,cuenta,concepto,nitzona,zona)
                 values('$Nroc','$datoN[$k]','$empleado[$k]','$fechapago[$k]','$pagado[$k]','$formapago[$k]','$bancos[$k]','$cuenta[$k]','$nota[$k]','$nitzona[$k]','$zona[$k]')";
                 $resulta=mysql_query($con)or die("Error al grabar detallado de Novedades de nomina ");
				 if($TipoPago=='prima'){
				 $Sql="update prima set estado='PAGADO' where prima.nroprima='$NroPrima[$k]'";
				 $Rs=mysql_query($Sql)or die("Error al al activar colillas");
				 }
                 $registro=mysql_affected_rows();
              endif;   
           endif;
       endfor;
        echo "<script language=\"javascript\">";
        echo ("open (\"imprimircomprobante.php?NroComprobante=$Nroc\" ,\"\");");
        echo "</script>";
            ?>
              <script language="javascript">
                open("PagoGrupal.php?Usuario=<?echo $Usuario;?>","_self");
             </script>
          <?
endif;
     ?>
