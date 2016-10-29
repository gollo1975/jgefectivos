<html>

<head>
  <title></title>
</head>
<body>
<?
  if (empty($concepto)):
?>
    <script language="javascript">
      alert("Digite el diagnostico del código ?")
      history.back()
    </script>
<?
  else:
    include("../conexion.php");
    $concepto=strtoupper($concepto);
    $concepto=strtoupper($concepto);
    $consulta="update control set concepto='$concepto' where control.codigo='$codigo'";
    $resultado=mysql_query($consulta)or die ("error en la inserccion de datos");
    $registro=mysql_affected_rows();
       echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizó $registro registros del código Nro :$codigo\",\"pie\");";
                   echo "open (\"modificargrupo.php\",\"_self\");";
                echo "</script>";
 endif;
?>
</body>
</html>
