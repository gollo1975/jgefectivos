<html>

<head>
  <title>Grabando registros</title>
</head>
<body>
<?
if (empty($fechaini)){
?>
  <script language="javascript">
    alert("Digite la fecha de inicio de la factura ?")
    history.back()
  </script>
<?
}elseif (empty($fechaven)){
?>
     <script language="javascript">
       alert("Digite la fecha de vencimiento ?")
       history.back()
     </script>
     <?
}elseif (empty($subtotal)){
   ?>
     <script language="javascript">
       alert("Digite el subtotal  de la factura ?")
       history.back()
     </script>
     <?
}elseif (empty($totalpagar)){
   ?>
     <script language="javascript">
       alert("Digite el total a pagar de la factura ?")
       history.back()
     </script>
     <?
}elseif (empty($nota)){
   ?>
     <script language="javascript">
       alert("Digite la desccripción/Observación de la factura.!")
       history.back()
     </script>
     <?
}else{
          include("../conexion.php");
          $nota=strtoupper("$nota");
          $consulta="update pagar set nrofactura='$nrofactura',nitprove='$provedor',fechaini='$fechaini',fechaven='$fechaven',subtotal='$subtotal',
             porcre='$porcre',basecre='$basecre',dcto='$dcto',valor='$totalbase',rfte='$rfte',baserfte='$baserfte',ivapagado='$ivapagado',total='$totalpagar',nota='$nota',saldo='$totalpagar',estado='$estado',tipofactura='$TipoFactura',estadofactura='$EstadoF' where pagar.nrofactura='$nrofactura' and pagar.nitprove='$nit'";
          $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
          $registro=mysql_affected_rows();
           echo "<script language=\"javascript\">";
                 echo "open (\"../pie.php?msg=Se actualizó $registro registros para el Nit: $provedor\",\"pie\");";
	   echo "open (\"modificar.php\",\"_self\");";
            echo "</script>";
}
       ?>
</body>
</html>
