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
else:
   $fechae=date("Y-m-d");
   $estado='ACTIVO';
   $nota=strtoupper($nota);
   include("../conexion.php");
      $consul="insert into entregaprovi(cedemple,nombres,vlrpagado,fechae,nota,carga)
      values('$cedula','$empleado','$valor','$fechae','$nota','$estado')";
      $res=mysql_query($consul)or die("Error al grabar la entrega");
      $regis=mysql_affected_rows();
     if ($regis==0):
          ?>
         <script language="javascript">
              alert("No se grabo la informacion en sistema ?")
              open("entrega.php","_self")
          </script>
         <?
      else:
         ?>
         <script language="javascript">
           alert("Se grabó con exito l registro ?")
            open("entrega.php","_self") 
         </script>
        <?
      endif;
 endif;
       ?>
</body>
</html>
