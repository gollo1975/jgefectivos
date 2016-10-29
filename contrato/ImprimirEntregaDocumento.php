<html>
        <head>
                <title>Reporte de entrega de Documentos</title>
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
//if(session_is_registered("xsession")):
        include("../conexion.php");
        $variable="select maestroentregadocumento.* from maestroentregadocumento
                   where maestroentregadocumento.nroentrega='$NroEntrega'";
        $resultado=mysql_query($variable)or die("Error al buscar las cartas de entrega.");
        $fila_C=mysql_fetch_array($resultado);
        $NroEntrega = $fila_C["nroentrega"];
        $Documento = $fila_C["cedemple"];
        $Empleado = $fila_C["empleado"];
        $Zona = $fila_C["zona"];
        $LugarE = $fila_C["lugarexpedicion"];
        $FechaEntrega= $fila_C["fechaentrega"];
       /*variables de numeros*/
         $Cedula=number_format($Documento);
         $FechaDia=date('d',strtotime($FechaEntrega));
         $FechaMes=date("m", strtotime($FechaEntrega));
         $Anio=date("Y", strtotime($FechaEntrega));
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
        $Sql="select modelorestriccionmedica.* from modelorestriccionmedica where modelorestriccionmedica.tipomodelo='ENTREGA'";
        $Rs=mysql_query($Sql)or die("Error al buscar modelos");
        $fila_M=mysql_fetch_array($Rs);
        $Contenido= $fila_M["concepto"];
        $Cadena = str_replace("#1",$Empleado,$Contenido);
        $Cadena = str_replace("#2",$Cedula,$Cadena);
        $Cadena = str_replace("#3",$LugarE,$Cadena);
        $Cadena = str_replace("#4",$Zona,$Cadena);
         ?>
         <table align="center" width="680">
               <tr><td width="118"><br></td></tr>
               <tr>
                  <td colspan="30" rowspan="8" class="cajas"><table width="100%" border="0" cellpadding="0" cellspacing="0">
               <tr>
                      <td width="125" rowspan="4" valign="top" style="border-top: 1px solid; border-left: 1px solid; border-bottom: 1px solid;border-right: 1px solid;"><img src="../image/logoMemo.jpg" width="128" height="115" border="0" heigth="120"></td>
               </tr>
               <tr>
                   <th height="50" bgcolor="#FFFFCC" style="border-top: 1px solid; border-right: 1px solid; border-bottom: 1px solid; font-size:14pt"><span class="Estilo1">ENTREGA DE DOCUMENTOS</span></th>
	      	   <td style="border-top: 1px solid; border-bottom: 1px solid; border-right: 1px solid; font-family:verdana; font-size:10pt" valign="bottom"><p align="center" >C&oacute;digo:FOR-SS-06.02 <p align="center" >Versi&oacute;n:02</p><p align="center" >Fecha: Marzo 2014</p></p></td>
               </tr>
               </table>
            <table align="center" width="680" border="0">
             <tr>
                 <td class="cajas">&nbsp;</td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                       <td class="FormatoCaja"><div align="left">Señor(a)</div></td>
                    </tr>
               </tr>
                <tr>
                 <td class="cajas" colspan="30"><div align="right"><b>Nro_Entrega:&nbsp;&nbsp;<?echo $NroEntrega;?></b></div></td>
               </tr>
                </table>
                <table border="0" align="center" width="680">
                    <tr>
                       <td class="FormatoCaja"><div align="left">Medellin-Antioquia, <?echo date('d');?> de <?echo $FechaMes;?> del año <?echo date('Y');?> </div></td>
                    <tr>
                       <td class="FormatoCaja"><div align="left"><b>JGEFECTIVOS SAS</b></div></td>
                    </tr>
                    <tr>
                       <td class="FormatoCaja"><div align="left">La Ciudad</b></div></td>
                    </tr>
                     <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                   <tr>
                      <td><p align="justify" class="FormatoCaja"><?echo $Cadena;?></p></td>
                   </tr>
                    <?
                   $SqlCarta="select detalladoentregadocumento.* from detalladoentregadocumento,maestroentregadocumento
                          where detalladoentregadocumento.nroentrega=maestroentregadocumento.nroentrega and
                                maestroentregadocumento.nroentrega='$NroEntrega'";
                    $RsCarta=mysql_query($SqlCarta)or die("Error al buscar detalles de la entrega de documentos");
                    ?>
                     <tr><td>&nbsp;</td></tr>
                     <table align="center" width="680" border="0">
                    <tr class="FormatoCaja">
                        <td></td>
                    </tr>
                    <?
                    $x=0;
                    while ($fila=mysql_fetch_array($RsCarta)){
                       ?>
                        <tr class="FormatoCaja">

                           <UL type = disk >
                             <td> <LI><?echo $fila["concepto"];?></td></UL>
                        </tr>
                       <?
                       $x += 1;
                    }
                ?>
                </table>
                 <table align="center" width="680" border="0">
                        <?if($x <= 4){?>
	                   <tr><td>&nbsp;</td></tr>
	                   <tr><td>&nbsp;</td></tr>
	                   <tr><td>&nbsp;</td></tr>
                           <tr><td>&nbsp;</td></tr>
                           <tr><td>&nbsp;</td></tr>
                           <tr><td>&nbsp;</td></tr>

                        <?}else{?>
                           <tr><td>&nbsp;</td></tr>
	                   <tr><td>&nbsp;</td></tr>
                           <tr><td>&nbsp;</td></tr>
                        <?}?>
	                 <tr>
	                       <td class="FormatoCaja"><div align="left">Atentamente,</div></td>
	                 </tr>
                          <?if($x <= 4){?>
                             <tr><td>&nbsp;</td></tr>
	                     <tr><td>&nbsp;</td></tr>
	                     <tr><td>&nbsp;</td></tr>
                             <tr><td>&nbsp;</td></tr>
                             <tr><td>&nbsp;</td></tr>
                             <tr><td>&nbsp;</td></tr>
                          <?}else{?>
                            <tr><td>&nbsp;</td></tr>
	                   <tr><td>&nbsp;</td></tr>
                           <tr><td>&nbsp;</td></tr>
                          <?}?>
                         <tr>
	                     <td colspan="30">----------------------------------------</td>
	                 </tr>
                         <tr>
	                     <td><div align="left" class="FormatoCaja"><?echo $Empleado;?></div></td>
	                 </tr>
                         <tr>
	                     <td><div align="left" class="FormatoCaja"><?echo $Cedula;?> de <?echo $LugarE;?></div></td>
	                 </tr>
                         <tr>
	                     <td><div align="left" class="FormatoCaja">Trabajador</div></td>
	                 </tr>

                 </table>

                <?
/*      else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;*/  
            ?>

                   </body>
</html>
