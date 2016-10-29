<html>

<head>
  <title></title>
</head>
<body>
  <?
    if(empty($nomprove))
     {
     ?>
       <script language="javascript">
         alert("Debe de digitar el Nombre del Proveedor")
         history.back()
       </script>
    <?
    }
     elseif(empty($dirprove))
     {
     ?>
       <script language="javascript">
         alert("Debe de digitar la Direccion del proveedor")
         history.back()
       </script>
     <?
     }
     elseif(empty($telprove))
     {
     ?>
       <script language="javascript">
         alert("Debe de digitar Telefono")
         history.back()
       </script>
     <?
     }
     elseif(empty($municipio))
     {
     ?>
       <script language="javascript">
         alert("Despliegar la lista para seleccionar un municipio ?")
         history.back()
       </script>
     <?
     }
     elseif(empty($codsucursal))
     {
     ?>
       <script language="javascript">
         alert("Despliegar la lista para seleccionar una sucursal ")
         history.back()
       </script>
     <?
     }
        else
        {
          include("../conexion.php");
           $nomprove=strtoupper($nomprove);
           $dirprove=strtoupper($dirprove);
           $email=strtoupper($email);
          $consulta="update provedor set dvprove='$dvprove',nomprove='$nomprove',dirprove='$dirprove',telprove='$telprove',
             faxprove='$faxprove',codmuni='$municipio',cuenta='$cuenta',tipoc='$tipo',banco='$banco',fecha='$fecha',email='$email',grancon='$gran',aretenedor='$agente',regimen='$regimen',codigocre='$actividad',estado='$estado',alianza='$alianza',alianzaexamen='$AlianzaExamen',codsucursal='$codsucursal' where nitprove='$nitprove'";
          $resultad=mysql_query($consulta)or die("Error al modificar el registro ?");
          $registro=mysql_affected_rows();
         echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizó $registro registro del Proveedor: $nomprove\",\"pie\");";
                    echo "open (\"../menu.php?op=provedor\",\"contenido\");";
                echo "</script>";
         }
       ?>
</body>
</html>
