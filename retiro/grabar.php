<input type="hidden" name="codigo" value="<? echo $codigo;?>">
<?
if (empty($dia)):
  ?>
  <script language="javascript">
    alert("El Campo DIAS, No puede estar vacío ?")
    history.back()
    </script>
  <?
else:
    include("../conexion.php");
    $consulta = "select count(*) from retiro";
    $result = mysql_query ($consulta);
    $sw = mysql_fetch_row($result);
    if ($sw[0]>0):
      $consult1 = "select max(cast(nroretiro as unsigned)) + 1  from retiro";
      $result1 = mysql_query ($consult1);
      $codec = mysql_fetch_row($result1);
      $nroretiro = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
    else:
      $nroretiro="00001";
    endif;
    $consulta="insert into retiro(nroretiro,cedemple,nombres,zona,fecha,fechare,dias)
    values('$nroretiro','$cedula','$nombre','$zona','$fecha','$fechare','$dia')";
    $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
    $con="update contrato set fechater='$fechare' where contrato.codemple='$codigo'and contrato.fechater='0000-00-00'";
         $resultad=mysql_query($con)or die("Inserccion incorrecta dos");
         $reg=mysql_affected_rows();
         if($reg==0):
           ?>
            <script language="javascript">
                alert("El contrato de este empleado no se cerro ?")
                history.back()
            </script>
           <?
         else:
         ?>
            <script language="javascript">
                alert("El contrato se Cerro con Exito en la Tabla  ?")
            </script>
           <?
            $registro=mysql_affected_rows();
            echo "<script language=\"javascript\">";
            echo "open (\"../pie.php?msg=Se Grabó $registro registro del Empleado: $nombre\",\"pie\");";
            //echo "open (\"../menu.php?op=generar\",\"contenido\");";
             echo "open(\"agregar.php\",\"_self\");";
            echo "</script>";
         endif;

endif;
?>

