<html>
<head>
<title>Grabando Registros</title>
</head>
<body>
<?
if (empty($nota)):
?>
  <script language="javascript">
    alert("Digite la observación al contrato.!")
    history.back()
  </script>
<?
else:
    $fechaM=date("Y-m-d");
    include("../conexion.php");
    $consulta="update modelocontrato set concepto='$nota',fecham='$fechaM' where codigo='$CodC'";
    $resultado=mysql_query($consulta)or die("Error al actualizar contratos");
    $registro=mysql_affected_rows();?>
    <script language="javascript">
       alert("Se Actualizó el registros con exito.!")
       open ("ActualizarC.php","_self")
     </script><?
endif;
       ?>
</body>
</html>
