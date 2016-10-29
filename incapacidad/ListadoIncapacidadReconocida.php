<html>
<head>
 <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script type="text/javascript">
      function Actualizar()
      {
         var Saldo = 0;
         var OtroValor = 0;
         var ValorP = 0;
         var Total = parseFloat(document.getElementById("TotalR").value);
         for (k=1;k<=Total;k++){
	     if (document.getElementById("datoN[" + k + "]").checked == true ){
                 Saldo = parseFloat(document.getElementById("TotalPago[" + k + "]").value);
                 ValorP += parseFloat(Saldo);
                 document.getElementById("ValorTotal").value= ValorP.toFixed(0);
             }
         }
      }
      function Validar()
          {
              if (document.getElementById("Nro_Factura").value.length <=0)
                  {
                   alert ("Digite el número de la factura para validar la nota credito.!");
                   document.getElementById("Nro_Factura").focus();
                  return;
                  }
              if (document.getElementById("ValorTotal").value.length <= 0)
                  {
                  alert ("No hay valores para el pago de las incapacidades.!");
                  document.getElementById("ValorTotal").focus();
                  return;
                  }
                  document.getElementById("IdIncapacidad").submit();

          }
</script>
</head>
<body>
<?php
include("../conexion.php");
$SqlZona="select zona.codzona,zona.zona  from zona
      where zona.codzona='$CodZona'";
$RsZona=mysql_query($SqlZona)or die("Error la validar la zona");
$FilaZona = mysql_fetch_array($RsZona);
?>
<center><h4><u>Listado de Incapacidades</u> </h4></center>
<form action="GrabarPagoIncapacidadZona.php" name="primero" method="post" id="IdIncapacidad" name="IdIncapacidad">
     <table border="0" align="center" width="500">
         <tr>
         <td><b>CodZona:</b></td>
         <td colspan="3"><input type="text" name="CodZona" value="<? echo $CodZona;?>"class="cajas" size="15" maxlength="13" readonly id="CodZona"></td>
         <td><b>Zona:</b></td>
         <td colspan="3"><input type="text" name="Zona" value="<?echo $FilaZona["zona"];?>" class="cajas" size="50"  readonly id="Zona"></td>
       </tr>
         <tr>
         <td><b>Nro_Factura:</b></td>
         <td colspan="3"><input type="text" name="Nro_Factura" value="" class="cajas" size="15" maxlength="15" id="Nro_Factura"></td>
          <td><b>Valor_Pagado:</b></td>
         <td colspan="3"><input type="text" name="ValorTotal" value="" class="cajas" size="12"  readonly id="ValorTotal"></td>
       </tr>

       </tr>
       <tr>
            <td><b>Nota:</b></td>
            <td colspan="10"><textarea name="Nota" cols="83" rows="3" class="cajas" id="Nota">RECONOCIMIENTO DE INCAPACIDADES</textarea></td>
       </tr>
       <table border="0" align="center" width="450">
           <tr class="cajas">
            <th><b>Item</b></td><th>&nbsp;</th><th><b>Nro_Incapacidad</b></th><th><b>Documento</b></th><th><b>Empleado</b></th><th><b>D_Inca.</b></th><th><b>D_Asumir</b></th><th><b>Desde</b></th><th><b>Hasta</b></th><th><b>Tipo_Incapacidad</b></th><th><b>Salario</b></th><th><b>Vlr_Pagar</b></th>
           </tr>
	       <?
	       $i=1;
               $Sql="select CONCAT(nomemple, ' ', nomemple1, ' ', apemple, ' ', apemple1) as Empleado,empleado.cedemple,incapacidad.nroinca,incapacidad.dias, incapacidad.diastemporal,incapacidad.salario,incapacidad.valortemporal,incapacidad.diasusuaria,tipoinca.concepto,incapacidad.fechaini,incapacidad.fechater
  		    from incapacidad,empleado,tipoinca
		    where empleado.cedemple=incapacidad.cedemple and
                          incapacidad.codzona='$CodZona' and
                          incapacidad.tipoinca=tipoinca.tipoinca and
                          incapacidad.reconocerusuaria='SI' and
                          incapacidad.pagada=' ' order by incapacidad.cedemple";
	      $Rs=mysql_query($Sql)or die("Error la validar salario");
              $TotalRegistro = mysql_num_rows($Rs);
              if($TotalRegistro != 0){
	              $i=1;
		      while ($fila = mysql_fetch_array($Rs)):?>
	                    <tr class="cajas">
			        <th><?echo $i;?></th>
			          <?
	                          echo ("<td><input type=\"checkbox\" id=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $fila['nroinca'] ."\" onClick=\"Actualizar()\"></td>");?>
	      	                  <td><input type="text" value="<?echo $fila["nroinca"];?>" name="NroIncapacidad[<? echo $i;?>]"id="NroIncapacidad[<? echo $i;?>]" size="16" readonly class="cajas"></td>
	                          <td><input type="text" value="<?echo $fila["cedemple"];?>" name="Documento[<? echo $i;?>]"id="Documento[<? echo $i;?>]" size="12" readonly class="cajas"></td>
		                  <td><input type="text" value="<?echo $fila["Empleado"];?>" name="Empleado[<? echo $i;?>]"id="Empleado[<? echo $i;?>]" size="40" readonly class="cajas"></td>
	                          <td><input type="text" value="<?echo $fila["dias"];?>" name="DiasGenerado[<? echo $i;?>]"id="DiasGenerado[<? echo $i;?>]" size="6" readonly class="cajas"></td>
	                          <td><input type="text" value="<?echo $fila["diastemporal"];?>" name="DiasAsumido[<? echo $i;?>]"id="DiasAsumido[<? echo $i;?>]" size="8" readonly class="cajas"></td>
	                          <td><input type="text" value="<?echo $fila["fechaini"];?>" name="Desde[<? echo $i;?>]"id="Desde[<? echo $i;?>]" size="10" readonly class="cajas"></td>
	                          <td><input type="text" value="<?echo $fila["fechater"];?>" name="Hasta[<? echo $i;?>]"id="Hsta[<? echo $i;?>]" size="10" readonly class="cajas"></td>
	                          <td><input type="text" value="<?echo $fila["concepto"];?>" name="Concepto[<? echo $i;?>]"id="Concepto[<? echo $i;?>]" size="25" readonly class="cajas"></td>
	                          <td><input type="text" value="<?echo $fila["salario"];?>" name="Salario[<? echo $i;?>]"id="Salario[<? echo $i;?>]" size="10" readonly class="cajas" style="text-align:right;background-color:#FFB3B3"></td>
	                          <td><input type="text" value="<?echo $fila["valortemporal"];?>" name="TotalPago[<? echo $i;?>]"id="TotalPago[<? echo $i;?>]" size="10" readonly class="cajas" style="text-align:right;background-color:#B8F9B0"></td>
		              <tr>
		                 <?
		                 $i=$i+1;
		       endwhile;
		       ?>
		       <td><input type="hidden" value="<?echo $TotalRegistro;?>" name="TotalR" id="TotalR" size="40" class="cajas" readonly></td>
		       <tr><td><br></td></tr>
	               <tr>
	                <td colspan="5"><input type="button" value="Generar" class="boton" name="Generar" onClick="Validar()" ></td>
	               </tr>
              <?
              }else{
                    ?>
		    <script language="javascript">
		       alert("No hay incapacidades para reconocimiento en esta Empresa.!")
		       history.back()
		    </script>
		    <?
              }
              ?>
              </table>
   </table>
</form>
</body>
</html>

