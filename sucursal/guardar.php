<html>

<head>
  <title></title>
</head>
<body>
<?
if (empty($codsucursal)):
?>
  <script language="javascript">
    alert("Digite el código de la sucursal")
    history.back()
  </script>
<?
 elseif (empty($sucursal)):
?>
  <script language="javascript">
    alert("Digite el nombre de la sucursal")
    history.back()
  </script>
<?
   elseif (empty($dirsucursal)):
?>
     <script language="javascript">
       alert("Digite la dirección de la sucursal")
       history.back()
     </script>
     <?

     elseif (empty($telsucursal)):
?>
      <script language="javascript">
       alert("Digite el teléfono de la sucursal")
       history.back()
      </script>
      <?
        else:
        $sucursal = strtoupper($sucursal);
        $dirsucursal = strtoupper($dirsucursal);
        $email=strtoupper($email);
        $banco=strtoupper($banco);
        $banco1=strtoupper($banco1);
        $tipo1=strtoupper($tipo1);
        $tipo2=strtoupper($tipo2);
          include("../conexion.php");
          $consulta="update sucursal set sucursal='$sucursal',dirsucursal='$dirsucursal',telsucursal='$telsucursal',faxsucursal='$faxsucursal',
             codmuni='$codmunicipio',cuenta1='$cuenta1',tipocta1='$tipo1',banco='$banco',cuenta2='$cuenta2',tipocta2='$tipo2',banco1='$banco1',dian='$dian',rango='$rango',rango2='$rango2',codepart='$departamento',email='$email',estadosucu='$principal',codmaestro='$empresa' where codsucursal='$codsucursal'";
          $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
          $registro=mysql_affected_rows();
              echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se Grabó $registro registro para la sucursal: $sucursal\",\"pie\");";
                    echo "open (\"../menu.php?op=sucursal\",\"contenido\");";
                echo "</script>";
       endif;
       ?>
</body>
</html>
