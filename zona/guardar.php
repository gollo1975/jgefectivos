<html>

<head>
  <title></title>
</head>
<body>
<?
if(empty($zona)):
     ?>
       <script language="javascript">
         alert("Debe de digitar el nombre de la zona")
         history.back()
       </script>
    <?
     elseif(empty($telzona)):
     ?>
       <script language="javascript">
         alert("Debe de digitar el telefono de la zona")
         history.back()
       </script>
    <?
     elseif(empty($dirzona)):
     ?>
       <script language="javascript">
         alert("Debe de digitar la Direccion de la zona")
         history.back()
       </script>
     <?
     elseif(empty($nitzona)):
     ?>
       <script language="javascript">
         alert("Debe de digitar nit de la zona")
         history.back()
       </script>
     <?
          elseif(empty($nomina)):
     ?>
       <script language="javascript">
         alert("Debe de digitar nomina de la zona")
         history.back()
       </script>
     <?
        else:
          include("../conexion.php");
          $fechaini=$a."/".$m."/".$d;
          $zona=strtoupper($zona);
          $dirzona=strtoupper($dirzona);
          $barzona=strtoupper($barzona);
          $emailzona=strtoupper($emailzona);
          $nomina=strtoupper($nomina);
           $consulta="update zona set zona='$zona',telzona='$telzona',faxzona='$faxzona',dirzona='$dirzona',
             barzona='$barzona',emailzona='$emailzona',codsucursal='$departamento',nitzona='$nitzona',dvzona='$dvzona',fechaini='$fechaini',nomina='$nomina',
             seguridad='$seguridad',caja='$caja',sena='$sena',icbf='$icbf',prestacion='$prestacion',admon='$admon',iva='$iva',tipofactura='$facturacion',estado='$estado',factura='$factura',genere='$comision' where codzona='$codzona'";
          $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
          $registro=mysql_affected_rows();
           echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registro registros para la Zona: $zona\",\"pie\");";
                    echo "open (\"../menu.php?op=zona\",\"contenido\");";
                echo "</script>";
       endif;
       ?>
</body>
</html>
