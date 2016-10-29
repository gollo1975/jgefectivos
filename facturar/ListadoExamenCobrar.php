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
                 Saldo = parseFloat(document.getElementById("CostoE[" + k + "]").value);
                 ValorP += parseFloat(Saldo);
                 document.getElementById("ValorTotal").value= ValorP.toFixed(0);
             }
         }
      }
      function Validar()
          {
              if (document.getElementById("ValorTotal").value.length <= 0)
                  {
                  alert ("No hay valores de cobro por examenes médicos.!");
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
<center><h4><u>Listado de Examenes</u> </h4></center>
<form action="GrabarCobroExamen.php" name="primero" method="post" id="IdIncapacidad" name="IdIncapacidad">
     <table border="0" align="center" width="500">
         <tr>
         <td><b>CodZona:</b></td>
         <td colspan="3"><input type="text" name="CodZona" value="<? echo $CodZona;?>"class="cajas" size="15" maxlength="13" readonly id="CodZona"></td>
         <td><b>Zona:</b></td>
         <td colspan="3"><input type="text" name="Zona" value="<?echo $FilaZona["zona"];?>" class="cajas" size="50"  readonly id="Zona"></td>
       </tr>
          <td><b>Valor_Cobro:</b></td>
         <td colspan="3"><input type="text" name="ValorTotal" value="" class="cajas" size="15"  readonly id="ValorTotal"></td>
       </tr>
       </tr>
       <tr>
            <td><b>Nota:</b></td>
            <td colspan="10"><textarea name="Nota" cols="74" rows="3" class="cajas" id="Nota">COBRO DE EXAMENES MEDICOS</textarea></td>
       </tr>
       <table border="0" align="center" width="450">
           <tr class="cajas">
            <th><b>Item</b></td><th>&nbsp;</th><th><b>Nro_Examen</b></th><th><b>Documento</b></th><th><b>Empleado</b></th><th><b>F_Examen</b></th><th><b>Validado</b></th><th><b>Cobrar_E</b></th><th><b>Vlr_Examen</b></th>
           </tr>
	       <?
	       $i=1;
               $Sql="select examen.* from examen,zona
                     where zona.codzona=examen.codzona and
                           zona.codzona='$CodZona' and
                          examen.pago='USUARIA' and
                          examen.cobrarexamen='SI' and
                          examen.posicion='FALTA' order by examen.fechap ASC";
	      $Rs=mysql_query($Sql)or die("Error la validar salario");
              $TotalRegistro = mysql_num_rows($Rs);
              if($TotalRegistro != 0){
	              $i=1;
		      while ($fila = mysql_fetch_array($Rs)):?>
	                    <tr class="cajas">
			        <th><?echo $i;?></th>
			          <?
	                          echo ("<td><input type=\"checkbox\" id=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $fila['nro'] ."\" onClick=\"Actualizar()\"></td>");?>
	      	                  <td><input type="text" value="<?echo $fila["nro"];?>" name="NroExamen[<? echo $i;?>]"id="NroExamen[<? echo $i;?>]" size="16" readonly class="cajas"></td>
	                          <td><input type="text" value="<?echo $fila["cedula"];?>" name="Documento[<? echo $i;?>]"id="Documento[<? echo $i;?>]" size="12" readonly class="cajas"></td>
		                  <td><input type="text" value="<?echo $fila["nombre"];?>" name="Empleado[<? echo $i;?>]"id="Empleado[<? echo $i;?>]" size="40" readonly class="cajas"></td>
	                          <td><input type="text" value="<?echo $fila["fechae"];?>" name="F_Examen[<? echo $i;?>]"id="F_Examen[<? echo $i;?>]" size="10" readonly class="cajas"></td>
	                          <td><input type="text" value="<?echo $fila["validadoso"];?>" name="Validado[<? echo $i;?>]"id="Validado[<? echo $i;?>]" size="8" readonly class="cajas"></td>
                                  <td><input type="text" value="<?echo $fila["cobrarexamen"];?>" name="Cobrar[<? echo $i;?>]"id="Cobrar[<? echo $i;?>]" size="8" readonly class="cajas"></td>
	                          <td><input type="text" value="<?echo $fila["costoe"];?>" name="CostoE[<? echo $i;?>]"id="CostoE[<? echo $i;?>]" size="12" readonly class="cajas" style="text-align:right;background-color:#FFB3B3"></td>
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
		       alert("No hay exámenes médicos para facturar a este cliente.!")
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

