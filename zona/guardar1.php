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
     elseif(empty($vendedor)):
     ?>
       <script language="javascript">
         alert("Debe seleccionar el vendedor")
         history.back()
       </script>
     <?
      elseif(empty($retefuente)):
     ?>
       <script language="javascript">
         alert("El campo refefuente no puede ser vacio")
         history.back()
       </script>
     <?
        else:
         include("../conexion.php");
          $fechaini=$a."/".$m."/".$d;
          $zona=strtoupper($zona);
          $dirzona=strtoupper($dirzona);
          $emailzona=strtoupper($emailzona);
          $nomina=strtoupper($nomina);
           $consulta="update zona set zona='$zona',telzona='$telzona',faxzona='$faxzona',dirzona='$dirzona',
             codmuni='$codigo',emailzona='$emailzona',codsucursal='$sucursal', codigo_sso_sucursal_fk='$ssosucursal',nitzona='$nitzona',dvzona='$dvzona',fechaini='$fechaini',nomina='$nomina'
             ,caja='$caja',sena='$sena',icbf='$icbf',prestacion='$prestacion',vacacion='$vacacion',admon='$admon',iva='$iva',estado='$estado',factura='$factura',datos='$datos',cedulaven='$vendedor',tiponegociacion='$TipoNegociacion',retefuente='$retefuente',vlrfte='$vlrfte',reteiva='$reteiva',vlriva='$vlriva',resolucion='$resolucion',cree='$cree',porcre='$porcre',tipoempresa='$ppal',reteica='$ReteIca',dcto='$Dcto',pordcto='$pordcto' where codzona='$codzona'";

          $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
          $registro=mysql_affected_rows();
           echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registro registros para la Zona: $zona\",\"pie\");";
                    echo "open (\"listadomodificar.php\",\"_self\");";
                echo "</script>";
endif;

       ?>
</body>
</html>
