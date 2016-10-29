<html>
<head>
<title>Grabado registros</title>
</head>
<body>
<?
if (empty($abono)):
?>
  <script language="javascript">
    alert("Digite el abono del empleado ")
    history.back()
  </script>
<?
elseif($abono>$nsaldo):
?>
  <script language="javascript">
    alert("El abono es mayor que el Saldo anterior? ")
    history.back()
  </script>
<?
else:
   include("../conexion.php");
    $calculo=$nsaldo-$abono;
    $nota=strtoupper($nota);
   $consulta = "select count(*) from debitomercado";
   $result = mysql_query ($consulta);
   $sw = mysql_fetch_row($result);
   if ($sw[0] > 0):
      $consulta1 = "select max(cast(numero as unsigned)) + 1 from debitomercado";
      $result1 = mysql_query ($consulta1) or die ("Fallo en la consulta");
      $codc = mysql_fetch_row($result1);
      $codca= str_pad($codc[0], 5, "0", STR_PAD_LEFT);

   else:
      $codca="00001";
   endif;
      $consul="insert into debitomercado(numero,cedemple,codmerca,nsaldo,fechabono,abono,nota)
      values('$codca','$cedemple','$codmerca','$nsaldo','$fechabono','$abono','$nota')";
      $res=mysql_query($consul)or die("Inserccion incorrecta");
      $actualiza="update mercado set nsaldo='$calculo' where mercado.codmerca='$codmerca'";
      $resulta=mysql_query($actualiza) or die("Fallo la inserccion");
      $regis=mysql_affected_rows();
      if ($regis==0):
          ?>
         <script language="javascript">
              alert("La tabla  Mercado No, se actualizo  en el B.D ?")
              open("agregar.php","_self")
          </script>
         <?
      else:
         ?>
         <script language="javascript">
           alert("La tabla  Mercado, se actualizó con éxito en la B.D  ?")
            open("agregar.php","_self") 
         </script>
        <?
      endif;
 endif;
       ?>
</body>
</html>
