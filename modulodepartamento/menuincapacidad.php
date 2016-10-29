<html>
<img src="image/empresas.png" title="Procesar Incapacidades">
<LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">

<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
         <a href="modulodepartamento/agregarincapacidad.php?codigo=<?echo $codigo;?>">Agregar Incapacidad</a> <br>
         <a href="modulodepartamento/modificarincapacidad.php?codigo=<? echo $codigo;?>">Modificar Incapacidad</a><br>
         <a href="modulodepartamento/listadoincapacidad.php?codigo=<?echo $codigo;?>">Descargar Incapacidad</a><br>
         <a href="modulodepartamento/seguimiento.php?codigo=<?echo $codigo;?>">Seguimiento de Incapacidad</a><br>
      </div>
   </td>
</tr>

</table>

</html>
