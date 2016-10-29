        <html>
        <head>
                <title>Editar Registro</title>
                  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</script>
        </head>
        <body>
        <?
                include("../conexion.php");
                $conB="select pagar.saldo from pagar where pagar.nrofactura='$NroFactura' and pagar.nitprove='$NitP' and pagar.saldo <= 0";
                $resB=mysql_query($conB) or die("Error de Actualizacion");
                $regB=mysql_num_rows($resB);
                if($regB=='0'):
                   if (!isset($nrofactura)):
                        $consulta="select comprobante.* from comprobante where conse='$codigo'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0):
                                  ?>
                                <script language="javascript">
                                        alert("No Existen Registros en la consulta ?")
                                        history.back()
                                </script>
                                  <?
                        else:
                           while ($filas=mysql_fetch_array($resultado)):
                                   ?>

                             <center><h4><u>Editar Registro</u></h4></center>
                              <form action="" method="post">
                              <input type="hidden" name="nro" value="<?echo $codex;?>">
                              <input type="hidden" name="nit" value="<?echo $nit;?>">
                               <input type="hidden" name="estado" value="<?echo $estado;?>">
                               <input type="hidden" name="TipoPago" value="<?echo $TipoPago;?>">
                                 <input type="hidden" value="<?echo $Usuario;?>" name="Usuario" id="Usuario">
                                   <table border="0" align="center">
                                      <tr><td><br></td></tr>
                                      <tr>
                                         <td><b>Código:</b></td>
                                           <td colspan="1"><input type="text" name="conse" value="<?echo $filas["conse"];?>" class="cajas" size="14" readonly></td>
                                           <?if ($estado=='NO' or $TipoPago=='prestacion' or $TipoPago=='empleado' or $TipoPago=='vacacion'):?>
                                             <td><b>Documento:</b></td>
                                             <td colspan="1"><input type="text" name="nrofactura" value="<?echo $filas["nrofactura"];?>" class="cajas" size="14"></td>
                                           <?else:?>
                                             <td><b>Documento:</b></td>
                                             <td colspan="1"><input type="text" name="nrofactura" value="<?echo $filas["nrofactura"];?>" class="cajas" size="14" readonly></td>
                                           <?endif;?>
                                       </tr>
                                       <tr>
                                         <?if ($estado=='NO' or $TipoPago=='prestacion' or $TipoPago=='empleado' or $TipoPago=='vacacion'):?>
                                            <td><b>Nit/Cédula:</b></td>
                                             <td colspan="1"><input type="text" name="nitprove" value="<?echo $filas["nitprove"];?>" class="cajas" size="14" ><input type="text" name="dv" value="<?echo $filas["dv"];?>" class="cajas" size="1" maxlength="1"></td>
                                             <td><b>Proveedor:</b></td>
                                            <td colspan="1"><input type="text" name="provedor" value="<?echo $filas["cliente"];?>" class="cajas" size="60" maxlength="60"></td>
                                         <?else:?>
                                             <td><b>Nit/Cédula:</b></td>
                                             <td colspan="1"><input type="text" name="nitprove" value="<?echo $filas["nitprove"];?>" class="cajas" size="14" readonly ><input type="text" name="dv" value="<?echo $filas["dv"];?>" class="cajas" size="1" maxlength="1" readonly></td>
                                             <td><b>Proveedor:</b></td>
                                            <td colspan="1"><input type="text" name="provedor" value="<?echo $filas["cliente"];?>" class="cajas" size="60" maxlength="60" readonly></td>
                                          <?endif;?>
                                       </tr>
                                       <tr>
                                        <?if ($estado=='NO' or $TipoPago=='prestacion' or $TipoPago=='empleado' or $TipoPago=='vacacion'):?>
                                           <td><b>Vlr_Pago:</b></td>
                                           <td colspan="10"><input type="text" name="pago" value="<?echo $filas["valor"];?>" class="cajas" size="14">&nbsp;&nbsp;&nbsp;&nbsp;
                                         <?else:?>
                                           <td><b>Vlr_Pago:</b></td>
                                           <td colspan="1"><input type="text" name="pago" value="<?echo $filas["valor"];?>" class="cajas" size="14" readonly></td>
                                           <td><b>Otro_Valor</b></td>
                                           <td colspan="10"><input type="text" name="OtroPago" value="0" class="cajas" size="14">
                                         <?endif;?>
                                           <b>Forma_Pago:</b>
                                            <select name="formapago" class="cajas">
				           <option value="<?echo $filas["pago"];?>" selected><?echo $filas["pago"];?>
				           <option value="BANCO">BANCO
				                   <option value="CHEQUE">CHEQUE
    			                           <option value="EFECTIVO">EFECTIVO
                                                   <option value="SUCURSAL">SUCURSAL
                                                   <option value="T. CREDITO">T. CREDITO
				         </select></td>
                                       </tr>
                                         <tr>
                                         <td><b>Cheque:</b></td>
                                            <td colspan="1"><input type="text" name="cheque" value="<?echo $filas["cheque"];?>" class="cajas" size="14" ></td>
                                            <td><b>Banco:</b></td>
                                            <td><select name="banco" class="cajasletra">
                                           <?
                                            $bancoaux=$filas["codbanco"];
                                            $consulta_b="select codbanco,bancos from banco";
                                            $resultado_b=mysql_query($consulta_b) or die("consulta de banco Incorrecta");
                                             while ($filas_b=mysql_fetch_array($resultado_b)):
                                                 if ($bancoaux==$filas_b["codbanco"]):
                                                     ?>
                                                     <option value="<?echo $filas_b["codbanco"];?>" selected><?echo $filas_b["bancos"];?>
                                                     <?
                                                 else:
                                                     ?>
                                                     <option value="<?echo $filas_b["codbanco"];?>"><?echo $filas_b["bancos"];?>
                                                    <?
                                                 endif;
                                             endwhile;
                                             ?>
			             </select></td>
                                       </tr>
                                       <tr>
                                         <td> <b>Tipo_Cta:</b></td>
                                          <td colspan="1"><select name="tipocta" class="cajas">
                                          <option value="<?echo $filas["cuenta"];?>" selected><?echo $filas["cuenta"];?>
				           <option value="AHORRO">AHORRO
					  <option value="CORRIENTE">CORRIENTE
       					 <option value="OFICINA">OFICINA
       					 <option value="OTRA">OTRA
                         	         </select></td>
                                          <td><b>Nota:</b></td>
                                           <td colspan="1"><input type="text" name="nota" value="<?echo $filas["concepto"];?>" class="cajas" size="60"></td>
                                       </tr>
                                       <tr><td><br></td></tr>
                                   <tr>
                                   <td colspan="5"><input type="submit" value="Guardar" class="boton"></td>
                                </tr>

                                   </table>
                                </form>
                                 <?
                          endwhile;
                       endif;
                else:
                       ?>
                       <input type="text" name="codex" value="<?echo $codex;?>">
                       <?
                      $provedor=strtoupper($provedor);
                      $nota=strtoupper($nota);
                     $cheque=strtoupper($cheque);
                     include("../conexion.php");
                     if ($estado=='NO'or $TipoPago=='prestacion' or $TipoPago=='empleado' or $TipoPago=='vacacion'):
                        $conC="update comprobante set nrofactura='$nrofactura',nitprove='$nitprove',dv='$dv',cliente='$provedor',valor='$pago',pago='$formapago',cheque='$cheque',codbanco='$banco',cuenta='$tipocta',concepto='$nota' where comprobante.conse='$conse'";
                        $resC=mysql_query($conC) or die("Error de Actualizacion");
                        $regC=mysql_affected_rows();
                        if ($regC==0):
                           ?>
                           <script language="javascript">
                             alert("No se Actualizo el Registro")
                             history.go(-2)
                           </script>
                           <?
                        else:
                           header("location: CrearPago.php?nro=$nro&nit=$nit&estado=$estado&TipoPago=$TipoPago");
                        endif;
                     else:
                        if($TipoPago=='compra'):
                              $ConT=0;$TotalE=0;
                               include("../conexion.php");
                               $conP="select pagar.saldo from pagar where pagar.nrofactura='$nrofactura' and pagar.nitprove='$nitprove'";
	                        $resP=mysql_query($conP) or die("Error al busca facturas");
                                $filas_P=mysql_fetch_array($resP);
                                $AuxS=$filas_P["saldo"];
                                $TotalE=$OtroPago+$pago;
                                $ConT=($AuxS-$OtroPago);
                                 echo $ConT;
                                 if($OtroPago==0):
                                       $conH="update comprobante set pago='$formapago',cheque='$cheque',codbanco='$banco',cuenta='$tipocta',concepto='$nota' where comprobante.conse='$conse'";
	                               $resH=mysql_query($conH) or die("Error de Actualizacion");
                                       $regC=mysql_affected_rows();
                                        if ($regC=='0'):
		                         ?>
			                       <script language="javascript">
			                         alert("No se Actualizo el Registro en sistema")
			                         history.go(-2)
			                       </script>
			                      <?
	                                else:
	                                    header("location: CrearPago.php?nro=$nro&nit=$nit&estado=$estado&TipoPago=$TipoPago&Usuario=$Usuario");
                                        endif;
                                 else:
                                      if($ConT==0):
                                           $conC="update pagar set saldo='$ConT',estadofinal='CANCELADA' where pagar.nrofactura='$nrofactura' and pagar.nitprove='$nitprove'";
	                                   $resC=mysql_query($conC) or die("Error de Actualizacion");
                                           /*actualizar pagos*/
                                           $conC="update comprobante set valor='$TotalE',pago='$formapago',cheque='$cheque',codbanco='$banco',cuenta='$tipocta',concepto='$nota' where comprobante.conse='$conse'";
	                                   $resC=mysql_query($conC) or die("Error de Actualizacion");
	                                   $regC=mysql_affected_rows();
                                      else:
                                        if($ConT < $AuxS):
                                           $conC="update pagar set saldo='$ConT' where pagar.nrofactura='$nrofactura' and pagar.nitprove='$nitprove'";
	                                   $resC=mysql_query($conC) or die("Error de Actualizacion");
                                           /*actualizar pagos*/
                                           $conC="update comprobante set valor='$TotalE',pago='$formapago',cheque='$cheque',codbanco='$banco',cuenta='$tipocta',concepto='$nota' where comprobante.conse='$conse'";
	                                   $resC=mysql_query($conC) or die("Error de Actualizacion");
	                                   $regC=mysql_affected_rows();
                                        else:
                                            ?>
		                             <script language="javascript">
		                               alert("La suma entre pagos es mayor que el saldo de la factura..")
		                                history.back()
		                             </script>
		                            <?
                                        endif;
                                     endif;
                                     if ($regC=='0'):
		                         ?>
			                       <script language="javascript">
			                         alert("No se Actualizo el Registro en sistema")
			                         history.go(-2)
			                       </script>
			                      <?
	                                else:
	                                    header("location: CrearPago.php?nro=$nro&nit=$nit&estado=$estado&TipoPago=$TipoPago&Usuario=$Usuario");
                                        endif;
                                endif;
                        else:
                         /*sigue el codigo aca/ */
                        endif;

                     endif;
                 endif;
               else:
                       ?>
                       <script language="javascript">
                          alert("Esta factura ya esta cancelada en sistema. Para Editar los registros, debe de Eliminarla")
                             history.back()
                           </script>
                       <?
             endif;
                           ?>

        </body>
</html>
