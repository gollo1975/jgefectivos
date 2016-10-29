<?
  if(empty($DatosE)):
   ?>
     <script language="javascript">
       alert("Debe de seleccionar un Item para eliminar el registro ?")
       history.back()
       </script>
   <?
  else:
       include("../conexion.php");
	  $Sql="select detalladoexamen.vlrexamen,detalladoexamen.nro from detalladoexamen
       where detalladoexamen.nro='$Nro'";
       $Rs=mysql_query($Sql)or die ("Error al buscar valores");
       $Suma = 0;
	   while($Linea = mysql_fetch_array($Rs)){
    	 $Suma += $Linea["vlrexamen"]; 
	     $Nro = $Linea["nro"];
      }
	    $Total = 0;
        $lista=$_POST["DatosE"];
         foreach ($lista as $Dato){
              $conB="select detalladoexamen.* from detalladoexamen
		         where detalladoexamen.codigo='$Dato'";
	          $resuB=mysql_query($conB)or die ("Error al buscar examen");
              $filas=mysql_fetch_array($resuB);
              $Total += $filas["vlrexamen"];
             /* codigo de eliminacion*/
              $consulta="delete from detalladoexamen where detalladoexamen.codigo='$Dato'";
              $resultado=mysql_query($consulta) or die ("eliminacion incorrecta");
			  $registro = mysql_affected_rows;
         }
		    $TotalSaldo = $Suma - $Total;
			$conA="update examen set costoe='$TotalSaldo' where examen.nro='$Nro'";
            $resuA=mysql_query($conA) or die("Actualizacion de examen  ");
            header("location: DetalladoEditado.php?Nro=$Nro");  
    endif;
?>
