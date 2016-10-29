	    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='PagoGrupal.php'
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
        if (!isset($CodMuni)):
           ?>
            <center><h4><u>Recibo de Caja</u></h4></center>
            <form action="" method="post">
               <input type="hidden" name="estado" value="<? echo $estado;?>" id="estado">
               <input type="hidden" name="TipoPago" value="<? echo $TipoPago;?>">
                 <?if($estado=='SI'){?>
                   <table border="0" align="center" width="680">
                 <?}else{?>
                    <table border="0" align="center" width="715">
                   <?
                 }
                   include("../conexion.php");
                   if (!$nro):
                        $codex=$nro;
                        ?>
                        <tr>
                          <td><b>Nit/Cedula:</b></td>
                          <td><input type="text" name="nit" value="<? echo $NitEmpresa;?>" size="13" readonly class="cajas" id="nit"></td>
                          <td><b>Empresa:</b></td>
                          <td colspan="10"><input type="text" name="empresa" value="<?echo $Empresa;?>" size="40" class="cajas" readonly></td>
                        </tr>
                        <tr>
			   <td><b>Municipio:</b></td>
			   <td  colspan="25"><select name="CodMuni" class="cajas" id="CodMuni">
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
	                   </select>
                           <b>Fecha_Pago:</b>
                           <input type="text" name="fechapago" value="<?echo date("Y-m-d");?>" size="13" maxlength="10" class="cajas" id="fechapago"></td>
                         </tr>
                         <tr>
		           <td><b>Tipo_Recibo:</b></td>
		           <td colspan="20"><select name="TipoRecibo" class="cajas" id="TipoRecibo">
		           <option value="0">Seleccione
		           <?$con="select idrecibo,descripcion from tiporecibo where estado='ACTIVO' order by descripcion ";
		           $resu=mysql_query($con)or die("Error de busqueda de tipos de recibo");
		           while($fila=mysql_fetch_array($resu)){
		                   ?>
		                    <option value="<? echo $fila["idrecibo"];?>"><?echo $fila["descripcion"];?>
		                  <?
		          }?>
		         </select>
                         <b>Vlr_Pago:</b>
                           <input type="text" name="valorP" value="" size="13" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="valorP"></td>
                        </tr>
                        <?
                        else:
                           $codex=$nro;
                            $consulta="select maestrorecibo.*,maestro.nomaestro,municipio.municipio,tiporecibo.descripcion from maestrorecibo,maestro,municipio,tiporecibo
                            where maestro.codmaestro=maestrorecibo.codmaestro and
                            maestrorecibo.codmuni=municipio.codmuni and
                            maestrorecibo.idrecibo=tiporecibo.idrecibo and
                            maestrorecibo.codmaestro='$nit' and maestrorecibo.nrocaja='$codex'";
                            $resultado=mysql_query($consulta) or die("error al buscar datos");
                            $filas=mysql_fetch_array($resultado);
                            $CodMuni=$filas["codmuni"];
                            ?>
                            <tr>
                                <td><b>Nit/Cedula:</b></td>
                                <td><input type="text" name="nit" value="<? echo $filas["codmaestro"];?>" size="13" readonly class="cajas" id="nit"></td>
                                <td><b>Empresa:</b></td>
                                <td><input type="text" name="empresa" value="<?echo $filas["nomaestro"];?>" size="40" class="cajas" readonly></td>
                            </tr>
                            <tr>
                                <td><b>Cod_Muni.:</b></td>
                                <td><input type="text" name="CodMuni" value="<?echo $filas["codmuni"];?>" size="13" class="cajas" readonly id="CodMuni"></td>
                                  <td><b>Municipio:</b></td>
                                <td><input type="text"  value="<?echo $filas["municipio"];?>" size="30" class="cajas" readonly ></td>
                            </tr>
                            <tr>
                             <td><b>Fecha_Pago:</b></td>
                                <td><input type="text" name="fechapago" value="<?echo $filas["fechapago"];?>" size="13" maxlength="10" class="cajas" readonly id="fechapago"></td>
                                <td><b>Vlr_Pago:</b></td>
                                <td><input type="text" name="valorP" value="<?echo $filas["vlrpagado"];?>" size="13" maxlength="11" class="cajas" readonly id="valorP"></td>
                             </tr>
                             <tr>
                                <td><b>Tipo_Recibo:</b></td>
                                <td><input type="text" name="TipoRecibo" value="<?echo $filas["idrecibo"];?>" size="13" class="cajas" readonly id="TipoRecibo"></td>
                                  <td><b>Descripción:</b></td>
                                <td><input type="text"  value="<?echo $filas["descripcion"];?>" size="30" class="cajas" readonly ></td>
                            </tr>
                              <?
                         endif;
                          ?>
                            <tr><td colspan="30">-----------------------------------------------------------------------------------------------------------------------------------------------------------------------</td></tr>
                           <?
                         if($estado=='NO'):
                                     ?>
                                      <tr>
                                      <td><b>Documento:</b></td>
                                       <td colspan="30"><input type="text" name="nrofactura" value="" size="13" maxlength="13" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="nrofactura">
                                       <b>Nit:</b>
                                       <input type="text" name="nitcliente" value="" size="11" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="nitcliente">
                                       <b>Dv:</b>
                                       <input type="text" name="dv" value="" size="1" maxlength="1" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="dv">
                                       <b>Cliente:</b>
                                       <input type="text" name="cliente" value="" size="47" maxlength="47" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="cliente"></td>
	                            </tr>
                                     <tr>
                                      <td><b>Dirección:</b></td>
                                       <td colspan="30"><input type="text" name="direcion" value="" size="45" maxlength="45" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="direcion">
                                       <b>Teléfono:</b>
                                       <input type="text" name="telefono" value="" size="11" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="telefono">
                                       <b>Abono:</b>
                                       <input type="text" name="vlrpago" value="" size="11" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="vlrpago">
	                            </tr>
	                            <tr>
                                      <td><b>Forma_Pago:</b></td>
                                       <td colspan="30"><select name="formapago" class="cajas">
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
			             </select>
                                     <b>Tipo_Cta:</b>
                                       <select name="tipocta" class="cajas">
				           <option value="0">Cuenta
				           <option value="AHORRO">AHORRO
				           <option value="CORRIENTE">CORRIENTE
                                           <option value="OFICINA">OFICINA
				         </select></td>
	                            </tr>
                                   <tr>
                                       <td><b>Nota:</b></td>
                                          <td colspan="30"><input type="text" name="nota" value="" size="40" maxlength="35" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="nota"></td>
                                   </tr>
                                    <tr>
                                   <td colspan="30"><div align="right"><input type="submit" value="Agregar"></div></td>
	                             </tr>
	                         </table>
	                            <input type="hidden" name="MM_insert" value="form1">
                          <?
                          else:
                                      $FechaV=date("Y-m-d");
                                       ?>
	                               <tr><td >&nbsp;</td></tr>
                                        <td><b>Nro_Factura:</b></td>
                                          <td><input type="text" name="nrofactura" value="" size="13" maxlength="13" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="nrofactura"></td>
	                                 <td><b>Empleado:</b></td>
                                       	     <td><select name="Documento" class="cajasletra" id="Documento">
				                <option value="0">Seleccione el Empleado
				               <?
	                                       $conF="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple1) as Empleado from empleado,contrato
		                                         where empleado.codemple=contrato.codemple and
	                                                 contrato.fechater='0000-00-00' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
	                                       $resuF=mysql_query($conF) or die("error al buscar empleados");
			                       while ($filas=mysql_fetch_array($resuF)):
	    	                                ?>
			                          <option value="<?echo $filas["cedemple"];?>"><?echo $filas["Empleado"];?>-<?echo $filas["cedemple"];?>
			                          <?
			                       endwhile;
			                        ?>
				               </select></td>
                                       </tr>
                                       <tr>
                                       <td><b>Abono:</b></td>
                                         <td><input type="text" name="vlrpago" value="" size="15" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="vlrpago"></td>
                                        <td><b>Forma_Pago:</b></td>
                                           <td><select name="formapago" class="cajas">
					           <option value="0">Seleccione
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
                                          <td><b>Tipo_Cta:</b></td>
                                           <td><select name="tipocta" class="cajas" id="tipocta">
					           <option value="0">Seleccione
					           <option value="AHORRO">AHORRO
					           <option value="CORRIENTE">CORRIENTE
	                                           <option value="OFICINA">OFICINA
					         </select></td>
                                        <td><b>Nota:</b></td>
                                           <td colspan="20"><input type="text" name="nota" value="" size="45" maxlength="35" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"id="nota"></td>
                                      </tr>
                                   <td colspan="30"><div align="right"><input type="submit" value="Agregar"></div></td>
	                             </tr>
	                            </table>
	                             <input type="hidden" name="MM_insert" value="form1">
                                    <?
                        endif;
                        ?>
                        </table>
                        </form>
                       <?
                        include("../conexion.php");
                        $consulta_d="select recibo.*,banco.bancos from recibo,banco
                         where recibo.codbanco=banco.codbanco and
                               recibo.nrocaja='$codex'";
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
                                <table border="1" align="center" width="870">
                                        <tr class="fondo">
                                                <th>&nbsp;</td>
                                                <th>&nbsp;</th>
                                                <th>Item</th>
                                                <th>Documento</th>
                                                <th>Nit/Cédula</th>
                                                <th>Cliente</th>
                                                <th>Abono</th>
                                                <th>Saldo</th>
                                                <th>Forma_Pago</th>
                                                <th>Producto</th>
                                                <th>Entidad</th>

                                        </tr>
                              	        <?
                                       $x=1;
                                       while ($filas_d = mysql_fetch_array($resultado_d)):
                                           $valor=number_format($filas_d["abono"],0);
                                            $Saldo=number_format($filas_d["nuevosaldo"],0);
                                           ?>
                                          <tr align="center" class="cajas">
                                                <input type="hidden" name="nit" value="<?echo $nit;?>">
                                                <input type="hidden" name="codex" value="<?echo $codex;?>">
                                                <th>&nbsp;<input type="checkbox" name="datos[]" value="<?echo $filas_d["id"];?>"></th>
                                                <td>&nbsp;<a href="ModificarRecibo.php?codigo=<?echo $filas_d["id"];?>&TipoPago=<?echo $TipoPago;?>&NroFactura=<?echo $filas_d["nrofactura"];?>&NitP=<?echo $filas_d["nitcliente"];?>&codex=<?echo $codex;?>&nit=<?echo $nit;?>&estado=<?echo $estado;?>"><img src="../image/mod.jpg" border="0" alt="Modificar Registro"></a></td>
                                                <td><div align="center"><font color="blue"><b><?echo $x;?></b></font></div></td>
                                                <td><div align="center"><font color="blue"><b><?echo $filas_d["nrofactura"];?></b></font></div></td>
                                                <td><div align="center"><font color="blue"><b><?echo $filas_d["nit"];?></b></font></div></td>
                                                <td><div align="left"><font color="blue"><b><?echo $filas_d["zona"];?></b></font></div></td>
                                                <td><div align="right"><font color="red"><b>$<?echo $valor;?></b></font></div></td>
                                                <td><div align="right"><font color="red"><b>$<?echo $Saldo;?></b></font></div></td>
                                                <td><div align="center"><font color="blue"><b><?echo $filas_d["pago"];?></b></font></div></td>
                                                 <td><div align="center"><font color="blue"><b><?echo $filas_d["cuenta"];?></b></font></div></td>
                                                <td><font color="blue"><b><?echo $filas_d["bancos"];?></b></font></td>
                                           </tr>
                                       <?
                                       $x=$x+1;
                                       $TotalC=$TotalC+$filas_d["valor"];
                                       endwhile;
                                       include("../numeros.php");
                                       $letras=num2letras($TotalC);
                                       $letras=strtoupper($letras);
                                       $TotalPagar=number_format($TotalC,0);
                                       $conF="update maestrorecibo set vlrpagado='$TotalC',letras='$letras' where maestrorecibo.nrocaja='$codex'";
                                       $resF=mysql_query($conF)or die ("Error al actualizar");
                                       $reg=mysql_affected_rows();
                                        ?>
                                       <tr>
                                       <td colspan="9">&nbsp;</td>
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
	                            <td colspan="9" align="center"><input type="submit" value="Eliminar"></td>
	                          </tr>
	                     </table>
                          </form>

                         <th><a href="ImprimirRecibo.php?NroRecibo=<?echo $codex;?>" target="_blank" onclick="volver()" class="fondo"><b><div align="center"><font color="red">Imprimir</font></div></b></a></th>
                         <?
                        endif;
         else:
                if($estado=='NO'):
                      if(empty($CodMuni)):
                              ?>
                              <script language="javascript">
                               alert("Seleccione de la lista el municipio ?")
                                history.back()
                              </script>
                              <?
                        elseif(empty($TipoRecibo)):
                                ?>
                               <script language="javascript">
                                alert("Seleccione el tipo de recibo a generar.!")
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
                       elseif(empty($nitcliente)):
                               ?>
                              <script language="javascript">
                                alert("Digite el Nit/Cédula del Cliente?")
                                history.back()
                              </script>
                                <?
                       elseif(empty($cliente)):
                               ?>
                              <script language="javascript">
                                alert("Digite el nombre del Cliente?")
                                history.back()
                              </script>
                           <?
                       elseif(empty($direcion)):
                               ?>
                              <script language="javascript">
                                alert("Digite la direcció del Cliente?")
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
                                alert("Seleccione la forma de pago de este Cliente ?")
                                history.back()
                              </script>
                            <?
                       elseif(empty($banco)):
                               ?>
                              <script language="javascript">
                                alert("Seleccione el Banco para el Ingreso ?")
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
                                $cliente=strtoupper($cliente);
                                $nota=strtoupper($nota);
                                $cheque=strtoupper($cheque);
                                $direcion=strtoupper($direcion);
                                $con="select recibo.nrocaja from recibo where recibo.nrofactura='$nrofactura' and recibo.nit='$nitcliente'";
                                $res=mysql_query($con)or die ("Error al buscar datos del examen");
                                $reg=mysql_num_rows($res);
                                if($reg==0):
	                                $consulta="select maestrorecibo.nrocaja from  maestrorecibo where maestrorecibo.nrocaja='$nro'";
	                                $resultado=mysql_query($consulta) or die("Error al buscar datos del recibo");
	                                $registros=mysql_num_rows($resultado);
	                                if ($registros==0):
	                                   $consulta = "select count(*) from maestrorecibo";
	                                   $result = mysql_query ($consulta);
	                                   $answ = mysql_fetch_row($result);
	                                  if ($answ[0] > 0):
	                                    $consulta = "select max(cast(nrocaja as unsigned)) + 1 from maestrorecibo";
	                                    $result2 = mysql_query($consulta);
	                                    $codc = mysql_fetch_row($result2);
	                                    $codex= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
	                                  else:
	                                    $codex = "000001";
	                                  endif;
                                          $AuxP=$vlrpago-$vlrpago;
	                                  $consulta="insert into maestrorecibo(nrocaja,codmaestro,codmuni,fechaRa,fechapago,idrecibo)
		                                              values('$codex','$nit','$CodMuni','$FechaR','$fechapago','$TipoRecibo')";
		                          $resultado=mysql_query($consulta) or die("Error al Grabar datos del recibo");
                                          /*codigo para buscar el pocentaje del item de recibo*/
                                          $ConI="select tiporecibo.porcentaje from  tiporecibo where tiporecibo.idrecibo='$TipoRecibo'";
	                                  $ResI=mysql_query($ConI) or die("Error al buscar el item del recibo de caja");
	                                  $Registros=mysql_fetch_array($ResI);
                                          $VlrP=$Registros["porcentaje"];
                                          $Aux=0;
                                          $Aux= round(($vlrpago * $VlrP )/100);
                                          /*Codigo para guardar el detalle*/
		                          $consulta1="insert into recibo(nrocaja,fechare,nrofactura,zona,dir,telefono,nit,dv,valor,abono,cree,codbanco,cuenta,pago,nuevosaldo,concepto)
		                                                values('$codex','$fechapago','$nrofactura','$cliente','$direcion','$telefono','$nitcliente','$dv','$vlrpago','$vlrpago','$Aux','$banco','$tipocta','$formapago','$AuxP','$nota')";
		                          $resultado=mysql_query($consulta1) or die("Error al grabar el detalle del comprobante");
		                          header("location: CrearPagoRecibo.php?nro=$codex&estado=$estado&nit=$nit");
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
                                             $ConI="select tiporecibo.porcentaje from  tiporecibo where tiporecibo.idrecibo='$TipoRecibo'";
	                                     $ResI=mysql_query($ConI) or die("Error al buscar el item del recibo de caja");
	                                     $Registros=mysql_fetch_array($ResI);
                                             $VlrP=$Registros["porcentaje"];
                                             $Aux=0;
                                             $Aux= round(($vlrpago * $VlrP )/100);
                                             $consulta1="insert into recibo(nrocaja,fechare,nrofactura,zona,dir,telefono,nit,dv,valor,abono,cree,codbanco,cuenta,pago,nuevosaldo,concepto)
		                                                values('$nro','$fechapago','$nrofactura','$cliente','$direcion','$telefono','$nitcliente','$dv','$vlrpago','$vlrpago','$Aux','$banco','$tipocta','$formapago','$AuxP','$nota')";
	                                     $resultado=mysql_query($consulta1) or die("Error al grabar el detalle del comprobante");
                                             header("location: CrearPagoRecibo.php?nro=$nro&estado=$estado&nit=$nit");

	                                endif;
                                 else:
                                     ?>
                                      <script language="javascript">
	                                alert("El Nro de Documento de pago o factura, ya esta cancelada a este Cliente ?")
	                                history.back()
	                              </script>
                                     <?
                                 endif;
                       endif;
                  else:
                       if(empty($CodMuni)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccione de la lista el municipio de Pago ?")
	                                history.back()
	                              </script>
                                  <?
                                elseif(empty($TipoRecibo)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccione de la lista el tipo de Recibo.!")
	                                history.back()
	                              </script>
	                            <?
                               elseif(empty($nrofactura)):
	                               ?>
	                              <script language="javascript">
	                                alert("Digite el Número de factura / Documento como soporte al pago?")
	                                history.back()
	                              </script>
	                            <?
                               elseif(empty($Documento)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccion la lista el empleado para el documento?")
	                                history.back()
	                              </script>
	                            <?
                             elseif(empty($vlrpago)):
	                               ?>
	                              <script language="javascript">
	                                alert("Digite el valor a abonar o cancelar la factura de venta ?")
	                                history.back()
	                              </script>
	                             <?
	                       elseif(empty($formapago)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccione la forma de pago de la factura de Venta ?")
	                                history.back()
	                              </script>
	                            <?
	                       elseif(empty($banco)):
	                               ?>
	                              <script language="javascript">
	                                alert("Seleccione la Entidad Bancaria de este pago ?")
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
                                elseif(empty($nota)):
	                               ?>
	                              <script language="javascript">
	                                alert("Digite la observación del recibo de Caja ?")
	                                history.back()
	                              </script>
                                      <?
                               else:
                                       include("../conexion.php");
                                       $consulta="select maestrorecibo.nrocaja from  maestrorecibo where maestrorecibo.nrocaja='$nro'";
	                               $resultado=mysql_query($consulta) or die("Error al buscar datos de duplicidad");
	                               $registros=mysql_num_rows($resultado);
	                               if ($registros==0):
	                                   $consulta = "select count(*) from maestrorecibo";
	                                   $result = mysql_query ($consulta);
	                                   $answ = mysql_fetch_row($result);
	                                  if ($answ[0] > 0):
	                                    $consulta = "select max(cast(nrocaja as unsigned)) + 1 from maestrorecibo";
	                                    $result2 = mysql_query($consulta);
	                                    $codc = mysql_fetch_row($result2);
	                                    $codex= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
	                                  else:
	                                    $codex = "000001";
	                                  endif;
                                              $nota=strtoupper($nota);
                                              $FechaR=date("Y-m-d");
                                              $consulta="insert into maestrorecibo(nrocaja,codmaestro,codmuni,fechaRa,fechapago,idrecibo)
		                                              values('$codex','$nit','$CodMuni','$FechaR','$fechapago','$TipoRecibo')";
		                                    $resultado=mysql_query($consulta) or die("Error al Grabar datos del recibo");
                                                    /*Codigo para guardar el detalle*/
                                                   $consulta1="insert into recibo(nrocaja,fechare,nrofactura,nit,valor,abono,codbanco,cuenta,pago,concepto)
		                                                values('$codex','$fechapago','$nrofactura','$Documento','$vlrpago','$vlrpago','$banco','$tipocta','$formapago','$nota')";
		                                    $resultado=mysql_query($consulta1) or die("Error al grabar el detalle del recibo");
                                                    /*codigo de actualizacion*/
                                               $aux="select empleado.cedemple,empleado.telemple,empleado.diremple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple1) as Nombres from empleado
	                                         where empleado.cedemple='$Documento'";
                                               $reP=mysql_query($aux)or die("Error al buscar empleados");
                                               $Rt=mysql_affected_rows();
                                               $filas_P=mysql_fetch_array($reP);
                                               $Nombres=$filas_P["Nombres"];
                                               $Direccion=$filas_P["diremple"];
                                               $Telefono=$filas_P["telemple"];
                                               $consC="update recibo set zona='$Nombres',dir='$Direccion',telefono='$Telefono' where recibo.nrocaja='$codex' and recibo.nit='$Documento'";
                                               $resC=mysql_query($consC)or die("Error de actualizacion en la table Recibo");
                                               $Cot=mysql_affected_rows();
                                               header("location: CrearPagoRecibo.php?nro=$codex&estado=$estado&nit=$nit&TipoPago=$TipoPago");
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
                                             $nota=strtoupper($nota);
                                             $consulta1="insert into recibo(nrocaja,fechare,nrofactura,nit,valor,abono,codbanco,cuenta,pago,concepto)
		                                                values('$nro','$fechapago','$nrofactura','$Documento','$vlrpago','$vlrpago','$banco','$tipocta','$formapago','$nota')";
		                                    $resultado=mysql_query($consulta1) or die("Error al grabar el detalle del recibo");
                                                    /*codigo de actualizacion*/
                                             $aux="select empleado.cedemple,empleado.telemple,empleado.diremple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple1) as Nombres from empleado
	                                         where empleado.cedemple='$Documento'";
                                               $reP=mysql_query($aux)or die("Error al buscar el relacion de la zona");
                                               $Rt=mysql_affected_rows();
                                               $filas_P=mysql_fetch_array($reP);
                                               $Nombres=$filas_P["Nombres"];
                                               $Direccion=$filas_P["diremple"];
                                               $Telefono=$filas_P["telemple"];
                                               $consC="update recibo set zona='$Nombres',dir='$Direccion',telefono='$Telefono' where recibo.nrocaja='$nro' and recibo.nit='$Documento'";
                                               $resC=mysql_query($consC)or die("Error de actualizacion en la table Recibo");
                                               $Cot=mysql_affected_rows();
		                                    header("location: CrearPagoRecibo.php?nro=$nro&estado=$estado&nit=$nit&TipoPago=$TipoPago");
	                               endif;
                       endif;/*este codigo es de estado de proceso*/
              endif;
       endif;
?>
</body>
</html>
