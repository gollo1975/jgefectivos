<html>
<LINK  REL="stylesheet" HREF="../estilo.css" type="text/css"> 
<img src="image/empresas.png" title="Administrar Examenes">

<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         �Qu� desea hacer?
      </div>
      <div class="itemmenu">
         <a href="examen/crear.php?CodUsuario=<?echo $CodUsuario;?>">Crear Examen</a> <br>
         <a href="examen/ModificarRegistro.php?CodUsuario=<?echo $CodUsuario;?>">Modificar Registro</a> <br>
	 <a href="examen/ValidarExamen.php?CodUsuario=<?echo $CodUsuario;?>">Validar Examen</a> <br>
          <a href="examen/MenuRestriccion.php?CodUsuario=<?echo $CodUsuario;?>">Restricci�n Mecica</a> <br> 
         <a href="examen/ModificarProveedor.php?CodUsuario=<?echo $CodUsuario;?>">Modificar_Proveedor_Zona</a> <br>
         <a href="examen/descargar.php">Subir relaci�n</a> <br>
         <a href="examen/subir.php">Recibo de Control[N�mina]</a><br>
         <a href="examen/subirplanta.php">Recibo de Control</a><br>
         <a href="examen/MenuAuditoria.php">Auditoria de Examenes</a><br> 
      </div>
   </td>
</tr>

</table>

</html>
