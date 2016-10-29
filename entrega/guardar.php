<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimir.php?nroentrega=' + numero
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
 <?
   include("../conexion.php");
   $consulta = "select count(*) from entrega";
   $result = mysql_query ($consulta);
   $sw = mysql_fetch_row($result);
    if ($sw[0]>0):
     $consulta = "select max(cast(nroentrega as unsigned)) + 1  from entrega";
     $result = mysql_query ($consulta);
     $codec = mysql_fetch_row($result);
     $code = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
    $consulta="insert into entrega (nroentrega,cedemple,fechainic,fechafinal,fechagra,valor,nota)
     value('$code','$cedula','$fechainic','$fechafinal','$fechagra','$suma','$nota')";
      $resultado=mysql_query($consulta) or die("Insercion incorrecta");
      $regis=mysql_affected_rows();
    else:
     $code="00001";
   $consulta="insert into entrega (nroentrega,cedemple,fechainic,fechafinal,fechagra,valor,nota)
     value('$code','$cedula','$fechainic','$fechafinal','$fechagra','$suma','$nota')";
      $resultado=mysql_query($consulta) or die("Insercion incorrecta");
      $regis=mysql_affected_rows();
   endif;
   if ($regis!=0):
     echo ("<script language=\"javascript\">");
     echo ("open (\"imprimir.php?nroentrega=$code\" ,\"\");");
     echo ("</script>");
           ?>
    <script language="javascript">
    open("entregaporte.php","_self");
    </script>
    <?
   endif;
?>
