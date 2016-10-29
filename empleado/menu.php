<html>

<LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
<img src="image/empresas.png" title="Administrar Empleados">
<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
         <a href="empleado/agregar.php">Agregar un Empleado</a> <br>
         <a href="empleado/modificar.php">Modificar un Empleado</a><br>
		  <a href="empleado/MenuTrasladoEps.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>">Traslado de Administradora</a><br>
		  <a href="empleado/menudetalle.php">Detalle Empleado</a><br>
          <a href="empleado/talladotacion.php">Agregar tallas</a><br>
           <a href="empleado/modificartalla.php">Modificar tallas</a><br>
           <a href="empleado/parametro.php">Parámetros de Facturación</a><br>
          <a href="empleado/MenuDocumento.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>">Entrega Documentos</a><br> 
      </div>
   </td>
</tr>

</table>
</html>
