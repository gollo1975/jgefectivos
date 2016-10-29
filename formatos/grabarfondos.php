<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimirfondo.php?nro=' + numero
                tiempo=90
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
<?
          include("../numeros.php");
          $suma=num2letras($valor);
          include("../conexion.php");
          $nota=strtoupper($nota);
          $suma=strtoupper($suma);
          $fechag=date("Y-m-d");
          $consulta = "select count(*) from fondos";
          $result = mysql_query ($consulta);
          $answ = mysql_fetch_row($result);
          if($answ[0]>0):
             $consulta = "select max(cast(radicado as unsigned)) + 1 from fondos";
             $result = mysql_query ($consulta) or die ("Fallo en la consulta");
             $codc = mysql_fetch_row($result);
             $codca= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
          else:
              $codca="00001";
          endif;
         $consulta="insert into fondos(radicado,cedemple,empleado,codigo,fondo,cuenta,documento,vlrmatricula,vlrfondo,letras,zona,observacion,fechap,fechagra)
                       values('$codca','$cedula','$empleado','$tipo','$fondo','$cuenta','$documento','$matricula','$valor','$suma','$zona','$nota','$fechap','$fechag')";
             $resultado=mysql_query($consulta) or die("error al grabar datos del fondo");
             $registro=mysql_affected_rows();
             ?>
            <script language="javascript">
               alert("Registros grabados con éxito en sistema ?")
            </script>
            <?
            echo ("<script language=\"javascript\">");
            echo ("open (\"imprimirfondo.php?nro=$codca\" ,\"\");");
            echo ("</script>");
            ?>
            <script language="javascript">
               open("agregar.php","_self");
            </script>
            <?
?>
