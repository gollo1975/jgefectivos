<?php
     include("../conexion.php");
         $consulta = "select count(*) from curso";
         $result = mysql_query ($consulta);
         $answ = mysql_fetch_row($result);
         if ($answ[0] > 0):
           $consulta = "select max(cast(codcurso as unsigned)) + 1 from curso";
                $result2 = mysql_query($consulta);
                $codc = mysql_fetch_row($result2);
                $codcur= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
         else:
             $codcur = "000001";
         endif;
             $consulta="insert into curso(codcurso,cedemple,nombres,fechag,fechar,puntaje,nitprove)
             values('$codcur','$cedula','$nombres','$fechag','$fechar','$puntaje','$provedor')";
             $resultado=mysql_query($consulta)or die("inserección incorrecta");
              $registro1=mysql_affected_rows();
          if ($registro1==0):
            ?>
            <script language="javascript">
              alert("No se actualizo el registro de la tabla empleado ?")
              history.go(-2)
            </script>
          <?
          else:
             ?>
            <script language="javascript">
              alert("El registro  se Guardó correctamente ?")
              open("agregar.php","_self");
            </script>
            <?
          endif;
?>
