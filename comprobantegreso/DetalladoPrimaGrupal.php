<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<script type="text/javascript">
function ActualizarSaldo()
         {
         var totalitem = 0;
         var pagado = 0;
         totalitem = parseFloat(document.getElementById("TotalR").value);
         var nEle = document.f1.elements.length;
               for (i=0; i<nEle; i++) {
                  if (document.f1.elements[i].type=="checkbox" &&
	                document.f1.elements[i].name.lastIndexOf('datoN')!=-1 ) {
			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
	          }
                }
         for (i=1;i<=totalitem;i++)
               {
                     pagado += parseFloat(document.getElementById("pagado[" + i+ "]").value);
                      document.getElementById("vlrpagado").value =  pagado;
            }
       }

</script>
<?
if($datoZ==''):

  ?>
   <script language="javascript">
      alert("Debe de seleccionar al menos una empresa del sistema.")
      history.back()
   </script>
  <?
  elseif(empty($municipio)):
  ?>
   <script language="javascript">
      alert("Seleccione el municipio de pago para el documento.")
      history.back()
   </script>
  <?
  elseif(empty($TipoCta)):
  ?>
   <script language="javascript">
      alert("Seleccione el tipo de cuenta de pago.")
      history.back()
   </script>
  <?
   elseif(empty($banco)):
  ?>
   <script language="javascript">
      alert("Seleccione un banco de la lista")
      history.back()
   </script>
  <?
   elseif(empty($TipoComprobante)):
  ?>
   <script language="javascript">
      alert("Seleccione de la lista el tipo de comprobante.!")
      history.back()
   </script>
  <?
  else:
  ?>
	<center><h4><u>Comprobantes Egreso</u></h4></center>
	<form action="GrabarNominaGrupal.php" method="post" name="f1">
        <input type="hidden" name="municipio" value="<?echo $municipio;?>">
        <input type="hidden" value="<?echo $Usuario;?>" name="Usuario" id="Usuario">
        <input type="hidden" name="TipoPago" value="<?echo $TipoPago;?>">
	   <table border="0" align="center" width="555">
	    <tr>
	    <tr><td><br></td></tr>
	    <tr>
	       <td><b>Nit/Cedula:&nbsp;&nbsp;&nbsp;</b></td>
	       <td><input type="text" name="nit" value="<? echo $nit;?>" size="13" readonly class="cajas"></td>
	       <td><b>Empresa:</b></td>
	       <td><input type="text" name="empresa" value="<?echo $empresa;?>" size="47" class="cajas" readonly></td>
	    </tr>
	    <tr>
               <td colspan="30"><b>Cod_Muni.:&nbsp;&nbsp;&nbsp;</b>
	      <input type="text" name="municipio" value="<?echo $municipio;?>" size="13" class="cajas" readonly>
	      <b>F_Pago:&nbsp;</b>
	      <input type="text" name="fechapagoN" value="<?echo $fechapago;?>" size="13" readonly class="cajas">
	      <b>Vlr_Pago:&nbsp;&nbsp;&nbsp;&nbsp;</b>
	      <input type="text" name="vlrpagado" value="0" size="13"  class="cajas" id="vlrpagado" style="text-align:right;background-color:#9BCDFF"></td>
	      </tr>
	      <tr>
	       <td colspan="30"><b>Desde:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
	       <input type="text" name="desde" value="<? echo $desde;?>" size="13"  class="cajas" readonly>
	       <b>Hasta:&nbsp;&nbsp;&nbsp;&nbsp;</b>
	       <input type="text" name="hasta" value="<?echo $hasta;?>" size="13" class="cajas" readonly>
	       <b>Tipoc_Cta:&nbsp;&nbsp;&nbsp;</b>
	      <input type="text" name="tipocta" value="<?echo $TipoCta;?>" size="13" class="cajas" readonly>
	      </tr>
               <tr>
               <td colspan="30"><b>Forma_Pago:</b>
               <input type="text" name="formapago" value="<?echo $formapago;?>" size="13" class="cajas" readonly>
               <b>Banco:&nbsp;&nbsp;&nbsp;&nbsp;</b>
               <input type="text" name="banco" value="<?echo $banco;?>" size="13" class="cajas" readonly>
	       <b>Tipo_Comp.:</b>
               <input type="text" name="TipoComprobante" value="<?echo $TipoComprobante;?>" size="13" class="cajas" readonly>
	       </tr>
	         <tr><td><b>Nota:</b></td>
	         <td colspan="30"><input type="text" value="<?echo $nota;?> " name="nota" size="39"  class="cajas" readonly></td>
	      </tr>
              </table>
               <table border="0" align="center" width="650">
	          <tr class="cajas">
	             <th><b>Item</b></td><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Cedula</b></th><th><b>Empleado</b></th><th><b>Vlr_Nomina</b></th><th><b>Zona</b></th>
	          </tr>
	     <?
              $i=1;
              $suma=0;
   	     include("../conexion.php");
             $lista=$_POST["datoZ"];
              foreach($lista as $Codzona){
                       $conB="select zona.zona,prima.nombre,prima.cedemple,prima.total,zona.nitzona,prima.nroprima from empleado,prima,zona,banco
		        where zona.codzona = prima.codzona and
                        empleado.cedemple=prima.cedemple and
                         zona.codzona='$Codzona' and
			  empleado.codbanco=banco.codbanco and
			  banco.codbanco= '$banco' and
                       empleado.cuenta > 0 and
                       prima.total > 0 and
		        prima.fechap between '$desde' and '$hasta' order by zona.zona,prima.nombre ASC";
		     $resB=mysql_query($conB) or die("Error al buscar primas");
                     $regZ= mysql_num_rows($resB);
                     $Cont=$Cont +$regZ;
		     while ($filas_s = mysql_fetch_array($resB)):
                        $suma=$suma + $filas_s["total"];
                          $FechaP=$fechapago;
						  ?>
		           <tr class="cajas">
	                   <th><?echo $i;?></th>
		              <?
		              echo ("<td><input type=\"checkbox\" id=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $filas_s['cedemple'] ."\" onClick=\"ActualizarSaldo()\"></td>");?>
		              <td><input type="text" value="<?echo $filas_s["cedemple"];?>"  size="13" readonly class="cajas"></td>
		              <td><input type="text" value="<?echo $filas_s["nombre"];?>" name="empleado[<? echo $i;?>]"id="empleado[<? echo $i;?>]" size="45" readonly class="cajas"></td>
		              <input type="hidden" value="<?echo $FechaP;?>" name="fechapago[<? echo $i;?>]"id="fechapago[<? echo $i;?>]"size="11" readonly class="cajas">
		              <td><input type="text" value="<?echo $filas_s["total"];?>" name="pagado[<? echo $i;?>]"id="pagado[<? echo $i;?>]"size="11"  class="cajas"></td>
		              <input type="hidden" value="<?echo $formapago;?>" name="formapago[<? echo $i;?>]"id="formapago[<? echo $i;?>]"size="11" readonly class="cajas"></td>
		              <input type="hidden" value="<?echo $banco;?>" name="bancos[<? echo $i;?>]"id="bancos[<? echo $i;?>]"size="11" readonly class="cajas"></td>
		             <input type="hidden" value="<?echo $TipoCta;?>" name="cuenta[<? echo $i;?>]"id="cuenta[<? echo $i;?>]"size="11" readonly class="cajas"></td>
	                  <input type="hidden" value="<?echo $nota;?>" name="nota[<? echo $i;?>]"id="nota[<? echo $i;?>]"size="30" readonly class="cajas"></td>
                      <td><input type="text" value="<?echo $filas_s["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]"size="40" class="cajas" readonly></td>
                      <td><input type="hidden" value="<?echo $filas_s["nitzona"];?>" name="nitzona[<? echo $i;?>]"id="nitzona[<? echo $i;?>]"size="15" class="cajas" readonly></td>
			          <td><input type="text" value="<?echo $filas_s["nroprima"];?>" name="NroPrima[<? echo $i;?>]"id="NroPrima[<? echo $i;?>]"size="10" class="cajas" readonly></td>   
		            <tr>
		           <?
		           $i=$i+1;
		     endwhile;

                 }
	          ?>
                  <td><input type="hidden" value="<?echo $suma;?>" name="totalpagado" size="15" class="cajas" readonly></td>
                  <td><input type="hidden" value="<?echo $Cont;?>" name="TotalR" id="TotalR" size="15" class="cajas" readonly></td>
	      <tr><td><br></td></tr>
	      <td colspan="5">
	          <input type="submit" value="Enviar Dato" class="boton" ></td>
	     </table>
	   </form>
 <?
 endif;
 ?>
</body>
</html>
