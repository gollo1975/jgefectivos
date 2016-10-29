<html>

<head>
  <title></title>
</head>
<body>
<input type="hidden" name="codigo" value="<? echo $codigo;?>">
<?
$nota=strtoupper($nota);
$cambio="CANCELADA";
include("../conexion.php");
$consulta = "select descarga.documento from descarga where descarga.documento='$documento'";
$result = mysql_query ($consulta);
$sw = mysql_num_rows($result);
if ($sw==0):
    $consulta1="insert into descarga(nroinca,cedemple,nombres,fechai,fechat,concepto,dias,documento,fechap,diaspagado,valor,nota)
     values('$numero','$cedula','$nombre','$fechai','$fechat','$concepto','$dia','$documento','$fechap','$diaspagado','$valor','$nota')";
     $resultado=mysql_query($consulta1)or die("Inserccion incorrecta ");
      $cons="update incapacidad set estado='$cambio' where incapacidad.nroinca='$numero'";
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
     echo "open (\"../menudepartamento.php?op=incapacidades&codigo=$codigo\",\"contenido\");";
     echo "</script>";
else:
   ?>
   <script language="javascript">
     alert("Este documento De Pago, ya esta registrado en Sistema ?")
     history.back()
   </script>
   <?
endif;
       ?>
</body>
</html>
