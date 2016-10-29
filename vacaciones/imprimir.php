<html>
        <head>
                <title>Impresión de Vacaciones</title>
              <LINK  REL="stylesheet" HREF="../formato.css" type="text/css">
                <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
                </script>
        </head>
       <body onLoad="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
               <?

        include("../conexion.php");
         $variable="select maestro.web,maestro.dirmaestro,sucursal.sucursal,maestro.telmaestro,maestro.faxmaestro,municipio.municipio,empleado.cuenta,empleado.basico, vacacion.* from maestro,zona,sucursal,empleado,vacacion,municipio where
                     maestro.codmaestro=sucursal.codmaestro and
                     maestro.codmuni=municipio.codmuni and
                     sucursal.codsucursal=zona.codsucursal and
                     zona.codzona=empleado.codzona and
                     empleado.cedemple=vacacion.cedemple and
                     vacacion.codvaca='$codvaca'";
        $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El Nro De la Vacacion, no existe en la b.d.")
            history.back()
          </script>
         <?
        else:
           $filas=mysql_fetch_array($resultado);
           $Codigo = $filas["codvaca"];
            $cedula=number_format($filas["cedemple"],0);
            $ibc=number_format($filas["ibc"],0);
            $valor=number_format($filas["valor"],2);
            $Subtotal=number_format($filas["subtotal"],0);
             ?>
               <table border="1" align="center" width="710">
               <tr>
               <td>
               <table border="0" align="center" width="710">
               <img src="../image/logounico.png" border="0" height="120" width="165">
                <tr>
                 <td colspan="12"><b><u><div align="center">EXTRACTO DE VACACIONES</div></u></b></td><td class="cajas"><b>Nro:</b>&nbsp;<?echo $filas["codvaca"];?></td>
                </tr>
                 <td><td><br></td></tr>
                 <tr class="cajas">
                  <td><b>Documento:</b>&nbsp;<?echo $cedula;?></td>
                  <td><b>Empleado:</b>&nbsp;<?echo $filas["nombre"];?></td>
                </tr>

                <tr class="cajas">
                  <td><b>Cuenta:</b>&nbsp;<?echo $filas["cuenta"];?>
                  <td colspan="10"><b>Sucursal:</b>&nbsp;<?echo $filas["sucursal"];?></td>
                </tr>
                 <tr class="cajas">
                  <td><b>F_Proceso:</b>&nbsp;<?echo $filas["fechap"];?></td>
                  <td colspan="10"><b>F_Inicio:</b>&nbsp;<?echo $filas["fechai"];?></td>
                </tr>
                 <tr class="cajas">
                  <td><b>F_Corte:</b>&nbsp;<?echo $filas["fechac"];?></td>
                  <td colspan="10"><b>Dias:</b>&nbsp;<?echo $filas["dias"];?></td>
                </tr>
                 <tr class="cajas">
                   <td><b>Ibc:</b>&nbsp;$<?echo $ibc;?></td>
                   <td><b>Total_Generado:</b>&nbsp;$<?echo $valor;?></td>
                 </tr>
                <td><td><br></td></tr>
                  <?
	                   $varV="select detallevacacion.* from detallevacacion,vacacion where
	                     detallevacacion.codvaca=vacacion.codvaca and
	                     vacacion.codvaca='$Codigo'";
	                  $resV=mysql_query($varV)or die("Error al validar el detalle de vacacion");
	                  $regV=mysql_num_rows($resV);
	                  if($regV != 0){
	                        ?>
                                 <tr>
		                   <td colspan="20">---------------------------------------------------------<b>Deducciones</b>----------------------------------------------------------</td>
		                  </tr>
		                  <table border="0" align="center" width="710">
	                        <tr class="cajas">
	                           <td><b>Item</b></td>
	                           <td width="5"><b>Cod_Salario</b></td>
	                           <td><b>Concepto</b></td>
	                           <td width="5"><b>Nro_Autorización</b></td>
	                            <td width="5"><b>Vlr_Deducción</b></td>
	                        <?
	                        $f=1;
		                   while($filas_s=mysql_fetch_array($resV)){
		                      $Valor=number_format($filas_s["valorpago"],2);
		                      ?>
		                      <tr class="cajas">
			                      <td><?echo $f;?></td>
			                      <td><?echo $filas_s["codsala"];?></td>
			                      <td><?echo $filas_s["concepto"];?></td>
			                      <td><div align="center"><?echo $filas_s["nrocredito"];?></div></td>
		                              <td><div align="right">$<?echo $Valor;?></div></td>
		                     </tr>
		                      <?$f=$f+1;
                                      $Total = $Total + $filas_s["valorpago"];
		                   }
                                     $Total = number_format($Total,2);
                            ?>
                                  <tr>
		                   <td>&nbsp;</td>
		                  </tr>

                                  <tr class="cajas">
		                     <td colspan="10"><b>Total Deducciones:&nbsp;<div align="right">$<?echo $Total;?></div></b></td>
		                  </tr>
                                   <tr>
		                   <td colspan="20">-----------------------------------------------------------------------------------------------------------------------------------</td>
		                  </tr>
                                  <tr>
		                   <td>&nbsp;</td>
		                  </tr>
                                    <tr>
                                  <td colspan="5"><b>Total_Pagar:</b>&nbsp;<div align="right">$<?echo $valor;?></div></td>
                                     </tr>
                                      <tr>
		                   <td>&nbsp;</td>
		                  </tr>

		                  <tr>
		                    <td colspan="19"><b>Firma:</b>&nbsp;-----------------------------------------------</td>
		                  </tr>
                                  <tr>
		                    <td colspan="19"><b>CC.:</b>&nbsp;_________________________________</td>
		                  </tr>

                            <?
	                  }else{
		                  ?>
	                          <tr>
		                   <td>&nbsp;</td>
		                  </tr>
		                  <tr>
		                   <td>&nbsp;</td>
		                  </tr>
		                  <tr>
		                  <td colspan="19"><b>Firma:</b>&nbsp;-----------------------------------------------</td>
		                    </tr>
                                     <tr>
		                    <td colspan="19"><b>CC.:</b>&nbsp;_________________________________</td>
		                  </tr>

                         <?
                 	  }
                  	 ?>
                   <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas" align="center">
                     <td colspan="50"><b><?echo $filas["municipio"];?></b>&nbsp;&nbsp;<?echo $filas["dirmaestro"];?>&nbsp;&nbsp; <b>Tel:</b>&nbsp;<?echo $filas["telmaestro"];?>&nbsp;<b>Fax:</b>&nbsp;<?echo $filas["faxmaestro"];?>&nbsp;<b>Web:</b>&nbsp;<?echo $filas["web"];?></td>
                </tr>
                 </table>
                 </td></tr>
               </table>
             <?

      endif;
            ?>

                   </body>
</html>
