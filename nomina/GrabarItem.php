<html>

<head>
  <title></title>
</head>

<body>
<?
if(empty($Variable)):
   ?>
    <script language="javascript">
              alert("Seleccione el estado a actualizar ?")
              history.back()
    </script>
   <?
else:
     include("../conexion.php");
     $conD="select zona.codzona,centro.codcentro from contrato,zona,empleado,centro where
     zona.codzona=empleado.codzona and
     empleado.cedemple=centro.cedemple and
     empleado.codemple=contrato.codemple and
     contrato.fechater='0000-00-00' and
     zona.codzona='$CodZona'";
     $resulD=mysql_query($conD)or die ("Error al buscar datos de la zona");
     $regiD=mysql_num_rows($resulD);
     if($regiD!=0):
        $k=0;
          while($filas=mysql_fetch_array($resulD)):
               $CodAuxiliar=$filas["codcentro"];
               if($Variable=='Activo'):
                   $Con="update decentro set activo='$Estado' where codsala='$CodSala' and codcentro='$CodAuxiliar'";
                   $Res=mysql_query($Con)or die("Error al actualizar el estado");
                   $k=$k+1;
               else:
                   $Con="update decentro set permanente='$Estado' where codsala='$CodSala' and codcentro='$CodAuxiliar'";
                   $Res=mysql_query($Con)or die("Error al actualizar el estado");
                   $k=$k+1;
               endif;
          endwhile;
         echo "<script language=\"javascript\">";
	echo "alert(\"Total registros actualizados: " . $k . "\");";
        echo ("open (\"DetalladoItem.php?CodZona=$CodZona\",\"_self\");");

	echo "</script>";
     else:
         ?>
         <script language="javascript">
              alert("El personal de esta zona no tiene empleados activos con centro de costo!")
              history.back()
         </script>
        <?
     endif;
endif;
?>

</body>

</html>
