<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
include("../conexion.php");
$consulta="select zona.zona from zona
where zona.codzona='$codigo'";
$resultado=mysql_query($consulta)or die ("Error al bsucar zona");
$registro=mysql_num_rows($resultado);
$fila=mysql_fetch_array($resultado);
if($registro==0):
    ?>
    <script language="javascript">
       alert("La zona no existe en sistema ?")
       history.back()
   </script><?
else:?>
    <table border="0" align="center">
         <tr class="cajas">
            <td><b>Zona:&nbsp;<?echo $fila["zona"];?></b></td>
         </tr>
    </table><?
    $con="select pagozona.* from pagozona,zona
    where  zona.codzona=pagozona.codzona and
    zona.codzona='$codigo'";
    $resu=mysql_query($con)or die ("Errort al buscar radicados");
    $regi=mysql_num_rows($resu);
    if($regi==0):
        ?>
        <script language="javascript">
            alert("No hay radicados de pago en esta zona ?")
            history.back()
        </script><?
    else:?>
        <center><h4><u>Detallado de Pago</u></h4></center>
        <table boder="0" align="center">
           <tr class="cajas">
             <td>Para ver La información del detallado, presione Click sobre el radicado..</td>
           </tr>
        </table>
	<table border="0" align="center">
	   <tr><td><br></td></tr>
	   <tr class="cajas">
	    <th>Item</th>
	        <th>Radicado</th>
	             <th>Nro_Factura</th>
	             <th>F_Radicado</th>
	             <th>Vlr_Pagado</th>
	       	             </tr>
	            <?
	            $i=1;
	             while($filas=mysql_fetch_array($resu)):
                     $totalpagar=number_format($filas["totalpagar"],0);
	           ?>
	             <tr class="cajas">
	             <th><?echo $i;?></th>
                     <td><a href="imprimirpagozona.php?codigo=<?echo $filas["radicado"];?>"><?echo $filas["radicado"];?></a></td>
	               <td><?echo $filas["nrofactura"];?></td>
	              <td><?echo $filas["fechap"];?></td>
	              <td><div align="right">$<?echo $totalpagar;?></div></td>
	               </tr>
	               <?
	               $i=$i + 1;
                       $suma=$suma+$filas["totalpagar"];
	             endwhile;
                     $suma=number_format($suma,0);
	             ?>
	             </table>
                     <div align="center"><b>Total_Pagado:</b>&nbsp;<?echo $suma;?></div>
	         <tr>

          </tr>
             <?
    endif;
endif;
?>
