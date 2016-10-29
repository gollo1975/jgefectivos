<html>
<head>
    <title>Carta Laboral</title>
    <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
<?
include ("../conexion.php");
$SqlS="select parametrolicenciapermiso.* from parametrolicenciapermiso where parametrolicenciapermiso.estado='CARTA' order by codsala";
$RsS=mysql_query($SqlS)or die("Error la validar salario");
$TotalRegistro = mysql_num_rows($RsS);
?>
<center><h4><u>Carta Laboral</u></h4></center>
<form action="ImprimirCartaEmpleado.php" method="post" id="inicio">
<input type="hidden" value="<?echo $xcodigo;?>" name="xcodigo" id="$xcodigo">
    <table border="0" align="center"
         <table border="0" align="center" width="300">
	       <tr class="cajas">
		      <th><b>Item</b></td><th>&nbsp;</th><th><b>Codigo</b></th><th><b>Descripción</b></th>
	       </tr>
	       <?
	       $i=1;
	       $Sql="select parametrolicenciapermiso.* from parametrolicenciapermiso where parametrolicenciapermiso.estado='CARTA'";
	       $Rs=mysql_query($Sql)or die("Error la validar salario");
               $TotalRegistro = mysql_num_rows($Rs);
	       while ($fila = mysql_fetch_array($Rs)):
	              ?>
	              <tr class="cajas">
	                  <th><?echo $i;?></th>
	                  <?
	                  echo ("<td><input type=\"checkbox\" id=\"Dato[" . $i . "]\" name=\"Dato[" . $i . "]\" value=\"" . $filas_s['codsala'] ."\" checked \" readonly></td>");?>
	                  <td><input type="text" value="<?echo $fila["codsala"];?>" name="CodSalario[<? echo $i;?>]"id="CodSalario[<? echo $i;?>]" size="4" readonly class="cajas"></td>
	                  <td><input type="text" value="<?echo $fila["concepto"];?>" name="Concepto[<? echo $i;?>]"id="Concepto[<? echo $i;?>]" size="40" readonly class="cajas"></td>
	              <tr>
	                 <?
	                 $i=$i+1;
	       endwhile;
	       ?>
              <td><input type="hidden" value="<?echo $TotalRegistro;?>" name="TotalR" id="TotalR" size="40" class="cajas" readonly></td>
              <tr><td><br></td></tr>
              <tr>
                   <td colspan="6"><input type="submit" value="Generar Carta" class="boton" id="grabar"></td>
              </tr>
    </table>
</fomr>

