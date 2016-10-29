<html>

<head>
<title></title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if (!isset($CodZona)){
	include("../conexion.php");
	?>
	<center><h4><u>Centro de Costo[General]</u></h4></center>
	<form action="" method="post" width="200" id="Id" name="Id">
		<table border="0" align="center">
			<tr><td><br></td></tr>
			<tr>
				<td><b>Desde:</b></td>
				<td><input type="text" name="Desde" value="<? echo date("Y-m-d");?>" size="12" maxlegth="10" class="cajas" id="Desde"></td>
				<td><b>Hasta:</b></td>
				<td><input type="text" name="Hasta" value="<? echo date("Y-m-d");?>" size="12" maxlegth="10" class="cajas" id="Hasta"></td>
			</tr>
			<tr>
				<td><b>Zona:</b></td>
				<td colspan="20"><select name="CodZona" class="cajas" id="CodZona" style="width: 420px">
				<option value="0">Seleccione la zona
				<?
				$consulta_z="select * from zona where zona.nomina='SI' and zona.estado='ACTIVA' and (zona.tiponegociacion='MISIONAL' OR zona.tiponegociacion='MIXTA') order by zona";
				$resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta de zonas");
				while($filas_z=mysql_fetch_array($resultado_z)):
				?>
				<option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
				<?
				endwhile;
				?>
				</select></td>
			</tr>
			<tr>
				<td><b>Valor:</b></td>
				<td><select name="baseiva" class="cajasletra" id="baseiva">
				<option value="10">10
				</select></td>
			</tr>
			<tr><td><br></td></tr>
			<tr>
				<td colspan="10">
				<input type="submit" value="Buscar" class="boton">
				<input type="reset" value="Limpiar" class="boton">
				</td>
			</tr>
		</table>
	</form>
<?
}elseif(empty($CodZona)){
   ?>
   <script language="javascript">
      alert ("Despliegue la vista para eligir la zona.!")
      history.back()
   </script>
  <?
}else{
     /*INICIO CODIGO DE BUSQUEDA IVA*/
     include("../conexion.php");
     $SqlZona="select zona.codzona,zona.zona,zona.iva from zona
           where zona.codzona='$CodZona'";
    $RsZona=mysql_query($SqlZona) or die("Error al buscar Zona");
    $FilaZ=mysql_fetch_array($RsZona);
    $vlriva = $FilaZ["iva"];
    $Zona= $FilaZ["zona"];
    /*FIN CODIGO DEL IVA*/
    $Sql="select detalladoparametrocentrocosto.* FROM parametrocentrocosto,zona,detalladoparametrocentrocosto WHERE
        detalladoparametrocentrocosto.nroparametro=parametrocentrocosto.nroparametro and
	parametrocentrocosto.codzona=zona.codzona and
	zona.codzona='$CodZona' order by detalladoparametrocentrocosto.concepto";
    $Rs=mysql_query($Sql) or die("Error al buscar centro de costos.");
    $Cont=mysql_num_rows($Rs);
    if($Cont!= 0){?>
	      <center><h4><u>Centro de Costo[General]</u></h4></center>
	      <form action="ProcesarCentroCosto.php" method="post" id="f1" name="f1">
                 <input type="hidden" name="baseiva" value="<?echo $baseiva;?>" id="baseiva">
                 <input type="hidden" name="CodZona" value="<?echo $CodZona;?>" id="CodZona">
                  <input type="hidden" name="Desde" value="<?echo $Desde;?>" id="Desde">
                  <input type="hidden" name="Hasta" value="<?echo $Hasta;?>" id="Hasta">
                  <input type="hidden" name="vlriva" value="<?echo $vlriva;?>" id="vlriva">
                  <input type="hidden" name="Zona" value="<?echo $Zona;?>" id="Zona" size="60">
	         <table border="0" align="center" width="350">
	            <tr class="cajas">
			<th><b>Item</b></td><th></th><th>Código</th><th><b>Concepto</b></td>
	            </tr>
	            <?
	            $i=1;
                    echo ("<input type=\"hidden\" id=\"Total\" name=\"Total\" value=\"" . mysql_num_rows($Rs) . "\">");  ;
	            while($Registro=mysql_fetch_array($Rs)){
                         $CodCostoInicio = $Registro["codigocosto"];
                         $SqlCosto="select zonacosto.codcosto from zonacosto
    			         where zonacosto.codcosto='$CodCostoInicio' and
                               zonacosto.codzona='$CodZona' and
							   zonacosto.desde='$Desde' and
                               zonacosto.hasta='$Hasta'  ";
			 $RsCosto=mysql_query($SqlCosto) or die("Error al buscar el codigo de costo en la zona costo.");
                         $Cont = mysql_num_rows($RsCosto);
                         if($Cont==0){
		                  ?>
		                  <tr class="cajas">
			               <th><?echo $i;?></th>
	                               <?
		                       echo ("<td><input type=\"checkbox\" id=\"Vector[" . $i . "]\" name=\"Vector[" . $i . "]\" value=\"" . $Registro['codigocosto'] ."\"\"></td>");?>
				       <td class="cajas"><input type="text" value="<?echo $Registro["codigocosto"];?>" size="10" readonly class="cajas"></td>
				       <td class="cajas"><input type="text" value="<?echo $Registro["concepto"];?>" size="35" readonly class="cajas"></td>
	                         </tr>
	                          <?
                          }
	                  $i +=1;
	            }
	            ?>
                     <tr><td><br></td></tr>
                     <tr>
                        <td colspan="5"><input type="submit" value="Generar" class="boton" id="Generar" name="Generar"></td>
                     </tr>
	         </table>
	      </form>
          <?
    }else{
         ?>
	   <script language="javascript">
	      alert ("Esta Empresa no tiene centro de costo creado para la facturación.!")
	      history.back()
	   </script>
	  <?
    }
}
?>

</body>

</html>
