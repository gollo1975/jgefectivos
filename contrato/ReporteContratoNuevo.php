<?
 session_start();
?>
<html>
        <head>
                <title>Impresión de contrato de trabajo</title>
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
        $variable="select convenio.* from convenio
                   where convenio.nroconvenio='$CodReporte'";
        $resultado=mysql_query($variable)or die("Error al bsucar convenios");
        $fila_C=mysql_fetch_array($resultado);
        $TipoContratto = $fila_C["tipocontrato"];
        $NroContrato = $fila_C["nroconvenio"];
        $Tipo = $fila_C["tipo"];
        $Cedula =$fila_C["cedemple"];
        $Nombre =$fila_C["nombres"];
        $LugarExpedicion =$fila_C["lugarexpedicion"];
        $Zona =$fila_C["zona"];
        $Cargo =$fila_C["cargo"];
        $Horario =$fila_C["horariotrabajo"];
        $FechaContratacion =$fila_C["fechacontratacion"];
        $Letra =$fila_C["letra"];
        $Salario =$fila_C["salario"];
        $FormaPago =$fila_C["formapago"];
        $DiaPago =$fila_C["diapago"];
        $Proceso =$fila_C["proceso"];
        $ConceptoNoSalarial = $fila_C["conceptonosalarial"];
        $PagoNoSalarial = $fila_C["pagonosalarial"];
        $LetraNoSalarial = $fila_C["letranosalarial"];
        $Direccion = $fila_C["direccion"];
        $Barrio = $fila_C["barrio"];
        $FechaNacimiento = $fila_C["fechanacimiento"];
        $CiudadContratacion = $fila_C["municipiocontratacion"];
        $DiasContrato = $fila_C["nrodias"];
        $FechaVencimiento = $fila_C["fechavencimiento"];
        /*variables de numeros*/
         $Cedula=number_format($Cedula);
         $Salario=number_format($Salario);
         $PagoNoSalarial =number_format($PagoNoSalarial);
         $FechaDia=date('d',strtotime($FechaContratacion));
         $FechaMes=date("m", strtotime($FechaContratacion));
         $Anio=date("Y", strtotime($FechaContratacion));
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
        $Sql="select modelocon.* from modelocon where modelocon.estado='$TipoContratto'";
        $Rs=mysql_query($Sql)or die("Error al bsucar modelos");
        $fila_M=mysql_fetch_array($Rs);
        $Contenido= $fila_M["nota"];
        $Cadena = str_replace("#1",$Nombre,$Contenido);
        $Cadena = str_replace("#2",$Cedula,$Cadena);
        $Cadena = str_replace("#3",$LugarExpedicion,$Cadena);
        $Cadena = str_replace("#4",$Zona,$Cadena);
        $Cadena = str_replace("#5",$Cargo,$Cadena);
        $Cadena = str_replace("#6",$Horario,$Cadena);
        $Cadena = str_replace("#7",$FechaContratacion,$Cadena);
        $Cadena = str_replace("#8",$Letra,$Cadena);
        $Cadena = str_replace("#9",$Salario,$Cadena);
        $Cadena = str_replace("#A",$FormaPago,$Cadena);
        $Cadena = str_replace("#B",$DiaPago,$Cadena);
        $Cadena = str_replace("#C",$FechaDia,$Cadena);
        $Cadena = str_replace("#D",$FechaMes,$Cadena);
        $Cadena = str_replace("#E",$Anio,$Cadena);
        $Cadena = str_replace("#F",$Proceso,$Cadena);
        $Cadena = str_replace("#G",$ConceptoNoSalarial,$Cadena);
        $Cadena = str_replace("#H",$LetraNoSalarial,$Cadena);
        $Cadena = str_replace("#I",$PagoNoSalarial,$Cadena);
        $Cadena = str_replace("#J",$Direccion,$Cadena);
        $Cadena = str_replace("#K",$Barrio,$Cadena);
        $Cadena = str_replace("#L",$FechaNacimiento,$Cadena);
        $Cadena = str_replace("#M",$CiudadContratacion,$Cadena);
        $Cadena = str_replace("#N",$DiasContrato,$Cadena);
        $Cadena = str_replace("#O",$FechaVencimiento,$Cadena);
         ?>

               <table border="0" align="center" width="720">
                 <tr>
                      <td><b><div align="center"><u><?echo $Tipo;?></u></b><b><div align="right">Nro:</b>&nbsp;<?echo $NroContrato;?></div></td>
                   </tr>
                   <tr><td><br></td></tr>
                </table>
                <table border="0" align="center" width="720">
                   <tr>
                      <td><p align="justify" class="FormatoCaja"><?echo $Cadena;?></p></td>
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
