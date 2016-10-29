        <html>
        <head>
                <title>Editar Registro</title>
                  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</script>
        </head>
        <body>
        <?
     include("../conexion.php");
     if($TipoPago=='venta'):
        ?>
          <script language="javascript">
             alert("Este registro no se puede Modificar en Sistema..")
             history.back()
          </script>
        <?
     else:
         if (!isset($nrofactura)):
              $consulta="select recibo.* from recibo where id='$codigo'";
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
                                   <table border="0" align="center">
                                      <tr><td><br></td></tr>
                                      <tr>
                                         <td><b>Código:</b></td>
                                           <td colspan="1"><input type="text" name="conse" value="<?echo $filas["id"];?>" class="cajas" size="14" readonly></td>
                                             <td><b>Documento:</b></td>
                                             <td colspan="1"><input type="text" name="nrofactura" value="<?echo $filas["nrofactura"];?>" class="cajas" size="14"></td>
                                       </tr>
                                        <tr>
                                         <td><b>Nit_Cliente:</b></td>
                                           <td colspan="1"><input type="text" name="nitcliente" value="<?echo $filas["nit"];?>" class="cajas" size="14" maxlength="14"><input type="text" name="dv" value="<?echo $filas["dv"];?>" class="cajas" size="1" maxlength="1"></td>
                                             <td><b>Cliente:</b></td>
                                             <td colspan="1"><input type="text" name="cliente" value="<?echo $filas["zona"];?>" class="cajas" size="50" ,axlength="50"></td>
                                       </tr>
                                       <tr>
                                        <td><b>Teléfono:</b></td>
                                             <td colspan="1"><input type="text" name="telefono" value="<?echo $filas["telefono"];?>" class="cajas" size="14" ,maxlength="13"></td>
                                         <td><b>Dirección:</b></td>
                                           <td colspan="1"><input type="text" name="direcion" value="<?echo $filas["dir"];?>" class="cajas" size="50" maxlength="50"></td>
                                       </tr>
                                       <tr>
                                           <td><b>Vlr_Abono:</b></td>
                                           <td colspan="1"><input type="text" name="abono" value="<?echo $filas["valor"];?>" class="cajas" size="14"></td>
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
                                          <td><b>Tipo_Cta:</b></td>
                                          <td><select name="tipocta" class="cajas">
                                          <option value="<?echo $filas["cuenta"];?>" selected><?echo $filas["cuenta"];?>
				           <option value="AHORRO">AHORRO
				           <option value="CORRIENTE">CORRIENTE
				         </select></td>
                                            <td><b>Forma_Pago:</b></td>
                                            <td><select name="formapago" class="cajas">
				           <option value="<?echo $filas["pago"];?>" selected><?echo $filas["pago"];?>
                                           <option value="BANCO">BANCO
				           <option value="CHEQUE">CHEQUE
    			                   <option value="EFECTIVO">EFECTIVO
                                           <option value="SUCURSAL">SUCURSAL
                                           <option value="T. CREDITO">T. CREDITO 
				         </select></td>
                                       </tr>


                                       <tr>
                                          <td colspan="20"><b>Nota:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                           <input type="text" name="nota" value="<?echo $filas["concepto"];?>" class="cajas" size="44" maxlength="37"></td>
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
                       <input type="hidden" name="codex" value="<?echo $codex;?>">
                       <?
                      $cliente=strtoupper($cliente);
                      $nota=strtoupper($nota);
                     $direcion=strtoupper($direcion);
                     include("../conexion.php");
                     if ($estado=='NO' or $TipoPago=='empleado'):
                        $conC="update recibo set nrofactura='$nrofactura',nit='$nitcliente',dv='$dv',zona='$cliente',dir='$direcion',telefono='$telefono',valor='$abono',abono='$abono',pago='$formapago',codbanco='$banco',cuenta='$tipocta',concepto='$nota' where recibo.id='$conse'";
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
                           header("location: CrearPagoRecibo.php?nro=$nro&nit=$nit&estado=$estado&TipoPago=$TipoPago");
                        endif;
                     endif;
                endif;
     endif;                   ?>

        </body>
</html>


