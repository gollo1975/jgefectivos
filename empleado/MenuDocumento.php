<html>

<LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
<img src="../image/empresas.png" title="Entrega de Documentos">
<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
          <a href="CrearRequisito.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>">Verificar Documentos</a><br>
          <a href="EditarRequisito.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>">Editar Documentos</a><br>
          <a href="ListarDocumento.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>">Listar Documentos</a><br>
      </div>
   </td>
</tr>

</table>
</html>
