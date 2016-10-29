<html>
<img src="../image/empresas.png" title="Archivo maestro de Nomina">
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
        <a href="nomina.php?Auxiliar=<?echo $Auxiliar;?>">Crear Nomina</a><br>
         <a href="Actualizar.php">Actualizar Información</a><br>
        <a href="CrearNovedad.php?Auxiliar=<?echo $Auxiliar;?>">Crear Novedad</a><br>
        <a href="ModificarNovedad.php?Auxiliar=<?echo $Auxiliar;?>">Modificar Novedad</a><br>
        <a href="modificarnomina.php">Modificar Colilla</a><br>
        <a href="abrirproceso.php?Auxiliar=<?echo $Auxiliar;?>">Abrir Proceso</a><br>
        <a href="Cerrar.php?Auxiliar=<?echo $Auxiliar;?>">Cerrar Proceso</a><br>
        <a href="../facturar/modificarfacturaparafiscal.php">Factura Servicio</a><br>
      </div>
   </td>
</tr>

</table>

</html>
