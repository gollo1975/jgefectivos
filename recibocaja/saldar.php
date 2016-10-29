<?
$validador=strtoupper($validador);
        include("../conexion.php");
        $TotalSaldo=($saldo-$valor);
        $con="update factura set estado='$validador',nsaldo='$TotalSaldo' where factura.nrofactura='$nrofactura'";
        $res=mysql_query($con)or die("Error de Modificacion $con");
        $registro=mysql_affected_rows();
        if ($registro!=0):
          ?>
          <script language="javascript">
            alert("La Factura se saldo con Exito en la Tabla ?")
             open("actualizarfactura.php","_self")
          </script>
          <?
        else:
        ?>
          <script language="javascript">
            alert("Error de Actulización en la Tabla ?")
            open("actualizarfactura.php","_self")
          </script>
          <?
        endif;

