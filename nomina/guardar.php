<?
        include("../conexion.php");
          $estado=strtoupper($estado);
          $con="select periodo.* from periodo where periodo.codzona='$codzona'
          and periodo.desde='$desde'
          and periodo.hasta='$hasta'";
          $resu=mysql_query($con)or die("Error de la Consulta");
          $regis=mysql_affected_rows();
          if($regis!=0):
             ?>
              <script language="javascript">
                alert("Esta Zona Ya se le Cargo este Periodo ?")
                history.go(-2)
              </script>
             <?
          else:
                  $consulta = "select count(*) from periodo";
                  $result = mysql_query ($consulta);
                  $sw = mysql_fetch_row($result);
                  if ($sw[0]>0):
                     $consult1 = "select max(cast(codigo as unsigned)) + 1  from periodo";
                     $result1 = mysql_query ($consult1);
                     $codec = mysql_fetch_row($result1);
                     $code = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
                  else:
                    $code="000001";
                  endif;
                  $consulta="insert into periodo(codigo,codzona,desde,hasta,estado,nota)
                            values('$code','$codzona','$desde','$hasta','$estado','$nota')";
                     $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
                     $registro=mysql_affected_rows();
                    echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se Grabó $registro registro de la Zona: $zona\",\"pie\");";
                    echo "open (\"deperiodo.php?CodSucursal=$CodSucursal\",\"_self\");";
                    echo "</script>";
          endif;
      ?>

