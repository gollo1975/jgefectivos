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
   $consulta = "select count(*) from novedad";
   $result = mysql_query ($consulta);
   $sw = mysql_fetch_row($result);
   $estado="ACTIVO";
   if ($sw[0] > 0):
      $consulta1 = "select max(cast(consecutivo as unsigned)) + 1 from novedad";
      $result1 = mysql_query ($consulta1) or die ("Fallo en la consulta");
      $codc = mysql_fetch_row($result1);
      $codca= str_pad($codc[0], 4, "0", STR_PAD_LEFT);
      $consul="insert into novedad(consecutivo,cedemple,novedad,fecha,estado)
      values('$codca','$cedemple','$novedad','$fecha','$estado')";
      $res=mysql_query($consul)or die("Inserccion incorrecta");
      $res=mysql_affected_rows();
   else:
      $codca="0001";
      $consul="insert into novedad(consecutivo,cedemple,novedad,fecha,estado)
      values('$codca','$cedemple','$novedad','$fecha','$estado')";
      $res=mysql_query($consul)or die("Inserccion incorrecta");
       $res=mysql_affected_rows();
   endif;
      if ($res!=0):
         ?>
         <script language="javascript">
           alert("Los registro fueron grabados con éxito ?")
          open("agregar.php","_self");
         </script>
        <?
      endif;
 endif;
       ?>
</body>
</html>
