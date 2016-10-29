<?
if (empty($cedemple)):
?>
  <script language="javascript">
    alert("Digite el documento del empleado")
    history.back()
  </script>
<?
elseif (empty($valor)):
?>
     <script language="javascript">
       alert("Digite el valor del aporte social ?")
       history.back()
     </script>
     <?
    else:
       $fecha1=$a1 . "/" . $m1 . "/" . $d1;
       include("../conexion.php");
       $consulta = "select count(*) from consignacion";
       $result = mysql_query ($consulta);
       $sw = mysql_fetch_row($result);
       if ($sw[0] > 0)
       {
          $consulta1 = "select max(cast(nrocon as unsigned)) + 1 from consignacion";
          $result1 = mysql_query ($consulta1) or die ("Fallo en la consulta");
          $codc = mysql_fetch_row($result1);
          $codca= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
          $consul="insert into consignacion(nrocon,cedemple,codbanco,fechapro,fechapago,valor)
          values('$codca','$cedemple','$codbanco','$fechapro','$fecha1','$valor')";
          $res=mysql_query($consul)or die("Inserccion incorrecta uno");
         }
       else
       {
          $codca="00001";
           $consul="insert into consignacion(nrocon,cedemple,codbanco,fechapro,fechapago,valor)
          values('$codca','$cedemple','$codbanco','$fechapro','$fecha1','$valor')";
          $res=mysql_query($consul)or die("Inserccion incorrecta");
        }
       echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $res registros en Aportes sociales\",\"pie\");";
                    echo "open (\"agregar.php\",\"contenido\");";
                echo "</script>";

endif;
 ?>

