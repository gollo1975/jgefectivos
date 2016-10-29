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
	<center><h4><u>Centro de Costo[Editar]</u></h4></center>
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
     $Sql="select zonacosto.* FROM zonacosto,zona,detalladoparametrocentrocosto WHERE
        detalladoparametrocentrocosto.codigocosto=zonacosto.codcosto and
	zonacosto.codzona=zona.codzona  and
	zona.codzona='$CodZona'  and
        zonacosto.desde='$Desde' and
        zonacosto.hasta='$Hasta' order by zonacosto.centro";
    $Rs=mysql_query($Sql) or die("Error al buscar centro de costos.");
    $Cont=mysql_num_rows($Rs);
    if($Cont!= 0){?>
	      <center><h4><u>Centro de Costo[General]</u></h4></center>
	      <form action="" method="post" id="f1" name="f1">
                 <input type="hidden" name="baseiva" value="<?echo $baseiva;?>" id="baseiva">
                 <input type="hidden" name="CodZona" value="<?echo $CodZona;?>" id="CodZona">
                  <input type="hidden" name="Desde" value="<?echo $Desde;?>" id="Desde">
                  <input type="hidden" name="Hasta" value="<?echo $Hasta;?>" id="Hasta">
                  <input type="hidden" name="vlriva" value="<?echo $vlriva;?>" id="vlriva">
                  <input type="hidden" name="Zona" value="<?echo $Zona;?>" id="Zona" size="60">
	         <table border="0" align="center" width="350">
	            <tr class="cajas">
			<th><b>#</b></td><th>Código</th><th><b>Centro Costo</b></td>
	            </tr>
	            <?
	            $i=1;
	            while($Registro=mysql_fetch_array($Rs)){
		           ?>
		           <tr class="cajas">
		               <th><?echo $i;?></th>
			       <td><a href="ModificarCentro.php?NroCodigo=<?echo $Registro["codigo"];?>&CodZona=<?echo $CodZona;?>&vlriva=<?echo $vlriva;?>&baseiva=<?echo $baseiva;?>&Zona=<?echo $Registro["zona"];?>&CentroCosto=<?echo $Registro["centro"];?>&Desde=<?echo $Desde;?>&Hasta=<?echo $Hasta;?>"><?echo $Registro["codcosto"];?></a></td>
			       <td><?echo $Registro["centro"];?></td>
		           </tr>
		            <?
	                  $i +=1;
	            }
	            ?>
	         </table>
	      </form>
              <div align="center"><a href="ListadoCentroCosto.php"><img src="../image/regresar.png" border="0" title="Regresar al menu de facturacion."></div>
          <?
    }else{
         ?>
	   <script language="javascript">
	      alert ("Esta Empresa no tiene centro de costo creado para modificar.!")
	      history.back()
	   </script>
	  <?
    }
}
?>

</body>

</html>
