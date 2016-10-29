    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script language="javascript">
        <script language="javascript">
     function volver(numero)// para declara funcion
                {
                pagina='descargar.php?
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
 </script>
</script>
       <head>
                <title>Descargar de Examenes medicos</title>
                 <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        </head>
        <body>
                <?
                         if (!isset($valor)):
                          ?>

                              <center><h2><u>Descargar Examanes</u></h2></center>
                               <form action="" method="post">
                                        <table border="0" align="center">
                                                <tr>
                                                        <td colspan="6"><br></td>
                                                </tr>
                <?
                                include("../conexion.php");
                                if (!$nro):
                                   $nit=$nro;
                                     ?>
                                     <tr>
                                        <td><b>Nit/Cedula:</b></td>
                                        <td><input type="text" name="nit" value="<? echo $codigo;?>" size="13" readonly class="cajas"></td>
                                        <td><b>Proverdor:</b></td>
                                        <td><input type="text" name="provedor" value="<?echo $provedor;?>" size="40" class="cajas" readonly></td>
                                     </tr>
                                     <tr>
                                        <td><b>Nro_Factura:</b></td>
                                        <td><input type="text" name="nrofactura" value="" size="13" maxlength="11" class="cajas"></td>
                                       <td><b>Vlr_Facturado:</b></td>
                                       <td><input type="text" name="valor" value="" size="13" maxlength="11" class="cajas"></td>
                                     </tr>
                                  <tr>
                                    <td><b>Nota:</b></td>
                                    <td colspan="10"><textarea name="observacion" cols="75" rows="4" class="cajas"></textarea></td>
                                  </tr>
                                 <?
                                else:
                                        $nit=$nro;
                                        $consulta="select * from cobroexamen where cobroexamen.nit='$nro' and cobroexamen.codigo='$codex'";
                                        $resultado=mysql_query($consulta) or die("consulta incorrecta 1");
                                        $filas=mysql_fetch_array($resultado);
                ?>                      <tr>
                                        <td><b>Nit/Cedula:</b></td>
                                        <td><input type="text" name="nit" value="<? echo $filas["nit"];?>" size="13" readonly class="cajas"></td>
                                        <td><b>Proverdor:</b></td>
                                        <td><input type="text" name="provedor" value="<?echo $filas["provedor"];?>" size="40" class="cajas" readonly></td>
                                     </tr>
                                     <tr>
                                        <td><b>Nro_Factura:</b></td>
                                        <td><input type="text" name="nrofactura" value="<?echo $filas["nrofactura"];?>" size="10"readonly class="cajas"></td>
                                       <td><b>Vlr_Facturado:</b></td>
                                       <td><input type="text" name="valor" value="<?echo $filas["valor"];?>" size="10" readonly class="cajas"></td>
                                     </tr>
                                     <tr>
                                       <td><b>Nota:</b></td>
                                       <td colspan="10"><textarea name="observacion" cols="75" rows="4" class="cajas" readonly><?echo $filas["observacion"];?></textarea></td>
                                     </tr>
                                      <?
                                endif;
                                     ?>
                         <tr>
                            <td colspan="6">&nbsp;</td>
                         </tr>
                          <tr>
                             <td><b>Documento</b></td>
                             <td><b>Nro_Abono</b></td>
                             <td><b>Total</b></td>
                             <td>&nbsp;</td>
                           </tr>
                           <tr>
                                  <td><input type="text" name="cedula" value="" size="13" maxlength="13" class="cajas">
                                 <td><input type="text" name="nroabono" value="0" size="11" maxlength="11" class="cajas">
                                 <td><input type="text" name="subtotal" value="0" size="11" maxlength="11" class="cajas">
                                 <td colspan="5"><input type="submit" value="Agregar" ></td>
                             </tr>
                        <input type="hidden" name="MM_insert" value="form1">
                        </form>
               <?
                        include("../conexion.php");
                        $consulta_d="select dexamen.* from dexamen where dexamen.codigo='$codex'";
                        $resultado_d=mysql_query($consulta_d) or die("Error al buscar detalles");
                        $registros_d=mysql_num_rows($resultado_d);
                        if ($registros_d==0):
                            ?>
                          <table border="" align="center" width="700">
                                <tr>
                                                <th>&nbsp;</th>
                                                <th>Documento</th>
                                                <th>Nro_Abono</th>
                                                <th>Vlr_Examen</th>
                                </tr>
                          </table>
                <?

                        else:

                ?>
                          <form action="eliminar.php" method="post">
                                <table border="1" align="center" width="980">
                                        <tr class="fondo">
                                                <td>&nbsp;</td>
                                                <th>&nbsp;</th>
                                                <th>Item</th>
                                                <th>Documento</th>
                                                <th>Nombres</th>
                                                <th>Nro_Recibo</th>
                                                <th>Vlr_Examen</th>
                                                <th>Positivo</th>
                                                <th>Negativo</th>
                                                <th>Estado</th>
                                                <th>Zona</th>

                                        </tr>
                                <?
                                $subtotal=0;
                                $x=1;
                                while ($filas_d = mysql_fetch_array($resultado_d))
                                {
                                $vlrexamen=number_format($filas_d["vlrexamen"],0);
                                $DatoN=number_format($filas_d["negativo"],0);
                                $DatoP=number_format($filas_d["positivo"],0);
                                ?>
                                        <tr align="center" class="cajas">
                                                <input type="hidden" name="nit" value="<?echo $nit;?>">
                                                <input type="hidden" name="codex" value="<?echo $codex;?>">
                                                <td>&nbsp;<input type="checkbox" name="datos[]" value="<?echo $filas_d["conse"];?>"></td>
                                                <td>&nbsp;<a href="modificar.php?codigo=<?echo $filas_d["conse"];?>&codex=<?echo $codex;?>&nit=<?echo $nit;?>"><img src="../image/mod.jpg" border="0" alt="Modificar Registro"></a></td>
                                                 <td><div align="center"><?echo $x;?></div></td>
                                                  <td><div align="center"><?echo $filas_d["cedula"];?></div></td>
                                                   <td><div align="left"><?echo $filas_d["asociado"];?></div></td>
                                                <td><div align="center"><?echo $filas_d["nroabono"];?></div></td>
                                                <td><div align="right">$<?echo $vlrexamen;?></div></td>
                                                <td><div align="right">$<?echo $DatoP;?></div></td>
                                                <td><div align="right">$<?echo $DatoN;?></div></td>
                                                 <td><div align="left"><?echo $filas_d["estado"];?></div></td>
                                                <td><?echo $filas_d["zona"];?></td>


                                           </tr>
                                <?
                                $x=$x+1;
                                $subtotal=$subtotal+$filas_d["vlrexamen"];
                                }
                                $subtotal=number_format($subtotal,2);
                             ?>
                          <tr>
                             <td colspan="20">&nbsp;</td>
                          </tr>
                          <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                                <th>&nbsp;</th>
                              <td><b>Total:</b></td>
                              <td><div align="center"><b><?echo $subtotal;?></b></div></td>
                              <td>&nbsp;</td>
                               <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="15" align="center"><input type="submit" value="Eliminar"></td>
                          </tr>
                         </table>

                         </form>

                         <th><a href="imprimirdescarga.php?codigo=<?echo $codex;?>" target="_blank" onclick="volver()" class="fondo"><b><div align="center"><font color="red"><h3>Imprimir</h3></font></div></b></a></th>
                         <?
                        endif;

                         elseif(empty($nrofactura)):

                ?>
                           <script language="javascript">
                               alert("Digite la factura de cobro ?")
                                history.back()
                           </script>

                 <?
                            elseif(empty($valor)):
                               ?>
                              <script language="javascript">
                                alert("Digite el valor total de la factura")
                                history.back()
                              </script>
                              <?
                              elseif(empty($cedula)):
                               ?>
                              <script language="javascript">
                                alert("Digite el documento del empleado ?")
                                history.back()
                              </script>
                <?
                            elseif(empty($subtotal)):
                               ?>
                              <script language="javascript">
                                alert("Digite el valor del examen médico ?")
                                history.back()
                              </script>
                <?
                             else:
                               $control='PAGADO';
                               $fechap=date("Y-m-d");
                                include("../conexion.php");
                               $Sql="select examen.cedula,examen.nro,examen.nombre,zona.zona,examen.costoe from examen,zona where
                                       examen.codzona=zona.codzona and
                                       examen.cedula='$cedula' and
                                       examen.control='FALTA' order by nro ASC limit 1";
                                $Rs=mysql_query($Sql)or die ("Error al buscar datos del examen inicial");
                                $Vector=mysql_fetch_array($Rs);
                                $NroExamen = $Vector["nro"];
                                $Empleado = $Vector["nombre"];
                                $Zona = $Vector["zona"];
                                $VlrExamenInicial = $Vector["costoe"];
                                $reg=mysql_num_rows($Rs);
                                if($reg!=0):
	                                $consulta="select * from cobroexamen where cobroexamen.codigo='$codex'";
	                                $resultado=mysql_query($consulta) or die("Error al buscar datos");
	                                $registros=mysql_num_rows($resultado);
	                                if ($registros==0):
	                                   $consulta = "select count(*) from cobroexamen";
	                                   $result = mysql_query ($consulta);
	                                   $answ = mysql_fetch_row($result);
	                                   $ciudad=strtoupper($ciudad);
	                                  if ($answ[0] > 0):
	                                    $consulta = "select max(cast(codigo as unsigned)) + 1 from cobroexamen";
	                                    $result2 = mysql_query($consulta);
	                                    $codc = mysql_fetch_row($result2);
	                                    $codex= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
	                                  else:
	                                    $codex = "000001";
	                                  endif;
                                             $observacion=strtoupper($observacion);
                                             $Buscar="select examen.nitprove from examen, provedor
                                                     where examen.nitprove = provedor.nitprove and
                                                           provedor.nitprove = '$nit' and
                                                           examen.nro = '$NroExamen'";
                                             $RegB=mysql_query($Buscar)or die("Error al buscar el proveedores ,$$Buscar");
                                             $Reg=mysql_num_rows($RegB);
                                             if($Reg != 0){
                                                 $subtotal=$subtotal;
                                                 $consulta="insert into cobroexamen (codigo,nit,provedor,nrofactura,valor,observacion,fechap)
                                                           values('$codex','$nit','$provedor','$nrofactura','$valor','$observacion','$fechap')";
						 $resultado=mysql_query($consulta) or die("Error al Grabar datos del provedor");
                                                 /*codigo que graba el detalle*/
						 $consulta1="insert into dexamen (cedula,asociado,nro,nroabono,vlrexamen,zona,codigo)
						             values('$cedula','$Empleado','$NroExamen','$nroabono','$subtotal','$Zona','$codex')";
						 $resultado=mysql_query($consulta1) or die("Error al grabar el detalle");

                                               $aux="select examen.nombre,zona.zona,examen.nro from examen,zona
	                                               where zona.codzona=examen.codzona and
	                                               examen.nro='$NroExamen'";
	                                         $re_e=mysql_query($aux)or die("Error al buscar el nombre de la zona");
                                                 $Reg_e=mysql_num_rows($re_e);
                                                 if($VlrExamenInicial == $subtotal){
                                                     $Estado='AL DIA';
                                                  }else{
                                                      if($subtotal > $VlrExamenInicial){
                                                           $Negativo=($VlrExamenInicial - $subtotal);
                                                           $Estado='COBRAR A ZONA';
                                                      }else{
                                                           if($subtotal < $VlrExamenInicial){
                                                                 $Positivo=($VlrExamenInicial - $subtotal);
                                                                 $Estado='SALDO A FAVOR';
                                                           }else{
                                                                $Estado='FALTA POR COBRAR';
                                                           }
                                                      }
                                                  }
                                                  /*fin codigo*/
	                                         $cons="update dexamen set estado='$Estado',positivo='$Positivo',negativo='$Negativo' where dexamen.codigo='$codex' and dexamen.nro='$NroExamen'";
	                                         $res1=mysql_query($cons)or die("Error de actualizacion en la table examen");
	                                         $con="update examen set control='$control' where examen.nro='$NroExamen'";
			                         $res=mysql_query($con) or die("Error al actualizar el examen");
			                         header("location: agregar.php?nro=$nit&codex=$codex");
                                            }else{
                                                ?>
                                                <script language="javascript">
                                                    alert("Este examen no le pertenece a este proveedor y/o ya esta descargado en sistema. Favor verificar el registro.!")
                                                    history.back()
                                                </script>
                                                <?
                                            }
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
                                              $Buscar="select examen.nitprove from examen,provedor
                                                     where examen.nitprove=provedor.nitprove and
                                                           provedor.nitprove='$nro' and
                                                           examen.nro='$NroExamen'";
                                             $RegB=mysql_query($Buscar)or die("Error al buscar el proveedores ,$Buscar");
                                             $Reg=mysql_num_rows($RegB);
                                             if($Reg != 0){
                                                   $subtotal=$subtotal;
                                                   $consulta1="insert into dexamen (cedula,asociado,nro,nroabono,vlrexamen,zona,codigo)
		                                                values('$cedula','$Empleado','$NroExamen','$nroabono','$subtotal','$Zona','$codex')";
		                                    $resultado=mysql_query($consulta1) or die("Error al grabar el detalle");
                                                   $aux="select examen.nombre,zona.zona,examen.nro from examen,zona
	                                               where zona.codzona=examen.codzona and
	                                               examen.nro='$NroExamen'";
	                                         $re_e=mysql_query($aux)or die("Error al buscar el nombre de la zona");
                                                 $Reg_e=mysql_num_rows($re_e);
                                                  if($VlrExamenInicial == $subtotal){
                                                     $Estado='AL DIA';
                                                  }else{
                                                      if($subtotal > $VlrExamenInicial){
                                                           $Negativo=($VlrExamenInicial - $subtotal);
                                                           $Estado='COBRAR A ZONA';
                                                      }else{
                                                           if($subtotal < $VlrExamenInicial){
                                                                 $Positivo=($VlrExamenInicial - $subtotal);
                                                                 $Estado='SALDO A FAVOR';
                                                           }else{
                                                                $Estado='FALTA POR COBRAR';
                                                           }
                                                      }
                                                  }
                                                   /*fin codigo*/
                                                    $cons="update dexamen set estado='$Estado',positivo='$Positivo',negativo='$Negativo' where dexamen.codigo='$codex' and dexamen.nro='$NroExamen'";
                                                    $res1=mysql_query($cons)or die("Error de actualizacion en la table examen");
                                                    $con="update examen set control='$control' where examen.nro='$NroExamen'";
		                                    $res=mysql_query($con) or die("Error al actualizar el examen");
	                                           header("location: agregar.php?nro=$nit&codex=$codex");
                                             }else{
                                                ?>
                                                <script language="javascript">
                                                    alert("Este examen no le pertenece a este proveedor y/o ya esta descargado en sistema. Favor verificar el registro.!")
                                                    history.back()
                                                </script>
                                                <?
                                            }

	                                endif;
                                 else:
                                   ?>
                                     <script language="javascript">
                                        alert("Este examen ya fue cobrador a este empleado por este proveedor  o el documento no existe en sistema, favor verificar.!")
                                        history.back()
                                     </script>
                                   <?
                                 endif;
                      endif;
?>
</body>
</html>
