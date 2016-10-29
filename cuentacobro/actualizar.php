<?
        $consulta="update cuenta set subtotal='$subtotal' where nit='$nit'";
        $resultado=mysql_query($consulta) or die("actualizacion 1 incorrecta");
?>    
