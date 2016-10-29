<?
  if(empty($datoN)){
      ?>
      <script language="javascript">
        alert("Debe de Seleccionar los Item que se van a Enviar para el Proceso de auditoria ?")
        history.back()
        </script>
       <?
   }else{
       $FechaP=date("Y-m-d");
       include("../conexion.php");
       //ciclo de grabar
       for ($k=1 ; $k<=$tActualizaciones; $k ++):
           if   ($datoN[$k] != "" ):
            $con="insert into auditoriaexamen(nro,cedemple,empleado,ccliente,cprovedor,diferencia,zona,fechap)
            values('$datoN[$k]','$cedula[$k]','$empleado[$k]','$vlrcliente[$k]','$VlrProve[$k]','$VlrDiferencia[$k]','$zona[$k]','$FechaP')";
            $resulta=mysql_query($con)or die("Inserccion incorrecta 2 $con");
            /*codigo de actualizacion en la tabla dexamen*/
            $ConA="update dexamen set auditoria='OK' where dexamen.nro='$datoN[$k]'";
            $resA=mysql_query($ConA)or die ("Error de actualización");
          endif;
       endfor;
               $registro=mysql_affected_rows();
               echo "<script language=\"javascript\">";
               echo "alert (\"Se grabo el registro con exito en sistema!\",\"pie\");";
              echo ("open (\"AuditoriaEmpleado.php\",\"_self\");"); 
               echo "</script>";
}
?>

