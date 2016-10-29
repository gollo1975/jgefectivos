<html>
<?
$opcion1= $_GET['op1'];
if (trim($opcion1)== "")
{

?>
<br><br><br>
<center>
<table class="tabla_botones" cellspacing=10>
<tr>
   <td>
      <?echo ("<a href=\"menu.php?op=$opcion&op1=admemp\">");?>
      <img src="image/empresas.png" title="Administrar empresas">
      </a>
   </td>
   <td>
      <?echo ("<a href=\"menu.php?op=$opcion&op1=conemp\">");?>
      <img src="image/consultas.png" title="Consultas">
      </a>
   </td>
   <td>
      <?echo ("<a href=\"menu.php?op=$opcion&op1=repemp\">");?>
      <img src="image/reportes.png" title="Reportes">
      </a>
   </td>
</tr>
<tr>
   <td>
      <center><font color="green"><b>Empresas</b></font></center>
   </td>
   <td>
      <center><font color="green"><b>Consultas</b></font></center>
   </td>
   <td>
      <center><font color="green"><b>Reportes</b></font></center>
   </td>
</tr>
</table>
</center>
<?
}
else
{
//Si opcion1 tiene algún valor, continua aqui...
?>
<img src="image/empresas.png" title="Administrar empresas">

<table width=20%>
<tr>
   <td>
      <div class="lbmenu">
         ¿Qué desea hacer?
      </div>
      <div class="itemmenu">
         <a href="maestro/agregar.php">Agregar una Empresa</a> <br>
         <a href="maestro/modificar.php">Modificar una Empresa</a><br>
      </div>
   </td>
</tr>

</table>

<?
}
?>
</html>
