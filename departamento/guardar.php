<html>

<head>
  <title></title>
</head>
<body>
<?
  if (empty($departamento)):
?>
    <script language="javascript">
      alert("Digite el nombre del departamento")
      history.back()
    </script>
<?
  else:
    include("../conexion.php");
    $departamento=strtoupper("$departamento");
    $consulta="update departamento set departamento='$departamento' where codepart='$codepart'";
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_affected_rows();
        echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se Modificó $registro registro para el departamento: $departamento\",\"pie\");";
                    echo "open (\"../menu.php?op=depto\",\"contenido\");";
                echo "</script>";
   endif;
?>
</body>
</html>
