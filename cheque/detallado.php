<?
 session_start();
?>
<html>
<head>
<title>Listado de Facturas</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>

<?
if(session_is_registered("xsession") or session_is_registered("validar")):
     include("../conexion.php");
     $consulta="select provedor.nomprove from provedor where nitprove='$nitprove'";
     $resultado=mysql_query($consulta)or die("Consulta incorrecta");
     $registros=mysql_num_rows($resultado);
     if($registros!=0):
       ?>
            <table border="0" align="center">
                <?
            while($filas=mysql_fetch_array($resultado)):
             ?>
             <tr>
              <td><b>Proveedor:&nbsp;<?echo $filas["nomprove"];?></td>
               </tr>
              <?
            endwhile;
            ?>
            </table>
            <?
            include("../conexion.php");
             $consu="select pagar.* from provedor,pagar where
                provedor.nitprove=pagar.nitprove and
                provedor.nitprove='$nitprove' order by pagar.fechaven DESC";
             $resu=mysql_query($consu)or die("Consulta incorrecta");
             $registros=mysql_num_rows($resu);
             ?>
              <center><h4>Listado de Facturas</h4></center>
              <table border="0" align="center">
              <tr  class="cajas">
			      <th>#</th>
                  <th>Nro_Factura</th>
                  <th>F_Proceso.</th>
				   <th>F_Inicio</th>
                  <th>F_Vencimiento</th>
                  <th>Dcto</th>
                  <th>%Rfte</th>
                  <th>Vlr_Rfte</th>
                  <th>Iva</th>
                  <th>Total</th>
                  <th>Saldo</th>
              </tr>
              <? $f=1;
               while($filas_s=mysql_fetch_array($resu)):
                $baserfte=number_format($filas_s["baserfte"],0);
                $ivapagado=number_format($filas_s["ivapagado"],0);
                $total=number_format($filas_s["total"],0);
                $saldo=number_format($filas_s["saldo"],0);
                ?>

              <tr  class="cajas">
			     <th><?echo $f;?></th>
                 <td><div align="center"><?echo $filas_s["nrofactura"];?></div></td>
				  <td><div align="center"><?echo $filas_s["fechagra"];?></div></td>
                 <td><div align="center"><?echo $filas_s["fechaini"];?></div></td>
				 <?if ($saldo > 0){?>
                    <td><div align="center"><font color="red"><?echo $filas_s["fechaven"];?></font></div></td>
				 <?}else{?>
					<td><div align="center"><?echo $filas_s["fechaven"];?></div></td> 
				 <?}?>	
                
                  <td><div align="center"><?echo $filas_s["dcto"];?></div></td>
                  <td><div align="center"><?echo $filas_s["rfte"];?></div></td>
                   <td><div align="right"><?echo $baserfte?>&nbsp;</td>
                    <td><div align="right"><?echo $ivapagado;?>&nbsp;</div></td>
                  <td><div align="right"><?echo $total;?>&nbsp;</div></td>
                  <td><div align="right"><?echo $saldo;?>&nbsp;</div></td>
               </tr>
              <?
              $f=$f+1;
			  $totalP=$totalP+$filas_s["total"];
			  $saldoP=$saldoP+$filas_s["saldo"];
            endwhile;
			$totalP=number_format($totalP,0);
            $saldoP=number_format($saldoP,0);
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
            <center><td class="cajas"><b>Total_Compra:</b>&nbsp;$&nbsp;<?echo $totalP?>&nbsp;&nbsp;<b>Total_Cartera:</b>&nbsp;$&nbsp;<?echo $saldoP?></td></center>

            <?
     endif;
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
 </table>

</body>
</html>
