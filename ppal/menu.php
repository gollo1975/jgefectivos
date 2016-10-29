<html>
<LINK  REL="stylesheet" HREF="../estilo.css" type="text/css"> 
<img src="image/reportes.png" title="Administrar empleados">

<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
         <a href="ppal/consultazona.php?codigo=<? echo $xzona;?>">Activos</a> <br>
          <a href="ppal/maestro.php?codigo=<? echo $xzona;?>">Por Documento</a> <br>
          <a href="ppal/aportesocial.php?codigo=<? echo $xzona;?>">Fondo de Aporte</a> <br>
          <a href="contrato/listadoconveniozona.php?codigo=<? echo $xzona;?>">Contrato Temporal</a> <br> 
      </div>
   </td>
</tr>
</table>
</html>
