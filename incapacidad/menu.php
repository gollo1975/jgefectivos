<html>
<img src="../image/empresas.png" title="Administrar empresas">
<LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">  

<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
         <a href="agregar.php?codigo=<?echo $codigo;?>">Agregar Incapacidad</a> <br>
         <a href="modificar.php">Modificar Incapacidad</a><br>
          <a href="MenuLicencia.php?codigo=<?echo $codigo;?>">Licencias</a><br> 
         <a href="agregarmotivo.php">Crear grupo</a><br>
          <a href="modificargrupo.php">Modificar rupo</a><br>
         <a href="menupago.php">Pago de Incapacidad</a><br>
         <a href="listadoincapacidad.php">Descargar Incapacidad</a><br>
         <a href="seguimiento.php">Seguimiento Incapacidad</a><br>      
      </div>
   </td>
</tr>

</table>

</html>
