<html>
<LINK  REL="stylesheet" HREF="../estilo.css" type="text/css"> 
<img src="image/empresas.png" title="Administrar Examenes">

<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
         <a href="examen/crear.php?codigo=<?echo $codigo;?>&CodUsuario=<? echo $DatoUsuario;?>">Crear Examen</a> <br>
		 <a href="examen/ValidarExamen.php?CodUsuario=<?echo $DatoUsuario;?>">Validar Examen</a> <br>
      </div>
   </td>
</tr>

</table>

</html>
