<?
if(empty($datoN)){
   ?>
   <script language="javascript">
      alert("Debe de chequear las diferentes cajas de verificacion para generar el Documento.!")
      history.back()
   </script>
   <?
}else{
      include("../conexion.php");
      $Sql="select factura.nrofactura
           from factura
           where factura.nrofactura='$Nro_Factura' and
                 factura.codzona='$CodZona' and
                 factura.nsaldo != 0";
      $Rs=mysql_query($Sql)or die("Error la validar la factura");
      $Cont= mysql_num_rows($Rs);
      if($Cont != 0){
	   include("../numeros.php");
	   $letras=num2letras($ValorTotal);
	   $letras=strtoupper($letras);
	   $Nota=strtoupper($Nota);
	   $FechaV=date("Y-m-d");
            include("../conexion.php");
	   $consulta = "select count(*) from pagozona";
	        $result = mysql_query ($consulta);
	        $sw = mysql_fetch_row($result);
	        if ($sw[0]>0):
	           $consulta = "select max(cast(radicado as unsigned)) + 1 from pagozona";
	           $result = mysql_query($consulta) or die ("Fallo en la consulta");
	           $codco = mysql_fetch_row($result);
	           $Nroc = str_pad ($codco[0], 6, "0", STR_PAD_LEFT);
	        else:
	          $Nroc="000001";
	        endif;
	       $consulta="insert into pagozona(radicado,codzona,zona,nrofactura,nota,totalpagar,letras,fechap)
	                   values('$Nroc','$CodZona','$Zona','$Nro_Factura','$Nota','$ValorTotal','$letras','$FechaV')";
	        $resultado=mysql_query($consulta)or die("Error al grabar el dato del pago de la incapacidad parte incial.!");
	        $registro=mysql_affected_rows();
	        for ($k=1 ; $k<=$TotalR; $k ++){
		     if   ($datoN[$k] != ""){
	                  $con="insert into depagozona(nroinca,cedemple,empleado,dias,diaspagado,desde,hasta,tipoincapacidad,salario,total,radicado)
		          values('$datoN[$k]','$Documento[$k]','$Empleado[$k]','$DiasGenerado[$k]','$DiasAsumido[$k]','$Desde[$k]','$Hasta[$k]','$Concepto[$k]','$Salario[$k]','$TotalPago[$k]','$Nroc')";
		          $resulta=mysql_query($con)or die("Error al grabar el detalle del pago de las incapacidades ");
		          $registro=mysql_affected_rows();
		          $Act="update incapacidad set pagada='SI' where incapacidad.nroinca='$datoN[$k]'";
			  $RegA=mysql_query($Act)or die("Error al actualizar la tabla incapacidad");
		    }
	       }
	       echo "<script language=\"javascript\">";
	       echo ("open (\"ReportePagoIncapacidad.php?NroPago=$Nroc\" ,\"\");");
	        echo "</script>";
	        ?>
	              <script language="javascript">
	              	open("PagarZona.php","_self");
	             </script>
	        <?
      }else{
          ?>
          <script language="javascript">
              alert("Este Número de factura esta cancelada o no pertenece a esta Empresa. Favor validar esta información.!");
              history.back()
          </script>
          <?
      }
}
?>
