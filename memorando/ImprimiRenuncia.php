<html>
        <head>
                <title>Impresión de Memorando</title>
              <LINK  REL="stylesheet" HREF="../formato.css" type="text/css">
                <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
                </script>
                <style type="text/css">
<!--
.Estilo1 {
	color: #009933;
	font-weight: bold;
}
-->
                </style>
</head>
        <body onLoad="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
               <?

        include("../conexion.php");
         $variable="select maestro.web,maestro.dirmaestro,maestro.telmaestro,sucursal.dirsucursal,sucursal.telsucursal,sucursal.faxsucursal,sucursal.codmuni as codigo,sucursal.sucursal,municipio.municipio,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.tipod,renuncia.* from municipio,zona,sucursal,empleado,renuncia,maestro
          where      maestro.codmaestro=sucursal.codmaestro and
                     sucursal.codsucursal=zona.codsucursal and
                     zona.codzona=empleado.codzona and
                     empleado.cedemple=renuncia.cedemple and
                     renuncia.codmuni=municipio.codmuni and
                     renuncia.radicado='$radicado'";
        $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El Radicado no existe en la b.d.")
            history.back()
          </script>
         <?
        else:
            while ($filas=mysql_fetch_array($resultado)):
             ?>

               <table align="center" width="700">
               
               <tr><td width="118"><br></td></tr>
               <tr>
                  <td colspan="30" rowspan="8" class="cajas"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    
                    <tr>
                      <td width="125" rowspan="4" valign="top" style="border-top: 1px solid; border-left: 1px solid; border-bottom: 1px solid;border-right: 1px solid;"><img src="../image/logoMemo.jpg" width="128" height="115" border="0" heigth="120"></td>
                      <td width="376" height="30" align="center" style="border-top: 1px solid; border-right: 1px solid; font-family:verdana; font-size:10pt">PROCESO GESTI&Oacute;N HUMANA </td>
					  <td width="186" style="border-top: 1px solid; border-right: 1px solid;font-family:verdana; font-size:10pt"><div align="center">P&aacute;gina 1 de 1 </div></td>
                    </tr>
                    
                    
                    <tr>
                      <th height="50" bgcolor="#FFFFCC" style="border-top: 1px solid; border-right: 1px solid; border-bottom: 1px solid;"><span class="Estilo1">ACTA DE DESCARGO POR RENUNCIA</span></th>
					  <td style="border-top: 1px solid; border-bottom: 1px solid; border-right: 1px solid; font-family:verdana; font-size:10pt" valign="bottom"><p align="center" >C&oacute;digo FOR-GH-16.02</p>				      </td>
                    </tr>
                    
                    <tr>
                      <td rowspan="2" align="center"  style="border-right: 1px solid; border-bottom: 1px solid;font-family:verdana; font-size:10pt">R&eacute;gimen Organizacional Interno </td>
                      <td height="15" valign="top" style="border-right: 1px solid; border-bottom: 1px solid;font-family:verdana; font-size:10pt"><div align="center">versi&oacute;n 01 </div></td>
                    </tr>
                    <tr>
                      <td height="15" valign="top" style="border-right: 1px solid; border-bottom: 1px solid;font-family:verdana; font-size:10pt"><div align="center">Fecha Abril de 2014 </div></td>
                    </tr>
                    
                  </table></td><td width="1" class="cajas">&nbsp;</td>
                </tr>
               <tr>
                 <td class="cajas">&nbsp;</td>
               </tr>
               <tr>
                 <td class="cajas"></td>
               </tr>
               <tr>
                 <td class="cajas">&nbsp;</td>
               </tr>
               <tr>
                 <td class="cajas">&nbsp;</td>
               </tr>
               <tr>
                 <td class="cajas">&nbsp;</td>
               </tr>
               <tr>
                 <td class="cajas">&nbsp;</td>
               </tr>
               <tr>
                 <td class="cajas">&nbsp;</td>
               </tr>
                <tr>
                  <td class="cajas" colspan="20"><?echo $filas["municipio"];?>&nbsp;<?echo $filas["fechap"];?></td><td class="cajas">&nbsp;</td>
                  <td class="cajas" colspan="40"><div align="center"></div></td>
                </tr>
                 <td><br></td>
                <td width="219">
                <td colspan="20">
                <td width="4"></td><td width="124" class="cajas"><b>
                  <div align="center">Rad.:</b>&nbsp;<?echo $filas["radicado"];?></div></td>
                </tr>
              <tr class="cajas">
                 <td><b><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></b>                </tr>
                <tr class="cajas">
                  <td><b><?echo $filas["dirigida"];?></b>                </tr>
                <tr class="cajas">
                  <td><b><?echo $filas["tipod"];?>.&nbsp;<?echo $filas["cedemple"];?></b>                </tr>

                <tr class="cajas">
                 <td>&nbsp;</td>
               </tr>
                 
                  <table border="0" align="center" width="700">
                   <tr class="cajas">
                    <td colspan="40"><b>Descargos:</b></td>
                    </tr>
                 </table>
                   <table border="0" align="center" width="700">
                    <tr>
                  <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas">
                     <td colspan="0" style="font-family:verdana; font-size:9pt"><p align="justify"><?echo $filas["descargo"];?></p></td>
                </tr>

                <table border="0" align="center" width="700">
                    <tr>
                  <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                     <tr class="cajas">
                     <td>Atentamente,</td>
                   </tr>
                    <tr>
                   <td>&nbsp;</td>
                  </tr>
                   <tr>
                   <td>&nbsp;</td>
                  </tr>
                    
                   <tr>
                   <td><br></td>
                  </tr>
                  <tr class="cajas">
                     <td colspan="30"><?echo $filas["firma"];?></td>
                </tr>
                <tr class="cajas">
                     <td colspan="30"><?echo $filas["cargo"];?></td>
                </tr>
                </table>
                </table>
        </table>
             <?
           endwhile;
      endif;
            ?>
			<table  border="0" align="center" width="700">
			<tr><td colspan="20"></td></tr>
			<tr><td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td colspan="8" style="border-top: 1px solid;">Firma de Recibido </td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
			<tr><td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>Documento</td>
			  <td colspan="7"style="border-bottom: 1px solid;">&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
				 <tr><td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td  style="font-family:verdana; font-size:7pt">&nbsp;</td>
				 </tr>
				 <tr>
				   <td colspan="20" style="font-family:verdana; font-size:7pt">Su Paz y Salvo y su liquidaci&oacute;n ser&aacute;n generados y entregados con la devoluci&oacute;n del carnet completo (pl&aacute;stico, Porta - Carnet, tira y/o yoyo), de lo contratio su costo será $5.500, ser&aacute; deducido de sus Prestaciones Sociales. </td>
			     </tr>
				 <tr>
				   <td colspan="20" style="font-family:verdana; font-size:7pt">&nbsp;</td>
		      </tr>
				 <tr>
				   <td colspan="5" style="font-family:verdana; font-size:7pt">ENTREGA CARNET </td>
		           <td style="font-family:verdana; font-size:7pt">SI</td>
		           <td style="font-family:verdana; font-size:7pt;border-bottom: 1px solid;">&nbsp;</td>
		           <td style="font-family:verdana; font-size:7pt">NO</td>
		           <td style="font-family:verdana; font-size:7pt;;border-bottom: 1px solid;">&nbsp;</td>
		           <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
		           <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
		           <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
		           <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
		           <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
		           <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
		           <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
		           <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
		           <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
		           <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
		           <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
			  </tr>

				 <tr>
				   <td colspan="5" style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt;">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
		      </tr>
				 <tr>
				   <td colspan="20" style="font-family:verdana; font-size:7pt;border-bottom: 3px solid;">&nbsp;</td>
		      </tr>
				 <tr>
				   <td colspan="8" style="font-family:verdana; font-size:7pt">Documento de confidencialidad alta </td>
				   <td style="font-family:verdana; font-size:7pt;">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
		      </tr>
				 <tr>
				   <td colspan="8" style="font-family:verdana; font-size:7pt">COPIA CONTROLADA. Uso exclusiva de GH </td>
				   <td style="font-family:verdana; font-size:7pt;">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td style="font-family:verdana; font-size:7pt">&nbsp;</td>
		      </tr>
				 <tr>
				   <td colspan="8" style="font-family:verdana; font-size:7pt">&nbsp;</td>
				   <td colspan="12" style="font-family:verdana; font-size:7pt;"><div align="right">JGEFECTIVOS S.A.S por el cuidado del Medio Ambiente </div></td>
		      </tr>
			</table>

</body>
</html>
