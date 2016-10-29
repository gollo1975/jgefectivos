<?
 session_start();
?>
<html>
        <head>
                <title>Reporte de restricciones Médicas</title>
              <LINK  REL="stylesheet" HREF="../formato.css" type="text/css">
                <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
                </script>
        </head>
        <body onload="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
               <?
    // if(session_is_registered("xsession")):
        include("../conexion.php");
        $variable="select maestrocartarestriccion.* from maestrocartarestriccion
                   where maestrocartarestriccion.nrocarta='$NroCarta'";
        $resultado=mysql_query($variable)or die("Error al bsucar cartas laborales");
        $fila_C=mysql_fetch_array($resultado);
        $NroCarta = $fila_C["nrocarta"];
        $Documento = $fila_C["cedula"];
        $Empleado = $fila_C["empleado"];
        $FechaExamen = $fila_C["fechaexamen"];
        $TipoRevision = $fila_C["tiporevision"];
        $Dias = $fila_C["dias"];
       /*variables de numeros*/
         $Cedula=number_format($Documento);
         $FechaDia=date('d',strtotime($FechaExamen));
         $FechaMes=date("m", strtotime($FechaExamen));
         $Anio=date("Y", strtotime($FechaExamen));
         /*ciclos de fechas*/
         if($FechaMes =='01' ){
            $FechaMes = 'Enero';
         }else{
              if($FechaMes =='02'){
                 $FechaMes = 'Febrero';
              }else{
                 if($FechaMes =='03'){
                    $FechaMes = 'Marzo';
                 }else{
                    if($FechaMes =='04'){
                        $FechaMes = 'Abril';
                    }else{
                         if($FechaMes =='05'){
                             $FechaMes = 'Mayo';
                         }else{
                              if($FechaMes =='06'){
                                 $FechaMes = 'Junio';
	                      }else{
	                           if($FechaMes =='07'){
	                                  $FechaMes = 'Julio';
	                           }else{
	                                if($FechaMes =='08'){
	           			      $FechaMes = 'Agosto';
	                                }else{
	                                     if($FechaMes =='09'){
	                                           $FechaMes = 'Septiembre';
	                                     }else{
	                                           if($FechaMes =='10'){
	                                                $FechaMes = 'Octubre';
	                                           }else{
	                                                if($FechaMes =='11'){
	                                                       $FechaMes = 'Noviembre';
	                                                }else{
	                                                       $FechaMes = 'Diciembre';
	                                                }
	                                           }
	                                     }
                                        }
	                           }
                              }
                         }
                    }
                 }
              }
           }

        /*codigo que busca modelo*/
        $Sql="select modelorestriccionmedica.* from modelorestriccionmedica where modelorestriccionmedica.tipomodelo='INICIO'";
        $Rs=mysql_query($Sql)or die("Error al buscar modelos");
        $fila_M=mysql_fetch_array($Rs);
        $Contenido= $fila_M["concepto"];
        $Cadena = str_replace("#1",$FechaDia,$Contenido);
        $Cadena = str_replace("#2",$FechaMes,$Cadena);
        $Cadena = str_replace("#3",$Anio,$Cadena);
         ?>
         <table align="center" width="680">
               <tr><td width="118"><br></td></tr>
               <tr>
                  <td colspan="30" rowspan="8" class="cajas"><table width="100%" border="0" cellpadding="0" cellspacing="0">
               <tr>
                      <td width="125" rowspan="4" valign="top" style="border-top: 1px solid; border-left: 1px solid; border-bottom: 1px solid;border-right: 1px solid;"><img src="../image/logoMemo.jpg" width="128" height="115" border="0" heigth="120"></td>
                      <td width="376" height="30" align="center" style="border-top: 1px solid; border-right: 1px solid; font-family:verdana; font-size:12pt">PROCESO SALUD OCUPACIONAL </td>
					  <td width="186" style="border-top: 1px solid; border-right: 1px solid;font-family:verdana; font-size:10pt"><div align="center">P&aacute;gina 1 de 1 </div></td>
               </tr>
               <tr>
                      <th height="50" bgcolor="#FFFFCC" style="border-top: 1px solid; border-right: 1px solid; border-bottom: 1px solid; font-size:14pt"><span class="Estilo1">CORRESPONDENCIA ENVIADA</span></th>
	      		  <td style="border-top: 1px solid; border-bottom: 1px solid; border-right: 1px solid; font-family:verdana; font-size:10pt" valign="bottom"><p align="center" >C&oacute;digo</p>				      </td>
               </tr>
                                <tr>
                      <td rowspan="2" align="center"  style="border-right: 1px solid; border-bottom: 1px solid;font-family:verdana; font-size:10pt">R&eacute;gimen Organizacional Interno </td>

                    </tr>
                    <tr>
                      <td height="15" valign="top" style="border-right: 1px solid; border-bottom: 1px solid;font-family:verdana; font-size:10pt"><div align="center">REG SO 01 CE</div></td>
                    </tr>
               </table>
            <table align="center" width="680" border="0">
             <tr>
                 <td class="cajas">&nbsp;</td>
               </tr>
                <tr>
                 <td class="cajas" colspan="30"><div align="right"><b>CONSECUTIVO:&nbsp;&nbsp;CE <?echo $NroCarta;?></b></div></td>
               </tr>
                </table>
                <table border="0" align="center" width="680" height="605">
                    <tr>
                       <td class="FormatoCaja"><div align="left">Medellin-Antioquia, <?echo date('d');?> de <?echo $FechaMes;?> del año <?echo date('Y');?> </div></td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                       <td class="FormatoCaja"><div align="left"><b>Señor(a)</b></div></td>
                    </tr>
                    <tr>
                       <td class="FormatoCaja"><div align="left"><b><?echo $Empleado;?></b></div></td>
                    </tr>
                    <tr>
                       <td class="FormatoCaja"><div align="left"><b>CC.&nbsp;<?echo $Cedula;?></b></div></td>
                    </tr>
                     <tr><td>&nbsp;</td></tr>
                     <tr>
                       <td class="FormatoCaja"><div align="left"><b>Asunto:</b>&nbsp;<?echo $TipoRevision;?></div></td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td></tr>
                   <tr>
                      <td><p align="justify" class="FormatoCaja"><?echo $Cadena;?></p></td>
                   </tr>
                    <?
                   $SqlCarta="select detalladorestriccionmedica.* from maestrocartarestriccion,detalladorestriccionmedica
                          where detalladorestriccionmedica.nrocarta=maestrocartarestriccion.nrocarta and
                                maestrocartarestriccion.nrocarta='$NroCarta'";
                    $RsCarta=mysql_query($SqlCarta)or die("Error al buscar detalles de la restriccion medica");
                    ?>
                    <tr><td>&nbsp;</td></tr>
                    <tr class="FormatoCaja">
                        <td></td>
                    </tr>
                    <?
                    while ($fila=mysql_fetch_array($RsCarta)){
                       ?>
                        <tr class="FormatoCaja">

                           <UL type = disk >
                             <td> <LI><?echo $fila["concepto"];?></td></UL>
                        </tr>
                       <?
                    }
                        $SqlSegunda="select modelorestriccionmedica.* from modelorestriccionmedica where modelorestriccionmedica.tipomodelo='FINAL'";
		        $RsSegunda=mysql_query($SqlSegunda)or die("Error al buscar modelos");
		        $fila_F=mysql_fetch_array($RsSegunda);
		        $Variable= $fila_F["concepto"];
		        $Auxiliar = str_replace("#4",$Dias,$Variable);
                    ?>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                      <td><p align="justify" class="FormatoCaja"><?echo $Auxiliar;?></p></td>
                    </tr>
                   <tr><td>&nbsp;</td></tr>

                       <tr>
                         <td><b><? echo "<img src=\"../image/firmaRuben.PNG\"/border=\"0\"/widht=\"90\"/height=\"120\"/>"?></b></td>
                      </tr>
                      <tr>
                      <td class="FormatoCaja"><b><?echo $fila_C["firma"];?></b></td>
                   </tr>
                    <tr>
                      <td class="FormatoCaja"><?echo $fila_C["cargo"];?></td>
                   </tr>
                     <tr>
                      <td class="FormatoCaja"><?echo $fila_C["profesion"];?></td>
                   </tr>
                    <tr>
                      <td class="FormatoCaja"><?echo $fila_C["licencia"];?></td>
                   </tr>
                    <tr>
                      <td class="cajasletras"><b>Firmada Digitalmente.</b></td>
                   </tr>
                   <tr><td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td></tr>
                     <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                        <tr>
                     <td rowspan="2" align="center"  style="border-right: 751px solid; border-bottom: 1px solid;font-family:verdana; font-size:10pt"></td>
                     </tr>
                   <table align="center" width="680" border="0">
                    </tr>

				 <tr>
				   <td colspan="8" style="font-family:verdana; font-size:7pt">Copia Archivo y Documentación</td>
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
				   <td colspan="8" style="font-family:verdana; font-size:7pt">COPIA CONTROLADA. Uso exclusiva de SO </td>
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

             <?

 /*     else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;  */
            ?>

                   </body>
</html>
