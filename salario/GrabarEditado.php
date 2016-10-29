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
   include("../conexion.php");
    $consulta="update parametropension set codsala='$Codigo',estado='$Estado' where codigo='$CodSala'";
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registros=mysql_affected_rows();
 echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $resultado registro del Empleado: $nombres\",\"pie\");";
                   echo "open (\"ParametroPension.php\",\"_self\");";
                echo "</script>";
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
