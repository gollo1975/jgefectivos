<?
if($valor != 0 ):
?>
<script language="javascript">
    alert("El campor Valor no puede ser vacio")
    history.back()
</script>
<?
else:
     $validador=strtoupper($validador);
        include("../conexion.php");
        $con="update cuenta set estado='$validador',nsaldo='$valor' where cuenta.nrocuenta='$cuenta'";
        $res=mysql_query($con)or die("Error de Modificacion $con");
        $registro=mysql_affected_rows();
        if ($registro!=0):
          ?>
          <script language="javascript">
            alert("La cuenta de cobro se anulo con Exito en la Tabla ?")
            open("anular1.php","_self")
          </script>
          <?
        else:
        endif;
endif;
