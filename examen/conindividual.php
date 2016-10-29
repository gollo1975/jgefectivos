<html>
<head>
  <title></title>
</head>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<body>
<script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                      function chequearcampos()
                    {
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento de Identidad ?");
                            document.getElementById("cedula").focus();
                            return;
                        }
                        document.getElementById("matrec").submit();

                    }
              </script>
<?
if(!isset($cedula)):
?>
  <div align="center"><h5><u>Examen por Empleado</u></h5></div>
  <form action="" method="post" id="matrec">
     <table border="0" align="center">
        <tr><td><br></td></tr>
        <tr>
            <td><b>Documento de Identidad:&nbsp;</b></td>
            <td><input type="text" name="cedula" size="15" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
        </tr>
       <tr><td><br></td></tr>
       <td colspan="3">
       <input type="button" value="Buscar" class="boton" onclick="chequearcampos()"></td>
     </table>
  </form>
<?
else:
    include("../conexion.php");
    $con="select examen.*,zona.zona,provedor.nomprove from zona,provedor,examen
               where zona.codzona=examen.codzona and
               provedor.nitprove=examen.nitprove and
               examen.cedula='$cedula' order by examen.nro DESC";
	$res=mysql_query($con)or die ("Error al buscar el examen ?");
	$reg=mysql_num_rows($res);
	if($reg!=0):
	     ?>

             <div align="center"><h5><u>Listado de Examenes</u></h5></div>
			 <div align="center">Para imprimir la orden del examen, presione click en el Nro de Examen.</div>
              <table border="0" align="center">
         
	           <tr class="cajas">
			   <th>Nro</td>
		            <th>Nro_Examen.</td>
		            <th>F_Examen</td>
		            <th>F_Proceso</td>
		            <th>Nro_Control</td>
	                    <th>Zona</td>
		            <th>Proveedor</td>
					<th>Vlr_Examen</td>
		            <th>Val.</td>
					<th>U_Validado</td>
					<th>H_Examen</td>
					<th>H_Validado</td>
					<th>F_Validado</td>
					<th>Estado</td>
	           </tr>
	         <?
			 $a=1;
	         while($filas=mysql_fetch_array($res)):
			    $Costo=number_format($filas["costoe"],0);
	            ?>
	             <tr class="cajas">
				  <th><?echo $a;?></th>
	                <td><a href="imprimircontrol.php?nropago=<?echo $filas["nro"];?>"><?echo $filas["nro"];?></a></td>
	                <td><?echo $filas["fechae"];?></td>
	                <td><?echo $filas["fechap"];?></td>
	                <td><?echo $filas["radicado"];?></td>
	                <td><?echo $filas["zona"];?></td>
	                <td><?echo $filas["nomprove"];?></td>
					<td><div align="center"><?echo $Costo;?></div></td>
	                <td><?echo $filas["validadoso"];?></td>
					 <td><?echo $filas["usuariovalidador"];?></td>
					<td><?echo $filas["horaexamen"];?></td>
                     <td><?echo $filas["horaexamenvalidado"];?></td>					
					 <td><?echo $filas["fechavalidado"];?></td>
					 <?if($filas["estado"] == 'ANULADO'){?>
                            <td><font color ="red"><?echo $filas["estado"];?></font></td>
					<?}else{?>
							  <td><?echo $filas["estado"];?></td>
					<?}?>	
	             </tr>
	            <?
				$a +=1;
	         endwhile;
	         ?>
	        </table>
	       <?
   else:
              ?>
	      <script language="javascript">
	         alert("No hay Examenes para descargar en sistema o el trabajaro no ingreso a la Compañia.")
	         open("conindividual.php","_self");
	      </script>
	      <?
   endif;
   
endif;
?>
</body>
</html>
