<html>
<head>
<title>Reporte de pago de Incapacidad</title>
<LINK  REL="stylesheet" HREF="../formato.css"  type="text/css">
<script language="javascript">
   function imprimir()
      {
      window.print()
      }
</script>
</head>
<body onload="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
<?
include("../conexion.php");
$variable="select pagozona.*,zona.nitzona,zona.dvzona from pagozona,zona
where zona.codzona=pagozona.codzona and
pagozona.radicado='$NroPago'";
$resultado=mysql_query($variable)or die("consulta incorrecta uno");
$registro=mysql_num_rows($resultado);
if ($registro!=0){
	$filas=mysql_fetch_array($resultado);
	$nit=number_format($filas["nitzona"],0);

	$Valor=number_format($filas["totalpagar"],0);
	?>
	<table border="1" align="center" width="700">
		<tr>
		<td>
		<table border="0" align="center" width="700">
		      <td colspan="10"class="cajas"><b><u><div align="left"><img src="../image/cabezote.PNG" border="0" height="135" cellpadding="0" cellspacing="0"></td>
                      <tr>
                        <td colspan="10"><div align="center"><b>EXTRACTO DE PAGO DE INCAPACIDAD</b></div></td>
                      </tr>
                      <tr>
                        <td colspan="10"><div align="right"><b>Nro_Pago:</b>&nbsp;<?echo $filas["radicado"];?></div></td>
                      </tr>
                       </tr><td colspan="10"><br></td><tr>
                      <tr>
                          <td class="cajas" colspan="2"><b>Nit/Cédula:</b>&nbsp;<?echo $nit;?>-<?echo $filas["dvzona"];?> </td>
		          <td class="cajas" colspan="5"><b>Empresa Usuaria:</b>&nbsp;<?echo $filas["zona"];?></td>
		      </tr>
                       <tr>
                          <td class="cajas" colspan="2"><b>Nro_Factura:</b>&nbsp;<?echo $filas["nrofactura"];?></td>
		          <td class="cajas" colspan="5"><b>F_Proceso:</b>&nbsp;<?echo $filas["fechap"];?></td>
		      </tr>
                      <tr>
                          <td class="cajas" colspan="2"><b>Valor:</b>&nbsp;$<?echo $Valor;?></td>
		          <td class="cajas" colspan="5"><b>Letras:</b>&nbsp;<?echo $filas["letras"];?> PESOS ML.</td>
		      </tr>
                       <tr>
                          <td class="cajas" colspan="10"><b>Observación:</b>&nbsp;<?echo $filas["nota"];?></td>
		      </tr>
                  </table>
                  </tr></td>
                  </table>
                   <table border="1" align="center" width="710">
                       <tr><td>
	                  <table border="0" align="center" width="900">
	                       <tr aling="center">
	                        <td colspan="30" class="cajas"><b><div align="center">Detallado de Pago</div> </b></td>
	                      </tr>
		          <?
                              include("../conexion.php");
		             $buscar="select depagozona.* from depagozona,pagozona
                                      WHERE   pagozona.radicado=depagozona.radicado and
			                      depagozona.radicado='$NroPago' order by depagozona.cedemple ";
		              $resul=mysql_query($buscar)or die("consulta incorrecta uno");
		              $reg=mysql_num_rows($resul);
		             if($reg!=0):
		                             ?>
		                         <tr class="cajas">
		                             <td><b><div align="center">Nro_Incapacidad</div><b></td>
		                             <td><b>Documento</b></td>
		                             <td><b>Empleado</b></td>
		                             <td><b><div align="center">D_Incap.</div></b></td>
		                             <td><b><div align="center">D_Asumidos</div></b></td>
                                             <td><b><div align="center">Desde</div></b></td>
                                             <td><b><div align="center">Hasta</div></b></td>
		                             <td><b><div align="center">Tipo_Incapacidad</div></b></td>
                                             <td><b><div align="center">Salario</div></b></td>
		                             <td><b><div align="left">Valor</div></b></td>
		                         </tr>
		                        <?$f=1;
		                     while ($filas_s=mysql_fetch_array($resul)):
		                       $Salario=number_format($filas_s["salario"],0);
                                       $TotalPagado=number_format($filas_s["total"],0);
		                       ?>
		                       <tr class="cajas">
		                           <td><?echo $filas_s["nroinca"];?></td>
		                           <td><?echo $filas_s["cedemple"];?></td>
		                           <td><?echo $filas_s["empleado"];?></td>
		                           <td><div align="center"><?echo $filas_s["dias"];?></div></td>
		                           <td><div align="center"><?echo $filas_s["diaspagado"];?></div></td>
		                           <td><div align="center"><?echo $filas_s["desde"];?></div></td>
                                           <td><div align="center"><?echo $filas_s["hasta"];?></div></td>
                                           <td><?echo $filas_s["tipoincapacidad"];?></div></td>
		                           <td><div align="right">$<?echo $Salario;?></div></td>
                                            <td><div align="right">$<?echo $TotalPagado;?></div></td>

		                       </tr>
		                       <?
		                       $f=$f+1;
		                        $a=$a+$filas_s["total"];
		                     endwhile;
                             else:
		               ?>
			          <script language="javascript">
			            alert("No hay detallado de pago por incapacidades.!")
			            history.back()
			          </script>
			         <?
		             endif;
                          ?>
                  </table>
                 </table>
                 <?
                  $a=number_format($a,2);
		   ?>
                    <tr>&nbsp;</td>
                    <tr>
                      <td class="cajas"><b><div align="center">Total_Pagado:</b>&nbsp;$<?echo $a;?></div></td>
                    </tr>

<?
}
?>

</body>
</html>
