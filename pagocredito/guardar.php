<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='descargar.php?nroabono=' + numero
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
<?
if(empty($abono)):
     ?>
       <script language="javascript">
         alert("Debe de digitar el abono al crédito ?")
         history.back()
       </script>
    <?
     elseif($abono > $saldo):
     ?>
       <script language="javascript">
         alert("El abono, No puede ser mayo que el Saldo  ?")
         history.back()
       </script>
    <?
        else:
         $nuevosaldo=($saldo-$abono);
          include("../conexion.php");
          $nota=strtoupper($nota);
          $consulta = "select count(*) from abono";
          $result = mysql_query ($consulta);
          $answ = mysql_fetch_row($result);
          if($answ[0]>0):
             $consulta = "select max(cast(codabono as unsigned)) + 1 from abono";
             $result = mysql_query ($consulta) or die ("Fallo en la consulta");
             $codc = mysql_fetch_row($result);
             $codigo= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
          else:
          $codigo='000001';
          endif;
          $consulta="insert into abono(codabono,cedemple,nrocredito,nuevo,abono,fecha,nota)
                       values('$codigo','$cedemple','$nrocredito','$nuevosaldo','$abono','$fecha','$nota')";
          $resultado=mysql_query($consulta) or die("Error de Grabado del abono$consulta");
          $registro=mysql_affected_rows();
          $con="update credito set nuevo='$nuevosaldo' where nrocredito='$nrocredito'";
          $resultad=mysql_query($con)or die("Inserccion incorrecta 1");
          $reg=mysql_affected_rows();
          if ($reg!=0):
               if($buscar=='imprimir'):
                  echo ("<script language=\"javascript\">");
                  echo ("open (\"recibocredito.php?nroabono=$codigo\" ,\"\");");
                  echo ("</script>");
                  ?>
                     <script language="javascript">
                        open("descargar.php","_self");
                     </script>
                    <?
               endif;
                ?>
                <script language="javascript">
                  alert("La tabla Credito, se actualizó con Exito ?")
                  history.go(-2)
                </script>
                <?
             else:
              ?>
              <script language="javascript">
                alert("La Tabla Crédito, No Se actualizó con éxito ?")
              </script>
              <?
             endif;
endif;
