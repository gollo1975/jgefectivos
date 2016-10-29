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
    $Valor='ACTIVO';
    $consulta = "select count(*) from retiroprovision";
    $result = mysql_query ($consulta);
    $sw = mysql_fetch_row($result);
    if ($sw[0]>0):
      $consult1 = "select max(cast(codretiro as unsigned)) + 1  from retiroprovision";
      $result1 = mysql_query ($consult1);
      $codec = mysql_fetch_row($result1);
      $nroretiro = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
    else:
      $nroretiro="000001";
    endif;
    $consulta="insert into retiroprovision(codretiro,cedemple,nombres,codzona,zona,fecha,fechare,dias,diasperiodo,estado)
    values('$nroretiro','$cedula','$nombre','$CodZona','$zona','$fecha','$fechare','$dia','$diaPago','$Valor')";
    $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
    $reg=mysql_affected_rows();
    if($reg!=0):
         ?>
            <script language="javascript">
                alert("El registros se grabo con Exito en la base de datos  ?")
            </script>
           <?
            echo "<script language=\"javascript\">";
            echo "open (\"../pie.php?msg=Se Grabó $registro registro del Empleado: $nombre\",\"pie\");";
            //echo "open (\"../menu.php?op=generar\",\"contenido\");";
             echo "open(\"retiroprovisional.php\",\"_self\");";
            echo "</script>";
         endif;

endif;
?>

