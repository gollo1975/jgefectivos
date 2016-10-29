<?
if(empty($datos)):
?>
   <script language="javascript">
      alert("Debe de chequear las cajas de verificacion.!")
      history.back()
   </script>
<?
else:
     include("../conexion.php");
     $SqlZona="select parametroexamenzona.codzona from parametroexamenzona
           where parametroexamenzona.codzona='$CodZona'";
     $RsZona=mysql_query($SqlZona)or die ("Error al buscar la configuracion del examen");
     if(mysql_num_rows($RsZona)== 0){
	     $fechap=date("Y-m-d");
             $Sql="insert into parametroexamenzona(codzona,zona,fechap)
	                   values('$CodZona','$Zona','$fechap')";
	     $Rs=mysql_query($Sql)or die("Error al grabar en la tabla inicial ");
	      /*ciclo para grabar detallado*/
	      $Total=0;
	      for ($k = 1; $k <= $TotalVector; $k ++):
	          if   ($datos[$k] != ""):
                       $con="insert into detalladoparametroexamenzona(idexamen,concepto,codzona)
	                   values('$datos[$k]','$concepto[$k]','$CodZona')";
	               $resulta=mysql_query($con)or die("Error al grabar la configuracion del examen. ");
	               $reg=mysql_affected_rows();
                       $Total = $Total + 1;

	          endif;
	      endfor;
	      /*ciclo para grabar detallado*/
	          echo "<script language=\"javascript\">";
	          echo "alert (\"Se Grabó $Total registros de la zona: $Zona\");";
	          echo ("open (\"ParametroExamen.php\",\"_self\");");
	          echo "</script>";
      }else{
            ?>
            <script language="javascript">
                 alert("Esta empresa ya tiene la configuracion establecida.!")
                 history.back()
            </script>
    <?

      }
endif;
 ?>

