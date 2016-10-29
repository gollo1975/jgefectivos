<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<script type="text/javascript">
function ActualizarSaldo()
         {
         var totalitem = 0
         var pagado = 0
         totalitem =  document.getElementById("TotalR").value
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
<? if($datos==''):
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
      alert("Seleccione un tipo de comprobante de la lista.!")
      history.back()
   </script>
  <?
  else:
     include("../conexion.php");
     $conT="select tipocomprobante.descripcion from tipocomprobante where tipocomprobante.id='$TipoComprobante'";
    $resT=mysql_query($conT) or die("Error al buscar comprobantes");
    $filasC=mysql_fetch_array($resT);
    $Concepto=$filasC["descripcion"];
  ?>
	<center><h4><u>Comprobantes Egreso</u></h4></center>
	<form action="GrabarNominaGrupal.php" method="post" name="f1" id="f1">
        <input type="hidden" name="municipio" value="<?echo $municipio;?>">
        <input type="hidden" value="<?echo $Usuario;?>" name="Usuario" id="Usuario">
	   <table border="0" align="center" width="510">
	    <tr>
	    <tr><td><br></td></tr>
	    <tr>
	       <td><b>Nit/Cedula:</b></td>
	       <td><input type="text" name="nit" value="<? echo $nit;?>" size="13" readonly class="cajas"></td>
	       <td><b>Empresa:</b></td>
	       <td><input type="text" name="empresa" value="<?echo $empresa;?>" size="40" class="cajas" readonly></td>
	    </tr>
	    <tr>
               <td><b>Cod_Muni.:</b></td>
	         <td><input type="text" name="municipio" value="<?echo $municipio;?>" size="13" class="cajas" readonly>
	         <td><b>F_Pago:</b></td>
	           <td><input type="text" name="fechapagoN" value="<?echo $fechapago;?>" size="13" readonly class="cajas">
             </tr>
             <tr>
	           <td><b>Vlr_Pago:</b></td>
	           <td><input type="text" name="vlrpagado" value="" size="13"  class="cajas" id="vlrpagado" style="text-align:right;background-color:#FF9595"></td>
	           <td><b>Desde:</b></td>
	           <td><input type="text" name="desde" value="<? echo $desde;?>" size="13"  class="cajas" readonly></td>
            </tr>
            <tr>
	           <td><b>Hasta:</b></td>
	            <td><input type="text" name="hasta" value="<?echo $hasta;?>" size="13" class="cajas" readonly></td>
	            <td><b>Tipoc_Cta:</b></td>
	            <td><input type="text" name="tipocta" value="<?echo $TipoCta;?>" size="13" class="cajas" readonly></td>
	      </tr>
               <tr>
                  <td><b>Forma_Pago:</b></td>
                  <td><input type="text" name="formapago" value="<?echo $formapago;?>" size="13" class="cajas" readonly></td>
                 <td><b>Banco:</b></td>
                 <td><input type="text" name="banco" value="<?echo $banco;?>" size="13" class="cajas" readonly></td>
	       </tr>
                 <tr>
                  <td><b>Id_Comp.:</b></td>
                  <td><input type="text" name="TipoComprobante" value="<?echo $TipoComprobante;?>" size="13" class="cajas" readonly></td>
                 <td><b>Concepto:</b></td>
                 <td><input type="text" value="<?echo $Concepto;?>" size="40" class="cajas" readonly></td>
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
             $lista=$_POST["datos"];
              foreach($lista as $Codzona){
                       $conB="select zona.zona,nomina.cedemple,nomina.neto,concat(nomemple, ' ' ,nomemple1,  ' ' ,apemple, ' ' ,apemple1) as Empleado,zona.nitzona from empleado,nomina,zona,periodo,banco
		         where zona.codzona=nomina.codzona and
                        zona.codzona=periodo.codzona and
                         nomina.cedemple=empleado.cedemple and
                         periodo.codigo=nomina.codigo and
		                zona.codzona='$Codzona' and
		                empleado.cuenta > 0 and
                        empleado.codbanco=banco.codbanco and
                        banco.codbanco='$banco' and
		                nomina.neto > 0  and
		                periodo.desde='$desde' and periodo.hasta='$hasta' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
		     $resB=mysql_query($conB) or die("Error al buscar zonas");
                     $regZ= mysql_num_rows($resB);
                     $Cont = $Cont + $regZ;
		     while ($filas_s = mysql_fetch_array($resB)):
                        $suma=$suma + $filas_s["neto"];
                          $FechaP=$fechapago
		           ?>
		           <tr class="cajas">
	                   <th><?echo $i;?></th>
		              <?
		              echo ("<td><input type=\"checkbox\" id=name=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $filas_s['cedemple'] ."\" onClick=\"ActualizarSaldo()\"></td>");?>
		              <td><input type="text" value="<?echo $filas_s["cedemple"];?>"  size="13" readonly class="cajas"></td>
		              <td><input type="text" value="<?echo $filas_s["Empleado"];?>" name="empleado[<? echo $i;?>]"id="empleado[<? echo $i;?>]" size="45" readonly class="cajas"></td>
		              <input type="hidden" value="<?echo $FechaP;?>" name="fechapago[<? echo $i;?>]"id="fechapago[<? echo $i;?>]"size="11" readonly class="cajas">
		              <td><input type="text" value="<?echo $filas_s["neto"];?>" name="pagado[<? echo $i;?>]"id="pagado[<? echo $i;?>]"size="11"  class="cajas"></td>
		              <input type="hidden" value="<?echo $formapago;?>" name="formapago[<? echo $i;?>]"id="formapago[<? echo $i;?>]"size="11" readonly class="cajas"></td>
		              <input type="hidden" value="<?echo $banco;?>" name="bancos[<? echo $i;?>]"id="bancos[<? echo $i;?>]"size="11" readonly class="cajas"></td>
		             <input type="hidden" value="<?echo $TipoCta;?>" name="cuenta[<? echo $i;?>]"id="cuenta[<? echo $i;?>]"size="11" readonly class="cajas"></td>
	                      <input type="hidden" value="<?echo $nota;?>" name="nota[<? echo $i;?>]"id="nota[<? echo $i;?>]"size="30" readonly class="cajas"></td>
                              <td><input type="text" value="<?echo $filas_s["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]"size="40" class="cajas" readonly></td>
                               <td><input type="hidden" value="<?echo $filas_s["nitzona"];?>" name="nitzona[<? echo $i;?>]"id="nitzona[<? echo $i;?>]"size="15" class="cajas" readonly></td>
		            <tr>
		           <?
		           $i=$i+1;
		     endwhile;
                 }
	          ?>
                  <td><input type="hidden" value="<?echo $Cont;?>" name="TotalR"id="TotalR" size="40" class="cajas" readonly></td>
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
