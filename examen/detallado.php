<html>
<head>
  <title></title>
</head>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<body>
 <tr>
            <td class="cajas"><div align="center"><b>Empleado:</b>&nbsp;<?echo $nombre;?></div></td>
   </tr>
             <?
      include("../conexion.php");
      $con="select examenomina.* from examenomina
               where examenomina.conse='$con'";
	   $res=mysql_query($con)or die ("Error al buscar el examen ?");
	   $reg=mysql_num_rows($res);
	   if($reg!=0):
	     ?>

             <div align="center"><h5><u>Histórico de pago</u></h5></div>
              <table border="0" align="center">
	           <tr class="cajas">
                            <th>Item</td>
		            <th>Nro_Pago</td>
		            <th>Nro_Control</td>
		            <th>F_Proceso</td>
		            <th>F_Nomina</td>
	                    <th>Valor</td>
	           </tr>
	         <?
                  $i=1;
	         while($filas=mysql_fetch_array($res)):
	            ?>
	             <tr class="cajas">
                      <th><?echo $i;?></th>
	                <td><?echo $filas["codpago"];?></td>
	                <td><?echo $filas["radicado"];?></td>
	                <td><?echo $filas["fechap"];?></td>
	                <td><?echo $filas["fechan"];?></td>
	                <td><?echo $filas["valor"];?></td>
	             </tr>
	            <?
                    $i=$i+1;
	         endwhile;
	         ?>
	        </table>
	       <?
           else:
              ?>
	      <script language="javascript">
	         alert("No existen descargas en este examen ?")
	         history.back()
	      </script>
	      <?
           endif;
?>
</body>
</html>
