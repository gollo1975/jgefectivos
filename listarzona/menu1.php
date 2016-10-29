<html>
<img src="image/consultas.png" title="Administrar Zonas">

<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
        <a href="listarzona/listado1.php">Buscar Zona</a> <br>
        <?if ($Usuario=='ADMINISTRADOR'):?>
           <a href="listarzona/ConContrato.php">Contratos Empresas</a> <br>
		    <a href="listarzona/ConsultaCotizacion.php">Cotizaciones </a> <br>
        <?endif;?>   
      </div>
   </td>
</tr>

</table>

</html>
