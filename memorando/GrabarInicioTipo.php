<?php
if($EstadoT=='NO'){
    if(empty($TipoProceso)){
	   ?>
	   <script language="javascript">
	      alert("Seleccione un proceso de la lista!")
	      history.back()
	   </script>
	   <?
    }elseif(empty($Concepto)){
	   ?>
	   <script language="javascript">
	      alert("Digite la descripción del Proceso!")
	      history.back()
	   </script>
	   <?
     }else{
	    include("../conexion.php");
	    $Cont="select tipoproceso.* from tipoproceso  where tipoproceso.idproceso='$TipoProceso'";
	    $ResC=mysql_query($Cont)or die ("error al procesar la relacion del proceso");
	    $swC = mysql_num_rows($ResC);
	    if($swC == 0){
	        $cons="insert into tipoproceso(idproceso,descripcion)
	        values('$TipoProceso','$Concepto')";
	        $resul=mysql_query($cons) or die("error al grabar");
                ?>
	        <script language="javascript">
	           alert("Datos grabados con exito en sistema!")
	            open("MaestroMemo.php","_self");
	         </script>
	        <?
            }else{
                 ?>
	         <script language="javascript">
	            alert("El tipo de proceso seleccionado ya tiene procedimiento, favor seleccionar otro!")
	            history.back()
	         </script>
	         <?
            }
     }
}else{
    ?>
     <script language="javascript">
        open("CrearDato.php","_self");
     </script>
    <?
}
?>
