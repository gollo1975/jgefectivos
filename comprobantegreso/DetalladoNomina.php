<html>
<head>
  <title>Creando Nomina</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">
function ActualizarSaldo()
         {
         var totalitem = document.getElementById("tActualizaciones").value
         var pagado = 0
         var nEle = document.f1.elements.length;
               for (i=0; i<nEle; i++) {
                  if (document.f1.elements[i].type=="checkbox" &&
	                document.f1.elements[i].name.lastIndexOf('datos')!=-1 ) {
			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
	          }
                }
         for (i=1;i<=totalitem;i++)
               {
                      pagado += parseFloat(document.getElementById("pagado[" + i+ "]").value);
                      f1.vlrpagado.value = pagado;
            }
       }

</script>

</head>
<body>
<?if(empty($TipoCta)):
?>
 <script language="javascript">
   alert("Seleccione el tipo de Cta bancaria.")
   history.back()
</script>
<?else:
    $nota=strtoupper($nota);
	include ("../conexion.php");
	$conB="select zona.zona,zona.nitzona,zona.dvzona from zona where zona.codzona='$CodZona'";
	$resB=mysql_query($conB) or die("Error al buscar zonas");
	$filas=mysql_fetch_array($resB);
        $consulta="select nomina.cedemple,nomina.neto,sum(nomina.presta)'TotalP',concat(nomemple, ' ' ,nomemple1,  ' ' ,apemple, ' ' ,apemple1) as Empleado,zona.zona,zona.nitzona from empleado,nomina,zona,periodo,banco
	  where zona.codzona=periodo.codzona and
	        zona.codzona='$CodZona' and
	        periodo.codigo=nomina.codigo and
	        nomina.cedemple=empleado.cedemple and
	        empleado.cuenta > 0 and
                empleado.codbanco=banco.codbanco and
                banco.codbanco='$codbanco' and
	        nomina.neto > 0  and
	        nomina.desde='$desde' and nomina.hasta='$hasta' group by empleado.nomemple, empleado.nomemple1, empleado.apemple,empleado.apemple1";
	$resN=mysql_query($consulta)or die("Error al buscar nominas");
	$regN=mysql_num_rows($resN);
	if($regN != 0):
	  ?>
	  <center><h4><u>Comprobante de Egreso</u></h4></center>
	  <form action="GrabarNomina.php" name="f1" method="post" id="f1">
	  <input type="hidden" name="TipoNomina" value="<?echo $TipoNomina;?>">
           <input type="hidden" name="TipoComprobante" value="<?echo $TipoComprobante;?>">
           <input type="hidden" value="<?echo $Usuario;?>" name="Usuario" id="Usuario">
          <input type="hidden" name="fechapagoN" value="<?echo $fechapagoN;?>">
	   <table border="0" align="center" width="590">
	       <tr>
	         <td><b>Nit/Cédula:</b></td>
	         <td><input type="text" value="<? echo $nit;?>" name="nit" size="14" class="cajas" readonly></td>
	         <td><b>Empresa:</b></td>
	         <td><input type="text" value="<? echo $empresa;?>" name="empresa" size="45" class="cajas" readonly></td>
	       </tr>
	       <td><b>Municipio:</b></td>
	         <td><input type="text" value="<? echo $municipio;?>" name="municipio" size="14"  class="cajas" readonly></td>
	         <td><b>Fecha_Pago:</b></td>
	         <td><input type="text" value="<? echo $fechapago;?>" name="fechapagoN" size="14"  class="cajas" readonly></td>
	       </tr>
	        <td><b>Nit_Proveedor:</b></td>
	         <td><input type="text" value="<? echo $filas["nitzona"];?>" name="codzona" size="14"  class="cajas" readonly></td>
	         <td><b>Zona:</b></td>
	         <td><input type="text" value="<? echo $filas["zona"];?>" name="zona" size="45"  class="cajas" readonly></td>
	       </tr>
	       </tr>
	      <td colspan="30"><b>Desde:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
	         <input type="text" name="desde" value="<?echo $desde;?>"  size="14" class="cajas" readonly>
	        <b>Hasta:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
	        <input type="text" name="hasta" value="<?echo $desde;?>"  size="14" class="cajas" readonly>
	        <b>Vlr_Pagado:</b>
	        <input type="text" name="vlrpagado" value="0"  size="14" class="cajas" >
	         </td>
	       </tr>
	    </table>
	    <table border="0" align="center">
	    <tr class="cajas">
	      <th><b>Item</b></td><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Cedula</b></th><th><b>Empleado</b></th><th><b>Vlr_Nomina</b></th>
	    </tr>
	    <tr><td><br></td><tr>
	    <?
	     $i=1;
	     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resN) . "\">");
	     while ($filas_s = mysql_fetch_array($resN)):
	          $FechaP=$fechapago
	           ?>
	           <tr class="cajas">
                   <th><?echo $i;?></th>
	              <?
	              echo ("<td><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_s['cedemple'] ."\" onClick=\"ActualizarSaldo()\"></td>");?>
	              <td><input type="text" value="<?echo $filas_s["cedemple"];?>"  size="13" readonly class="cajas"></td>
	              <td><input type="text" value="<?echo $filas_s["Empleado"];?>" name="empleado[<? echo $i;?>]"id="empleado[<? echo $i;?>]" size="45" readonly class="cajas"></td>
	              <input type="hidden" value="<?echo $FechaP;?>" name="fechapago[<? echo $i;?>]"id="fechapago[<? echo $i;?>]"size="11" readonly class="cajas">
	               <td><input type="text" value="<?echo $filas_s["neto"];?>" name="pagado[<? echo $i;?>]"id="pagado[<? echo $i;?>]"size="11"  class="cajas"></td>
	              <td><input type="hidden" value="BANCO" name="formapago[<? echo $i;?>]"id="formapago[<? echo $i;?>]"size="11" readonly class="cajas"></td>
	              <td><input type="hidden" value="<?echo $codbanco;?>" name="bancos[<? echo $i;?>]"id="bancos[<? echo $i;?>]"size="11" readonly class="cajas"></td>
	              <td><input type="hidden" value="<?echo $TipoCta;?>" name="cuenta[<? echo $i;?>]"id="cuenta[<? echo $i;?>]"size="11" readonly class="cajas"></td>
                      <td><input type="hidden" value="<?echo $nota;?>" name="nota[<? echo $i;?>]"id="nota[<? echo $i;?>]"size="30" readonly class="cajas"></td>
               <td><input type="hidden" value="<?echo $filas_s["nitzona"];?>" name="nitzona[<? echo $i;?>]"id="nitzona[<? echo $i;?>]"size="15" readonly class="cajas"></td>
               <td><input type="hidden" value="<?echo $filas_s["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]"size="40" readonly class="cajas"></td>

	            <tr>
	           <?
	           $i=$i+1;
	           $Suma=($Suma+$filas_s["Pago"]);
	     endwhile;
          ?>
          <tr><td><br></td></tr>
          <td colspan="5">
          <input type="submit" value="Grabar Dato" class="boton" ></td>
          </table>
          </form>
          <?
	else:
	   ?>
	   <script language="javascript">
	     alert("No existe pago de nomina en esta fecha de busqueda ?")
	     history.back()
	     </script>
	   <?
	endif;
endif;
?>
</body>
</html>
