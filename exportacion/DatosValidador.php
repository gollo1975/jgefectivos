<html>

<head>
  <title>Detalle Eps y Pensión</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 <script language="javascript">
       function ActualizarSaldo()
         {
         totalitem = 0
         pagado = 0
         totalitem =  document.getElementById("tActualizaciones").value
         var nEle = document.f1.elements.length;
               for (i=0; i<nEle; i++) {
                  if (document.f1.elements[i].type=="checkbox" &&
	                document.f1.elements[i].name.lastIndexOf('datoN')!=-1 ) {
			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
	          }
                }
      }
</script>
<input type="hidden" value="<?echo $Desde;?>" name="Desde">
<input type="hidden" value="<?echo $Hasta;?>" name="Hasta">
<?php
if($datoN==''):
  ?>
   <script language="javascript">
      alert("Seleccione la empresa para Exportar la nómina.")
      history.back()
   </script>
  <?
else:?>
    <center><h4><u>Detalle Descuentos.</u></h4></center>
    <form action="ResultadoFinal.php" name="f1" id="f1" method="post">
        <input type="hidden" value="<?echo $Desde;?>" name="Desde">
        <input type="hidden" value="<?echo $Hasta;?>" name="Hasta">
        <table border="0" align="center" width=615">
	    <tr class="cajas">
	         <th><b>Item</b></td><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Zona</b></th><th>Desde</th><th><b>Hasta</b></th>
	   </tr> <?
        include("../conexion.php");
        $i=1;
        $lista=$_POST["datoN"];
        foreach($lista as $Codzona){
	    $consu="select concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as Empleado,nomina.cedemple,nomina.consecutivo,zona.zona from empleado,periodo,zona,nomina where
	    zona.codzona=periodo.codzona and
	    empleado.cedemple=nomina.cedemple and
	    periodo.codigo=nomina.codigo and
	    periodo.desde='$Desde' and periodo.hasta='$Hasta' and
	    zona.codzona='$Codzona' order by zona.zona,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
	    $resulta=mysql_query($consu)or die ("Error de busqueda de nomina");
	    $reg=mysql_num_rows($resulta);
	    echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resulta) . "\">");
	    while ($filas=mysql_fetch_array($resulta)){

	          ?>
	         <tr class="cajas">
	          <th><?echo $i;?></th>
	              <?
		      echo ("<td class=\"cajas\"><input type=\"checkbox\" id=name=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $filas['consecutivo'] ."\"\">" .$filas['consecutivo']."</td>");?>
		      <td class="cajas"><input type="text" value="<?echo $filas["Empleado"];?>" name="trabajador[<? echo $i;?>]"id="trabajador [<? echo $i;?>]" size="45" readonly class="cajas"></td>
		      <td class="cajas"><input type="text" value="<?echo $Desde;?>" name="desde[<? echo $i;?>]"id="desde[<? echo $i;?>]" size="12" readonly class="cajas"></td>
		      <td class="cajas"><input type="text" value="<?echo $Hasta;?>" name="hasta[<? echo $i;?>]"id="hasta[<? echo $i;?>]" size="12" readonly class="cajas"></td>
		  <tr>
		   <?
		 $i=$i+1;
         	    }
                }
         $Contador=$i-1;
         ?>
          <input type="hidden" value="<?echo $Contador;?>" name="Contador">
	    <tr><td><br></td></tr>
	    <td colspan="5">
	    <input type="submit" value="Exportar" class="boton" ></td>
	   </table>
    </form> <?
endif;
?>
</body>
</html>



