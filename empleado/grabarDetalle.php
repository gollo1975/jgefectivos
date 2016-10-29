<html>
<head>
  <title></title>
</head>
<body>
<?php
if(empty($nivel)):
  ?>
  <script language="javascript">
     alert("Seleccion el nivel de estudio de la lista.")
     history.back()
  </script>
  <?

elseif(empty($rango)):
  ?>
  <script language="javascript">
     alert("Seleccion el nivel salarial de la lista.")
     history.back()
  </script>
  <?
else:
    include("../conexion.php");
    $fechap=date("Y-m-d");
    $documento=strtoupper($documento);
    $nombres=strtoupper($nombres);
    $conB="select detallempleado.cedemple from detallempleado where cedemple='$cedula'";
    $resuB=mysql_query($conB)or die ("Error al buscar datos del empleado");
    $regB=mysql_num_rows($resuB);
    if($regB==0):
       if($nro==0):
           $conG="insert into detallempleado (cedemple,empleado,codzona,nivelestudio,cabezafamilia,padrefamilia,nrohijo,rangosalario,fechap)
	       values('$cedula','$empleado','$zona','$nivel','$cabeza','$padre','$nro','$rango','$fechap')";
	       $resuG=mysql_query($conG)or die ("Error al grabar datos $conG");
                header("location: agregardetalle.php"); 
       else:
         if(empty($tipo)):
           ?>
             <script language="javascript">
                alert("Seleccion el tipo de identificación de la lista.")
                history.back()
             </script>
           <?
         elseif(empty($documento)):
            ?>
            <script language="javascript">
               alert("Digite el documento identidad del hijo(a).")
               history.back()
               </script>
            <?
              elseif(empty($nombres)):
                 ?>
                 <script language="javascript">
                   alert("Digite el los nombres completos del hijo.")
                   history.back()
                  </script>
           <?
           else:
              $conH="select detallehijo.documento from detallehijo where detallehijo.documento='$documento'";
              $resuH=mysql_query($conH)or die ("Error al buscar datos del empleado");
              $regH=mysql_num_rows($resuH);
             if($regH==0):
	       $conG="insert into detallempleado (cedemple,empleado,codzona,nivelestudio,cabezafamilia,padrefamilia,nrohijo,rangosalario,fechap)
	       values('$cedula','$empleado','$zona','$nivel','$cabeza','$padre','$nro','$rango','$fechap')";
	       $resuG=mysql_query($conG)or die ("Error al grabar datos $conG");
	       $conD="insert into detallehijo(tipo,documento,nombre,fechanac,cedemple,parentezco,fechaingreso)
	       values('$tipo','$documento','$nombres','$fechan','$cedula','$parentezco','$fechap')";
	       $resuD=mysql_query($conD)or die ("Error al grabar datos de los hijos");
	       $reg=mysql_affected_rows();
	       header("location: agregardetalle.php?cedula=$cedula&sw=1");
             else:
               ?>
               <script language="javascript">
                  alert("Este Documento del hijo ya esta matriculado.")
                  history.back()
                 </script>
              <?
             endif;
           endif;
       endif;
    else:
       $conH="select detallehijo.documento from detallehijo where detallehijo.documento='$documento'";
       $resuH=mysql_query($conH)or die ("Error al buscar datos del empleado");
       $regH=mysql_num_rows($resuH);
       if($regH==0):
	       $conD="insert into detallehijo(tipo,documento,nombre,fechanac,cedemple,parentezco,fechaingreso)
	       values('$tipo','$documento','$nombres','$fechan','$cedula','$parentezco','$fechap')";
	       $resuD=mysql_query($conD)or die ("Error al grabar datos de los hijos");
	       $reg=mysql_affected_rows();
	       header("location: agregardetalle.php?cedula=$cedula&sw=1");
       else:
          ?>
          <script language="javascript">
             alert("Este Documento del hijo ya esta matriculado.")
             history.back()
          </script>
          <?
       endif;
    endif;

endif;
?>

</body>

</html>
