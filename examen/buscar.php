<html>
<head>
  <title></title>
</head>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<body>
 <tr>
            <td class="cajas"><div align="center"><b>Provedor:</b>&nbsp;<?echo $provedor;?></div></td>
   </tr>
             <?
      include("../conexion.php");
      $con="select dexamen.* from dexamen,cobroexamen
               where cobroexamen.codigo=dexamen.codigo and
                     cobroexamen.codigo='$cod'";
	   $res=mysql_query($con)or die ("Error al buscar el examen ?");
	   $reg=mysql_num_rows($res);
	   if($reg!=0):
	     ?>

             <div align="center"><h5><u>Listado de Examenes</u></h5></div>
              <table border="0" align="center">
	           <tr class="cajas">
                            <th>Item</td>
		            <th>Documento</td>
		            <th>Empleado</td>
		            <th>Nro_Control</td>
		            <th><div align="right">Vlr_Examen</div></td>
                            <th><div align="right">Positivo</div></td>
                            <th><div align="right">Negativo</div></td>
                            <th><div align="right">Estado</div></td>
                           <th><div align="center">Auditoria</div></td>
   			   <th>Zona</td>
	           </tr>
	         <?
                  $i=1;
				  $Total=0;
	         while($filas=mysql_fetch_array($res)):
                 $valor=number_format($filas["vlrexamen"],0);
                 $Positivo=number_format($filas["positivo"],0);
                 $Negativo=number_format($filas["negativo"],0);
	            ?>
	             <tr class="cajas">
                      <th><?echo $i;?></th>
	                <td><?echo $filas["cedula"];?></td>
	                <td><?echo $filas["asociado"];?></td>
	                <td><div align="center"><?echo $filas["nroabono"];?></div></td>
	                <td><div align="right">$<?echo $valor;?></div></td>
                        <td><div align="right">$<?echo $Positivo;?></div></td>
                        <?if($Negativo != 0){?>
                             <td><div align="right"><font color="red">$<?echo $Negativo;?></font></div></td>
                             <td><div align="center"><font color="red"><?echo $filas["estado"];?></font></div></td>
                             <td><div align="center"><?echo $filas["auditoria"];?></div></td>
                        <?}else{?>
                              <td><div align="right">$<?echo $Negativo;?></div></td>
                             <td><div align="center"><?echo $filas["estado"];?></div></td>
                             <td><div align="center"><?echo $filas["auditoria"];?></div></td>
                         <?}?>    
		       <td><div align="left"><?echo $filas["zona"];?></div></td>
   
	             </tr>
	            <?
                    $i=$i+1;
					$Total += + $filas["positivo"];
	         endwhile;
			 $Total= number_format($Total,0);
	         ?>
	        </table>
			<div align="center"><b></b>Total_Positivo:&nbsp;$<?php echo $Total;?></div>
	       <?
           else:
              ?>
	      <script language="javascript">
	         alert("No existen descargas en este examen ?")
	         open("confecha.php","_self");
	      </script>
	      <?
           endif;
?>
</body>
</html>
