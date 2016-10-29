
<html>
<LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
<img src="image/empresas.png" title="Procesos Disciplinarios">

<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
     </div>
      <div class="itemmenu">
         <?if($admon!=''):
           ?>
            <a href="memorando/agregar.php?admon=<?echo $admon;?>">Crear Memorando</a> <br>
            <a href="memorando/ModificarRegistro.php?admon=<?echo $admon;?>">Modificar Registro</a> <br>
            <a href="memorando/Renuncias.php?admon=<?echo $admon;?>">Seguimiento X Renuncias</a> <br>
            <a href="memorando/MenuMaestro.php">Maestro Disciplinario</a> <br>
           <?
           endif;
            if($Sdepto > 0):
               ?>
               <a href="memorando/agregar.php?Sdepto=<?echo $Sdepto;?>">Crear Memorando</a> <br>
               <a href="memorando/Renuncias.php?Sdepto=<?echo $Sdepto;?>">Seguimiento X Renuncias</a> <br>
             <?
            endif;
            if($Szona != 0):
            ?>
               <a href="memorando/agregar.php?Szona=<?echo $Szona;?>">Crear Memorando</a> <br>
               <a href="memorando/Renuncias.php?Szona=<?echo $Szona;?>">Seguimiento X Renuncias</a> <br>
            <?
            endif;
            ?>
      </div>
   </td>
</tr>

</table>

</html>

