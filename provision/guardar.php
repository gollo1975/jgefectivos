<html>
<head>
<title>Grabado registros</title>
</head>
<body>
<?
if (empty($valor)):
?>
  <script language="javascript">
    alert("Digite valor de provisión ")
    history.back()
  </script>
<?
elseif (empty($periodo)):
?>
  <script language="javascript">
    alert("Seleccione el periodo de nomina ")
    history.back()
  </script>
<?
else:
   $fechap=date("Y-m-d");
   $estado='ACTIVO';
   $nota=strtoupper($nota);
   include("../conexion.php");
      $consul="insert into provision(cedemple,nombre,valor,periodo,fechap,estado,nota)
      values('$cedula','$empleado','$valor','$periodo','$fechap','$estado','$nota')";
      $res=mysql_query($consul)or die("Error al grabar");
      $regis=mysql_affected_rows();
     if ($regis==0):
          ?>
         <script language="javascript">
              alert("No se grabo la informacion en sistema ?")
              open("agregar.php","_self")
          </script>
         <?
      else:
         ?>
         <script language="javascript">
           alert("Se grabó con exito l registro ?")
            open("agregar.php","_self") 
         </script>
        <?
      endif;
 endif;
       ?>
</body>
</html>
