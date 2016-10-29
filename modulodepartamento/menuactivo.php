<html>
<img src="image/empresas.png" title="Empleados activos">
<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
          <a href="modulodepartamento/empleadoindividual.php?codigo=<?echo $codigo;?>">Individual</a> <br>  
         <a href="modulodepartamento/listadoempleado.php?codigo=<?echo $codigo;?>">Zona</a> <br>
         <a href="modulodepartamento/aportesocial.php?codigo=<?echo $codigo;?>">Aporte social</a> <br>
         <a href="contrato/listadoconveniodepto.php">Contrato Temporal</a> <br>
		 <a href="empleado/ConsultaChequeo.php">Check de Lista</a><br>
		 <a href="consulta/DetalladoMaestroDocumento.php?codigo=<?echo $codigo;?>">Documento Maestro Empleado</a><br>
      </div>
   </td>
</tr>

</table>

</html>
