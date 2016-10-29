<?
   include("../conexion.php");
   $busca="select acceso.cedula from acceso where cedula='$firma'";
   $resu=mysql_query($busca)or die("Error en la busqueda de la cedula");
   $conta=mysql_num_rows($resu);
   if($conta!=0):
          $con="select Pnovedad.* from pnovedad where pnovedad.codzona='$codzona'
          and pnovedad.desde='$desde'
          and pnovedad.hasta='$hasta'";
          $resu=mysql_query($con)or die("Error de la Consulta");
          $regis=mysql_affected_rows();
          if($regis!=0):
             ?>
              <script language="javascript">
                alert("Este Periodo ya fue Creado en Sistema ?")
                history.go(-1)
              </script>
             <?
          else:
                  $consulta = "select count(*) from pnovedad";
                  $result = mysql_query ($consulta);
                  $sw = mysql_fetch_row($result);
                  if ($sw[0]>0):
                     $consult1 = "select max(cast(codigo as unsigned)) + 1  from pnovedad";
                     $result1 = mysql_query ($consult1);
                     $codec = mysql_fetch_row($result1);
                     $code = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
                  else:
                    $code="000001";
                  endif;
                  $estado=strtoupper($estado);
                  $consulta="insert into pnovedad(codigo,codzona,desde,hasta,estado,nota,firma)
                            values('$code','$codzona','$desde','$hasta','$estado','$nota','$firma')";
                     $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
                     $registro=mysql_affected_rows();
                    echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se Grabó $registro registro del Periodo: $desde,$hasta\",\"pie\");";
                    echo "open (\"../menudepartamento.php?op=novedadnomina&codigo=<? echo $codigo;?>\",\"contenido\");";
                    echo "</script>";
          endif;
   else:
      ?>
              <script language="javascript">
                alert("El Documento del administrador que digitó, no es válido en la base de datos ?")
                history.back()
              </script>
             <?
   endif;
      ?>

