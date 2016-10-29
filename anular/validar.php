<?
if($valor='' ):
?>
<script language="javascript">
    alert("El campor Valor no puede ser vacio")
    history.back()
</script>
<?
else:
     $validador=strtoupper($validador);
        include("../conexion.php");
        $con="update factura set estado='$validador',nsaldo='$valor' where factura.nrofactura='$nrofactura'";
        $res=mysql_query($con)or die("Error de Modificacion $con");
        $registro=mysql_affected_rows();
        if ($registro!=0):
          ?>
          <script language="javascript">
            alert("La Factura se saldo con Exito en la Tabla ?")
            open("anular.php","_self")
          </script>
          <?
        else:
        endif;
endif;
