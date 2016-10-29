<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }

                 </script>
</head>
<body>
<?php
if(!isset($Desde)){
?>
   <center><h4><u>Vinculacion por Funcionario</u></h4></center>
   <form action="" method="post">
       <table border="0" align="center" id="f1">
	    <tr>
	    <tr><td><br></td></tr>
	    <tr>
	         <td><b>Desde:&nbsp;</b></td>
	         <td><input type="text" name="Desde" value="<?echo date('Y-m-d');?>" size="14" maxlength="10" onfocus="ColorFoco(this.id)"class="cajas" onblur="QuitarFoco(this.id)" id="Desde">&nbsp;</td>
	    </tr>
	    <tr>
	         <td><b>Hasta:&nbsp;</b></td>
	         <td><input type="text" name="Hasta" value="<?echo date('Y-m-d');?>" size="14" maxlength="10" onfocus="ColorFoco(this.id)" class="cajas" onblur="QuitarFoco(this.id)" id="Hasta">&nbsp;</td>
	   </tr>
	           <tr><td><br></td></tr>
	    <tr><td colspan="5"><input type="submit" Value="Buscar" class="boton" id="buscar"></td></tr>
     </table>
   </form>
<?
}else{
    ?>
    <center><h4><u>Vinculacion por Funcionario</u></h4></center>
    <form action="" method="post">
	  <table border="0" align="center" width="300">
	    <tr>
	    <tr><td><br></td></tr>
              <?
	        include("../conexion.php");?>
	        <td><b>Funcionario:</b></td><td><select name="select" onChange="location.href=this.value" class="cajas">
	        <option>Seleccione</option>
	        <?$con="select acceso.nombre,acceso.usuario from acceso,departamentoempleado  where
 			        acceso.codigo=departamentoempleado.codigo order by acceso.nombre";
	        $resu=mysql_query($con)or die("Error de busqueda");
	        while($filas=mysql_fetch_array($resu)):
	        ?>
	           <option value="DetalleVinculacion.php?NroC=<?echo $filas["usuario"];?>&Desde=<?echo $Desde;?>&Hasta=<?echo $Hasta;?>"><?echo $filas["nombre"];?>
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
