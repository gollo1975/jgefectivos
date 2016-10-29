<html>
<LINK  REL="stylesheet" HREF="../estilo.css" type="text/css"> 
<img src="image/reportes.png" title="Administrar incapacidades">

<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
         <a href="ppal/incapaindividual.php?codigo=<? echo $codigo;?>">Por Empleado</a> <br>
         <a href="ppal/incapafecha.php?codigo=<? echo $codigo;?>">Fechas</a> <br>
		 <a href="Estadistica/EstadisticaIncapacidad.php?codigo=<?echo $codigo;?>">Estadisticas incapacidad</a> <br>
         <a href="ppal/incapageneral.php?codigo=<? echo $codigo;?>">General</a> <br>
         <a href="ppal/pagoincapacidad.php?codigo=<? echo $codigo;?>">Extracto de Pago</a> <br>    
      </div>
   </td>
</tr>
</table>
</html>
