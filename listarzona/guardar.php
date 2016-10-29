<?
if(empty($mes)):
     ?>
       <script language="javascript">
         alert("El Campo Mes no puede estar vacio")
         history.back()
       </script>
    <?
elseif(empty($ano)):
     ?>
       <script language="javascript">
         alert("El Campo Año no puede estar vacio")
         history.back()
       </script>
    <?
else:
         include("../conexion.php");
          $mes=strtoupper($mes);
          $ano=strtoupper($ano);
          $consulta = "select count(*) from periodo";
          $result = mysql_query ($consulta);
          $sw = mysql_fetch_row($result);
          if ($sw[0]>0):
             $consulta = "select max(cast(codigo as unsigned)) + 6  from codigo";
             $result = mysql_query ($consulta);
             $codec = mysql_fetch_row($result);
             $code = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
          else:
            $codme="000001";
          endif;

             $consulta="insert into periodo(codigo,codzona,desde,hasta,mes,ano)
                    values('$codme','$codzona','$desde','$hasta','$mes','$ano')";
             $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
             $registro=mysql_affected_rows();
             if($registro!=0):
               ?>
                 <script language="javascript">
                   alert("Se Grabaron Registro en el sistema")
                   open("perido.php","_self")
                 </script>
               <?
             endif;
            /*echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se Grabó $registro registro de la Zona: $zona\",\"pie\");";
                    echo "open (\"../menu.php?op=periodo\",\"contenido\");";
                echo "</script>";*/
endif;
       ?>

