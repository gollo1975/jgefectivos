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
                alert ("Digite el Documento del Empleado.");
                document.getElementById("cedemple").focus();
                return;
           }
             document.getElementById("f1").submit();
       }
</script>
     <?
if (!isset($cedemple)){
    ?>
    <center><h4><u>Cobro de Examenes Medicos</u></h4></center>
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
   $con="select derelacionexamen.*,relacionexamen.zona,relacionexamen.fechap from derelacionexamen,relacionexamen
   where  derelacionexamen.radicado=relacionexamen.radicado and
          derelacionexamen.cedemple='$cedemple' order by derelacionexamen.radicado DESC ";
   $resu=mysql_query($con)or die ("Error al buscar cobros de examenes.");
   $reg=mysql_num_rows($resu);
   if($reg!=0){?>
         <center><h4><u>Información Encontrada</u></h4></center>
         <form action="" method="post" id="f2" name="f2">
              <table border="0" align="center">
  	          <tr class="cajas">
                   <th>Item</th>
         	     <th>Nro_Exam.</th>
	             <th>Documento</th>
		     <th>Empleado</th>
                     <th>F_Cobro</th>
                     <th>Vlr_Cobrado</th>
                      <th>Zona</th>
		  </tr>
	          <?
	          $i=1;
	          while($filaP=mysql_fetch_array($resu)){
                       $Documento=number_format($cedemple,0);
                       $Valor=number_format($filaP["valor"],0);
                       ?>
	                  <tr class="cajas">
		             <th><?echo $i;?></th>
			    <td><?echo $filaP["nro"];?></a></td>
                            <td><?echo $Documento;?></td>
                            <td><?echo $filaP["empleado"];?></td>
                            <td><?echo $filaP["fechap"];?></td>
                            <td><div align="right"><?echo $Valor;?></div></td>
                            <td><?echo $filaP["zona"];?></div></td>
			  <tr>
			  <?
			  $i=$i+1;
	          }
	          ?>

            </table>
                 
         <form>
              <tr><td><br></td></tr>
             <div align="center"><a href="ConsultaExamenCobrado.php"<b><font color="red"><h4>Nueva_Consulta</h4></font></b></a></div>
   <?}else{
        ?>
         <script language="javascript">
          alert("No hay cobros de examenes para este empleado.!")
          history.back()
         </script>
         <?
   }
}
?>
</body>
</html>
