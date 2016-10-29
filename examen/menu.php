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
         <a href="examen/crear.php?CodUsuario=<?echo $CodUsuario;?>">Crear Examen</a> <br>
         <a href="examen/ModificarRegistro.php?CodUsuario=<?echo $CodUsuario;?>">Modificar Registro</a> <br>
	 <a href="examen/ValidarExamen.php?CodUsuario=<?echo $CodUsuario;?>">Validar Examen</a> <br>
          <a href="examen/MenuRestriccion.php?CodUsuario=<?echo $CodUsuario;?>">Restricción Mecica</a> <br> 
         <a href="examen/ModificarProveedor.php?CodUsuario=<?echo $CodUsuario;?>">Modificar_Proveedor_Zona</a> <br>
         <a href="examen/descargar.php">Subir relación</a> <br>
         <a href="examen/subir.php">Recibo de Control[Nómina]</a><br>
         <a href="examen/subirplanta.php">Recibo de Control</a><br>
         <a href="examen/MenuAuditoria.php">Auditoria de Examenes</a><br> 
      </div>
   </td>
</tr>

</table>

</html>
