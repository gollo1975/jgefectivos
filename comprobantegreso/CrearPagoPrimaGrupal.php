<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<center><h4><u>Comprobantes Egreso</u></h4></center>
<form action="DetalladoPrimaGrupal.php" method="post">
  <input type="hidden" name="empresa" value="<?echo $NitEmpresa;?>">
   <input type="hidden" name="municipio" value="<?echo $municipio;?>">
   <input type="hidden" value="<?echo $Usuario;?>" name="Usuario" id="Usuario">
    <input type="hidden" name="TipoPago" value="<?echo $TipoPago;?>">
   <table border="0" align="center" width="565">
    <tr>
    <tr><td><br></td></tr>
        <?
    include("../conexion.php");?>
    <tr>
       <td><b>Nit/Cedula:</b></td>
       <td><input type="text" name="nit" value="<? echo $NitEmpresa;?>" size="13" readonly class="cajas"></td>
       <td><b>Empresa:</b></td>
       <td><input type="text" name="empresa" value="<?echo $Empresa;?>" size="47" class="cajas" readonly></td>
    </tr>
    <tr>
       <td ><b>Municipio:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
       <td  colspan="5"><select name="municipio" class="cajas">
       <option value="0">Seleccione
       <?
       $consulta="select codmuni,municipio from municipio order by municipio";
       $resultado=mysql_query($consulta) or die("error al buscar empresa");
       while ($filas=mysql_fetch_array($resultado)):
             ?>
             <option value="<?echo $filas["codmuni"];?>"><?echo $filas["municipio"];?>
             <?
       endwhile;
       ?>
      </select></td>
	  <tr>
      <td><b>Fecha_Pago:</b></td>
      <td><input type="text" name="fechapago" value="<?echo date("Y-m-d");?>" size="13" maxlength="10" class="cajas">
      <td><b>Vlr_Pago:</b></td>
      <td><input type="text" name="valorP" value="" size="13" maxlength="11" class="cajas"></td>
      </tr>
      <tr>
       <td><b>Desde:</b></td>
       <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="13"  class="cajas" maxlength="10">
       <td><b>Hasta:</b></td>
       <td><input type="text" name="hasta" value="<?echo date("Y-m-d");?>" size="13" class="cajas" maxlength="10"></td>
	   </tr>
	   <tr>
         <td><b>TipoCta:</b></td>
            <td><select name="TipoCta" class="cajas">
               <option value="0">Seleccione un Item
	           <option value="AHORRO">AHORRO
	            <option value="CORRIENTE">CORRIENTE
               <option value="OFICINA">OFICINA
               <option value="OTRA">OTRA
	        </select></td>
        <td><b>Forma_Pago:</b></td>
           <td><select name="formapago" class="cajas">
	          <option value="0">Seleccione un Item
	          <option value="EFECTIVO">EFECTIVO
	          <option value="CHEQUE">CHEQUE
	          <option value="BANCO">BANCO
	          <option value="SUCURSAL">SUCURSAL
              <option value="T. CREDITO">T. CREDITO 
	        </select></td>
		</tr>	
		<tr>
          <td><b>Banco:</b></td>
            <td colspan="20"><select name="banco" class="cajasletra">
	           <option value="0">Seleccione el banco
			  <?
			  $consulta_z="select codbanco,bancos from banco  order by bancos";
			  $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
			  while ($filas_z=mysql_fetch_array($resultado_z)):
			  ?>
			  <option value="<?echo $filas_z["codbanco"];?>"><?echo $filas_z["bancos"];?>
			  <?
			  endwhile;
			  ?>
			  </select></td>
		  </tr>
         <tr>
             <td><b>Tipo_Comprobante:</b></td>
              <td colspan="20"><select name="TipoComprobante" class="cajas" id="TipoComprobante">
	       <option value="0">Seleccione
	        <?
                 $consulta="select tipocomprobante.descripcion,tipocomprobante.id  from tipocomprobante  where tipocomprobante.estado='ACTIVO' order by descripcion";
	          $resultado=mysql_query($consulta) or die("error al buscar el tipo de comprobante");
	          while ($filas=mysql_fetch_array($resultado)):
	             ?>
	            <option value="<?echo $filas["id"];?>"><?echo $filas["descripcion"];?>
                    <?
                  endwhile;
            ?>
            </select></td>
      </tr>

      <?if ($TipoPago=='nomina'):?>
         <tr><td><b>Nota:</b></td>
         <td colspan="30"><input type="text" value="Nómina del  " name="nota" size="40" maxlength="35" class="cajas"></td>
      <?else:?>
           <tr><td><b>Nota:</b></td>
         <td colspan="30"><input type="text" value="Primas del " name="nota" size="40" maxlength="35" class="cajas"></td>
      <?endif;?>
      </tr>
     <?
     $conB="select zona.zona,zona.nitzona,zona.dvzona,zona.codzona from zona where zona.estado='ACTIVA' and zona.nomina='SI' order by zona";
     $resB=mysql_query($conB) or die("Error al buscar zonas");
     $regN=mysql_num_rows($resB);
     ?>
     </table>
     <table border="0" align="center" width="565">
    <tr class="cajas">
	      <th><b>Item</b></td><th>Cod_Zona</th><th><b>Zona</b></th>
	    </tr>
	    <?
	     $i=1;
	     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resB) . "\">");
	     while ($filas_Z = mysql_fetch_array($resB)):
	           ?>
	           <tr class="cajas">
                   <th><?echo $i;?></th>
	              <?
	              echo ("<td><input type=\"checkbox\" id=name=\"datoZ[" . $i . "]\" name=\"datoZ[" . $i . "]\" value=\"" . $filas_Z['codzona'] ."\" \"></td>");?>
	              <td class="cajas"><input type="text" value="<?echo $filas_Z["codzona"];?>"  size="9" readonly class="cajas"></td>
	              <td class="cajas"><input type="text" value="<?echo $filas_Z["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]" size="67" readonly class="cajas"></td>
                      <td class="cajas"><input type="hidden" value="<?echo $filas_Z["nitzona"];?>" name="nitempresa[<? echo $i;?>]"id="nitempresa[<? echo $i;?>]" size="15" readonly class="cajas"></td>
	            <tr>
	           <?
	           $i=$i+1;
	     endwhile;
          ?>
      <tr><td><br></td></tr>
      <td colspan="5">
          <input type="submit" value="Buscar Zonas" class="boton" ></td>
     </table>
   </form>
</body>
</html>
