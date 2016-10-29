	    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='PagoGrupal.php?Usuario=<?echo $Usuario;?>'
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }
         function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
</script>
       <head>
                <title>Comprobante Egresos</title>
                 <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        </head>
        <body>
                <?
        if (!isset($municipio)):
           ?>
            <center><h4><u>Comprobante de Egresos</u></h4></center>
            <form action="" method="post">
               <input type="hidden" name="estado" value="<? echo $estado;?>">
               <input type="hidden" name="TipoPago" value="<? echo $TipoPago;?>">
                <input type="hidden" value="<?echo $Usuario;?>" name="Usuario" id="Usuario">
               <?if($estado=='NO'){
                 ?>
                  <table border="0" align="center" width="768">
               <?}else{
                ?>
                  <table border="0" align="center" width="640">
                <?
                }
                   include("../conexion.php");
                   if (!$nro):
                        $codex=$nro;
                        ?>
                        <tr>
                          <td><b>Nit/Cedula:</b></td>
                          <td><input type="text" name="nit" value="<? echo $NitEmpresa;?>" size="13" readonly class="cajas"></td>
                          <td><b>Empresa:</b></td>
                          <td><input type="text" name="empresa" value="<?echo $Empresa;?>" size="40" class="cajas" readonly></td>
                        </tr>
                        <tr>
			   <td ><b>Municipio:</b></td>
			   <td  colspan="15"><select name="municipio" class="cajas">
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
                           </tr>
                           <tr>
                              <td><b>Fecha_Pago:</b></td>
                              <td><input type="text" name="fechapago" value="<?echo date("Y-m-d");?>" size="13" maxlength="10" class="cajas"></td>
                              <td><b>Vlr_Pago:</b></td>
                              <td><input type="text" name="valorP" value="" size="13" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="valorP"></td>
                           </tr>
                           <tr>
                           <td><b>Tipo_Comprobante:</b></td>
			   <td  colspan="10"><select name="TipoComprobante" class="cajas" id="TipoComprobante">
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
                        <?
                        else:
                           $codex=$nro;
                            $consulta="select maestrocomprobante.*,maestro.nomaestro,municipio.municipio,tipocomprobante.descripcion from maestrocomprobante,maestro,municipio,tipocomprobante
                            where maestro.codmaestro=maestrocomprobante.codmaestro and
                            maestrocomprobante.codmuni=municipio.codmuni and
                            maestrocomprobante.id=tipocomprobante.id and
                            maestrocomprobante.codmaestro='$nit' and maestrocomprobante.nro='$codex'";
                            $resultado=mysql_query($consulta) or die("error al buscar datos");
                            $filas=mysql_fetch_array($resultado);
                            $Muni=$filas["municipio"];

                            ?>
                            <tr>
                                <td><b>Nit/Cedula:</b></td>
                                <td><input type="text" name="nit" value="<? echo $filas["codmaestro"];?>" size="13" readonly class="cajas"></td>
                                <td><b>Empresa:</b></td>
                                <td><input type="text" name="empresa" value="<?echo $filas["nomaestro"];?>" size="40" class="cajas" readonly></td>
                            </tr>
                            <tr>
                                <td><b>Cod_Municipio:</b></td>
                                <td><input type="text" name="municipio" value="<?echo $filas["codmuni"];?>" size="13" class="cajas" readonly></td>
                                <td><b>Municipio:</b></td>
                                <td><input type="text"  value="<?echo $filas["municipio"];?>" size="25" class="cajas" readonly></td>
                            </tr>
                                <td><b>Fecha_Pago:</b></td>
                                <td><input type="text" name="fechapago" value="<?echo $filas["fechapago"];?>" size="13" maxlength="10" class="cajas" readonly></td>
                                <td><b>Vlr_Pago:</b></td>
                                <td><input type="text" name="valorP" value="<?echo $filas["vlrpagado"];?>" size="13" maxlength="11" class="cajas" readonly></td>
                            </tr>
                            <tr>
                                <td><b>Id_Comp.:</b></td>
                                <td><input type="text" name="TipoComprobante" value="<?echo $filas["id"];?>" size="13" class="cajas" readonly id="TipoComprobante"></td>
                                <td><b>Descripción:</b></td>
                                <td><input type="text"  value="<?echo $filas["descripcion"];?>" size="25" class="cajas" readonly></td>
                            </tr>
                                                          <?
                         endif;
                          ?>
                            <tr><td colspan="30">--------------------------------------------------------------------------------------------------------------------------------------------------------------</td></tr>
                           <?
                         if($estado=='NO'):
                                     ?>
                                      <tr>
                                      <td><b>Nro_Factura:</b></td>
                                         <td colspan="20"><input type="text" name="nrofactura" value="" size="13" maxlength="13" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="nrofactura">
                                          <b>Nit:</b>
                                          <input type="text" name="nitprove" value="" size="11" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="nitprove">
                                        <b>Dv:</b>
                                       <input type="text" name="dv" value="" size="1" maxlength="1" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="dv">

                                       <b>Proveedor:</b>
                                       <input type="text" name="provedor" value="" size="47" maxlength="47" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="provedor"></td>
	                            </tr>
	                            <tr>
                                       <td><b>Vlr_Pago:</b></td>
                                       <td  colspan="20"><input type="text" name="vlrpago" value="" size="11" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="vlrpago">
                                       <b>Forma_Pago:</b>
                                       <select name="formapago" class="cajas">
				           <option value="0">Seleccione un Item
				           <option value="BANCO">BANCO
				           <option value="CHEQUE">CHEQUE
    			                   <option value="EFECTIVO">EFECTIVO
                                           <option value="SUCURSAL">SUCURSAL
                                           <option value="T. CREDITO">T. CREDITO
				         </select>
                                        <b>Banco:</b>
                                 	<select name="banco" class="cajasletra">
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
                                   <tr>
                                       <td><b>Cheque:</b></td>
                                       <td  colspan="20"><input type="text" name="cheque" value="" size="11" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="cheque">
                                       <b>Tipo_Cta:</b>
                                       <select name="tipocta" class="cajas">
				           <option value="0">Seleccione Cta
				           <option value="AHORRO">AHORRO
	                                    <option value="CORRIENTE">CORRIENTE
                                         <option value="OFICINA">OFICINA
                                         <option value="OTRA">OTRA
				         </select>
	                                  <b>Nota:</b>
                                          <input type="text" name="nota" value="" size="40" maxlength="100" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="nota"></td>
                                    <tr>
                                   <td colspan="30"><div align="right"><input type="submit" value="Agregar"></div></td>
	                             </tr>
	                         </table>
	                            <input type="hidden" name="MM_insert" value="form1">
                               <?
                               else:
                                  if($TipoPago=='compra'):
                                     $FechaV=date("Y-m-d");
                                       ?>
	                               <tr><td >&nbsp;</td></tr>
	                               <tr>
                                        <td><b>Nro_Factura:</b></td>
                                 	   <td  colspan="20"><select name="NroPago" class="cajasletra">
				                <option value="0">Seleccione la Factura
				               <?
	                                       $conF="select pagar.nrofactura,pagar.nitprove,pagar.fechaven,provedor.nomprove,pagar.saldo,pagar.conse from pagar,provedor
	                                       where provedor.nitprove=pagar.nitprove and
	                                       pagar.saldo > 0 and
	                                       pagar.fechaven <= '$FechaV' order by pagar.fechaven DESC";
			                       $resuF=mysql_query($conF) or die("error al buscar empresa");
			                       while ($filas=mysql_fetch_array($resuF)):
	    	                          ?>
			                          <option value="<?echo $filas["conse"];?>"><?echo $filas["nrofactura"];?>-<?echo $filas["nomprove"];?>-<?echo $filas["saldo"];?>
			                          <?
			                       endwhile;
			                        ?>
				               </select></td>
                                         </tr>
                                         <tr>
                                              <td><b>Validar_Pago:</b></td>
                                              <td><input type="radio" name="validarPago" value="parcial"><font color="red">Parcial</font><input type="radio" name="validarPago" value="total"><font color="red">Total</font></td>
                                             <td><b>Vlr_Pago:</b></td>
                                             <td><input type="text" name="vlrpago" value="" size="11" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="vlrpago"></td>
                                         </tr>
                                         <tr>
                                          <td><b>Forma_Pago:</b></td>
                                              <td><select name="formapago" class="cajas">
					           <option value="0">Seleccione un Item
					           <option value="BANCO">BANCO
					           <option value="CHEQUE">CHEQUE
	    			                   <option value="EFECTIVO">EFECTIVO
	                                           <option value="SUCURSAL">SUCURSAL
	                                           <option value="T. CREDITO">T. CREDITO
					         </select></td>
                                           <td><b>Banco:</b></td>
                                        	<td colspan="10"><select name="banco" class="cajasletra">
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
                                          <td><b>Cheque:</b></td>
                                            <td><input type="text" name="cheque" value="" size="11" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="cheque">
                                          <td><b>Tipo_Cta:</b></td>
                                             <td> <select name="tipocta" class="cajas" id="tipocta">
					           <option value="0">Seleccione Cta
					           <option value="AHORRO">AHORRO
		                                    <option value="CORRIENTE">CORRIENTE
	                                           <option value="OFICINA">OFICINA
	                                           <option value="OTRA">OTRA
					         </select></td>
	                               </tr>
                                   <td colspan="30"><div align="right"><input type="submit" value="Agregar"></div></td>
	                             </tr>
	                            </table>
	                             <input type="hidden" name="MM_insert" value="form1">
                                    <?
                                  else:
                                    if($TipoPago=='prestacion'):
                                        $FechaV=date("Y-m-d");
                                         ?>
	                                 <tr><td >&nbsp;</td></tr>
	                                 <tr>
                                            <td><b>Nro_Prestación:</b></td>
                                            <td colspan="20"> <select name="NroPago" class="cajasletra" id="NroPago">
			                        <option value="0">Seleccione el Empleado
				                 <?
	                                         $conF="select prestacion.nropresta,prestacion.nombres,prestacion.cedemple from prestacion
	                                         where prestacion.control='ACTIVA' order by nombres ASC";
			                         $resuF=mysql_query($conF) or die("error al buscar prestaciones");
			                         while ($filas=mysql_fetch_array($resuF)):
	    	                                   ?>
			                          <option value="<?echo $filas["nropresta"];?>"><?echo $filas["nropresta"];?>-<?echo $filas["nombres"];?>
			                          <?
			                         endwhile;
			                          ?>
			                    </select>
                                            <b>Vlr_Pago:</b>
                                            <input type="text" name="vlrpago" value="" size="11" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="vlrpago"></td>
                                          </tr>
                                          <tr>
                                          <td><b>Forma_Pago:</b></td>
                                          <td><select name="formapago" class="cajas">
				           <option value="0">Seleccione un Item
				           <option value="BANCO">BANCO
				           <option value="CHEQUE">CHEQUE
    			                   <option value="EFECTIVO">EFECTIVO
                                           <option value="SUCURSAL">SUCURSAL
                                           <option value="T. CREDITO">T. CREDITO
				          </select></td>
                                          <td><b>Banco:</b></td>
                                 	     <td colspan="10"><select name="banco" class="cajasletra">
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
                                          <tr>
                                          <td><b>Cheque:</b></td>
                                            <td><input type="text" name="cheque" value="" size="11" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="cheque">
                                          <td><b>Tipo_Cta:</b></td>
                                             <td><select name="tipocta" class="cajas">
				                <option value="0">Seleccione Cta
				                <option value="AHORRO">AHORRO
	                                        <option value="CORRIENTE">CORRIENTE
                                                <option value="OFICINA">OFICINA
                                                <option value="OTRA">OTRA
				               </select></td>
	                                  </tr>
                                          <td colspan="30"><div align="right"><input type="submit" value="Agregar"></div></td>
	                                  </tr>
	                                  </table>
	                                  <input type="hidden" name="MM_insert" value="form1">
                                         <?
                                      else:
                                          if($TipoPago=='empleado'):
	                                       $FechaV=date("Y-m-d");
	                                         ?>
		                                 <tr><td >&nbsp;</td></tr>
		                                 <tr>
	                                         <td><b>Empleado:</b></td>
		                                       <td colspan="20"><select name="Documento" class="cajasletra" id="Documento">
					                 <option value="0">Seleccione el Empleado
					                 <?
		                                         $conF="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple1) as Empleado from empleado,contrato
		                                         where empleado.codemple=contrato.codemple and
	                                                 contrato.fechater='0000-00-00' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
				                         $resuF=mysql_query($conF) or die("error al buscar prestaciones");
				                         while ($filas=mysql_fetch_array($resuF)):
		    	                                   ?>
				                          <option value="<?echo $filas["cedemple"];?>"><?echo $filas["cedemple"];?>-<?echo $filas["Empleado"];?>
				                          <?
				                         endwhile;
				                          ?>
					                  </select>
		                                          <b>Vlr_Pago:</b>
		                                          <input type="text" name="vlrpago" value="" size="11" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="vlrpago"></td>
	                                          </tr>
	                                          <tr>
	                                          <td><b>Forma_Pago:</b></td>
	                                          <td><select name="formapago" class="cajas">
					           <option value="0">Seleccione un Item
					           <option value="BANCO">BANCO
				                   <option value="CHEQUE">CHEQUE
    			                           <option value="EFECTIVO">EFECTIVO
                                                   <option value="SUCURSAL">SUCURSAL
                                                   <option value="T. CREDITO">T. CREDITO
					          </select></td>
	                                          <td><b>Banco:</b></td>
	                                 	  <td><select name="banco" class="cajasletra" id="banco">
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
	                                          <td><b>Cheque:</b></td>
	                                           <td><input type="text" name="cheque" value="" size="11" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="cheque"></td>
	                                           <td><b>Tipo_Cta:</b></td>
	                                              <td><select name="tipocta" class="cajas">
					                 <option value="0">Seleccione Cta
					                 <option value="AHORRO">AHORRO
	                                                 <option value="CORRIENTE">CORRIENTE
                                                         <option value="OFICINA">OFICINA
                                                         <option value="OTRA">OTRA
					                 </select></td>
                                                </tr>
                                               <tr>
                                                 <td> <b>Nota:</b></td>
                                                  <td colspan="25"><input type="text" name="nota" value="" size="40" maxlength="37" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="nota"></td>
		                                  </tr>
	                                          <td colspan="30"><div align="right"><input type="submit" value="Agregar"></div></td>
		                                  </tr>

		                                  </table>
		                                  <input type="hidden" name="MM_insert" value="form1">
	                                         <?
                                            else:
                                                $FechaV=date("Y-m-d");
	                                         ?>
		                                 <tr><td >&nbsp;</td></tr>
		                                 <tr>
	                                         <td><b>Empleado:</b></td>
	                                 	    <td colspan="20"><select name="NroPago" class="cajasletra" id="NroPago">
					                 <option value="0">Seleccione el Empleado
					                 <?
		                                         $conF="select vacacion.codvaca,vacacion.nombre,vacacion.cedemple from vacacion
		                                         where vacacion.control='ACTIVA' order by nombre ASC";
				                         $resuF=mysql_query($conF) or die("error al buscar vacaciones");
				                         while ($filas=mysql_fetch_array($resuF)):
		    	                                   ?>
				                          <option value="<?echo $filas["codvaca"];?>"><?echo $filas["codvaca"];?>-<?echo $filas["nombre"];?>
				                          <?
				                         endwhile;
				                          ?>
				                  </select>
	                                               <b>Vlr_Pago:</b>
	                                              <input type="text" name="vlrpago" value="" size="11" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="vlrpago">
                                                  </tr>
                                                  <tr>
                                                     <td><b>F_Pago:</b></td>
	                                                <td><select name="formapago" class="cajas">
						           <option value="0">Seleccione un Item
						           <option value="BANCO">BANCO
					                   <option value="CHEQUE">CHEQUE
	    			                           <option value="EFECTIVO">EFECTIVO
	                                                   <option value="SUCURSAL">SUCURSAL
	                                                   <option value="T. CREDITO">T. CREDITO
						          </select></td>
	                                              <td><b>Banco:</b></td>
	                                 	        <td colspan="10"><select name="banco" class="cajasletra">
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
	                                              <td> <b>Cheque:</b></td>
	                                                 <td><input type="text" name="cheque" value="" size="11" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="cheque"></td>
	                                               <td><b>Tipo_Cta:</b></td>
		                                           <td><select name="tipocta" class="cajas">
						           <option value="0">Seleccione Cta
						           <option value="AHORRO">AHORRO
		                                           <option value="CORRIENTE">CORRIENTE
	                                                   <option value="OFICINA">OFICINA
	                                                   <option value="OTRA">OTRA
						          </select></td>
		                                  </tr>
	                                          <td colspan="30"><div align="right"><input type="submit" value="Agregar"></div></td>
		                                  </tr>
		                                  </table>
		                                  <input type="hidden" name="MM_insert" value="form1">
	                                         <?
                                           endif;
                                      endif;
                                  endif;
                               endif;
                               ?>
                           </table>
                        </form>
                       <?
                        include("../conexion.php");
                        $consulta_d="select comprobante.*,banco.bancos from comprobante,banco
                         where comprobante.codbanco=banco.codbanco and
                               comprobante.nro='$codex'";
                        $resultado_d=mysql_query($consulta_d) or die("Error al buscar detalles");
                        $registros_d=mysql_num_rows($resultado_d);
                        if ($registros_d==0):
                             ?>
                               <table border="" align="center" width="700">
                                 <tr class="fondo">
                                                <th>&nbsp;</td>
                                                <th>&nbsp;</th>
                                                <th>Item</th>
                                                <th>Documento</th>
                                                <th>Nit/Cédula</th>
                                                <th>Tercero</th>
                                                <th>Vlr_Pago</th>
                                                <th>Forma_Pago</th>
                                                <th>Producto</th>
                                                <th>Entidad</th>
                                                <th>Compro.</th>

                                        </tr>
                              </table>
                              <?
                        else:
                            ?>
                            <form action="EliminarDatos.php" method="post">
                               <input type="hidden" name="codex" value="<?echo $codex;?>">
                               <input type="hidden" name="estado" value="<?echo $estado;?>">
                               <input type="hidden" name="TipoPago" value="<?echo $TipoPago;?>">
                                 <input type="hidden" value="<?echo $Usuario;?>" name="Usuario" id="Usuario">
                                <table border="1" align="center" width="870">
                                        <tr class="fondo">
                                                <th>&nbsp;</td>
                                                <th>&nbsp;</th>
                                                <th>Item</th>
                                                <th>Documento</th>
                                                <th>Nit/Cédula</th>
                                                <th>Tercero</th>
                                                <th>Vlr_Pago</th>
                                                <th>Forma_Pago</th>
                                                <th>Producto</th>
                                                <th>Entidad</th>
                                                <th>Compro.</th>

                                        </tr>
                              	        <?
                                       $x=1;
                                       while ($filas_d = mysql_fetch_array($resultado_d)):
                                           $valor=number_format($filas_d["valor"],0);
                                           ?>
                                          <tr align="center" class="cajas">
                                                <input type="hidden" name="nit" value="<?echo $nit;?>">
                                                <input type="hidden" name="codex" value="<?echo $codex;?>">
                                                <th>&nbsp;<input type="checkbox" name="datos[]" value="<?echo $filas_d["conse"];?>"></th>
                                                <td>&nbsp;<a href="ModificarC.php?codigo=<?echo $filas_d["conse"];?>&TipoPago=<?echo $TipoPago;?>&NroFactura=<?echo $filas_d["nrofactura"];?>&NitP=<?echo $filas_d["nitprove"];?>&codex=<?echo $codex;?>&nit=<?echo $nit;?>&Usuario=<?echo $Usuario;?>&estado=<?echo $estado;?>"><img src="../image/mod.jpg" border="0" alt="Modificar Registro"></a></td>
                                                <td><div align="center"><font color="blue"><b><?echo $x;?></b></font></div></td>
                                                <td><div align="center"><font color="blue"><b><?echo $filas_d["nrofactura"];?></b></font></div></td>
                                                <td><div align="center"><font color="blue"><b><?echo $filas_d["nitprove"];?></b></font></div></td>
                                                <td><div align="left"><font color="blue"><b><?echo $filas_d["cliente"];?></b></font></div></td>
                                                <td><div align="right"><font color="red"><b>$<?echo $valor;?></b></font></div></td>
                                                <td><div align="center"><font color="blue"><b><?echo $filas_d["pago"];?></b></font></div></td>
                                                 <td><div align="center"><font color="blue"><b><?echo $filas_d["cuenta"];?></b></font></div></td>
                                                <td><font color="blue"><b><?echo $filas_d["bancos"];?></b></font></td>
                                                <td><div align="center"><font color="blue"><b><?echo $filas_d["nro"];?></b></font></div></td>
                                           </tr>
                                       <?
                                       $x=$x+1;
                                       $TotalC=$TotalC+$filas_d["valor"];
                                       endwhile;
                                       include("../numeros.php");
                                       $letras=num2letras($TotalC);
                                       $letras=strtoupper($letras);
                                       $TotalPagar=number_format($TotalC,0);
                                       $conF="update maestrocomprobante set vlrpagado='$TotalC',letras='$letras' where maestrocomprobante.nro='$codex'";
                                       $resF=mysql_query($conF)or die ("Error al actualizar");
                                       $reg=mysql_affected_rows();
                                        ?>
                                       <tr>
                                       <td colspan="30">&nbsp;</td>
                                       </tr>
                                      <tr>
                                      <th>&nbsp;</td>
	                              <th>&nbsp;</td>
	                              <th>&nbsp;</td>
	                              <th>&nbsp;</td>
	                               <th>&nbsp;</td>
	                              <th><b>Total Pagado:</b></td>
	                              <th><div align="center"><b>$<?echo $TotalPagar;?></b></div></th>
	                              <th>&nbsp;</td>
	                              <th>&nbsp;</td>
	                              <th>&nbsp;</td>
	                              <th>&nbsp;</td>
		                     </tr>
	                          <tr>
	                            <td colspan="30" align="center"><input type="submit" value="Eliminar"></td>
	                          </tr>
	                     </table>
                          </form>

                         <th><a href="imprimircomprobante.php?NroComprobante=<?echo $codex;?>&Usuario=<?echo $Usuario;?>" target="_blank" onclick="volver()" class="fondo"><b><div align="center"><font color="red">Imprimir</font></div></b></a></th>
                         <?
                        endif;
                     else:
                       if($estado=='NO'):
                           if(empty($municipio)):
                              ?>
                              <script language="javascript">
                               alert("Seleccione de la lista el municipio ?")
                                history.back()
                              </script>
                              <?
                              elseif(empty($TipoComprobante)):
                                ?>
                               <script language="javascript">
                                alert("Seleccione el tipo de comprobante de la lista.!")
                                history.back()
                              </script>
                              <?
                              elseif(empty($nrofactura)):
                                ?>
                               <script language="javascript">
                                alert("Digite el documento o Factura a causar.")
                                history.back()
                              </script>
                              <?
                              elseif(empty($nitprove)):
                               ?>
                              <script language="javascript">
                                alert("Digite el Nit/Cédula del Proveedor?")
                                history.back()
                              </script>
                                <?

                            elseif(empty($provedor)):
                               ?>
                              <script language="javascript">
                                alert("Digite el nombre del Proveedor ?")
                                history.back()
                              </script>
                           <?
                            elseif(empty($vlrpago)):
                               ?>
                              <script language="javascript">
                                alert("Digite el valor de pago para este documento ?")
                                history.back()
                              </script>
                             <?
                            elseif(empty($formapago)):
                               ?>
                              <script language="javascript">
                                alert("Seleccione la forma de pago para este Proveedor ?")
                                history.back()
                              </script>
                            <?
                               elseif($formapago=='CHEQUE' and $cheque==''):
                                 ?>
                              <script language="javascript">
                                alert("Debe de Digitar el Nro de Cheque para este documento.")
                                history.back()
                              </script>
                                 <?
                            elseif(empty($banco)):
                               ?>
                              <script language="javascript">
                                alert("Seleccione el medio de pago para este Proveedor ?")
                                history.back()
                              </script>
                               <?
                             elseif(empty($nota)):
                               ?>
                              <script language="javascript">
                                alert("Digite la nota de pago para este documento ?")
                                history.back()
                              </script>
                               <?
                           else:
                                $FechaR=date("Y-m-d");
                                include("../conexion.php");
                                $provedor=strtoupper($provedor);
                                $nota=strtoupper($nota);
                                $cheque=strtoupper($cheque);
                                if($estado=='NO'):
                                  $con="select comprobante.nrofactura from comprobante where comprobante.nrofactura='$nrofactura' and comprobante.nitprove='$nitprove'";
                                  $res=mysql_query($con)or die ("Error al buscar datos del examen");
                                  $reg=mysql_num_rows($res);
                                  if($reg==0):
	                                $consulta="select maestrocomprobante.nro from  maestrocomprobante where maestrocomprobante.nro='$nro'";
	                                $resultado=mysql_query($consulta) or die("Error al buscar datos de la factura");
	                                $registros=mysql_num_rows($resultado);
	                                if ($registros==0):
	                                   $consulta = "select count(*) from maestrocomprobante";
	                                   $result = mysql_query ($consulta);
	                                   $answ = mysql_fetch_row($result);
	                                  if ($answ[0] > 0):
	                                    $consulta = "select max(cast(nro as unsigned)) + 1 from maestrocomprobante";
	                                    $result2 = mysql_query($consulta);
	                                    $codc = mysql_fetch_row($result2);
	                                    $codex= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
	                                  else:
	                                    $codex = "000001";
	                                  endif;
	                                      $consulta="insert into maestrocomprobante(nro,codmaestro,codmuni,fechaRa,fechapago,id,usuario)
	                                              values('$codex','$nit','$municipio','$FechaR','$fechapago','$TipoComprobante','$Usuario')";
		                                    $resultado=mysql_query($consulta) or die("Error al Grabar datos del Comprobante");
                                                    /*Codigo para guardar el detalle*/
		                                    $consulta1="insert into comprobante(nro,nrofactura,nitprove,dv,cliente,fecha,valor,pago,cheque,codbanco,cuenta,concepto)
		                                                values('$codex','$nrofactura','$nitprove','$dv','$provedor','$fechapago','$vlrpago','$formapago','$cheque','$banco','$tipocta','$nota')";
		                                    $resultado=mysql_query($consulta1) or die("Error al grabar el detalle del comprobante");
		                                    header("location: Crearpago.php?nro=$codex&estado=$estado&nit=$nit&Usuario=$Usuario");
	                                elseif (empty($nro)):
	                                   ?>
	                                        <script language="javascript">
	                                                alert("Este conscutivo ya existe")
	                                                pagina="agregar.php"
	                                                tiempo=50
	                                                ubicacion="_self"
	                                                setTimeout("open(pagina,ubicacion)",tiempo)
	                                                history.back()
	                                        </script>
	                                   <?
	                                else:

                                                  $consulta1="insert into comprobante(nro,nrofactura,nitprove,dv,cliente,fecha,valor,pago,cheque,codbanco,cuenta,concepto)
		                                                values('$nro','$nrofactura','$nitprove','$dv','$provedor','$fechapago','$vlrpago','$formapago','$cheque','$banco','$tipocta','$nota')";
		                                    $resultado=mysql_query($consulta1) or die("Error al grabar el detalle del comprobante");
		                                    header("location: Crearpago.php?nro=$nro&estado=$estado&nit=$nit&Usuario=$Usuario");

	                                endif;
                              else:
                                   ?>
                                     <script language="javascript">
                                        alert("Esta Factura de Compra ya fue pagada a este proveedor, favor verificar. ?")
                                        history.back()
                                     </script>
                                   <?
                              endif;
                        endif;
                           endif;
                       else:
                           if($TipoPago=='compra'):
                               if(empty($municipio)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccione de la lista el municipio de Pago ?")
	                                history.back()
	                              </script>
	                             <?
                               elseif(empty($TipoComprobante)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccion el tipo de comprobante de la lista. ?")
	                                history.back()
	                              </script>
	                             <?
                               elseif(empty($NroPago)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccion de la lista una Factura para procesar. ?")
	                                history.back()
	                              </script>
	                             <?
                               elseif($validarPago==''):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccion una opcion de pago de la factura.")
	                                history.back()
	                              </script>
	                             <?
	                       elseif(empty($vlrpago)):
	                               ?>
	                              <script language="javascript">
	                                alert("Digite el valor de pago para este documento ?")
	                                history.back()
	                              </script>
	                             <?
	                       elseif(empty($formapago)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccione la forma de pago para este Proveedor ?")
	                                history.back()
	                              </script>
	                            <?
	                               elseif($formapago=='CHEQUE' and $cheque==''):
	                                 ?>
	                              <script language="javascript">
	                                alert("Debe de Digitar el Nro de Cheque para este documento.")
	                                history.back()
	                              </script>
	                                 <?
	                            elseif(empty($banco)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccione el medio de pago para este Proveedor ?")
	                                history.back()
	                              </script>
	                               <?

                                        elseif(empty($tipocta)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccione el tipo de Cuenta del débito ?")
	                                history.back()
	                              </script>
                                      <?
                                     else:
                                     include("../conexion.php");
                                        $consulta="select maestrocomprobante.nro from  maestrocomprobante where maestrocomprobante.nro='$nro'";
	                                $resultado=mysql_query($consulta) or die("Error al buscar datos de la factura para comparacion");
	                                $registros=mysql_num_rows($resultado);
	                                if ($registros==0):
	                                   $consulta = "select count(*) from maestrocomprobante";
	                                   $result = mysql_query ($consulta);
                                           $answ = mysql_fetch_row($result);
	                                  if ($answ[0] > 0):
	                                    $consulta = "select max(cast(nro as unsigned)) + 1 from maestrocomprobante";
	                                    $result2 = mysql_query($consulta);
	                                    $codc = mysql_fetch_row($result2);
	                                    $codex= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
	                                  else:
	                                    $codex = "000001";
	                                  endif;
                                          $FechaR=date("Y-m-d");
	                                       $consulta="insert into maestrocomprobante(nro,codmaestro,codmuni,fechaRa,fechapago,id,usuario)
		                                             values('$codex','$nit','$municipio','$FechaR','$fechapago','$TipoComprobante','$Usuario')";
		                               $resultado=mysql_query($consulta) or die("Error al Grabar datos del Comprobante");
                                               /*codigo que busca la factura*/
                                               $aux="select pagar.saldo,pagar.nrofactura,provedor.nitprove,provedor.dvprove,provedor.nomprove,pagar.nota,pagar.baserfte,pagar.rfte,pagar.ivapagado,provedor.dvprove,provedor.nomprove from pagar,provedor
                                                     where provedor.nitprove=pagar.nitprove and
                                                           pagar.conse='$NroPago'";
                                               $reP=mysql_query($aux)or die("Error al buscar el nombre");
                                               $filas_P=mysql_fetch_array($reP);
                                               $Provedor=$filas_P["nomprove"];
                                               $Dv=$filas_P["dvprove"];
                                               $NroFactura=$filas_P["nrofactura"];
                                               $ValorS=$filas_P["saldo"];
                                               $AuxSaldo=$filas_P["saldo"];
                                               $Saldo = $AuxSaldo - $vlrpago;
                                               $NitP=$filas_P["nitprove"];
                                               $Nota=$filas_P["nota"];
                                               /*CODIGO QUE PERMITE INSERTA EN EL DETALLE DEL COMPROBANTE*/
                                               $consulta1="insert into comprobante(nro,nrofactura,nitprove,dv,cliente,fecha,valor,pago,cheque,codbanco,cuenta,concepto)
		                                                values('$codex','$NroFactura','$NitP','$Dv','$Provedor','$fechapago','$vlrpago','$formapago','$cheque','$banco','$tipocta','$Nota')";
		                               $resultado=mysql_query($consulta1) or die("Error al grabar el detalle del comprobante");
                                                /*codigo de actualizacion*/
                                               if($validarPago=='parcial'):
                                                  $AuxT='ABONADA';
                                               else:
                                                 $AuxT='CANCELADA';
                                                 $Fuente=$filas_P["baserfte"]. ' ';
                                                 $IvaGenerado=$filas_P["ivapagado"]. ' ';
                                                 $PorFuente=$filas_P["rfte"];
                                               endif;
                                               if($vlrpago > $ValorS):
                                                 $consulta="delete from maestrocomprobante where nro='$codex'";
           				         $resultado=mysql_query($consulta) or die ("Error a eliminar datos");
                                                 $regP=mysql_affected_rows();
                                                 ?>
                                                     <script language="javascript">
			                                alert("El valor a pagar es mayor al saldo de la factura. Favor Eliminar Registro ")
			                                history.back()
			                              </script>
                                                  <?
                                               else:
                                                    $consC="update comprobante set retencionfuente='$Fuente',porfuente='$PorFuente',ivagenerado='$IvaGenerado' where comprobante.nro='$codex' and comprobante.nrofactura='$NroFactura'";
                                                    $resC=mysql_query($consC)or die("Error de actualizacion en la table comprobante");
                                                    /*segundo codigo*/
                                                    $conP="update pagar set saldo='$Saldo',estadofinal='$AuxT' where pagar.nrofactura='$NroFactura' and pagar.nitprove='$NitP'";
                                                    $resP=mysql_query($conP)or die("Error de actualizacion en la tabla Pagar");
                                                  header("location: Crearpago.php?nro=$codex&estado=$estado&nit=$nit&TipoPago=$TipoPago&Usuario=$Usuario");

                                               endif;
                                                    /**/
                                        elseif (empty($nro)):
	                                   ?>
	                                        <script language="javascript">
	                                                alert("Este conscutivo ya existe")
	                                                pagina="agregar.php"
	                                                tiempo=50
	                                                ubicacion="_self"
	                                                setTimeout("open(pagina,ubicacion)",tiempo)
	                                                history.back()
	                                        </script>
	                                   <?
	                                else:
                                         include("../conexion.php");
                                           $Saldo=0;$ValorS=0;$TotalSaldo=0;
                                             $aux="select pagar.saldo,pagar.nrofactura,provedor.nitprove,provedor.dvprove,provedor.nomprove,pagar.nota,pagar.baserfte,pagar.rfte,pagar.ivapagado,provedor.dvprove,provedor.nomprove from pagar,provedor
                                                     where provedor.nitprove=pagar.nitprove and
                                                           pagar.conse='$NroPago'";
                                               $reP=mysql_query($aux)or die("Error al buscar el nombre");
                                               $filas_P=mysql_fetch_array($reP);
                                               $Provedor=$filas_P["nomprove"];
                                               $Dv=$filas_P["dvprove"];
                                               $NroFactura=$filas_P["nrofactura"];
                                               $ValorS=$filas_P["saldo"];
                                               $AuxSaldo=$filas_P["saldo"];
                                               $Saldo = $AuxSaldo - $vlrpago;
                                               $NitP=$filas_P["nitprove"];
                                               $Nota=$filas_P["nota"];
                                              $consulta1="insert into comprobante(nro,nrofactura,nitprove,dv,cliente,fecha,valor,pago,cheque,codbanco,cuenta,concepto)
		                                                values('$nro','$NroFactura','$NitP','$Dv','$Provedor','$fechapago','$vlrpago','$formapago','$cheque','$banco','$tipocta','$Nota')";
		                               $resultado=mysql_query($consulta1) or die("Error al grabar el detalle del comprobante");
                                                    /*codigo de actualizacion*/
                                               if($validarPago=='parcial'):
                                                  $AuxT='ABONADA';
                                               else:
                                                  $AuxT='CANCELADA';
                                                  $Fuente=$filas_P["baserfte"]. ' ';
                                                  $IvaGenerado=$filas_P["ivapagado"]. ' ';
                                                  $PorFuente=$filas_P["rfte"];
                                               endif;
                                               echo $vlrpago. ' '. $ValorS;
                                               if($vlrpago > $ValorS):
                                                  ?>
                                                     <script language="javascript">
			                                alert("El valor a pagar es mayor al saldo de al factura. Favor Eliminar Registro ")
			                                history.back()
			                              </script>
                                                  <?
                                               else:
                                                    $consC="update comprobante set retencionfuente='$Fuente',porfuente='$PorFuente',ivagenerado='$IvaGenerado' where comprobante.nro='$nro' and comprobante.nrofactura='$NroFactura'";
                                                    $resC=mysql_query($consC)or die("Error de actualizacion en la table comprobante");
                                                    $Cot=mysql_affected_rows();
                                                    /*segundo codigo*/
                                                    $conP="update pagar set saldo='$Saldo',estadofinal='$AuxT' where pagar.nrofactura='$NroFactura' and pagar.nitprove='$NitP'";
                                                    $resP=mysql_query($conP)or die("Error de actualizacion en la tabla Pagar, Detallado");
		                                    header("location: Crearpago.php?nro=$nro&estado=$estado&nit=$nit&TipoPago=$TipoPago&Usuario=$Usuario");
                                               endif;

	                                endif;
                                   endif;
                           else:
                              if($TipoPago=='prestacion'):
                                 if(empty($municipio)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccione de la lista el municipio para el pago ?")
	                                history.back()
	                              </script>
	                             <?
                                  elseif(empty($TipoComprobante)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccioneel tipo de comprobante de la lista.!")
	                                history.back()
	                              </script>
	                             <?
                                 elseif(empty($NroPago)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccione el empleado para el pago de las prestaciones ?")
	                                history.back()
	                              </script>
	                             <?
	                              elseif(empty($vlrpago)):
	                               ?>
	                              <script language="javascript">
	                                alert("Digite el valor de pago para este documento ?")
	                                history.back()
	                              </script>
	                             <?
	                            elseif(empty($formapago)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccione la forma de pago para este pago de prestaciones ?")
	                                history.back()
	                              </script>
	                            <?
	                               elseif($formapago=='CHEQUE' and $cheque==''):
	                                 ?>
	                              <script language="javascript">
	                                alert("Debe de Digitar el Nro de Cheque para este documento.")
	                                history.back()
	                              </script>
	                                 <?
	                            elseif(empty($banco)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccione el medio de pago para este de prestaciones ?")
	                                history.back()
	                              </script>
	                               <?
                                        elseif(empty($tipocta)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccione el tipo de Cuenta del débito ?")
	                                history.back()
	                              </script>
	                               <?
                                     else:
                                     include("../conexion.php");
                                        $consulta="select maestrocomprobante.nro from  maestrocomprobante where maestrocomprobante.nro='$nro'";
	                                $resultado=mysql_query($consulta) or die("Error al buscar datos de la factura para comparacion");
	                                $registros=mysql_num_rows($resultado);
	                                if ($registros==0):
	                                   $consulta = "select count(*) from maestrocomprobante";
	                                   $result = mysql_query ($consulta);
	                                   $answ = mysql_fetch_row($result);
	                                  if ($answ[0] > 0):
	                                    $consulta = "select max(cast(nro as unsigned)) + 1 from maestrocomprobante";
	                                    $result2 = mysql_query($consulta);
	                                    $codc = mysql_fetch_row($result2);
	                                    $codex= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
	                                  else:
	                                    $codex = "000001";
	                                  endif;
                                          $FechaR=date("Y-m-d");
	                                       $consulta="insert into maestrocomprobante(nro,codmaestro,codmuni,fechaRa,fechapago,id,usuario)
		                                             values('$codex','$nit','$municipio','$FechaR','$fechapago','$TipoComprobante','$Usuario')";
		                               $resultado=mysql_query($consulta) or die("Error al Grabar datos del Comprobante");
                                               /*codigo del detalle*/
                                               $consulta1="insert into comprobante(nro,nrofactura,fecha,valor,pago,cheque,codbanco,cuenta)
		                                                values('$codex','$NroPago','$fechapago','$vlrpago','$formapago','$cheque','$banco','$tipocta')";
		                               $resultado=mysql_query($consulta1) or die("Error al grabar el detalle del comprobante");
                                                    /*codigo de actualizacion*/
                                               $aux="select prestacion.cedemple,prestacion.nombres,zona.nitzona,zona.zona from prestacion,empleado,zona
                                                     where zona.codzona=empleado.codzona and
                                                           empleado.cedemple=prestacion.cedemple and
                                                            prestacion.nropresta='$NroPago'";
                                               $reP=mysql_query($aux)or die("Error al buscar ls prestaciones");
                                               $filas_P=mysql_fetch_array($reP);
                                               $cliente=$filas_P["nombres"];
                                               $Cedula=$filas_P["cedemple"];
                                               $NitZona=$filas_P["nitzona"];
                                               $Zona=$filas_P["zona"];
                                               $AuxT='PAGADO';
                                               $consC="update comprobante set nitprove='$Cedula',cliente='$cliente',concepto='PAGO DE PRESTACIONES',nitzona='$NitZona',zona='$Zona' where comprobante.nro='$codex' and comprobante.nrofactura='$NroPago'";
                                               $resC=mysql_query($consC)or die("Error de actualizacion en la table comprobante");
                                              /*segundo codigo*/
                                               $conP="update prestacion set control='$AuxT' where prestacion.nropresta='$NroPago'";
                                               $resP=mysql_query($conP)or die("Error de actualizacion en la tabla Prestaciones");
                                               header("location: Crearpago.php?nro=$codex&estado=$estado&nit=$nit&TipoPago=$TipoPago&Usuario=$Usuario");
                                                    /**/
                                        elseif (empty($nro)):
	                                   ?>
	                                        <script language="javascript">
	                                                alert("Este conscutivo ya existe")
	                                                pagina="agregar.php"
	                                                tiempo=50
	                                                ubicacion="_self"
	                                                setTimeout("open(pagina,ubicacion)",tiempo)
	                                                history.back()
	                                        </script>
	                                   <?
	                                else:
                                              $consulta1="insert into comprobante(nro,nrofactura,fecha,valor,pago,cheque,codbanco,cuenta)
		                                                values('$nro','$NroPago','$fechapago','$vlrpago','$formapago','$cheque','$banco','$tipocta')";
		                               $resultado=mysql_query($consulta1) or die("Error al grabar el detalle del comprobante");
                                               /*codigo de actualizaciones*/
                                              $aux="select prestacion.cedemple,prestacion.nombres,zona.nitzona,zona.zona from prestacion,empleado,zona
                                                     where zona.codzona=empleado.codzona and
                                                           empleado.cedemple=prestacion.cedemple and
                                                            prestacion.nropresta='$NroPago'";
                                               $reP=mysql_query($aux)or die("Error al buscar ls prestaciones");
                                               $filas_P=mysql_fetch_array($reP);
                                               $cliente=$filas_P["nombres"];
                                               $Cedula=$filas_P["cedemple"];
                                               $NitZona=$filas_P["nitzona"];
                                               $Zona=$filas_P["zona"];
                                               $AuxT='PAGADO';
                                               $consC="update comprobante set nitprove='$Cedula',cliente='$cliente',concepto='PAGO DE PRESTACIONES',nitzona='$NitZona',zona='$Zona' where comprobante.nro='$nro' and comprobante.nrofactura='$NroPago'";
                                               $resC=mysql_query($consC)or die("Error de actualizacion en la table comprobante");
                                              /*segundo codigo*/
                                               $conP="update prestacion set control='$AuxT' where prestacion.nropresta='$NroPago'";
                                               $resP=mysql_query($conP)or die("Error de actualizacion en la tabla Prestaciones");
		                               header("location: Crearpago.php?nro=$nro&estado=$estado&nit=$nit&TipoPago=$TipoPago&Usuario=$Usuario");
	                                endif;
                                   endif;
                              else:
                                   if($TipoPago=='empleado'):
	                                  if(empty($municipio)):
		                               ?>
		                              <script language="javascript">
		                                alert("Seleccione de la lista el municipio para el pago ?")
		                                history.back()
		                              </script>
		                             <?
                                          elseif(empty($TipoComprobante)):
		                               ?>
		                              <script language="javascript">
		                                alert("Seleccione el tipo de comprobante de la Lista.!")
		                                history.back()
		                              </script>
		                             <?
	                                  elseif(empty($Documento)):
		                               ?>
		                              <script language="javascript">
		                                alert("Seleccione el empleado de la lista. ?")
		                                history.back()
		                              </script>
		                             <?
		                          elseif(empty($vlrpago)):
		                              ?>
		                              <script language="javascript">
		                                alert("Digite el valor de pago para este documento ?")
		                                history.back()
		                              </script>
		                             <?
		                         elseif(empty($formapago)):
		                               ?>
		                              <script language="javascript">
		                                alert("Seleccione la forma de pago para este empleado ?")
		                                history.back()
		                              </script>
		                            <?
		                         elseif($formapago=='CHEQUE' and $cheque==''):
		                                 ?>
		                              <script language="javascript">
		                                alert("Debe de Digitar el Nro de Cheque para este documento.")
		                                history.back()
		                              </script>
		                                 <?
		                         elseif(empty($banco)):
		                               ?>
		                              <script language="javascript">
		                                alert("Seleccione el medio de pago para este Empleado ?")
		                                history.back()
		                              </script>
		                               <?
	                                 elseif(empty($tipocta)):
		                               ?>
		                              <script language="javascript">
		                                alert("Seleccione el tipo de Cuenta del débito ?")
		                                history.back()
		                              </script>
		                               <?
	                                 else:
	                                       include("../conexion.php");
	                                        $consulta="select maestrocomprobante.nro from  maestrocomprobante where maestrocomprobante.nro='$nro'";
		                                $resultado=mysql_query($consulta) or die("Error al buscar datos de la factura para comparacion");
		                                $registros=mysql_num_rows($resultado);
		                                if ($registros==0):
		                                   $consulta = "select count(*) from maestrocomprobante";
		                                   $result = mysql_query ($consulta);
		                                   $answ = mysql_fetch_row($result);
		                                  if ($answ[0] > 0):
		                                    $consulta = "select max(cast(nro as unsigned)) + 1 from maestrocomprobante";
		                                    $result2 = mysql_query($consulta);
		                                    $codc = mysql_fetch_row($result2);
		                                    $codex= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
		                                  else:
		                                    $codex = "000001";
		                                  endif;
                                                     $FechaR=date("Y-m-d");
		                                       $consulta="insert into maestrocomprobante(nro,codmaestro,codmuni,fechaRa,fechapago,id,usuario)
			                                             values('$codex','$nit','$municipio','$FechaR','$fechapago','$TipoComprobante','$Usuario')";
			                               $resultado=mysql_query($consulta) or die("Error al Grabar datos del Comprobante");
	                                               /*codigo del detalle*/
	                                               $consulta1="insert into comprobante(nro,nitprove,fecha,valor,pago,cheque,codbanco,cuenta,concepto)
			                                                values('$codex','$Documento','$fechapago','$vlrpago','$formapago','$cheque','$banco','$tipocta','$nota')";
			                               $resultado=mysql_query($consulta1) or die("Error al grabar el detalle del comprobante");
	                                                    /*codigo de actualizacion*/
	                                               $aux="select concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple1) as Empleado,zona.zona,zona.nitzona from empleado,zona
	                                                     where  zona.codzona=empleado.codzona and
                                                                    empleado.cedemple='$Documento'";
	                                               $reP=mysql_query($aux)or die("Error al buscar empleados");
	                                               $filas_P=mysql_fetch_array($reP);
	                                               $Empleado=$filas_P["Empleado"];
                                                       $NitZona=$filas_P["nitzona"];
                                                       $Zona=$filas_P["zona"];
	                                               $consC="update comprobante set cliente='$Empleado',nitzona='$NitZona',zona='$Zona' where comprobante.nro='$codex' and comprobante.nitprove='$Documento'";
	                                               $resC=mysql_query($consC)or die("Error de actualizacion en la table comprobante");
	                                               header("location: Crearpago.php?nro=$codex&estado=$estado&nit=$nit&TipoPago=$TipoPago&Usuario=$Usuario");
	                                                    /**/
	                                        elseif (empty($nro)):
		                                   ?>
		                                        <script language="javascript">
		                                                alert("Este conscutivo ya existe")
		                                                pagina="CrearPago.php"
		                                                tiempo=50
		                                                ubicacion="_self"
		                                                setTimeout("open(pagina,ubicacion)",tiempo)
		                                                history.back()
		                                        </script>
		                                   <?
		                                else:
	                                             $consulta1="insert into comprobante(nro,nitprove,fecha,valor,pago,cheque,codbanco,cuenta,concepto)
			                                                values('$nro','$Documento','$fechapago','$vlrpago','$formapago','$cheque','$banco','$tipocta','$nota')";
			                               $resultado=mysql_query($consulta1) or die("Error al grabar el detalle del comprobante");
	                                                    /*codigo de actualizacion*/
	                                               $aux="select concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple1) as Empleado,zona.zona,zona.nitzona from empleado,zona
	                                                     where zona.codzona=empleado.codzona and
                                                                   empleado.cedemple='$Documento'";
	                                               $reP=mysql_query($aux)or die("Error al buscar empleados");
	                                               $filas_P=mysql_fetch_array($reP);
	                                               $Empleado=$filas_P["Empleado"];
                                                       $NitZona=$filas_P["nitzona"];
                                                       $Zona=$filas_P["zona"];
	                                               $consC="update comprobante set cliente='$Empleado',nitzona='$NitZona',zona='$Zona' where comprobante.nro='$nro' and comprobante.nitprove='$Documento'";
	                                               $resC=mysql_query($consC)or die("Error de actualizacion en la table comprobante");
			                               header("location: Crearpago.php?nro=$nro&estado=$estado&nit=$nit&TipoPago=$TipoPago&Usuario=$Usuario");
		                                endif;
	                                 endif;
                                     else:
                                         if(empty($municipio)):
		                               ?>
		                              <script language="javascript">
		                                alert("Seleccione de la lista el municipio para el pago ?")
		                                history.back()
		                              </script>
		                             <?
                                           elseif(empty($TipoComprobante)):
		                               ?>
		                              <script language="javascript">
		                                alert("Seleccione el tipo de comprobante de la Lista.!")
		                                history.back()
		                              </script>
		                             <?
	                                  elseif(empty($NroPago)):
		                               ?>
		                              <script language="javascript">
		                                alert("Seleccione el empleado de la lista. ?")
		                                history.back()
		                              </script>
		                             <?
		                          elseif(empty($vlrpago)):
		                              ?>
		                              <script language="javascript">
		                                alert("Digite el valor de pago para este documento ?")
		                                history.back()
		                              </script>
		                             <?
		                         elseif(empty($formapago)):
		                               ?>
		                              <script language="javascript">
		                                alert("Seleccione la forma de pago para este empleado ?")
		                                history.back()
		                              </script>
		                            <?
		                         elseif($formapago=='CHEQUE' and $cheque==''):
		                                 ?>
		                              <script language="javascript">
		                                alert("Debe de Digitar el Nro de Cheque para este documento.")
		                                history.back()
		                              </script>
		                                 <?
		                         elseif(empty($banco)):
		                               ?>
		                              <script language="javascript">
		                                alert("Seleccione el medio de pago para este Empleado ?")
		                                history.back()
		                              </script>
		                               <?
	                                 elseif(empty($tipocta)):
		                               ?>
		                              <script language="javascript">
		                                alert("Seleccione el tipo de Cuenta del débito ?")
		                                history.back()
		                              </script>
		                               <?
	                                 else:
	                                       include("../conexion.php");
	                                        $consulta="select maestrocomprobante.nro from  maestrocomprobante where maestrocomprobante.nro='$nro'";
		                                $resultado=mysql_query($consulta) or die("Error al buscar datos de la factura para comparacion");
		                                $registros=mysql_num_rows($resultado);
		                                if ($registros==0):
		                                   $consulta = "select count(*) from maestrocomprobante";
		                                   $result = mysql_query ($consulta);
		                                   $answ = mysql_fetch_row($result);
		                                  if ($answ[0] > 0):
		                                    $consulta = "select max(cast(nro as unsigned)) + 1 from maestrocomprobante";
		                                    $result2 = mysql_query($consulta);
		                                    $codc = mysql_fetch_row($result2);
		                                    $codex= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
		                                  else:
		                                    $codex = "000001";
		                                  endif;
	                                               $FechaR=date("Y-m-d");
		                                       $consulta="insert into maestrocomprobante(nro,codmaestro,codmuni,fechaRa,fechapago,id,usuario)
			                                             values('$codex','$nit','$municipio','$FechaR','$fechapago','$TipoComprobante','$Usuario')";
			                               $resultado=mysql_query($consulta) or die("Error al Grabar datos del Comprobante");
	                                               /*codigo del detalle*/
	                                               $consulta1="insert into comprobante(nro,nrofactura,fecha,valor,pago,cheque,codbanco,cuenta,concepto)
			                                                values('$codex','$NroPago','$fechapago','$vlrpago','$formapago','$cheque','$banco','$tipocta','$nota')";
			                               $resultado=mysql_query($consulta1) or die("Error al grabar el detalle del comprobante");
                                                        /*codigo de actualizacion*/
	                                               $aux="select vacacion.cedemple,vacacion.nombre,zona.zona,zona.nitzona from vacacion,zona,empleado
	                                                     where zona.codzona=empleado.codzona and
                                                                   empleado.cedemple=vacacion.cedemple and
                                                                   vacacion.codvaca='$NroPago'";
	                                               $reP=mysql_query($aux)or die("Error al buscar las vacaciones");
	                                               $filas_P=mysql_fetch_array($reP);
	                                               $cliente=$filas_P["nombre"];
	                                               $Cedula=$filas_P["cedemple"];
                                                       $NitZona=$filas_P["nitzona"];
                                                       $Zona=$filas_P["zona"];
	                                               $AuxT='PAGADO';
	                                               $consC="update comprobante set nitprove='$Cedula',cliente='$cliente',concepto='PAGO DE VACACIONES',nitzona='$NitZona',zona='$Zona' where comprobante.nro='$codex' and comprobante.nrofactura='$NroPago'";
	                                               $resC=mysql_query($consC)or die("Error de actualizacion en la table comprobante");
	                                              /*segundo codigo*/
	                                               $conP="update vacacion set control='$AuxT' where vacacion.codvaca='$NroPago'";
	                                               $resP=mysql_query($conP)or die("Error de actualizacion en la tabla vacaciones");
	                                               header("location: Crearpago.php?nro=$codex&estado=$estado&nit=$nit&TipoPago=$TipoPago&Usuario=$Usuario");
	                                                    /**/
	                                        elseif (empty($nro)):
		                                   ?>
		                                        <script language="javascript">
		                                                alert("Este conscutivo ya existe")
		                                                pagina="CrearPago.php"
		                                                tiempo=50
		                                                ubicacion="_self"
		                                                setTimeout("open(pagina,ubicacion)",tiempo)
		                                                history.back()
		                                        </script>
		                                   <?
		                                else:
	                                             $consulta1="insert into comprobante(nro,nrofactura,fecha,valor,pago,cheque,codbanco,cuenta,concepto)
			                                                values('$nro','$NroPago','$fechapago','$vlrpago','$formapago','$cheque','$banco','$tipocta','$nota')";
			                               $resultado=mysql_query($consulta1) or die("Error al grabar el detalle del comprobante");
                                                     /*codigo de actualizacion*/
                                                       $aux="select vacacion.cedemple,vacacion.nombre,zona.zona,zona.nitzona from vacacion,zona,empleado
	                                                     where zona.codzona=empleado.codzona and
                                                                   empleado.cedemple=vacacion.cedemple and
                                                                   vacacion.codvaca='$NroPago'";
	                                               $reP=mysql_query($aux)or die("Error al buscar las vacaciones");
	                                               $filas_P=mysql_fetch_array($reP);
	                                               $cliente=$filas_P["nombre"];
	                                               $Cedula=$filas_P["cedemple"];
                                                       $NitZona=$filas_P["nitzona"];
                                                       $Zona=$filas_P["zona"];
	                                               $AuxT='PAGADO';
	                                               $consC="update comprobante set nitprove='$Cedula',cliente='$cliente',concepto='PAGO DE VACACIONES',nitzona='$NitZona',zona='$Zona' where comprobante.nro='$nro' and comprobante.nrofactura='$NroPago'";
	                                               $resC=mysql_query($consC)or die("Error de actualizacion en la table comprobante");
	                                              /*segundo codigo*/
	                                               $conP="update vacacion set control='$AuxT' where vacacion.codvaca='$NroPago'";
	                                               $resP=mysql_query($conP)or die("Error de actualizacion en la tabla vacaciones");
			                               header("location: Crearpago.php?nro=$nro&estado=$estado&nit=$nit&TipoPago=$TipoPago&Usuario=$Usuario");
		                                endif;
	                                 endif;
                                     endif;
                              endif;
                           endif;/*este codigo es de estado de proceso*/

                   endif;
             endif;
?>
</body>
</html>
