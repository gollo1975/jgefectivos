<script language="javascript">
                function imprimir()// para declara funcion
                {
                pagina='detalladosubir.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
                </script>
<td><input type="hidden" name="i" value="<? echo $i;?>"></td>
<td><input type="hidden" name="codigo" value="<? echo $codigo;?>"></td>
<td><input type="hidden" name="hasta" value="<? echo $hasta;?>"></td>  
<?
  if(empty($datoN)):
      ?>
      <script language="javascript">
        alert("Debe de Seleccionar los Item que se van a Enviar para el Proceso de Nomina ?")
        history.back()
        </script>
      <?
   else:
      include("../conexion.php");
      $consulta="update nomina set codigo='$codigop',cedemple='$cedula',fechap='$fechap',desde='$desde',hasta='$hasta',devengado='$devengado',deduccion='$dedu',neto='$neto',presta='$presta'
              where nomina.consecutivo='$codigo'";
       $resultad=mysql_query($consulta)or die("Inserccion incorrecta 1 $consulta");
       //ciclo de grabar
       for ($k=1 ; $k<=$TotalV; $k ++):
           if   ($datoN[$k] != "" ):
            $con="update denomina set codsala='$codsala[$k]',descripcion='$descri[$k]',vlrhora='$vlrhora[$k]',nrohora='$nrohora[$k]',salario='$deven[$k]',porcentaje='$porcen[$k]',deduccion='$deduccion[$k]'
                        where denomina.conse='$datoN[$k]'";
            $resulta=mysql_query($con)or die("Inserccion incorrecta 2 $con");
          endif;
       endfor;
       $registro=mysql_affected_rows();
      echo "<script language=\"javascript\">";
       echo "open (\"../pie.php?msg=Se Grabó $registro registro de la cedula: $cedula\",\"pie\");";
      echo ("open (\"modificarnomina.php\" ,\"_self\");");
       echo "</script>";
  endif;
      ?>

