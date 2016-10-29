<html>

<head>
  <title>Grabando registros</title>
</head>
<body>
<?
if (empty($provedor)):
?>
  <script language="javascript">
    alert("Digite el provedor")
    history.back()
  </script>
<?
 elseif (empty($fechaini)):
?>
  <script language="javascript">
    alert("Digite la fecha de inicio de la factura ?")
    history.back()
  </script>
<?
   elseif (empty($fechaven)):
?>
     <script language="javascript">
       alert("Digite la fecha de vencimiento ?")
       history.back()
     </script>
     <?
   elseif (empty($subtotal)):
   ?>
     <script language="javascript">
       alert("Digite el subtotal  de la factura ?")
       history.back()
     </script>
     <?
   elseif (empty($totalpagar)):
?>
     <script language="javascript">
       alert("Digite el total a pagar de la factura ?")
       history.back()
     </script>
     <?
	 elseif (empty($estado)):
?>
     <script language="javascript">
       alert("Seleccione el estado de la factura ?")
       history.back()
     </script>
     <?
      else:
          include("../conexion.php");
          $nota=strtoupper("$nota");
          $consulta="update pagar set nrofactura='$nrofactura',nitprove='$provedor',fechaini='$fechaini',fechaven='$fechaven',subtotal='$subtotal',
             dcto='$dcto',valor='$totalbase',rfte='$rfte',baserfte='$baserfte',ivapagado='$ivapagado',total='$totalpagar',nota='$nota',saldo='$totalpagar',estado='$estado' where pagar.nrofactura='$nrofactura' and pagar.nitprove='$nit'";
          $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
          $registro=mysql_affected_rows();
           echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizó $registro registro de la factura Nro: $nrofactura\",\"pie\");";
                    echo "open (\"../menu.php?op=pagofactura\",\"contenido\");";
                echo "</script>";
       endif;
       ?>
</body>
</html>
