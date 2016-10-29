<html>
<img src="image/empresas.png" title="Administrar contratos laborales">

<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
           <a href="contrato/convenio.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>&codigo=<?echo $codigo;?>">Contrato Temporal</a><br>
           <a href="contrato/ModificarConvenioCarta.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>&codigo=<?echo $codigo;?>">Modificar Contrato</a><br>
		   <a href="contrato/EntregaDocumento.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>&codigo=<?echo $codigo;?>">Entrega Documentos</a><br>
		    <a href="contrato/AutorizacionDescuento.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>">Autorización descuento</a><br>
			<a href="contrato/CartaPresentacion.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>">Carta Presentación</a><br>
			<a href="empleado/MenuTrasladoEps.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>">Traslado de Administradora</a><br>
      </div>
   </td>
</tr>

</table>

</html>
