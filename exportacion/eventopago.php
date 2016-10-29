<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>  
<?
if(!isset($Desde)){
  ?>	
   <center><h4><u>Incapacides por Evento</u></h4></center>
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
 </form >
<?
}else{
?>
<center><h4><u>Incapacides por Evento</u></h4></center>
   <form action="" method="post" id="f1">
      <input type="hidden" name="Desde" value="<? echo $Desde;?>"> 
	  <input type="hidden" name="Hasta" value="<? echo $Hasta;?>"> 
        <table border="0" align="center" width="220" >
            <tr><td><br></td></tr>	
     <tr>
        <?
        include("../conexion.php");?>
        <td><b>Evento:&nbsp;</b></td>
		<td colspan="4"><select name="select" onChange="location.href=this.value" class="cajas">
        <option>Seleccione el evento</option>
        <?$con="select tipoinca,concepto from tipoinca  order by concepto ";
        $resu=mysql_query($con)or die("Error de busqueda");
        while($filas=mysql_fetch_array($resu)):
        ?>
           <option value="auxiliarevento.php?codservicio=<? echo $filas["tipoinca"];?>&Desde=<?echo $Desde;?>&Hasta=<?echo $Hasta;?>"><?echo $filas["concepto"];?>
        <?
        endwhile;?>
        </select></td>
       </tr>
           <tr><td><br></td></tr>
     </table>
   </form>
 <?
}
?>	 
</body>
</html>


