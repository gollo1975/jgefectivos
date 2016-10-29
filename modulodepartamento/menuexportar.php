<html>
<img src="image/reportes.png" title="Exportar Archivos">
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
        <a href="modulodepartamento/zonactiva.php?codigo=<? echo $xdepto;?>">Empleado x Zona</a><br>
        <a href="modulodepartamento/nominactiva.php?codigo=<? echo $xdepto;?>">Nomina por fecha</a> <br>
        <a href="modulodepartamento/planillanomina.php?codsucu=<? echo $xdepto;?>">Planilla de Nomina[Ingresos]</a> <br>
         <a href="modulodepartamento/planillanomina1.php?codsucu=<? echo $xdepto;?>">Planilla de Nomina[Egresos]</a> <br> 
        <a href="modulodepartamento/primactiva.php?codigo=<? echo $xdepto;?>">Primas</a> <br>
         <a href="modulodepartamento/novedadnomina.php?codigo=<? echo $xdepto;?>">Novedades de Nomina</a> <br>
         <a href="modulodepartamento/exportardetalle.php?codigo=<? echo $xdepto;?>">Detalle Factura</a> <br>
         <a href="modulodepartamento/exportacioncentro.php?codigo=<? echo $xdepto;?>">Detalle por Centro de Costo</a> <br>    

      </div>
   </td>
</tr>

</table>

</html>
