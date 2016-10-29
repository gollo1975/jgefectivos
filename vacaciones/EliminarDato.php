<?
if($DatoE==''){
    ?>
     <script language="javascript">
        alert("Seleccione un item para el proceso de Eliminacion.!")
        history.back();
     </script>
    <?
}else{
         include("../conexion.php");
         $lista=$_POST["DatoE"];//diario va en mayuscula el post
         foreach ($lista as $dato)
            {
                /*CODIGO QUE BUSCA EL VALOR DE LA TABLA DETALLEVACACION*/
               $conD="select detallevacacion.* from detallevacacion
               where detallevacacion.idvaca='$dato'";
               $resuD=mysql_query($conD)or die ("Error al buscar el detalle de vacaciones");
               $filaD=mysql_fetch_array($resuD);
               $NroCredito = $filaD["nrocredito"];
               $ValorD = $filaD["valorpago"];
               $CodSala = $filaD["codsala"];
               /*CODIGO QUE BUSCA EN CENTRO DE NOMINA*/
                $conC="select decentro.codcentro from decentro,centro
               where centro.codcentro=decentro.codcentro and
                     centro.cedemple='$Cedula'";
		  $resuC=mysql_query($conC)or die ("Error al buscar eel centro de nomina");
		  $filaC=mysql_fetch_array($resuC);
		  $CodCentro = $filaC["codcentro"];
               /*CODIGO QUE BUSCA EL CREDITO*/

                 $conC="select credito.nuevo,credito.cuota from credito
	                   where credito.nrocredito='$NroCredito' and credito.cedemple='$Cedula' and credito.codsala='$CodSala'";
	         $resuC=mysql_query($conC)or die ("Error al buscar el detalle de vacaciones");
                 $Reg = mysql_num_rows($resuC);
	         $filaC=mysql_fetch_array($resuC);
	         $SaldoC = $filaC["nuevo"];
                 $CuotaC =  $filaC["cuota"];
	         $TotalC = $SaldoC + $ValorD;
                 if($Reg != 0){
	               /*ACTUALIZAR EL CREDITO CON EL SALDO EN LA TABLA CREDITO*/
	                $SS="update credito set nuevo='$TotalC' where credito.nrocredito='$NroCredito'";
	               $ReS=mysql_query($SS)or die ("Error al actualizar el credito");
                       if($SaldoC <= 0){
                          $ConC="update decentro set deduccion='-$CuotaC', permanente='SI', estado='SI' where decentro.codsala='$CodSala' and decentro.codcentro='$CodCentro'";
		          $resuC = mysql_query ($ConC) or die ("Error al actualizar");
                       }
                }else{
                      $conC="select mercado.nsaldo,mercado.cuota from mercado
	                   where mercado.codmerca='$NroCredito'";
	               $resuC=mysql_query($conC)or die ("Error al buscar el credito de mercado");
	               $filaC=mysql_fetch_array($resuC);
	               $SaldoC = $filaC["nsaldo"];
                       $Cuota =  $filaC["cuota"];
	               $TotalC = $SaldoC + $ValorD;
	               /*ACTUALIZAR EL CREDITO CON EL SALDO EN LA TABLA MERCADO*/
	               $SS="update mercado set nsaldo='$TotalC' where mercado.codmerca='$NroCredito'";
	               $ReS=mysql_query($SS)or die ("Error al actualizar el credito");
                       if($SaldoC <= 0){
                          $ConC="update decentro set deduccion='-$Cuota', permanente='SI', estado='SI' where decentro.codsala='$CodSala' and decentro.codcentro='$CodCentro'";
		          $resuC = mysql_query ($ConC) or die ("Error al actualizar");
                       }
               }

               /*FIN CODIGO*/
               /*PERMITE ELIMINAR EL REGHISTRO*/
                $consulta="delete from detallevacacion where detallevacacion.idvaca='$dato'";
                $resultado=mysql_query($consulta) or die ("Error al validar la eliminacion.");
                $registros=mysql_affected_rows();
            }
           if ($registros==0){
                ?>
                <script language="javascript">
                        alert("No se elimino ningun registro del sistema.!")
                        history.back();
                </script>
                <?
            }else{
                header("location: CrearDeduccionVacacion.php?EstadoModificado=$EstadoModificado&Cedula=$Cedula&Sw=$Sw&NroVacacion=$NroVacacion");
            }    	
}
?>
