<input type="hidden" name="cedemple" value="<? echo $cedemple;?>">
<input type="hidden" name="estado" value="<? echo $estado;?>">
<?
 $nombres=strtoupper($nombres);
	$fechaM=date("Y-m-d");
	include("../conexion.php");
        if($estado=='actualizar'):
           $conH="update detallempleado set codzona='$codzona', nivelestudio='$nivel',cabezafamilia='$cabeza',padrefamilia='$padre',nrohijo='$nro',rangosalario='$rango',fecham='$fechaM'  where cedemple='$cedemple'";
	   $resuH=mysql_query($conH)or die ("Error al actualizar informacion");
	   $regH=mysql_affected_rows();
   	   header("location: ModificarDetalle.php?cedemple=$cedemple&estado=$estado");
        else:
           if($estado=='adicionar'):
               if(empty($documento)):
               ?>
	        <script language="javascript">
		    alert("Digite le documento de identidad del niño.")
		    history.back()
	        </script>
	        <?
	       else:
		        $conB="select detallehijo.documento from detallehijo where detallehijo.documento='$documento'";
		        $resuB=mysql_query($conB)or die ("Error al buscar datos del empleado");
		        $regB=mysql_num_rows($resuB);
		        if($regB==0):
		             $conH="insert into detallehijo(tipo,documento,nombre,fechanac,cedemple,parentezco,fechaingreso,fechaeditado)
			      values('$tipo','$documento','$nombres','$fechan','$cedemple','$parentezco','$fechaM','$fechaM')";
			      $resuH=mysql_query($conH)or die ("Error al grabar datos de los hijos");
			      $regH=mysql_affected_rows();
			      header("location: ModificarDetalle.php?cedemple=$cedemple&estado=$estado");
		        else:
		           ?>
			   <script language="javascript">
			     alert("Este documento del hijo ya esta ingresado en sistemas")
		             history.back()
			    </script>
			   <?
		        endif;
             endif;
           else:
              ?>
	       <script language="javascript">
	          alert("Debe de cambiar el estado del proceso.")
	          history.back()
	       </script>
	       <?
           endif;
        endif;
?>

