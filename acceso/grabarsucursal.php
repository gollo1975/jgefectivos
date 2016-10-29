<html>

<head>
  <title></title>
</head>
<body>
<?
if (empty($actual)):
?>
  <script language="javascript">
    alert("El campo Clave actual no puede estar vacio ?")
    history.back()
  </script>
<?
   elseif (empty($nueva)):
?>
     <script language="javascript">
       alert("Digite la clave nueva ?")
       history.back()
     </script>
     <?
      elseif (empty($confirmar)):
?>
     <script language="javascript">
       alert("El campo Cofirmar clave no puede estar vacio ?")
       history.back()
     </script>
     <?
      elseif ($nueva!=$confirmar):
?>
     <script language="javascript">
       alert("Error al Confirmar la clave Nueva ?")
       history.back()
     </script>
     <?
      else:
         $nueva=strtoupper($nueva);
          include("../conexion.php");
          $cons="select acceso.clave from acceso where clave='$actual'";
          $re=mysql_query($cons)or die ("Error de consulta");
          $reg=mysql_num_rows($re);
          if ($reg!=0):
             $consulta="update acceso set clave='$nueva' where usuario='$usuario'";
             $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
             $registros=mysql_affected_rows();
             echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registros registros para el usuario: $usuario\",\"pie\");";
                   // echo "open (\"../menu.php?op=curso\",\"contenido\");";
                     echo ("open (\"cambiar.php\",\"_self\");");
                echo "</script>";
          else:
          ?>
             <script language="javascript">
              alert("La clave actual no Coincide con la digitada ?")
              history.back()
             </script>
             <?
          endif;
      endif;
       ?>
</body>
</html>
