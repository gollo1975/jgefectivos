<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimir.php?codvaca=' + numero
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
     <?
       include("../conexion.php");
           $control='ACTIVA';
          $nombres=strtoupper($nombres);
          $nota=strtoupper($nota);
          $consulta = "select count(*) from vacacion";
          $result = mysql_query ($consulta);
          $answ = mysql_fetch_row($result);
          if($answ[0]>0):
             $consulta = "select max(cast(codvaca as unsigned)) + 1 from vacacion";
             $result = mysql_query ($consulta) or die ("Fallo en la consulta");
             $codc = mysql_fetch_row($result);
             $codva= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
          else:
            $codva="00001";
          endif;
             $consulta="insert into vacacion(codvaca,cedemple,nombre,fechap,fechai,fechac,dias,ibc,valor,nota,control)
                       values('$codva','$cedula','$nombres','$fechap','$fechai','$fechac','$dias','$ibc','$valor','$nota','$control')";
             $resultado=mysql_query($consulta) or die("Insercion incorrecta $consulta");
             $registro=mysql_affected_rows();
             echo ("<script language=\"javascript\">");
             echo "open (\"../pie.php?msg=Se Grabo $registro registros del empleado: $nombres\",\"pie\");";
             echo ("open (\"imprimir.php?codvaca=$codva\" ,\"\");");
             echo ("</script>");
             ?>
             <script language="javascript">
               open("listado.php","_self");
             </script>
             <?

