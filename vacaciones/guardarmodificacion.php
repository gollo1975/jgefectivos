<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimir.php?codvaca=' + numero
                tiempo=50
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
 <?php
 if(empty($Deduccion)){
   ?>
     <script language="javascript">
         alert("Seleccione si tiene deducciones en el sistema.!")
          history.back()
    </script>
   <?php
}else{
       include("../conexion.php");
          $nombres=strtoupper($nombres);
          $nota=strtoupper($nota);
          $consulta="update vacacion set fechap = '$fechap', fechai = '$fechai', fechac = '$fechac', dias = '$dias', ibc = '$ibc',subtotal='$valor', valor = '$valor', nota  = '$nota' where codvaca = '$codvaca'";
             $resultado=mysql_query($consulta) or die("Modificacion incorrecta $consulta");
             $registro=mysql_affected_rows();
             echo ("<script language=\"javascript\">");
             echo "open (\"../pie.php?msg=Se Grabo $registro registros del empleado: $nombres\",\"pie\");";
             echo ("open (\"imprimir.php?codvaca=$codvaca\" ,\"\");");
             echo ("</script>");
	         if($Deduccion=='NO'){
	             ?>
	             <script language="javascript">
	               open("modificarvacaciones.php","_self");
	             </script>
                     <?
                 }else{
                   $EstadoModificado = 'SI';
                      header("location: CrearDeduccionVacacion.php?NroVacacion=$codvaca&Cedula=$cedula&EstadoModificado=$EstadoModificado");
                 }
}
?>
