<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if(!isset($Desde)){
  ?>	
   <center><h4><u>Incapacides Generales</u></h4></center>
   <form action="" method="post" id="f1">
        <table border="0" align="center" width="220" >
            <tr><td><br></td></tr>
         <tr>
			<td><b>Desde:</b></td>
			<td><input type="text" name="Desde" value="<? echo date("Y-m-d");?>" size="12" maxlength="10" id="Desde" class="cajas"></td>
			<td><b>Hasta:</b></td>
			<td><input type="text" name="Hasta" value="<? echo date("Y-m-d");?>" size="12" maxlength="10" id="Hasta" class="cajas"></td>
		  </tr>
		  <tr><td><br></td></tr>
        <tr>
          <td colspan="5"><input type="submit" value="Buscar" class="boton" id="buscar">
        </td></tr>
	</table>
 </form>
<?
}else{
?>
<center><h4><u>Incapacides Generales</h4></center>
<form action="" method="post">
  <table border="0" align="center" width="220">
    <tr>
    <tr><td><br></td></tr>
        <?
        include("../conexion.php");?>
        <td colspan="5"><b>Empresa:&nbsp;</b></td><td><select name="select" onChange="location.href=this.value" class="cajas">
        <option>Seleccione la empresa</option>
        <?$con="select codmaestro,nomaestro from maestro  ";
        $resu=mysql_query($con)or die("Error de busqueda de incapacidades");
        while($filas=mysql_fetch_array($resu)):
        ?>
           <option value="auxiliargeneral.php?Nit=<? echo $filas["codmaestro"];?>&Desde=<?echo $Desde;?>&Hasta=<?echo $Hasta;?>"><?echo $filas["nomaestro"];?>
		<?
        endwhile;
		?>
        </select></td>
       </tr>
           <tr><td><br></td></tr>
     </table>
   </form>
<?}?>   
</body>
</html>


