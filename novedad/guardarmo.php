<html>
<head>
<title>Grabando registros</title>
</head>
<body>
<?
if (empty($novedad)):
?>
  <script language="javascript">
    alert("Digite la novedad del empleado ")
    history.back()
  </script>
<?
else:
   include("../conexion.php");
   $estado=strtoupper($estado);
   $consul="update novedad set novedad='$novedad',estado='$estado' where consecutivo='$consecutivo'";
      $res=mysql_query($consul)or die("Inserccion incorrecta");
      $res=mysql_affected_rows();
      ?>
      <script language="javascript">
           alert("Los registro fueron grabados con éxito ?")
          open("modificar.php","_self");
         </script>
        <?
  endif;
       ?>
</body>
</html>
