<html>
<head>
                <title>Actualizar Estado</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
<script language="javascript">
    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
    function enviar()
        {
        if (document.getElementById("cedemple").value.length <=0)
           {
                alert ("Digite el Documento del Empleado para auditar el examen!.");
                document.getElementById("cedemple").focus();
                return;
           }
             document.getElementById("f1").submit();
       }
</script>
     <?
if (!isset($cedemple)){
    ?>
    <center><h4><u>Actualizar Estado</u></h4></center>
    <form action="" method="post" id ="f1" name="f1">
          <table border="0" align="center"
          <tr><td><br></td></tr>
          <tr>
          <td><b>Documento de identidad:</b></td>
          <td><input type="text" name="cedemple" value="" size="15" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
          </tr>
          <tr><td><br></td></tr>
          <tr><td ><input type="button" Value="Buscar" class="boton" onclick="enviar()" id="buscar" name="buscar"></td></tr>
       </table>
   </form>
<?
}else{
   include("../conexion.php");
   $con="select dexamen.*,examen.costoe from dexamen,examen
   where  examen.nro=dexamen.nro and
          examen.cedula='$cedemple'";
   $resu=mysql_query($con)or die ("Error al buscar datos del examen.");
   $reg=mysql_num_rows($resu);
   if($reg!=0){?>
         <center><h4><u>Actualizar Estado de Examen</u></h4></center>
         <form action="" method="post" id="f2" name="f2">
              <table border="0" align="center" width="700">
  	          <tr class="cajas">
                   <th>Item</th>
		      <th>Reg.</th>
		     <th>Nro_Exam.</th>
	             <th>Documento</th>
		     <th>Empleado</th>
		     <th>Estado</th>
		     <th>Vlr_Cobro_Prove</th>
                     <th>Vlr_Cobro_Zona</th>
		  </tr>
	          <?
	          $i=1;
	          while($filaP=mysql_fetch_array($resu)){
                       $Documento=number_format($cedemple,0);
                       $Valor1=number_format($filaP["vlrexamen"],0);
                       $Valor2=number_format($filaP["costoe"],0);
                        ?>
	                  <tr class="cajas">
		             <th><?echo $i;?></th>
			    <td><a href ="DetalleA.php?NroC=<?echo $filaP["conse"];?>&NroE=<?echo $filaP["nro"];?>&Empleado=<?echo $filaP["asociado"];?>&ValorP=<?echo $filaP["vlrexamen"];?>&ValorZ=<?echo $filaP["costoe"];?>&Documento=<?echo $cedemple;?>&EstadoA=<?echo $filaP["estado"];?>"><?echo $filaP["conse"];?></a></td>
                            <td><?echo $filaP["nro"];?></td>
                            <td><?echo $Documento;?></td>
                            <td><?echo $filaP["asociado"];?></td>
							 <td><div align="center"><?echo $filaP["estado"];?></div></td>
                            <td><div align="center"><?echo $Valor1;?></div></td>
                            <td><div align="center"><?echo $Valor2;?></div></td>
			  <tr>
			  <?
			  $i=$i+1;
	          }
	          ?>

            </table>
                 
         <form>
              <tr><td><br></td></tr>
             <div align="center"><a href="ActualizarEstado.php"<b><font color="red"><h4>Nueva_Consulta</h4></font></b></a></div>
   <?}else{
        ?>
         <script language="javascript">
          alert("Este empleado no se le puede hacer actualizar el estado por que no tiene relacion de Entidades!")
          history.back()
         </script>
         <?
   }
}
?>
</body>
</html>
