		<html>
        <head>
                <title>Requisito de Empleado</title>
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
         $variable="select maestrorequisito.* from maestrorequisito where maestrorequisito.idRequisito='$IdChequeo'";
        $resultado=mysql_query($variable)or die("Error al buscar el codigo");
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
			   $Nota=$filas["nota"];
             ?>

               <table align="center" border="0" width="700">
               
               <tr><td width="118"><br></td></tr>
               <tr>
                  <td colspan="30" rowspan="8" class="cajas"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    
                    <tr>
                      <td width="125" rowspan="4" valign="top" style="border-top: 1px solid; border-left: 1px solid; border-bottom: 1px solid;border-right: 1px solid;"><img src="../image/logoMemo.jpg" width="128" height="115" border="0" heigth="120"></td>
                      <td width="376" height="30" align="center" style="border-top: 1px solid; border-right: 1px solid; font-family:verdana; font-size:10pt">PROCESO DE SEGURIDAD SOCIAL </td>
					  <td width="186" style="border-top: 1px solid; border-right: 1px solid;font-family:verdana; font-size:10pt"><div align="center">P&aacute;gina 1 de 1 </div></td>
                    </tr>
                    
                    
                    <tr>
                      <th height="50" bgcolor="#FFFFCC" style="border-top: 1px solid; border-right: 1px solid; border-bottom: 1px solid;"><span class="Estilo1">VERIFICACION DE REQUISITOS</span></th>
					  <td style="border-top: 1px solid; border-bottom: 1px solid; border-right: 1px solid; font-family:verdana; font-size:10pt" valign="bottom"><p align="center" >C&oacute;digo FOR-SS-04.02</p>				      </td>
                    </tr>
                    
                    <tr>
                      <td rowspan="2" align="center"  style="border-right: 1px solid; border-bottom: 1px solid;font-family:verdana; font-size:10pt"> </td>
                      <td height="15" valign="top" style="border-right: 1px solid; border-bottom: 1px solid;font-family:verdana; font-size:10pt"><div align="center">versi&oacute;n 02 </div></td>
                    </tr>
                    <tr>
                      <td height="15" valign="top" style="border-right: 1px solid; border-bottom: 1px solid;font-family:verdana; font-size:10pt"><div align="center">Fecha Marzo de 2014 </div></td>
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
                 <td class="cajas">&nbsp;</td>
               </tr>
                <tr>
                  <td class="cajas" colspan="20">Medellin&nbsp;<?echo $filas["fechap"];?></td><td class="cajas">&nbsp;</td>
                  <td class="cajas" colspan="40"><div align="center"></div></td>
                </tr>
                 <td><br></td>
                <td width="219">
                <td colspan="20">
                <td width="4"></td><td width="124" class="cajas"><b>
                  <div align="center">Nro_Entrega:</b>&nbsp;<?echo $filas["idRequisito"];?></div></td>
                </tr>
                <?
                $Sql="select detalladomaestrorequisito.*,maestrorequisito.fechap,maestrorequisito.nombre as Empleado,maestrorequisito.cedula, listadodocumentoempleado.concepto as Detalle from maestrorequisito,detalladomaestrorequisito,listadodocumentoempleado
                    where detalladomaestrorequisito.idRequisito= maestrorequisito.idRequisito and
					       listadodocumentoempleado.iddocumento= detalladomaestrorequisito.iddocumento and
                          maestrorequisito.idRequisito='$IdChequeo'";
                $Rs=mysql_query($Sql)or die("Error al buscar el codigo");
                ?>
                 </table>
                 <td class="cajas"colspan="40"><div align="center"><b><h4><u>LISTADO DE DOCUMENTOS</u></h4></b></div></td>
                   <table border="1" align="center" width="750">
                      <tr class="cajas">
                        <td><b><div align="center">Concepto</div></b></td>
                        <td><b><div align="center">Estado</div></b></td>
                        <td><b><div align="center">Validado</div></b></td>
                        <td><b><div align="center">Cant.</div></b></td>
                        <td><b><div align="center">Pend.</div></b></td>
                        <td><b><div align="center">F_Proceso</div></b></td>
                      </tr>
                    <?
                    while($Rt=mysql_fetch_array($Rs)){
                        $Empleado=$Rt["Empleado"];
                        $Documento=$Rt["cedula"];
                        ?>
                        <tr class="cajas">
                            <td><?echo $Rt["Detalle"];?></td>
                            <td><?echo $Rt["estado"];?></td>
                            <td><div align="center"><?echo $Rt["validacion"];?></div></td>
                            <td><div align="center"><?echo $Rt["cantidad"];?></div></td>
                            <td><div align="center"><?echo $Rt["pendiente"];?></div></td>
                            <td><?echo $Rt["fechap"];?></td>
                        <tr>
                        <?
                    }
					$Documento=number_format($Documento,0);
                    ?>
                  </table>
                <table border="0" align="center" width="750">
				<tr>
                     <td colspan="0" class="cajasletras"style="font-family:verdana; font-size:9pt"><p align="justify"><b>Pendiente:</b>&nbsp;<?echo $Nota;?></p></td>
                </tr>
				<tr><td><br></td></tr>
                <td class="cajas"colspan="40"><div align="center"><b><h4><u>NOTA IMPORTANTE</u></h4></b></div></td>
                  <tr>
                     <td colspan="0" style="font-family:verdana; font-size:9pt"><p align="justify">Yo, <b><?echo $Empleado;?></b>, identificado con el Nro <b><?echo $Documento;?></b>, declaro conocer todos los requisitos que se necesitan
                     para legalizar la vinculación como Trabajador en misión de la Empresa <b>JGEFECTIVOS SAS</b>; me comprometo que en un termino no mayor a Quince(15) dias calendario, haré llegar la documentacion faltante
                     para completar el proceso de ingreso. El incumplimiento a este compromiso, será causal para dar por terminado el contrato suscrito entre las partes.</b></p></td>
                </tr>
                  </tr>
                  <tr><td><br></td></tr>
                   <tr><td><br></td></tr>
                    <tr><td><br></td></tr>
                     <tr>
                     <td>Atentamente,</td>
                   </tr>

                   <tr>
                   <td>&nbsp;</td>
                  </tr>
                    <tr><td><br></td></tr>
                     <tr><td><br></td></tr>
                      <tr><td><br></td></tr>

                </table>
                </table>
        </table>
             <?
           endwhile;
      endif;
            ?>
			<table  border="0" align="center" width="750">
			<tr><td colspan="20"></td></tr>
		       <td colspan="8" style="border-top: 1px solid;">Firma de Empresa </td>
			  <td>&nbsp;</td>
			  <td colspan="8" style="border-top: 1px solid;">Firma de Empleado </td>
			  <td>&nbsp;</td>
			</tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
                          <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>Documento:&nbsp;<?echo $Documento;?></td>
			  <td>&nbsp;</td>
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
				   <td colspan="8" style="font-family:verdana; font-size:7pt">COPIA CONTROLADA. Uso exclusiva de SS </td>
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
