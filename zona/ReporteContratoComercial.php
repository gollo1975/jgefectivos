<?
 session_start();
?>
<html>
        <head>
                <title>Impresión de contrato de Comercial</title>
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
    if(session_is_registered("xsession")):
        include("../conexion.php");
        $variable="select contratocomercial.* from contratocomercial
                   where contratocomercial.nroc='$Nro'";
        $resultado=mysql_query($variable)or die("Error al bsucar convenios");
        $fila_C=mysql_fetch_array($resultado);
        $NroContrato = $fila_C["nroc"];
        $Nit =$fila_C["nit"];
        $Dv =$fila_C["dv"];
        $Empresa =$fila_C["cliente"];
        $Direccion =$fila_C["direccion"];
        $MunicipioEmpresa =$fila_C["municipioempresa"];
        $Representante =$fila_C["representantelegal"];
        $Proceso =$fila_C["proceso"];
        $CotizacionLetra =$fila_C["cotizacionletra"];
        $TextoAdecuado =$fila_C["textoadecuado"];
        $MunicipioExpedicion =$fila_C["municipioexpedicion"];
        $Cedula =$fila_C["documento"];
        $NroCotizacion =$fila_C["nrocotizacion"];
        $CotizacionNro =$fila_C["cotizacionnro"];
        $FechaContrato =$fila_C["fechap"];
        /*variables de numeros*/
         $Cedula=number_format($Cedula,0);
         $Nit=number_format($Nit,0);
         $FechaDia=date('d',strtotime($FechaContrato));
         $FechaMes=date("m", strtotime($FechaContrato));
         $Anio=date("Y", strtotime($FechaContrato));
         if($FechaMes =='01'){
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
        $Sql="select modelocontrato.concepto from modelocontrato where modelocontrato.estado='COMERCIAL'";
        $Rs=mysql_query($Sql)or die("Error al buscar el modelo del contrato comercial.!");
        $fila_M=mysql_fetch_array($Rs);
        $Contenido= $fila_M["concepto"];
        $Cadena = str_replace("#1",$Empresa,$Contenido);
        $Cadena = str_replace("#2",$Nit,$Cadena);
        $Cadena = str_replace("#3",$Dv,$Cadena);
        $Cadena = str_replace("#4",$Direccion,$Cadena);
        $Cadena = str_replace("#5",$MunicipioEmpresa,$Cadena);
        $Cadena = str_replace("#6",$Representante,$Cadena);
        $Cadena = str_replace("#7",$Proceso,$Cadena);
        $Cadena = str_replace("#8",$NroCotizacion,$Cadena);
        $Cadena = str_replace("#9",$CotizacionLetra,$Cadena);
        $Cadena = str_replace("#A",$CotizacionNro,$Cadena);
        $Cadena = str_replace("#B",$TextoAdecuado,$Cadena);
        $Cadena = str_replace("#C",$FechaDia,$Cadena);
        $Cadena = str_replace("#D",$FechaMes,$Cadena);
        $Cadena = str_replace("#E",$Anio,$Cadena);
        $Cadena = str_replace("#F",$Cedula,$Cadena);
        $Cadena = str_replace("#G",$MunicipioExpedicion,$Cadena);
         ?>

               <table border="0" align="center" width="710">
                <td><td><tr></td><div align="center"><b>CONTRATO COMERCIAL CON EMPRESA USUARIA</b></div></td>
                <tr><td><div align="right"><b>Nro:</b></b>&nbsp;CC-<?echo $Nro;?></div></td</tr>
                   <tr><td><br></td></tr>
                </table>
                <table border="0" align="center" width="710">
                   <tr>
                      <td><p align="justify" class="Formato"><?echo $Cadena;?></p></td>
                   </tr>
                </table>

             <?

else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
   ?>

                   </body>
</html>
