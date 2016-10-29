<?
       include("../conexion.php");
       $con="update factura set subtotal='$subtotal' where nrofactura='$nro'";
       $resultado=mysql_query($con) or die("Error al actualizar el subtotal");
       if($confte=='NO'):
          $consulta="update factura set iva=(subtotal*porcentaje/100),rfte=0,rteiva=0,grantotal=(subtotal+iva),nsaldo=grantotal where nrofactura='$nro'";
          $resultado=mysql_query($consulta) or die("Error al Grabar la retencion en la fuente en cero");
       else:
          if($confte=='SI' and $conreteiva='SI'):
             $consulta="update factura set iva=(subtotal*porcentaje/100),rfte=round(subtotal*$vlrfte/100),rteiva=round(iva*$vlriva/100),grantotal=(subtotal+iva),nsaldo=grantotal where nrofactura='$nro'";
             $resultado=mysql_query($consulta) or die("Error al Grabar la retencion en la fuente y el reteiva");
          else:
             if($confte=='SI'):
                $consulta="update factura set iva=(subtotal*porcentaje/100),rfte=round(subtotal*$vlrfte/100),rteiva=0,grantotal=(subtotal+iva),nsaldo=grantotal where nrofactura='$nro'";
                $resultado=mysql_query($consulta) or die("Error al Grabar la retencion en la fuente");
             else:
             endif;
         endif;
       endif;

?>
