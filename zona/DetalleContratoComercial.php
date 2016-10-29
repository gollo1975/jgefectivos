<html>

<head>
  <title>Contrato Comercial</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>  
<?php 
include("../conexion.php");
$con1="select modelocontrato.concepto from modelocontrato";
$resu1=mysql_query($con1)or die("Error en la busqueda del contrato");
$Sql="select cotizacioncomercial.* from cotizacioncomercial where cotizacioncomercial.idcotizacion='$IdCotizacion'";
$Rs=mysql_query($Sql)or die("Error en la busqueda del contrato");
$Cont=mysql_num_rows($Rs);
$fila=mysql_fetch_array($Rs);
if($Cont!=0):
        while($filas=mysql_fetch_array($resu1)):
          ?>
           <center><h4><u>Contrato Comercial</u></h4></center>
            <form action="GrabarContratoC.php" method="post" name="f1" id="matcon">
              <table border="0" align="center">
                 <tr><td><br></td></tr>
                 <tr>
                    <td><b>Nit/cédula:&nbsp;</b></td>
                    <td><input type="text" name="Nit" value="<?echo $fila["nitempresa"];?>" size="15" class="cajas" readonly id="Nit"><b>Dv:</b>&nbsp;<input type="text" name="Dv" size="2"  value="<?echo $Dv;?>" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Dv"></td>
                 </tr>
                 <tr>
                    <td><b>Empresa:&nbsp;</b></td>
                    <td><input type="text" name="Empresa" value="<?echo $fila["razonsocial"];?>" size="60" class="cajas" maxlength="55" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Empresa"></td>
                 </tr>
                 <tr>
                    <td><b>Dir_Empresa:&nbsp;</b></td>
                    <td><input type="text" name="Direccion" value="" size="60" class="cajas" maxlength="55" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Direccion"></td>
                 </tr>
                 <tr>
		              <td><b>Municipio_Empresa:&nbsp;</b></td>
		                  <td colspan="40"><select name="CodMuni" class="cajasletra" id="CodMuni"  style="width: 380px">
		                         <option value="0">Seleccione Municipio
		                          <?
	                                       $consulta_z="select codmuni,municipio from municipio  order by municipio";
	                                       $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
	                                       while ($filas_z=mysql_fetch_array($resultado_z))
	                                       {
		                               ?>
		                                        <option value="<?echo $filas_z["codmuni"];?>"><?echo $filas_z["municipio"];?>
		                                  <?
		                                  }
		                                  ?>
		                   </select></td>
		         </tr>
                 <tr>
                  <tr>
                    <td><b>R_Legal:&nbsp;</b></td>
                    <td><input type="text" name="RepresentanteLegal" value="" size="60" class="cajas" maxlength="55" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="RepresentanteLegal"></td>
                 </tr>
                 <tr>
                    <td><b>Proceso:&nbsp;</b></td>
                    <td><textarea name="Proceso" cols="60"  rows="4"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Proceso" ></textarea></td>
                 </tr>
                 <tr>
                    <td><b>Cotización_Letra:&nbsp;</b></td>
                    <td><input type="text" name="CotizacionLetra" value="" size="60" class="cajas" maxlength="55" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="CotizacionLetra"></td>
                 </tr>
                 <tr>
                    <td><b>Texto:&nbsp;</b></td>
                    <td><textarea name="TextoAdecuado" cols="60"  rows="4"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TextoAdecuado">rubro facturado y pagado por la CONTRATANTE </textarea></td>
                 </tr>
                  <tr>
		              <td><b>Municipio_Expedicion:&nbsp;</b></td>
		                  <td colspan="40"><select name="CodMuniExpedicion" class="cajasletra" id="CodMuniExpedicion"  style="width: 380px">
		                         <option value="0">Seleccione Municipio
		                          <?
	                                       $consulta_z="select codmuni,municipio from municipio  order by municipio";
	                                       $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
	                                       while ($filas_z=mysql_fetch_array($resultado_z))
	                                       {
		                               ?>
		                                        <option value="<?echo $filas_z["codmuni"];?>"><?echo $filas_z["municipio"];?>
		                                  <?
		                                  }
		                                  ?>
		                   </select></td>
		         </tr>
                 <tr>
                 <tr>
                    <td><b>Documento:&nbsp;</b></td>
                    <td><input type="text" name="Documento" value="" size="15" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Documento"></td>
                 </tr>
                  <tr>
                    <td><b>Nro_Cotización:&nbsp;</b></td>
                    <td><input type="text" name="NroC" value="<?echo $fila["idcotizacion"];?>" size="15" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="NroC"></td>
                 </tr>
                 <tr>
                    <td><b>Cotización_Nro:&nbsp;</b></td>
                    <td><input type="text" name="CotizacionNro" value="<?echo $fila["porcentajeadmon"];?>" size="15" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="CotizacionNro"></td>
                 </tr>
                 <tr>
                    <td><b>Fecha_Contrato:&nbsp;</b></td>
                    <td><input type="text" name="FechaContrato" value="<?echo date('Y-m-d');?>" size="15" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaContrato"></td>
                 </tr>
                  <tr><td><br></td></tr>
                 <tr>
                  <td colspan="2">
                    <input type="submit" value="Grabar" class="boton"></td>
                  </tr>
               </table>
            </form>
          <?
        endwhile;
else:
      ?>
      <script language="javascript">
        alert("No hay datos para mostrar  ?")
        history.back()
      </script>
      <?
endif;
?>
</body>

</html>