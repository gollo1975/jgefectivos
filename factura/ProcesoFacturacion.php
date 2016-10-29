<html>
<head>
  <title>Factura de Venta</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">
	function ColorFoco(obj)
	{
       		document.getElementById(obj).style.background="#9DFF9D"
	}

	function QuitarFoco(obj)
	{
		document.getElementById(obj).style.background="white"
	}

	function Validar()
	{
		if (document.getElementById("NroServicio").value.length <=0)
		{
			alert ("Digite el Nro del Servicio para la Facturacion.!");
			document.getElementById("NroServicio").focus();
			return;
	        }
	        document.getElementById("Busqueda").submit();
        }
        function ValidarCentro()
	{
		if (document.getElementById("Desde").value.length <=0)
		{
			alert ("Digite la fecha de inicio de Busqueda.!");
			document.getElementById("Desde").focus();
			return;
	        }
	        document.getElementById("Busqueda").submit();
        }
</script>
</head>
<body>
<?
if(!isset($TipoFactura)){
include("../conexion.php");
?>
  <center><h4><u>FACTURA DE VENTA</u></h4></center>
  <form action="" method="post" id="Inicio" name="Inicio">
     <table border="0" align="center" heigth="350">
       <tr>
       <tr><td><br></td></tr>
         </tr>
        <td><b>Tipo_Factura:</b></td>
              <td colspan="1"><select name="TipoFactura" class="cajas" id="TipoFactura" style=" width: 225px">
               <option value="0">Seleccione
                  <?
                     $consulta="select nroservicio, servicio from tipofactura ";
                     $resultado=mysql_query($consulta) or die("Error al buscar el servicio");
                      while ($filas=mysql_fetch_array($resultado)):
                          ?>
                          <option value="<?echo $filas["nroservicio"];?>"><?echo $filas["servicio"];?>
                          <?
                     endwhile;
                        ?>
               </select>           </td>
        </tr>
        <tr>
            <td><b>Aplica Iva:</b></td>
               <td><select name="AplicaIva" class="cajasletra" id="AplicaIva" style=" width: 225px">
               <option value="SI">SI
               <option value="NO">NO
              </select></td>
        </tr>
         <tr>
            <td><b>Facturación por:</b></td>
            <td><input type="radio" value="General" name="TipoFacturacion">General<input type="radio" value="CentroCosto" name="TipoFacturacion">Centro de Costo<input type="radio" value="sgsst" name="TipoFacturacion">SGSST</td>
        </tr>
      <tr><td><br></td></tr>
        <td colspan="5">
          <input type="submit" value="Crear Factura" class="boton" ></td>
    </table>
  </form>
<?
}elseif(empty($TipoFactura)){
  ?>
  <script language="javascript">
    alert("Seleccione el tipo de Factura.")
    history.back()
  </script>
  <?
}elseif(empty($TipoFacturacion)){
  ?>
  <script language="javascript">
    alert("Seleccione el tipo de facturación a procesar.!")
    history.back()
  </script>
  <?
}else{
	include("../conexion.php");
	/*codigo de tipo factura*/
	$Sql="select tipofactura.servicio,tipofactura.basegrabado from tipofactura
	where tipofactura.nroservicio='$TipoFactura'";
	$Rs=mysql_query($Sql)or die("Error en la busqueda de tipo de factura");
	$filaS=mysql_fetch_array($Rs);
	$Servicio=$filaS["servicio"];
        $TipoBaseVenta=$filaS["basegrabado"];
        if($TipoFactura==1 AND $TipoFacturacion=='General'){
		?>
		<center><h4><u>FACTURA DE VENTA</u></h4></center>
		<form action="DetalleCobroServicio.php" method="post" id="Busqueda" name="Busqueda">
                        <input type="hidden" name="AplicaIva" value="<?echo $AplicaIva;?>" id="AplicaIva">
                        <input type="hidden" name="Servicio" value="<?echo $Servicio;?>" id="Servicio">
                        <input type="hidden" name="TipoBaseVenta" value="<?echo $TipoBaseVenta;?>" id="TipoBaseVenta">
	        	<table border="0" align="center" heigth="350">
	                        <tr>
	      		            <td><b>Tipo_Factura:</b></td>
	       			    <td><input type="text" name="TipoFactura" value="<?echo $TipoFactura;?>" size="2" readonly class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TipoFactura"><?echo $Servicio;?></td>
	     			</tr>
  	                                <tr>
		      		            <td><b>Tipo_Proceso:</b></td>
		       			    <td><input type="text" name="TipoProceso" value="GENERAL" size="20" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TipoProceso"></td>
	     			</tr>
				<tr>
					<td><b>Zona:</b></td>
					<td colspan=3><select name="CodZona" class="cajas" id="CodZona" style="width: 400px">
					<option value="0">Seleccione la Zona
					<?
					$Sql="select codzona,zona from zona where zona.estado='ACTIVA' and (tiponegociacion='MISIONAL' OR tiponegociacion='MIXTA') order by zona ";
					$Rs=mysql_query($Sql)or die ("Consulta de zona incorrecta");
					while($Rt=mysql_fetch_array($Rs)):
					?>
					<option value="<?echo $Rt["codzona"];?>"> <?echo $Rt["zona"];?>
					<?
					endwhile;
					?></select></td>
				</tr>
                                <tr>
	      		            <td><b>Nro_Servicio:</b></td>
	       			    <td><input type="text" name="NroServicio" value="" size="20" maxlength="10" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="NroServicio"></td>
	     			</tr>
                                <tr>
			            <td><b>Valor_Aiu:</b></td>
			               <td><select name="TipoVlr" class="cajasletra" id="TipoVlr">
			               <option value="10">10
			              </select></td>
			        </tr>
                                <tr>
	      		            <td><b>Tipo_Servicio:</b></td>
	       			    <td><input type="radio" value="Misional"  name="TipoServicio">Misional<input type="radio" value="ExamenesMedicos"  name="TipoServicio">Examenes Médicos</td>
	     			</tr>
                                <tr>
	      		            <td><b>Incluye_Ajuste:</b></td>
	       			    <td><input type="radio" value="NO" checked name="AjusteF">NO<input type="radio" value="SI"  name="AjusteF">SI</td>
	     			</tr>
                               <tr><td><br></td></tr>
                               <tr>
		                  <td colspan="4"><input type="button" value="Validar" class="boton" onclick="Validar()"></td>
			       </tr>
	                 </table>
	        </form>
                <?
        }
        if($TipoFactura==1 AND $TipoFacturacion=='CentroCosto'){
             ?>
		<center><h4><u>FACTURA DE VENTA</u></h4></center>
		<form action="DetalleBusquedacentro.php" method="post" id="Busqueda" name="Busqueda">
                        <input type="hidden" name="AplicaIva" value="<?echo $AplicaIva;?>" id="AplicaIva">
                        <input type="hidden" name="Servicio" value="<?echo $Servicio;?>" id="Servicio">
                        <input type="hidden" name="TipoBaseVenta" value="<?echo $TipoBaseVenta;?>" id="TipoBaseVenta">
                        <input type="hidden" name="TipoFactura" value="<?echo $TipoFactura;?>" id="TipoFactura">
	        	<table border="0" align="center" heigth="350">
	                        <tr>
	      		            <td><b>Tipo_Factura:</b></td>
	       			    <td><input type="text" name="TipoFactura" value="<?echo $TipoFactura;?>" size="20" readonly class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TipoFactura"><?echo $Servicio;?></td>
	     			</tr>
  	                                <tr>
		      		            <td><b>Tipo_Proceso:</b></td>
		       			    <td><input type="text" name="TipoProceso" value="CENTRO DE COSTO" size="20" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TipoProceso"></td>
	     			</tr>
				<tr>
					<td><b>Zona:</b></td>
					<td colspan=3><select name="CodZona" class="cajas" id="CodZona" style="width: 400px">
					<option value="0">Seleccione la Zona
					<?
					$Sql="select codzona,zona from zona where zona.estado='ACTIVA' and (tiponegociacion='MISIONAL' OR tiponegociacion='MIXTA') order by zona ";
					$Rs=mysql_query($Sql)or die ("Consulta de zona incorrecta");
					while($Rt=mysql_fetch_array($Rs)):
					?>
					<option value="<?echo $Rt["codzona"];?>"> <?echo $Rt["zona"];?>
					<?
					endwhile;
					?></select></td>
				</tr>
                                <tr>
			            <td><b>Valor_Aiu:</b></td>
			               <td><select name="TipoVlr" class="cajasletra" id="TipoVlr">
			               <option value="10">10
			              </select></td>
			        </tr>
                                <tr>
	      		            <td><b>Desde:</b></td>
	       			    <td><input type="text" name="Desde" value="<?echo date('Y-m-d');?>" size="20" maxlength="10" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Desde"></td>
	     			</tr>
                                <tr>
                                    <td><b>Hasta:</b></td>
	       			    <td><input type="text" name="Hasta" value="<?echo date('Y-m-d');?>" size="20" maxlength="10" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Hasta"></td>
                               </tr>
                               <tr><td><br></td></tr>
                               <tr>
		                  <td colspan="10"><input type="button" value="Buscar Centro" class="boton" id="buscar" onclick="ValidarCentro()"></td>
			       </tr>
	                 </table>
	        </form>
                <?
        }
        if($TipoFactura==1 AND $TipoFacturacion=='sgsst'){
           ?>
		<center><h4><u>FACTURA DE VENTA</u></h4></center>
		<form action="FacturaServicioSgsst.php" method="post" id="Busqueda" name="Busqueda">
                        <input type="hidden" name="AplicaIva" value="<?echo $AplicaIva;?>" id="AplicaIva">
                        <input type="hidden" name="Servicio" value="<?echo $Servicio;?>" id="Servicio">
                        <input type="hidden" name="TipoBaseVenta" value="<?echo $TipoBaseVenta;?>" id="TipoBaseVenta">
	        	<table border="0" align="center" heigth="350">
	                        <tr>
	      		            <td><b>Tipo_Factura:</b></td>
	       			    <td><input type="text" name="TipoFactura" value="<?echo $TipoFactura;?>" size="2" readonly class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TipoFactura"><?echo $Servicio;?></td>
	     			</tr>
  	                                <tr>
		      		            <td><b>Tipo_Proceso:</b></td>
		       			    <td><input type="text" name="TipoProceso" value="GENERAL" size="20" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TipoProceso"></td>
	     			</tr>
				<tr>
					<td><b>Zona:</b></td>
					<td colspan=3><select name="CodZona" class="cajas" id="CodZona" style="width: 400px">
					<option value="0">Seleccione la Zona
					<?
					$Sql="select codzona,zona from zona where zona.estado='ACTIVA' and (tiponegociacion='MISIONAL' OR tiponegociacion='MIXTA') order by zona ";
					$Rs=mysql_query($Sql)or die ("Consulta de zona incorrecta");
					while($Rt=mysql_fetch_array($Rs)):
					?>
					<option value="<?echo $Rt["codzona"];?>"> <?echo $Rt["zona"];?>
					<?
					endwhile;
					?></select></td>
				</tr>
                                <tr>
			            <td><b>Valor_Aiu:</b></td>
			               <td><select name="TipoVlr" class="cajasletra" id="TipoVlr">
			               <option value="10">10
			              </select></td>
			        </tr>
                               <tr><td><br></td></tr>
                               <tr>
		                  <td colspan="4"><input type="submit" value="Validar" class="boton"></td>
			       </tr>
	                 </table>
	        </form>
                <?
        }
        if($TipoFactura==2){
           ?>
  	   <script language="javascript">
		    alert("Este tipo de facturación no esta autorizada en la Compañia.")
		    history.back()
	  </script>
           <?
        }
        if($TipoFactura==3 AND $TipoFacturacion=='General'){
             ?>
		<center><h4><u>FACTURA DE VENTA</u></h4></center>
		<form action="FacturaServicioAdicional.php" method="post" id="Busqueda" name="Busqueda">
                        <input type="hidden" name="AplicaIva" value="<?echo $AplicaIva;?>" id="AplicaIva">
                        <input type="hidden" name="Servicio" value="<?echo $Servicio;?>" id="Servicio">
	        	<table border="0" align="center" heigth="350">
	                        <tr>
	      		            <td><b>Tipo_Factura:</b></td>
	       			    <td><input type="text" name="TipoFactura" value="<?echo $TipoFactura;?>" size="2" readonly class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TipoFactura"><?echo $Servicio;?></td>
	     			</tr>
  	                                <tr>
		      		            <td><b>Tipo_Proceso:</b></td>
		       			    <td><input type="text" name="TipoProceso" value="GENERAL" size="20" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TipoProceso"></td>
	     			</tr>
				<tr>
					<td><b>Zona:</b></td>
					<td colspan=3><select name="CodZona" class="cajas" id="CodZona" style="width: 400px">
					<option value="0">Seleccione la Zona
					<?
					$Sql="select codzona,zona from zona where zona.estado='ACTIVA' and (tiponegociacion='MIXTA' OR tiponegociacion='OTROS') order by zona ";
					$Rs=mysql_query($Sql)or die ("Consulta de zona incorrecta");
					while($Rt=mysql_fetch_array($Rs)):
					?>
					<option value="<?echo $Rt["codzona"];?>"> <?echo $Rt["zona"];?>
					<?
					endwhile;
					?></select></td>
				</tr>
                                	<tr>
					<td><b>Servicio:</b></td>
					<td colspan=3><select name="NroServicio" class="cajas" id="NroServicio" style="width: 400px">
					<option value="0">Seleccione servicio
					<?
					$SqlI="select item.* from item where item.adicional='SI' order by concepto ASC ";
					$RsI=mysql_query($SqlI)or die ("Error al buscar item");
					while($RtI=mysql_fetch_array($RsI)):
					?>
					<option value="<?echo $RtI["codcom"];?>"> <?echo $RtI["concepto"];?>
					<?
					endwhile;
					?></select></td>
				</tr>
                                <tr>
		      		            <td><b>Nro_Contrato</b></td>
		       			    <td><input type="text" name="NroContrato" value="" size="20"  class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="NroContrato"></td>
	     			</tr>
                               <tr><td><br></td></tr>
                               <tr>
		                  <td colspan="4"><input type="button" value="Buscar" class="boton" onclick="Validar()"></td>
			       </tr>
	                 </table>
	        </form>
                <?
          }
          if($TipoFactura==3 AND $TipoFacturacion=='CentroCosto'){
              ?>
	  	   <script language="javascript">
			    alert("Favor cambiar el tipo de facturación.")
			    history.back()
		  </script>
           <?
          }

}
?>
</body>
</html>


