<input type="hidden" name="fechapago" value="<?echo $fechapago;?>">
<?
if(empty($datoN)):
   ?>
   <script language="javascript">
      alert("Debe de chequear todas las cajas de verificacion para generar el Documento.")
      history.back()
   </script>
   <?
elseif(empty($Validar)):
   ?>
   <script language="javascript">
      alert("Seleccione el tipo de estado para la colilla de pago.")
      history.back()
   </script>
   <?
else:
   include("../conexion.php");
     $i=0;
    for ($k=1 ; $k<=$tActualizaciones; $k ++):
       if   ($datoN[$k] != ""):
              $con="update nomina set estadoc='$Validar' where nomina.cedemple='$datoN[$k]' and nomina.desde='$Desde' and nomina.hasta='$Hasta'";
                 $resulta=mysql_query($con)or die("Error al al activar colillas");
                 $registro=mysql_affected_rows();
                  $i=$i+1;
       endif;
    endfor;
    ?>
     <script language="javascript">
         alert("Se grabaron : <?echo ($i);?> registros en el corte de nomina, desde el : <?echo $Desde;?> hasta el : <?echo $Hasta;?>.!")
         open("ActivarColillas.php","_self")
     </script>
    <?
    echo $i;
endif;
     ?>
