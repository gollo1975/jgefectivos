<html>
<head>
<title>Grabando registros</title>
</head>
<body>
<?
if(empty($concepto)):
?>
  <script language="javascript">
    alert("Digite el tipo de contrato")
    history.back()
  </script>
  <?
else:
  include("../conexion.php");
  $consulta="update tipocontrato set concepto='$concepto' where tipo='$tipo'";
  $resultado=mysql_query($consulta)or die("consulta incorrecta");
  $registro=mysql_affected_rows();
  if ($registro==0):
  ?>
    <script language="javascript">
      alert("No se actualizo el Registro ?")
      history.go(-2)
    </script>
  <?
  else:
   ?>
    <script language="javascript">
      alert("E lregistro se actualizó con éxito ?")
      history.go(-2)
    </script>
    <?
  endif;
endif;
?>
</body>
</html>
