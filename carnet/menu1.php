<html>
<img src="image/consultas.png" title="Administrar Carnets">

<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
         <a href="carnet/consulta.php?codigo=<?echo $codigo;?>">Invidual</a> <br>
         <?
         if($codigo==0):
            ?>
            <a href="carnet/zona.php">Zona</a> <br>
         <?
         else:
         endif;
         ?>

        </div>
   </td>
</tr>
</table>

</html>
