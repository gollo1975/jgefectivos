<html>

<head>
  <title></title>
</head>
<body>
<input type="hidden" name="codigo" value="<?echo $codigo;?>">
<?
if (empty($nroinca)):

?>

  <script language="javascript">
    alert("Digite el Nro de la incapacidad")
    history.back()
  </script>
<?
 elseif (empty($fechaini)):
?>
  <script language="javascript">
    alert("Digite la fecha de inicio ?")
    history.back()
  </script>
<?
   elseif (empty($fechater)):
?>
     <script language="javascript">
       alert("Digite la fecha final")
       history.back()
     </script>
     <?

     elseif (empty($fechapro)):
?>
      <script language="javascript">
       alert("Digite la fecha de proceso")
       history.back()
      </script>
      <?
       elseif (empty($motivo)):
?>
      <script language="javascript">
       alert("Digite el motivo de la incapacidad")
       history.back()
      </script>
      <?
        else:
        $estado=strtoupper($estado);
         $motivo=strtoupper($motivo);
          include("../conexion.php");
          $consulta="update incapacidad set fechaini='$fechaini',fechater='$fechater',tipoinca='$tipo',dias='$dias',codeps='$eps',
            cedemple='$empleado',estado='$estado',fechapro='$fechapro',motivo='$motivo' where nroinca='$nroinca'";
          $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
          $registro=mysql_affected_rows();
           echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registro registros dela incapacidad Nro: $nroinca\",\"pie\");";
                    echo "open (\"../menudepartamento.php?op=incapacidades&codigo=$codigo\",\"contenido\");";
                echo "</script>";
       endif;
       ?>
</body>
</html>
