<html>

<head>
  <title></title>
</head>
<body>
<?
if (empty($diaspagar)):

?>

  <script language="javascript">
    alert("Digite el Nro de dias a paga de la incapacidad")
    history.back()
  </script>
<?
 elseif (empty($porcentaje)):
?>
  <script language="javascript">
    alert("Digite el porcentaje de Pago ?")
    history.back()
  </script>
<?
   elseif (empty($ibc)):
?>
     <script language="javascript">
       alert("Digite el ibc para pago")
       history.back()
     </script>
     <?

     elseif (empty($pagado)):
?>
      <script language="javascript">
       alert("Digite el valor a pagar")
       history.back()
      </script>
      <?
        else:
        $fechap=date("Y-m-d");
        $nota=strtoupper($nota);
        $cambio="SI";
          include("../conexion.php");
          $consulta = "select count(*) from pagado";
            $result = mysql_query ($consulta);
            $sw = mysql_fetch_row($result);
            if ($sw[0]>0):
              $consult1 = "select max(cast(nropago as unsigned)) + 1  from pagado";
              $result1 = mysql_query ($consult1);
              $codec = mysql_fetch_row($result1);
              $nropago = str_pad($codec[0], 4,"0", STR_PAD_LEFT);
            else:
              $nropago="0001";
            endif;
              $consulta1="insert into pagado(nropago,nroinca,cedemple,nombre,fechai,fechat,fechap,concepto,dias,diapagar,porcentaje,ibc,valor,nota)
              values('$nropago','$numero','$cedula','$nombre','$fechai','$fechat','$fechap','$concepto','$dia','$diaspagar','$porcentaje','$ibc','$pagado','$nota')";
              $resultado=mysql_query($consulta1)or die("Inserccion incorrecta ");
              $registro=mysql_affected_rows();
              $cons="update incapacidad set pagada='$cambio' where incapacidad.nroinca='$numero'";
               $resulta=mysql_query($cons)or die("Error de Inserccion");
              $reg=mysql_affected_rows();
              if($reg!=0):
                ?>
                 <script language="javascript">
                   alert("La Tabla Incapacidad se actualizó con Exito ?")
                   </script>
                <?
               endif;
                  echo "<script language=\"javascript\">";
                        echo "open (\"../pie.php?msg=Se Grabo $registro registro de la incapacidad Nro: $numero\",\"pie\");";
                        echo ("open (\"pagar.php\",\"_self\");");
                    echo "</script>";

   endif;
       ?>
</body>
</html>
