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
                        if (document.getElementById("fechai").value.length <=0)
                        {
                            alert ("Digite el documento de Identidad ?");
                            document.getElementById("fechaf").focus();
                            return;
                        }
                        document.getElementById("matrec").submit();

                    }
              </script>
<?
if(!isset($fechai)):
?>
  <div align="center"><h5><u>Examen por Fechas</u></h5></div>
  <form action="" method="post" id="matrec">
     <table border="0" align="center">
        <tr><td><br></td></tr>
        <tr>
            <td><b>Fecha_Inicio:&nbsp;</b></td>
            <td><input type="text" name="fechai" value="<?echo date("Y-m-d");?>" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechai"></td>
        </tr>
        <tr>
            <td><b>Fecha_Final:&nbsp;</b></td>
            <td><input type="text" name="fechaf" value="<?echo date("Y-m-d");?>" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechaf"></td>
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
               examen.fechap between '$fechai' and '$fechaf' order by examen.nombre,zona.zona";
	   $res=mysql_query($con)or die ("Error al buscar el examen ?");
	   $reg=mysql_num_rows($res);
	   if($reg!=0):
	     ?>

             <div align="center"><h5><u>Listado de Examenes</u></h5></div>
             <tr><td class="cajas"><div align="center">Presione click sobre el Número de examen para ver el informe. </div></td></tr>
              <table border="0" align="center">
	           <tr class="cajas">
                    <th>Item</td>
					<th>Número</td>
                    <th>Documento</td>
                    <th>Nombres</td>
		            <th>Zona</td>
	                <th>Proveedor</td>
		            <th>F_Proceso</td>
                    <th>Valor</td>
					<th>Vso.</td>
					<th>Usuario</td>
					<th>Cobrar</td>
                    <th>Tipo_E.</td>
                    <th>H_Examen</td>
					<th>H_Validado</td>
					<th>Estado</td>
                    
	           </tr>
	         <?
                 $i=1;
	         while($filas=mysql_fetch_array($res)):
			    $Nota=$filas["nota"];
	            ?>
	             <tr class="cajas">
                        <th><?echo $i;?></th>
						<td><a href="imprimircontrol.php?nropago=<?echo $filas["nro"];?>"><?echo $filas["nro"];?></a></td>
                        <td><?echo $filas["cedula"];?></td>
                        <td><?echo $filas["nombre"];?></td>
	                <td><?echo $filas["zona"];?></td>
	                <td><?echo $filas["nomprove"];?></td>
                     <td><?echo $filas["fechap"];?></td>
                        <td><div align="right"><?echo $filas["costoe"];?></div></td>
					<?if($filas["validadoso"]=="NO"){?>
					<td><div align="center"><a href="Nota.php?Dato=<?echo $filas["validadoso"];?>&Nota=<?echo $filas["nota"];?>"><font color="red"><?echo $filas["validadoso"];?></a></font></div></td>
					<td><div align="center"><font color="red"><?echo $filas["usuariovalidador"];?></font></div></td>					  
					<?}else{?>
					    <td><div align="center"><a href="Nota.php?Dato=<?echo $filas["validadoso"];?>&Nota=<?echo $filas["nota"];?>"><font color="blue"><?echo $filas["validadoso"];?></a></font></div></td>
						<td><div align="center"><font color="blue"><?echo $filas["usuariovalidador"];?></font></div></td>
					<?}?>
					<td><div align="center"><?echo $filas["cobrarexamen"];?></div></td>
                         <td><?echo $filas["tipoe"];?></td>
	                    <td><?echo $filas["horaexamen"];?></td>
						<td><?echo $filas["horaexamenvalidado"];?></td>
						<?if($filas["estado"] == 'ANULADO'){?>
                            <td><font color ="red"><?echo $filas["estado"];?></font></td>
						<?}else{?>
							  <td><?echo $filas["estado"];?></td>
						<?}?>	
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
	         alert("No hay Examenes en este rango de fechas ?")
	         open("confecha.php","_self");
	      </script>
	      <?
           endif;
endif;
?>
</body>
</html>
