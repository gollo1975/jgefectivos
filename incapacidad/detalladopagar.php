<html>

<head>
  <title>Pagar Incapacidad</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
   <script language="javascript">
      function calcular()
        {
        x1 = 0;
        x2 = 0;
        x3 = 0;
        x4 = 0;
        x5 = 0;
        x1 = document.getElementById("diaspagar").value;
        x2 = document.getElementById("porcentaje").value;
        x3 = document.getElementById("ibc").value;
        x4 = (x1 * x3);
        x5 = (x4 * x2)/100;
        document.getElementById("pagado").value = x5.toFixed(0);
        }
  </script>
</head>

<body>
<?
include("../conexion.php");
$cons="select incapacidad.*,tipoinca.concepto,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1
from incapacidad,empleado,tipoinca
where empleado.cedemple=incapacidad.cedemple and
tipoinca.tipoinca=incapacidad.tipoinca and
incapacidad.pagada='' and
incapacidad.nroinca='$codigo'";
$resu=mysql_query($cons)or die ("Error de Consulta $cons");
$reg=mysql_num_rows($resu);
if($reg!=0):
  while($filas=mysql_fetch_array($resu)):
  ?>
   <center><h4><u>Pagar Incapacidad</u></h4></center>
          <form action="grabarpago.php" method="post" width="200">
           <table border="0" align="center">
             <tr><td><br></td></tr>  
            <tr>
                <td><b>Nro_Incapacidad:</b></td>
               <td><input type="text" name="numero" value="<? echo $filas["nroinca"];?>"class="cajas" size="15" maxlenght="15" readonly></td>
             </tr>
             <tr>
                <td><b>Documento:</b></td>
               <td><input type="text" name="cedula" value="<? echo $filas["cedemple"];?>"class="cajas" size="15" maxlenght="15" readonly></td>
             </tr>
             <tr>
                <td><b>Empleado:</b></td>
               <td colspan="20"><input type="text" name="nombre" value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>" class="cajas"size="48" maxlenght="45" readonly></td>
             </tr>
             <tr>
               <td><b>Fecha_Inicio:</b></td>
               <td ><input type="text" name="fechai" value="<? echo $filas["fechaini"];?>" class="cajas"size="13" maxlenght="10" readonly></td>
               <td><b>Fecha_Ter.:</b></td>
               <td colspan="1"><input type="text" name="fechat" value="<? echo $filas["fechater"];?>" class="cajas"size="13" maxlenght="10" readonly></td>
             </tr>
             <tr>
               <td><b>Descripción:</b></td>
               <td ><input type="text" name="concepto" value="<? echo $filas["concepto"];?>" class="cajas"size="30" maxlenght="30" readonly></td>
               <td><b>Dias:</b></td>
               <td colspan="1"><input type="text" name="dia" value="<? echo $filas["dias"];?>" class="cajas" size="3" maxlenght="3" readonly></td>
             </tr>
             <tr>
               <td><b>Dias_Pagar</b></td>
               <td ><input type="text" name="diaspagar" value="" class="cajas"size="4" maxlenght="4"></td>
               <td><b>% Pago:</b></td>
               <td colspan="1"><input type="text" name="porcentaje" value="" class="cajas" size="10" maxlenght="10"></td>
             </tr>
             <tr>
               <td><b>Ibc:</b></td>
               <td ><input type="text" name="ibc" value="" class="cajas" size="11" maxlenght="11"></td>
               <td><b>Vlr_Pagado:</b></td>
               <td ><input type="text" name="pagado" value="" class="cajas" size="11" maxlenght="11" onfocus="calcular()"></td>
             </tr>
             <tr>
              <td><b>Nota:</b></td>
               <td colspan="5"><textarea  name="nota" cols="59" rows="5" class="cajas"></textarea></td>
              </tr>
             <tr><td><br></td></tr>
             <tr>
               <td colspan="5">
                  <input type="submit" value="Guardar Dato" class="boton"></td>
             </tr>
           </table>
         </form>
         <?
endwhile;
 $fecha=date("Y-m-d");
else:
  ?>
    <script language="javascript">
      alert("La incapacidad ya se fue pagada a este Empleado? ")
      history.back()
    </script>
  <?
endif;

?>
</body>
</html>
