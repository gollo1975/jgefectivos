<?
 session_start();
?>
<html>

<head>
  <title></title>
</head>
<body>
<?
 if(session_is_registered("xsession")):
  if (empty($bancos)):
?>
<script language="javascript">
  alert("Digite el nombre del banco")
  history.back()
</script>
<?
  elseif(empty($dirbanco)):
?>
<script language="javascript">
  alert("Digite la dirección del banco")
  history.back()
</script>
<?
 elseif(empty($telbanco)):
?>
<script language="javascript">
  alert("Digite el teléfono del banco")
  history.back()
</script>
<?
 elseif(empty($municipio)):
?>
<script language="javascript">
  alert("Digite el municipio del banco")
  history.back()
</script>
<?
  else:
    $bancos=strtoupper($bancos);
    $dirbanco=strtoupper($dirbanco);
    $municipio=strtoupper($municipio);
    include("../conexion.php");
    $consulta="update banco set bancos='$bancos',dirbanco='$dirbanco',telbanco='$telbanco',
    municipio='$municipio',nomina='$Convenio' where codbanco='$codbanco'";
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registros=mysql_affected_rows();
 echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $resultado registro del banco: $bancos\",\"pie\");";
                   echo "open (\"../menu.php?op=banco\",\"contenido\");";
                echo "</script>";
 endif;
 else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
?>
</body>

</html>
