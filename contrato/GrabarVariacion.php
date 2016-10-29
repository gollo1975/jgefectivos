<?php
include("../conexion.php");
$Buscar = "select contrato.salario_anterior from contrato where contrato.contrato='$NroC'";
$Ejec=mysql_query($Buscar)or die("Error al buscar");
$fila=mysql_fetch_array($Ejec);
$Valor=$fila["salario_anterior"];
if($Valor != $Nuevo_Salario_Ibc){
   $Con="update contrato set salario_anterior='$salarioActual',salario='$Nuevo_Salario',salario_ibc='$Nuevo_Salario_Ibc',salario_fecha_desde='$FechaV',cambio='SI' where contrato.contrato='$NroC'";
    $res=mysql_query($Con)or die("Error al validar");
	 ?>
	 <script language="javascript">
	    alert("Se actualizo el registro con exito en el sistema..! ?")
	   open("listado.php","_self");
	  </script>
         <?
}else{
      ?>
	 <script language="javascript">
	    alert("Esta variacion ya se realizo en el sistema.! ?")
            history.back()
	  </script>
         <?             
}
?>
