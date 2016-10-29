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
                 pagado += parseFloat(document.getElementById("TotalV[" + i+ "]").value);
                 f1.VlrPagado.value = pagado;
            }
       }

</script>

</head>
<body>
<?if(empty($municipio)):
?>
 <script language="javascript">
   alert("Seleccione el Municipio de la lista!")
   history.back()
</script>
<?elseif(empty($FormaPago)):
?>
 <script language="javascript">
   alert("Seleccione la forma de pago del archivo!")
   history.back()
</script>
<?elseif(empty($TipoCta)):
?>
 <script language="javascript">
   alert("Seleccione el tipo de Producto!")
   history.back()
</script>
<?elseif(empty($codbanco)):
?>
 <script language="javascript">
   alert("Seleccione la entidad bancaria!")
   history.back()
</script>
<?elseif(empty($TipoComprobante)):
?>
 <script language="javascript">
   alert("Seleccione el tipo de comprobante de la lista.!")
   history.back()
</script>
<?elseif(empty($NroPago)):
?>
 <script language="javascript">
   alert("Digite el Nro de la programación de pago de Prestaciones!")
   history.back()
</script>
<?else:
    $nota=strtoupper($nota);
	include ("../conexion.php");
        /*perrmite mostra el cabezo del comprobante*/
        $Con="select municipio.municipio,banco.bancos from maestro,banco,municipio
	where maestro.codmaestro=banco.codmaestro and
	      maestro.codmuni=municipio.codmuni and
              maestro.codmaestro='$NitEmpresa'";
	$resC=mysql_query($Con)or die("Error al buscar Empresa");
        $filasE = mysql_fetch_array($resC);

        /*fin consulta*/
        $ConV="select detallepagoprestacion.*,programarprestacion.vlrpagado,zona.nitzona from detallepagoprestacion,zona,programarprestacion
	where programarprestacion.idprogramapresta=detallepagoprestacion.idprogramapresta and
	      detallepagoprestacion.codzona=zona.codzona and
          detallepagoprestacion.idprogramapresta='$NroPago' order by detallepagoprestacion.zona";
	$resN=mysql_query($ConV)or die("Error al buscar prestaciones");
	$regN=mysql_num_rows($resN);  
	if($regN != 0):
	  ?>
	  <center><h4><u>Comprobante de Egreso[Prestacione]</u></h4></center>
	  <form action="GrabarPagoPrestacion.php" name="f1" method="post" id="f1">
	  <input type="hidden" name="TipoNomina" value="<?echo $TipoNomina;?>">
          <input type="hidden" name="TipoComprobante" value="<?echo $TipoComprobante;?>">
           <input type="hidden" value="<?echo $Usuario;?>" name="Usuario" id="Usuario">  
           <input type="hidden" name="fechapago" value="<?echo $fechapago;?>">
	   <table border="0" align="center" width="590">
	       <tr>
	         <td><b>Nit/Cédula:</b></td>
	         <td><input type="text" value="<? echo $NitEmpresa;?>" name="NitEmpresa" size="12" class="cajas" readonly id="NitEmpresa"></td>
	         <td><b>Empresa:</b></td>
	         <td><input type="text" value="<? echo $empresa;?>" name="empresa" size="47" class="cajas" readonly ></td>
	       </tr>
	       <td><b>Cod_Municipio:</b></td>
	         <td><input type="text" value="<? echo $municipio;?>" name="municipio" size="12" class="cajas" readonly id="municipio"></td>
	         <td><b>Municipio</b></td>
	         <td><input type="text" value="<? echo $filasE["municipio"];?>" name="" size="47" class="cajas" readonly></td>
	       </tr>
               <tr>
                <td><b>Cod_Banco:</b></td>
	         <td><input type="text" value="<? echo $codbanco;?>" name="codbanco" size="12" class="cajas" readonly id="codbanco"></td>
	         <td><b>Banco:</b></td>
	         <td><input type="text" value="<? echo $filasE["bancos"];?>" name="" size="47" class="cajas" readonly ></td>
	       </tr>
               </tr>
                <td><b>F_Pago:</b></td>
	         <td><input type="text" value="<? echo $fechapago;?>" name="fechapago" size="12" class="cajas" readonly id="fechapago"></td>
	         <td><b>Forma_Pago:</b></td>
	         <td><input type="text" value="<? echo $FormaPago;?>" name="FormaPago" size="15" class="cajas" readonly id="FormaPago">
                <b>Tipo_Producto:</b>
	         <input type="text" value="<? echo $TipoCta;?>" name="TipoCta" size="12" class="cajas" readonly id="TipoCta"></td>
	       </tr>
                <tr>
	        <td colspan="15"><b>Nota:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
	         <input type="text" value="<?echo $Nota;?>" name="Nota" size="45" maxlength="35" class="cajas" id="Nota" readonly>
                  <b>Vlr_Pagado:</b>
	         <input type="text" value="0" name="VlrPagado" size="15" class="cajas" id="VlrPagado" readonly></td>
	       </tr>
	    </table>
	    <table border="0" align="center">
	    <tr class="cajas">
	      <th><b>Item</b></td><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Nro_Vaca.</b></th><th><b>Cedula</b></th><th><b>Empleado</b></th><th><b>Vlr_Pagar</b></th><th><b>Zona</b></th>
	    </tr>

	    <?
	     $i=1;
	     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resN) . "\">");
	     while ($filas_s = mysql_fetch_array($resN)):
                 $ValidarPago=$filas_s["vlrpagado"];
           ?>
	           <tr class="cajas">
                   <th><?echo $i;?></th>
	              <?
	              echo ("<td><input type=\"checkbox\" id=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_s['nropresta'] ."\" onClick=\"ActualizarSaldo()\"></td>");?>
	             <td><input type="text" value="<?echo $filas_s["nropresta"];?>" name="NroV[<? echo $i;?>]"id="NroV[<? echo $i;?>]" size="8" readonly class="cajas"></td>
                     <td><input type="text" value="<?echo $filas_s["cedemple"];?>" name="Documento[<? echo $i;?>]"id="Documento[<? echo $i;?>]" size="13" readonly class="cajas"></td>
	              <td><input type="text" value="<?echo $filas_s["empleado"];?>" name="empleado[<? echo $i;?>]"id="empleado[<? echo $i;?>]" size="45" readonly class="cajas"></td>
	              <td><input type="text" value="<?echo $filas_s["total"];?>" name="TotalV[<? echo $i;?>]"id="TotalV[<? echo $i;?>]"size="11" readonly class="cajas"></td>
                      <td><input type="text" value="<?echo $filas_s["zona"];?>" name="Zona[<? echo $i;?>]"id="Zona[<? echo $i;?>]"size="47" readonly class="cajas"></td>
                      <td><input type="hidden" value="<?echo $filas_s["nitzona"];?>" name="NitZona[<? echo $i;?>]"id="NitZona[<? echo $i;?>]"size="15" readonly class="cajas"></td>
                      <td><input type="hidden" value="<?echo $ValidarPago;?>" name="ValidarPago" size="15" readonly class="cajas"></td>

	            <tr>
	           <?
	           $i=$i+1;
	     endwhile;
          ?>
          <tr><td><br></td></tr>
          <td colspan="5">
          <input type="submit" value="Grabar Dato" class="boton" id="grabar" name="grabar" ></td>
          </table>
          </form>
          <?
	else:
	   ?>
	   <script language="javascript">
	     alert("Este Número de programación para pago de vacaciones, no existe!.")
	     history.back()
	     </script>
	   <?
	endif;
endif;
?>
</body>
</html>
