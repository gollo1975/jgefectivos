<script language="javascript">
            function imprimir(numero)// para declara funcion
             {
              pagina='imprimirpresta.php?nropresta=' + numero
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
               }
</script>
 <?
  if (empty($dias)):
  ?>
    <script language="javascript">
      alert("El campo Dias No puede estar Vacío..")
      history.back()
    </script>
  <?
  elseif (empty($pagar)):
  ?>
    <script language="javascript">
      alert("El campo Total Pagar No puede estar Vacío..")
      history.back()
    </script>
  <?
  else:
     include("../conexion.php");
   $nota=strtoupper($nota);
   $control='ACTIVA';
   $nombre=strtoupper($nombre);
   $consulta = "select count(*) from prestacion";
   $result = mysql_query ($consulta);
   $sw = mysql_fetch_row($result);
    if ($sw[0]>0):
     $consulta = "select max(cast(nropresta as unsigned)) + 1  from prestacion";
     $result = mysql_query ($consulta);
     $codec = mysql_fetch_row($result);
     $codcesa = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
     else:
       $codcesa="000001";
     endif;
     $consulta="insert into prestacion(nropresta,cedemple,nombres,fechapro,fechaini,fechacor,ibc,dias,auxilio,prestamo,vestuario,otros,comfenalco,total,cesantia,interes,prima,vacacion,nota,control)
       value('$codcesa','$cedula','$nombre','$fechap','$fechainic','$fechacorte','$salario','$dias','$auxilio','$prestamo','$vestuario','$otros','$comfenalco','$pagar','$valor1','$valor2','$valor3','$valor4','$nota','$control')";
       $resultado=mysql_query($consulta) or die("Insercion incorrecta");
       $regis=mysql_affected_rows();
     echo ("<script language=\"javascript\">");
     echo "open (\"../pie.php?msg=Se Grabo $regis registros del empleado: $nombre\",\"pie\");";
     echo ("open (\"imprimirpresta.php?nropresta=$codcesa\" ,\"\");");
     echo ("</script>");
           ?>
    <script language="javascript">
    open("listadocesantia.php","_self");
    </script>
    <?
  endif;
?>
