<html>
        <head>
                <title>Reporte Prestaciones Sociales</title>
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

$ConT = "select maestro.web, maestro.telmaestro, maestro.dirmaestro, zona.zona, sucursal.faxsucursal, municipio.municipio, empleado.cuenta, prestacion.* 
		 from maestro,zona,sucursal,empleado,prestacion,municipio where
                     municipio.codmuni=maestro.codmuni and
                      maestro.codmaestro=sucursal.codmaestro and
                     sucursal.codsucursal=zona.codsucursal and
                     zona.codzona=empleado.codzona and
                     empleado.cedemple=prestacion.cedemple and
					 prestacion.fechapro between '2014-12-17' and '2014-12-18' and 
                     zona.codzona='031'";				  

$ResT=mysql_query($ConT)or die ("Error al buscar prestaciones");
$ReG=mysql_num_rows($ResT);
while ($filas = mysql_fetch_array ($ResT))	{
	
	$nropresta = $filas ["nropresta"];
if ($ReG == 0):
         $variable="select maestro.web, maestro.telmaestro, maestro.dirmaestro, zona.zona, sucursal.faxsucursal, municipio.municipio, empleado.cuenta, prestacion.* 
		 from maestro,zona,sucursal,empleado,prestacion,municipio where
                     municipio.codmuni=maestro.codmuni and
                      maestro.codmaestro=sucursal.codmaestro and
                     sucursal.codsucursal=zona.codsucursal and
                     zona.codzona=empleado.codzona and
                     empleado.cedemple=prestacion.cedemple and
					 prestacion.fechapro between '2014-12-17' and '2014-12-18' and 
                     zona.codzona='031'";
					 
        $resultado=mysql_query($variable)or die("Error al buscar datos");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El Nro De la Prestacion, no existe en la b.d 1")
            history.back()
          </script>
         <?
        else:
			$nropresta =  $filas ["nropresta"];
			while ($filas = mysql_fetch_array(resultado))	{
			
			$variable="select maestro.web, maestro.telmaestro, maestro.dirmaestro, zona.zona, sucursal.faxsucursal, municipio.municipio, empleado.cuenta, prestacion.* 
		 from maestro,zona,sucursal,empleado,prestacion,municipio where
                     municipio.codmuni=maestro.codmuni and
                      maestro.codmaestro=sucursal.codmaestro and
                     sucursal.codsucursal=zona.codsucursal and
                     zona.codzona=empleado.codzona and
                     empleado.cedemple=prestacion.cedemple and
					 prestacion.nropresta = '$nropresta'";
        		$resultado=mysql_query($variable)or die("Error al buscar datos");
		
		
            while ($filas=mysql_fetch_array($resultado)):
             	$suma=$filas["ibc"]+$filas["auxilio"];
             	$novedad=$filas["prestamo"]+$filas["vestuario"]+$filas["otros"]+$filas["comfenalco"]+$filas["empresa"];
				 $compensacion=$filas["cesantia"]+$filas["interes"]+$filas["prima"]+$filas["vacacion"];
				 $total=$compensacion+$novedad;
				 $compensacion=number_format($compensacion,0);
				 $novedad=number_format($novedad,0);
				 $total=number_format($total,0);
				 $cedula=number_format($filas["cedemple"],0);
				 $ibc=number_format($filas["ibc"],0);
				 $auxilio=number_format($filas["auxilio"],0);
				 $suma=number_format($suma,0);
				 $cesantia=number_format($filas["cesantia"],0);
				 $interes=number_format($filas["interes"],0);
				 $prima=number_format($filas["prima"],0);
				 $vacacion=number_format($filas["vacacion"],0);
				 $prestamo=number_format($filas["prestamo"],0);
				 $vestuario=number_format($filas["vestuario"],0);
				 $otros=number_format($filas["otros"],0);
				 $comfenalco=number_format($filas["comfenalco"],0);
				 $Empresa=number_format($filas["empresa"],0);
				 $nropresta = $filas["nropresta"];
			  
			  		
              ?>
			  <br>
              
               <td>
               <table border="0" align="center" width="650" height ="5500">
               <img src="../image/logounico.png" border="0" width="145" height="130">
                <tr>
                 <td colspan="5" class="cajas"><td class="cajas"><td colspan="30" align="center"><b><u>PRESTACIONES SOCIALES</u></b></td><td colspan="20"><td class="cajas"><b>Nro:</b>&nbsp;<?echo $filas["nropresta"];?></td>
                </tr>
                 <td><td><br></td></tr>
                 <tr class="cajas">
                  <td colspan="13"><b>Documento:</b>&nbsp;<?echo $cedula;?></td>
                </tr>
                <tr class="cajas">
                  <td colspan="20"><b>Empleado:</b>&nbsp;<?echo $filas["nombres"];?></td>
                </tr>
                <tr class="cajas">
                  <td colspan="6"><b>F_Proceso:</b>&nbsp;<?echo $filas["fechapro"];?></td><td colspan="10"><b>F_Inicio:</b>&nbsp;<?echo $filas["fechaini"];?></td> <td colspan="40"><b>Zona:</b>&nbsp;<?echo $filas["zona"];?></td>
                </tr>
                <tr class="cajas">
                  <td colspan="6"><b>F_Corte:</b>&nbsp;<?echo $filas["fechacor"];?></td><td colspan="10"><b>Cuenta:</b>&nbsp;<?echo $filas["cuenta"];?></td><td colspan="8"><b>Dias_Cesantia:</b>&nbsp;<?echo $filas["dias"];?></td><td colspan="8"><b>Dias_Vacación:</b>&nbsp;<?echo $filas["dias"];?></td><td colspan="8"><b>Dias_Prima:</b>&nbsp;<?echo $filas["diasprima"];?></td><td colspan="20"><b>F_Imp:</b>&nbsp;<? echo date("Y-m-d");?></td>
                </tr>
                <table border="0" align="center" width="710">
                <tr>
                   <td>&nbsp;</td>
                </tr>
                <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Base Para Liquidar Prestaciones:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?echo $ibc;?></td>
                </tr>
                 <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Ayuda Para el Transporte:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?echo $auxilio;?></td>
                </tr>
                 <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Base Liquidar Otras Prestaciones:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?echo $suma;?></td>
                </tr>
                 <tr class="cajas">
                    <td width="15"></td><td colspan="50"><b></b>______________________________________________________________________________________________</td>
                    </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas">
                 <td width="15" align="right"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Cesantias:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $cesantia;?></td>
                </tr>
                 <tr class="cajas">
                 <td width="15" align="right"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Intereses :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $interes;?></td>
                </tr>
                <tr class="cajas">
                 <td width="15" align="right"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Prima Semestral     :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $prima;?></td>
                </tr>
                <tr class="cajas">
                 <td width="15"align="right"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Vacaciones:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $vacacion;?></td>
                </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TOTAL PRESTACIONES:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $compensacion;?></td>
                </tr>
                 <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas">
                    <td width="15"></td><td colspan="50"><b>_________________________Novedades de las Prestaciones_____________________________</b></td>
                    </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                   <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Descuento de Vestuario :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $vestuario;?></td>
                </tr>
                 <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Descuento de Caja_Comp.:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $ <?echo $comfenalco;?></td>
                </tr>
                  <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Descuento de Financiero:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $prestamo;?></td>
                </tr>
                <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Descuento de Mercado :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $otros;?></td>
                </tr>

                 <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Descuento de Empresa:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $ <?echo $Empresa;?></td>
                </tr>
                <tr>
                   <td>&nbsp;</td>
                  </tr>
                <tr>
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TOTAL NOVEDADES:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $novedad;?></td>
                </tr>
                 <tr class="cajas">
                    <td width="15"></td><td colspan="50"><b></b>______________________________________________________________________________________________</td>
                    </tr>
                    <tr>
                   <td>&nbsp;</td>
                  </tr>
                 <tr>
                 <td width="10"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TOTAL PAGAR:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $total;?></td>
                </tr>
                <tr>
                   <td>&nbsp;</td>
                  </tr>
                     <tr class="cajas">
                    <td width="15"></td><td colspan="50"><b>Nota:</b>&nbsp;<?echo $filas["nota"];?></td>
                    </tr>
                  <tr>
                   <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                   <tr class="cajas">
                    <td width="15"></td><td colspan="19"><b>Firma:</b>&nbsp;-----------------------------------------------&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Empresa:</b>&nbsp;------------------------------------</td>
                    </tr>
                     <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas" align="center">
                     <td colspan="50"><b><?echo $filas["municipio"];?></b>&nbsp;&nbsp;<?echo $filas["dirmaestro"];?>&nbsp;&nbsp; <b>PBX:</b>&nbsp;<?echo $filas["telsucursal"];?>&nbsp;<b>Fax:</b>&nbsp;<?echo $filas["faxsucursal"];?>&nbsp;<b>Web:</b>&nbsp;<?echo $filas["web"];?></td>
                </tr>
                 </table>
                 </td></tr>
               </table>
             <?
           endwhile;
		   }
      endif;
	  
else:
     $variable="select maestro.web,maestro.telmaestro,maestro.dirmaestro,zona.zona,sucursal.faxsucursal,municipio.municipio,empleado.cuenta,prestacion.*,empleado.codemple from maestro,zona,sucursal,empleado,prestacion,municipio where
                     municipio.codmuni=maestro.codmuni and
                      maestro.codmaestro=sucursal.codmaestro and
                     sucursal.codsucursal=zona.codsucursal and
                     zona.codzona=empleado.codzona and
                     empleado.cedemple=prestacion.cedemple and
                     prestacion.nropresta='$nropresta'";
        $resultado=mysql_query($variable)or die("Error al buscar datos");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El Nro De la Prestacion, no existe en la b.d 2")
            history.back()
          </script>
         <?
        else:
            while ($filas=mysql_fetch_array($resultado)):
             $suma=$filas["ibc"]+$filas["auxilio"];
             $DeduccionV=-$filas["totald"];
             $compensacion=$filas["cesantia"]+$filas["interes"]+$filas["prima"]+$filas["vacacion"];
             $total=$compensacion+$DeduccionV;
             $compensacion=number_format($compensacion,2);
             $total=number_format($total,2);
             $cedula=number_format($filas["cedemple"],0);
             $ibc=number_format($filas["ibc"],0);
             $auxilio=number_format($filas["auxilio"],0);
             $suma=number_format($suma,0);
             $cesantia=number_format($filas["cesantia"],0);
             $interes=number_format($filas["interes"],0);
             $prima=number_format($filas["prima"],0);
             $vacacion=number_format($filas["vacacion"],0);
             $DeduccionT=number_format($DeduccionV,2);
              ?>
                <tr><td>
                <table border="0" align="center" width="718" >
               <td colspan="60"><img src="../image/LogoInicio.JPG" border="0" width="205" height="115" class="cajas"><b><u> PRESTACIONES SOCIALES</u></b> <td  class="cajas"><div align="right"><b>Nro:</b>&nbsp;<?echo $filas["nropresta"];?></div></td>
                 <tr><td><br></td></tr>
                 <tr class="cajas">
                  <td colspan="6"><b>Cod_Empleado:</b>&nbsp;<?echo $filas["codemple"];?></td>
				  <td colspan="13"><b>Documento:</b>&nbsp;<?echo $cedula;?></td>
				  <td colspan="40"><b>Empleado:</b>&nbsp;<?echo $filas["nombres"];?></td
                </tr>
                <tr class="cajas">
                  <td colspan="10"><b>F_Proceso:</b>&nbsp;<?echo $filas["fechapro"];?></td><td colspan="10"><b>F_Inicio:</b>&nbsp;<?echo $filas["fechaini"];?></td> <td colspan="40"><b>Zona:</b>&nbsp;<?echo $filas["zona"];?></td>
                </tr>
                <tr class="cajas">
                  <td colspan="10"><b>F_Corte:</b>&nbsp;<?echo $filas["fechacor"];?></td><td colspan="10"><b>Cuenta:</b>&nbsp;<?echo $filas["cuenta"];?></td><td colspan="8"><b>Dias_Cesantia:</b>&nbsp;<?echo $filas["dias"];?></td><td colspan="8"><b>Dias_Vacación:</b>&nbsp;<?echo $filas["dias"];?></td><td colspan="8"><b>Dias_Prima:</b>&nbsp;<?echo $filas["diasprima"];?></td><td colspan="20"><b>F_Imp:</b>&nbsp;<? echo date("Y-m-d");?></td>
                </tr>
                </table>
                <table border="0" align="center" width="718"><tr><td>
                 <table border="0" align="center" width="718">
                 <tr><td>&nbsp;</td></tr>
                <tr class="cajas">
                   <td colspan="50"><b></b>_____________________________________________<b>Información de Prestaciones</b>______________________________________________</td>
                    </tr>
                     <tr><td>&nbsp;</td></tr>
                <tr class="cajas">
                 <td colspan="20"><b>Base Para Liquidar Prestaciones:</b>&nbsp;<td colspan="10"><div align="right">$<?echo $ibc;?></div></td>
                </tr>
                 <tr class="cajas">
                 <td colspan="20"><b>Ayuda Para el Transporte:</b>&nbsp;<td colspan="10"><div align="right">$<?echo $auxilio;?></div></td>
                </tr>
                 <tr class="cajas">
                </td><td colspan="20"><b>Base Liquidar Otras Prestaciones:</b>&nbsp;<td colspan="10"><div align="right">$<?echo $suma;?></div></td>
                </tr>
                 <tr class="cajas">
                   <td colspan="50"><b></b>______________________________________________<b>Detallado de Prestaciones</b>________________________________________________</td>
                    </tr>
                    <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas">
                 <td colspan="25"><b>Cesantias:</b>&nbsp;<td colspan="5"><div align="right">$<?echo $cesantia;?></div></td>
                </tr>
                 <tr class="cajas">
                 <td colspan="25"><b>Intereses:</b>&nbsp;<td colspan="5"><div align="right">$<?echo $interes;?></div></td>
                </tr>
                <tr class="cajas">
                <td colspan="25"><b>Prima Semestral:</b>&nbsp;<td colspan="5"><div align="right">$<?echo $prima;?></div></td>
                </tr>
                <tr class="cajas">
                 <td colspan="25"><b>Vacaciones:</b>&nbsp;<td colspan="5"><div align="right">$<?echo $vacacion;?></div></td>
                </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                <td colspan="20"><b>Total Prestaciones:</b><td colspan="10"><div align="right"><b>$<?echo $compensacion;?></b></div></td>
                </tr>
                <?
               $ConP="select detalleprestacion.* from prestacion,detalleprestacion
                     where prestacion.nropresta=detalleprestacion.nropresta and
                     prestacion.nropresta='$nropresta'";
               $ResP=mysql_query($ConP)or die ("Error al buscar deducciones");
                ?>
                 <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas">
                    </td><td colspan="50"><b>_____________________________________Novedades de las Prestaciones__________________________________________</b></td>
                    </tr>
                     <td>&nbsp;</td>
                   
<table border="1" align="center"  width="610">
	           <tr class="cajas">
	              <td><b>Item</b></td>
                      <td width="5"><b>Cod_Salario</b></td>
                      <td><b>Concepto</b></td>
                      <td width="5"><b>Vlr_Deducción</b></td>
                      <td width="5"><b>Nro_Documento</b></td>
                   </tr>
                   <?$f=1;
                   while($filas_s=mysql_fetch_array($ResP)):
                      $Valor=number_format($filas_s["valorpago"],0);
                      ?>
                      <tr class="cajas">
	                      <td><?echo $f;?></td>
	                      <td><?echo $filas_s["codsala"];?></td>
	                      <td><?echo $filas_s["concepto"];?></td>
	                      <td><div align="center">$<?echo $Valor;?></div></td>
	                      <td><div align="center"><?echo $filas_s["nrocredito"];?></div></td>
                     </tr>
                      <?$f=$f+1;
                   endwhile;
                   ?>

</table>
                    <table border="0" align="center"  width="718">
                <tr>
                   <td>&nbsp;</td>
                  </tr>
                <tr>
                 <td colspan="20"><b>Total Deducciones:</b>&nbsp;<td colspan="10"><div align="right"><b>$<?echo $DeduccionT;?></b></div></td>
                </tr>
                 <tr class="cajas">
                    <td colspan="50"><b></b>_____________________________________________________________________________________________________________</td>
                    </tr>
                    <tr>
                   <td>&nbsp;</td>
                  </tr>
                 <tr>
                 <td colspan="20"><b>TOTAL PAGAR:</b>&nbsp;<td colspan="10"><div align="right"><b>$<?echo $total;?></b></div></td>
                </tr>
                <tr>
                   <td>&nbsp;</td>
                  </tr>
                     <tr class="cajas">
                    <td width="15"></td><td colspan="50"><b>Nota:</b>&nbsp;<?echo $filas["nota"];?></td>
                    </tr>
                  <tr>
                   <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                   <tr class="cajas">
                    <td width="15"></td><td colspan="30"><b>Firma:</b>&nbsp;---------------------------------------------&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Empresa:</b>&nbsp;---------------------------------</td>
                    </tr>
                     <tr><td>&nbsp;</td></tr>
                     <tr><td>&nbsp;</td></tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas" align="center">
                     <td colspan="50"><b><?echo $filas["municipio"];?></b>&nbsp;&nbsp;<?echo $filas["dirmaestro"];?>&nbsp;&nbsp; <b>PBX:</b>&nbsp;<?echo $filas["telsucursal"];?>&nbsp;<b>Fax:</b>&nbsp;<?echo $filas["faxsucursal"];?>&nbsp;<b>Web:</b>&nbsp;<?echo $filas["web"];?></td>
                </tr>
                 </table>
				 
                 </td></tr>
               </table>
			   <br>
			   <br>
			   <br>
			    <br>
				 <br>
				  <br>
				   <br>
             <?
           endwhile;
      endif;
endif;
}
            ?>

                   </body>
</html>
