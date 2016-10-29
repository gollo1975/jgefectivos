<html>
<head>
                <title>Auditoria de Examenes</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
<script language="javascript">
    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
    function enviar()
        {
        if (document.getElementById("cedemple").value.length <=0)
           {
                alert ("Digite el Documento del Empleado para auditar el examen!.");
                document.getElementById("cedemple").focus();
                return;
           }
             document.getElementById("f1").submit();
       }
</script>
     <?
if (!isset($cedemple)){
    ?>
    <center><h4><u>Auditoria de Examenes</u></h4></center>
    <form action="" method="post" id ="f1" name="f1">
          <table border="0" align="center"
          <tr><td><br></td></tr>
          <tr>
          <td><b>Documento de identidad:</b></td>
          <td><input type="text" name="cedemple" value="" size="15" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
          </tr>
          <tr><td><br></td></tr>
          <tr><td ><input type="button" Value="Buscar" class="boton" onclick="enviar()" id="buscar" name="buscar"></td></tr>
       </table>
   </form>
<?
}else{
   include("../conexion.php");
  $con="select dexamen.nro,dexamen.zona,dexamen.vlrexamen from dexamen
   where dexamen.cedula='$cedemple'";
   $resu=mysql_query($con)or die ("Error al buscar datos del examen.");
   $reg=mysql_num_rows($resu);
   if($reg!=0){
       $conA="select dexamen.nro,dexamen.zona,dexamen.vlrexamen from dexamen
       where dexamen.cedula='$cedemple' and dexamen.auditoria='' ";
       $resuA=mysql_query($conA)or die ("Error al buscar datos del examen.");
       $regA=mysql_num_rows($resuA);
       if($regA !=0 ){
	       while ($fila=mysql_fetch_array($resu)){
	           $NroE=$fila["nro"];
	           $VlrProvedor=$fila["vlrexamen"];
	           $Zona=$fila["zona"];
	          $conR="select derelacionexamen.* from derelacionexamen,dexamen
		   where dexamen.nro=derelacionexamen.nro and
	                 dexamen.auditoria='' and
	                 dexamen.estado='FALTA POR COBRAR' and
	                 derelacionexamen.cedemple='$cedemple' and
	                 derelacionexamen.nro='$NroE'";
		   $resuR=mysql_query($conR)or die ("Error al buscar datos en la relacion de cobro a cliente!");
		   $regR=mysql_num_rows($resuR);
	           if($regR !=0){?>
	                <center><h4><u>Auditoria de Examenes</u></h4></center>
	                <form action="GrabarAuditoria.php" method="post" id="f2" name="f2">
	                <table border="0" align="center" width="700">
			      <tr class="cajas">
			         <th>Reg.</th>
			         <th>Nro_Exam.</th>
	                         <th>Documento</th>
			         <th>Empleado</th>
			         <th>Cobro_Clien.</th>
			         <th>Cobro_Prov.</th>
	                         <th>Diferencia</th>
	                         <th>Zona</th>
			      </tr>
	               <?
	               $i=1;
	                 echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . $regR . "\">");
	               while($filaP=mysql_fetch_array($resuR)){
	                   $Diferencia=$filaP["valor"]-$VlrProvedor;
	                  ?>
	                  <tr class="cajas">
		             <th><?echo $i;?></th>
			     <?
			     echo ("<td><input type=\"checkbox\" id=name=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"". $NroE ."\" onClick=\"ActualizarSaldo()\">".$NroE."</td>");?>
			     <td><input type="text" value="<?echo $filaP["cedemple"];?>" name="cedula[<? echo $i;?>]"id="cedula[<? echo $i;?>]" size="12" readonly class="cajas"></td>
			     <td><input type="text" value="<?echo $filaP["empleado"];?>" name="empleado[<? echo $i;?>]"id="empleado[<? echo $i;?>]"size="41" readonly class="cajas">
			     <td><input type="text" value="<?echo $filaP["valor"];?>" name="vlrcliente[<? echo $i;?>]"id="vlrcliente[<? echo $i;?>]"size="11"  class="cajas"></td>
			     <td><input type="text" value="<?echo $VlrProvedor;?>" name="VlrProve[<? echo $i;?>]"id="VlrProve[<? echo $i;?>]"size="11" readonly class="cajas"></td>
	                     <?if($Diferencia < 0){?>
			        <td><input type="text" value="<?echo $Diferencia;?>" name="VlrDiferencia[<? echo $i;?>]"id="VlrDiferencia[<? echo $i;?>]"size="11" style="text-align:right;background-color:orange" readonly class="cajas"></td>
	                     <?}else{?>
	                        <td><input type="text" value="<?echo $Diferencia;?>" name="VlrDiferencia[<? echo $i;?>]"id="VlrDiferencia[<? echo $i;?>]"size="11" readonly class="cajas"></td>
	                    <?}?>
			     <td><input type="text" value="<?echo $Zona;?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]"size="35" readonly class="cajas"></td>
			  <tr>
			  <?
			  $i=$i+1;
	               }
	             ?>
	              <tr><td><br></td></tr>
	                 <tr><td colspan="5" ><input type="submit" Value="Grabar" class="boton" id="grabar" name="grabar"></td></tr>
		     </table>
	            </fomr>
		     <?
	           }
                }
        }else{
             ?>
	         <script language="javascript">
	          alert("Este empleado ya tiene la auditoria, favor revisar!")
	          history.back()
	         </script>
	     <?
        }
   }else{
        ?>
         <script language="javascript">
          alert("Este empleado no se le puede hacer auditoria y/o no se ha descargado el examen medico!")
          history.back()
         </script>
         <?
   }
}
?>
</body>
</html>
