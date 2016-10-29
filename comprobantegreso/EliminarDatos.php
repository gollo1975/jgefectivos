<?
        include("../conexion.php");
        $lista=$_POST["datos"];//diario va en mayuscula el post
        foreach ($lista as $dato)
        {
             if($TipoPago=='prestacion' or $TipoPago=='compra' or $TipoPago=='vacacion'):
                    $aux="select comprobante.nrofactura,comprobante.valor,comprobante.nitprove from comprobante
                    where conse='$dato'";
                    $reP=mysql_query($aux)or die("Error al buscar las prestaciones");
                    $filas_P=mysql_fetch_array($reP);
              endif;
                 /*datoa a eliminart*/
                 $consulta="delete from comprobante where conse='$dato'";
                $resultado=mysql_query($consulta) or die ("Error a eliminar datos");
                $regP=mysql_affected_rows();
        }
        if($TipoPago=='prestacion'):
          $Nrofactura=$filas_P["nrofactura"];
          $conP="update prestacion set control='ACTIVA' where prestacion.nropresta='$Nrofactura'";
          $resP=mysql_query($conP)or die("Error de actualizacion en la tabla Prestaciones");
          $regP=mysql_affected_rows();
        else:
           if($TipoPago=='compra'):
	           $Nrofactura=$filas_P["nrofactura"];
	           $Valor=$filas_P["valor"];
	           $NitP=$filas_P["nitprove"];
	           $auxP="select pagar.saldo from pagar
	                  where nrofactura='$Nrofactura' and nitprove='$NitP'";
	           $resP=mysql_query($auxP)or die("Error al buscar facturas de compras");
	           $filas_S=mysql_fetch_array($resP);
	           $Saldo=$filas_S["saldo"]+$Valor;
	          /*codigo de actualizavcion*/
	          $conP="update pagar set saldo='$Saldo' where pagar.nrofactura='$Nrofactura' and pagar.nitprove='$NitP'";
	          $resP=mysql_query($conP)or die("Error de actualizacion en la tabla compras");
	          $regP=mysql_affected_rows();
            else:
               if($TipoPago=='vacacion'):
                  $Nrofactura=$filas_P["nrofactura"];
                  $conP="update vacacion set control='ACTIVA' where vacacion.codvaca='$Nrofactura'";
                  $resP=mysql_query($conP)or die("Error de actualizacion en la tabla Vacacion");
                  $regP=mysql_affected_rows();
               endif;
            endif;
        endif;
        if ($regP==0)
        {
?>
                <script language="javascript">
                        alert("Este Registro no se Eliminó de la base de datos.)")
                        history.back();
                </script>
<?
        }
        else
        {
                header("location: CrearPago.php?estado=$estado&nro=$codex&nit=$nit&TipoPago=$TipoPago&Usuario=$Usuario");
        }
?>
