<html>
        <head>
                <title>Modificar Factura</title>
                <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
                <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }

                    function chequearcampos()
                    {
                        if (document.getElementById("nrofactura").value.length <=0)
                        {
                            alert ("Digite el número de factura a modificar ?");
                            document.getElementById("nrofactura").focus();
                            return;
                        }
                        document.getElementById("carga").submit();
                    }

                </script>
        </head>
        <body>
        <?
                if (!isset($nrofactura)):
                 include("../conexion.php");
        ?>
                        <center><h4><u>Editar Documento</u></h4></center>
                        <form action="" method="post" id="carga">
                                <table border="0" align="center">
                                        <tr>
                                                <td colspan="2"><br></td>
                                        </tr>
                                        <tr>
                                                <td><b>Número de Factura:</b></td>
                                                <td><input type="text" name="nrofactura" value="" size="12" maxlength="12" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nrofactura"></td>
                                        </tr>
                                         <tr>
			                  <td><b>Base:</b></td>
			                     <td colspan="1"><select name="BaseFactura" class="cajas">
			                        <?
			                        $consulta="select concepto,nro from parametroiva ";
			                        $resultado=mysql_query($consulta) or die("Error al buscar");
			                        while ($filas=mysql_fetch_array($resultado)):
			                          ?>
			                          <option value="<?echo $filas["nro"];?>"><?echo $filas["concepto"];?>
			                          <?
			                        endwhile;
			                          ?>
			                   </select></td>
                                        </tr>
                                         <tr>
			                  <td><b>Base:</b></td>
			                     <td colspan="1"><select name="TipoFactura" class="cajas">
                                              <option value="0">Seleccione
			                        <?
			                        $consulta="select nroservicio,servicio from tipofactura ";
			                        $resultado=mysql_query($consulta) or die("Error al buscar");
			                        while ($filas=mysql_fetch_array($resultado)):
			                          ?>
			                          <option value="<?echo $filas["nroservicio"];?>"><?echo $filas["servicio"];?>
			                          <?
			                        endwhile;
			                          ?>
			                   </select></td>
                                        </tr>
                                        <tr>
                                                <td colspan="2"><br></td>
                                        </tr>

                                        <tr>
                                                <td><input type="button" value="Buscar Datos" class="boton" onclick="chequearcampos()"></td>
                                        </tr>
                                </table>
                        </form>
        <?
                elseif(empty($TipoFactura)):
                   ?>
                   <script language="javascript">
                      alert("Favor seleccion  el tipo de Factura")
                      history.back()
                   </script>
                   <?
                else:
                      include("../conexion.php");
                        $consulta="select factura.*,zona.vlrfte,zona.vlriva,tipofactura.servicio from factura,tipofactura,zona
                        where factura.nroservicio=tipofactura.nroservicio and
                         tipofactura.nroservicio='$TipoFactura' and
                        zona.codzona=factura.codzona and
                        factura.nrofactura='$nrofactura'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        $filas=mysql_fetch_array($resultado);
                        $Vlrfte=$filas["vlrfte"];
                        $VlrRiva=$filas["vlriva"];
                        $Iva=$filas["porcentaje"];
                        $BaseF=$filas["base"];
                        if ($registros ==0):
                            ?>
                                <script language="javascript">
                                        alert("Esta número de factura que digito no cumple los parametrso de busqueda")
                                        history.back()
                                </script>
                             <?
                        else:
                            $conF="select recibo.nrofactura from factura,recibo
                               where factura.nrofactura=recibo.nrofactura and
                                     factura.nrofactura='$nrofactura'";
                       	    $resuF=mysql_query($conF) or die("Error al buscar de recibos de cajas");
                            $regF=mysql_num_rows($resuF);
                            if($regF==0):
                               $conN="select notacredito.nrofactura from factura,notacredito
                               where factura.nrofactura=notacredito.nrofactura and
                                     factura.nrofactura='$nrofactura'";
                       	       $resuN=mysql_query($conN) or die("Error al buscra de notas creditos");
                               $regN=mysql_num_rows($resuN);
                               if($regN==0):
	                            ?>
	                             <center><h4><u>Datos de la Factura</u></h4></center>
                                     <input type="hidden" name="BaseF" value="<?echo $BaseF;?>">
	                              <form action="guardarC.php" method="post">
	                                 <table border="0" align="center">
                                                  <tr>
                                                                <td><b>Nro_Factura:</b></td>
                                                                <td><input type="text" name="nrofactura" value="<?echo $filas["nrofactura"];?>" size="15" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nrofactura"></td>
                                                        </tr>
					                <tr>
					                  <td><b>Zona:</b></td>
					                  <td><select name="Codzona"class="cajas">
						                 <?
						                 $Cod=$filas["codzona"];
						                 $consulta_e="select zona,codzona from zona where estado='ACTIVA' and nomina='SI' and tipoempresa='NO' order by zona";
						                 $resultado_e=mysql_query($consulta_e)or die("Consulta  incorrecta");
						                 while($filas_e=mysql_fetch_array($resultado_e)):
						                 if ($Cod==$filas_e["codzona"]):
						                 ?>
						                 <option value="<?echo $filas_e["codzona"];?>" selected><?echo $filas_e["zona"];?>
						                 <?
						                   else:
						                   ?>
						                     <option value="<?echo $filas_e["codzona"];?>"><?echo $filas_e["zona"];?>
						                   <?
						                   endif;
						                 endwhile;
						                 ?> </selet></td>
						              </tr>
                                                        <tr>
                                                                <td><b>F_Inicio:</b></td>
                                                                <td><input type="text" name="inicio"value="<?echo $filas["fechaini"];?>" size="15" maxlength="10" class=" cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="inicio">
                                                                <b>F_Vcto:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                                                <input type="text" name="fechafinal"value="<?echo $filas["fechaven"];?>" size="15" maxlength="10"  class=" cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechafinal">
                                                        </tr>
                                                        <tr>
                                                          <td><b>T_Factura:</b></td>
					                  <td><select name="Tipo"class="cajas">
						                 <?
						                 $Nro=$filas["nroservicio"];
						                 $consulta_e="select nroservicio,servicio from tipofactura order by servicio";
						                 $resultado_e=mysql_query($consulta_e)or die("Error al buscar tipo de factura");
						                 while($filas_e=mysql_fetch_array($resultado_e)):
						                 if ($Nro==$filas_e["nroservicio"]):
						                 ?>
						                 <option value="<?echo $filas_e["nroservicio"];?>" selected><?echo $filas_e["servicio"];?>
						                 <?
						                   else:
						                   ?>
						                     <option value="<?echo $filas_e["nroservicio"];?>"><?echo $filas_e["servicio"];?>
						                   <?
						                   endif;
						                 endwhile;
						                 ?> </selet></td>
						              </tr>
                                                        </tr>
			                                   <td><b>Observación:</b></td>
			                                   <td colspan="5"><textarea name="observacion" cols="78" rows="4" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="observacion"><?echo $filas["observacion"];?></textarea></td></tr>
			                                  <tr>
                                                        <tr>
                                                                <td colspan="4"><input type="submit" value="Actualizar" class="boton"></td>
                                                        </tr>
                               <?else:
                                    ?>
                                  <script language="javascript">
                                        alert("La factura no se puede modificar por que tiene notas creditos en sistemas.")
                                         history.back()
                                  </script>
                                    <?
                                 endif;
                               ?>
                               </table>
                            </form>
        <?
                             else:
                                ?>
                                <script language="javascript">
                                        alert("La factura no se puede modificar por efectos contables")
                                        history.back()
                                </script>
                             <?
                             endif;
                        endif;
         ?>
         </body>
         </html>
         <?
           include("../conexion.php");
           $conD="select defactura.*,item.concepto,item.sumar,item.basefte,factura.base from defactura,factura,item
           where factura.nrofactura=defactura.nrofactura and
           item.codcom=defactura.codcom and
           factura.nrofactura='$nrofactura'";
           $resuD=mysql_query($conD) or die("Error al buscar detalles");
           $regD=mysql_num_rows($resuD);
             /*codigo de tipo factura*/
                    $conEF="select tipofactura.estado from tipofactura
                               where tipofactura.nroservicio='$TipoFactura'";
                    $resuEF=mysql_query($conEF) or die("Error al buscra parametros de base");
                    $filas_EF= mysql_fetch_array($resuEF);
                    $EstadoEF=$filas_EF["estado"];
           if($regD!=0):
	          ?>
                  <form action="" method="post">
                  <input type="hidden" name="nrofactura"value="<?echo $nrofactura;?>">
                  <input type="hidden" name="BaseFactura"value="<?echo $BaseFactura;?>">
                  <input type="hidden" name="BaseF"value="<?echo $BaseF;?>">
                  <input type="hidden" name="TipoFactura"value="<?echo $TipoFactura;?>">
                  <table border="0" align="center">

	            <tr class="cajas">
	               <th><br></th><th><b><u>Item</u></b></th><th><b>&nbsp;<u>Cuenta</u></b></th><th><b>&nbsp;<u>Descripcion</u></b></th><th><b><u>Cant.</u></b></th><th><b><u>Vlr_Unit</u></b></th><th><b><u>Total</u></b>
	             </tr>
                    <?
                    $conB="select parametroiva.valor from parametroiva
                               where parametroiva.nro='$BaseFactura'";
                    $resuB=mysql_query($conB) or die("Error al buscra parametros de base");
                    $filas_B= mysql_fetch_array($resuB);
                    $BaseFa=$filas_B["valor"];
                     while ($filas= mysql_fetch_array($resuD)):
                     $cant= number_format($filas["can"],0);
                      $valor= number_format($filas["vlruni"],0);
                      $total= number_format($filas["total"],0);
                      $NroItem=$filas["basefte"]
                     ?>
                    <tr class="cajas">

                        <td>&nbsp;&nbsp;<a href="DetalleModificar.php?datos=<?echo $filas["remision"];?>&nrofactura=<?echo $filas["nrofactura"];?>&BaseFactura=<?echo $BaseFactura;?>&TipoFactura=<?echo $TipoFactura;?>"><img src="../image/mod.jpg" border="0" alt="Permite Modificar el Registro"></a></td><td>&nbsp;&nbsp;<?echo $filas["remision"];?></td>
                        <td>&nbsp;&nbsp;<?echo $filas["codcom"];?></td>
                        <td><?echo $filas["concepto"];?></td>
                        <td><div align="center"><?echo $filas["cantidad"];?></div></td>
                        <td><div align="right">$<?echo $valor;?></div></td>
                        <td><div align="right">$<?echo $total;?></div></td>
                      </tr>
                     <?
                       if($filas["sumar"]=='SI'):
                         $suma=$suma+$filas["total"];
                       else:
                          $sumaBase=$sumaBase+$filas["total"];
                       endif;
                     endwhile;
                      $SaldoSubtotal=$suma;
                      $BaseG=round(($suma*$BaseFa)/100);
                      $BaseG=number_format($BaseG,0);
                     /*codigo de factura*/
                     if($SaldoSubtotal >= $BaseF):
                        if($EstadoEF=='NO'):
	                     $AuxI=round(($suma*$Iva)/100);
	                     $IvaA=number_format($AuxI,0);
	                     $AuxFte=round(($suma*$NroItem)/100);
                             $Fuente=number_format($AuxFte,0);
	                     $AuxRete=round(($AuxI*$VlrRiva)/100);
                             $ReteIva=number_format($AuxRete,0);
	                    // $AuxCre=round($suma*$Vlrcre)/100;
	                     $subtotal=number_format($suma,0);
	                     $TotalF=round(($suma + $AuxI)-($AuxFte+$AuxRete+$AuxCre));
	                     $ATotal=number_format($TotalF,0);
                        else:
                               $AuxI=round(($sumaBase*$Iva)/100);
	                       $IvaA=number_format($AuxI,0);
	                       $AuxFte=round(($sumaBase*$Vlrfte)/100);
                               $Fuente=number_format($AuxFte,0);
	                       $AuxRete=round(($AuxI*$VlrRiva)/100);
                               $ReteIva=number_format($AuxRete,0);
	                      // $AuxCre=round($suma*$Vlrcre)/100;
	                       $subtotal=number_format($suma,0);
	                       $TotalF=round(($suma + $AuxI)-($AuxFte+$AuxRete+$AuxCre));
	                       $ATotal=number_format($TotalF,0);
                        endif;
                     else:
                         if($EstadoEF=='SI'):
                            $AuxI=round(($sumaBase * $Iva)/100);
                            $IvaA=number_format($AuxI,0);
	                    $AuxCre=round($suma*$Vlrcre)/100;
	                    $subtotal=number_format($suma,0);
	                    $TotalF=round(($suma + $AuxI)-($AuxR+$AuxCre));
	                   $ATotal=number_format($TotalF,0);
                         else:
                           $AuxI=round(($sumaBase * $Iva)/100);
                            $IvaA=number_format($AuxI,0);
	                    $AuxCre=round($suma*$Vlrcre)/100;
	                    $subtotal=number_format($suma,0);
                            $AuxRete=round(($AuxI*$VlrRiva)/100);
                            $ReteIva=number_format($AuxRete,0);
	                    $TotalF=round(($suma + $AuxI)-($AuxR+$AuxCre));
	                   $ATotal=number_format($TotalF,0);
                         endif;
                     endif;
                     ?>
                     <tr><td><br></td></tr>
	           </table>
                    <div align="center"><b>Subtotal:</b>&nbsp;$<?echo $subtotal;?>&nbsp;&nbsp;<b>Iva:</b>&nbsp;$<?echo $IvaA;?>&nbsp;&nbsp;<b>R_Fte:</b>&nbsp;$<?echo $Fuente;?>&nbsp;&nbsp;<b>Rte_Iva:</b>&nbsp;$<?echo $ReteIva;?>&nbsp;&nbsp;<b>Total_Pagar:</b>&nbsp;$<?echo $ATotal;?></div>
                    <div align="center"><b><font color="red">Base_Grabada:&nbsp;$<?echo $BaseG;?></font></b></div>
                </form>
             <?
              $conA="update factura set subtotal='$suma',rfte='$AuxFte', iva='$AuxI',rteiva='$AuxRete',vlrcre='$AuxCre',grantotal='$TotalF',nsaldo='$TotalF' where factura.nrofactura='$nrofactura'";
              $resA=mysql_query($conA)or die ("Erro al actualizar saldos");
              $regA=mysql_affected_rows();
        else:   
               ?>
                  <script language="javascript">
                   alert("la factura no presenta relacion del detallado..")
                   history.back()
                 </script>
                             <?
       endif;
  endif;
             ?>

        </body>
</html>
