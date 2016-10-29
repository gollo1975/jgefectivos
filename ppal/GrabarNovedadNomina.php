<input type="hidden" name="fechap" value="<? echo $fechap;?>" size="11">
<input type="hidden" name="desde" value="<? echo $desde;?>" size="11">
<input type="hidden" name="hasta" value="<? echo $hasta;?>" size="11">
 <input type="hidden" name="Cedula" value="<? echo $Cedula;?>" size="11">
<?
if(empty($datoN)):
   ?>
   <script language="javascript">
      alert("Debe de chequear las cajas de verificaion para procesar el registro.!")
      history.back()
   </script>
   <?
else:
    include("../conexion.php");
       $conR="select novedadnomina.desde,novedadnomina.hasta,novedadnomina.codzona from novedadnomina
         where novedadnomina.desde='$desde' and
         novedadnomina.hasta='$hasta' and
         novedadnomina.codzona='$codzona' and
         novedadnomina.cedemple='$Cedula'";
        $resR=mysql_query($conR)or die ("Error de consulta de validacion");
	$regist=mysql_num_rows($resR);
        if($regist==0):
            $consulta = "select count(*) from novedadnomina";
	    $result = mysql_query ($consulta);
	    $sw = mysql_fetch_row($result);
	    if ($sw[0]>0):
	          $consulta = "select max(cast(codnovedad as unsigned)) + 1 from novedadnomina";
	           $result = mysql_query($consulta) or die ("Fallo en la consulta");
	           $codco = mysql_fetch_row($result);
	           $codnove = str_pad ($codco[0], 10, "0", STR_PAD_LEFT);
	    else:
	          $codnove="0000000001";
	    endif;
	   $consulta="insert into novedadnomina(codnovedad,cedemple,nombre,codzona,zona,fechap,desde,hasta,nota)
	               values('$codnove','$Cedula','$nombre','$codzona','$zona','$fechap','$desde','$hasta','$observacion')";
	    $resultado=mysql_query($consulta)or die("inserección incorrecta $consulta");
            for ($k=1 ; $k<=$tActualizaciones; $k ++){
	           if   ($datoN[$k] != ''){
		           $conC="select salario.ibcprestacional from salario
		        	where salario.codsala='$datoN[$k]'";
			   $resC=mysql_query($conC)or die ("Error de consulta la tabla salario");
			   $fila=mysql_fetch_array($resC);
			   $CodSala = $fila["ibcprestacional"];
			   if($CodSala == 'NO'){
			        $con="insert into denovedanomina(codnovedad,codsala,concepto,vlrhora,nrohora,salario,prestacion,variacion,porcentaje,deduccion)
			              values('$codnove','$datoN[$k]','$concepto[$k]','$vlrhora[$k]','$nrohora[$k]','$salario[$k]','$prestacion[$k]','$variacion[$k]','$porcentaje[$k]','$deduccion[$k]')";
			        $resulta=mysql_query($con)or die("Error al grabar detallado de Novedades de nomina ");
			        $registro=mysql_affected_rows();
		   	   }else{
			        $con="insert into denovedanomina(codnovedad,codsala,concepto,vlrhora,nrohora,prestacion,variacion,porcentaje,deduccion,ibcprestacional)
				     values('$codnove','$datoN[$k]','$concepto[$k]','$vlrhora[$k]','$nrohora[$k]','$prestacion[$k]','$variacion[$k]','$porcentaje[$k]','$deduccion[$k]','$salario[$k]')";
				$resulta=mysql_query($con)or die("Error al grabar detallado de Novedades de nomina ");
			        $registro=mysql_affected_rows();
  			   }
	           }
	       }
	        echo "<script language=\"javascript\">";
	        echo "open (\"../pie.php?msg=Se Grabó $registro registro del Empleado: $nombre\",\"pie\");";
	        echo "</script>";
	       header("location: nuevanovedad.php?desde=$desde&hasta=$hasta&codigo=$codzona&orden=$orden&Cedula=$Cedula");
        else:
            ?>
	   <script language="javascript">
	      alert("Este novedad ya esta grabada en sistema!")
	      history.back()
	   </script>
	   <?
        endif;
 endif;
     ?>
