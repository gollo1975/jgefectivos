<?
        include("../conexion.php");
        $lista=$_POST["datos"];//diario va en mayuscula el post
        foreach ($lista as $dato)
        {
             if($TipoPago=='venta'):
                    $aux="select recibo.nrofactura,recibo.valor,recibo.codzona from recibo
                    where id='$dato'";
                    $reP=mysql_query($aux)or die("Error al buscar las prestaciones");
                    $filas_P=mysql_fetch_array($reP);
                    $Nrofactura=$filas_P["nrofactura"];
	            $Valor=$filas_P["valor"];
                    $CodZona=$filas_P["codzona"];
	            $auxP="select factura.nsaldo from factura
	                  where factura.nrofactura='$Nrofactura' and
                                factura.codzona='$CodZona'   ";
	           $resP=mysql_query($auxP)or die("Error al buscar facturas de venta");
	           $filas_S=mysql_fetch_array($resP);
	           $Saldo=$filas_S["nsaldo"]+$Valor;
                   $DaP='MODIFICADA';
	          /*codigo de actualizavcion*/
	          $conP="update factura set nsaldo='$Saldo',estado='$DaP' where factura.nrofactura='$Nrofactura' and factura.codzona='$CodZona'";
	          $resP=mysql_query($conP)or die("Error de actualizacion en la tabla Fcatura de Venta");
	          $regP=mysql_affected_rows();
               endif;
                 /*datoa a eliminart*/
                 $consulta="delete from recibo where id='$dato'";
                $resultado=mysql_query($consulta) or die ("Error a eliminar datos");
                $regP=mysql_affected_rows();
        }
        if ($regP==0):
?>
                <script language="javascript">
                        alert("Este Registro no se Eliminó de la base de datos.)")
                        history.back();
                </script>
<?
        else:
                header("location: CrearPagoRecibo.php?estado=$estado&nro=$codex&nit=$nit&TipoPago=$TipoPago");
        endif;
?>
