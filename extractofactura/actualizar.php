<?
        $consulta="update extracto set subtotal='$subtotal' where nrofactura='$nrofactura'";
        $resultado=mysql_query($consulta) or die("actualizacion 1 incorrecta");
?>    
