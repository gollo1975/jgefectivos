<html>

<head>
  <title>Descargar Incapacidad</title>
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

                    function chequearcampos()
                    {
                        if (document.getElementById("documento").value.length <=0)
                        {
                            alert ("El campo Documento de pago no puede estar vacío");
                            document.getElementById("documento").focus();
                            return;
                        }
                        if (document.getElementById("valor").value.length <=0)
                        {
                            alert ("El campo Valor Pagado no puede estar vacío");
                            document.getElementById("valor").focus();
                            return;
                        }
                         document.getElementById("matdescarga").submit();
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
incapacidad.nroinca='$codigo'";
$resu=mysql_query($cons)or die ("Error de Consulta $cons");
$reg=mysql_num_rows($resu);
while($filas=mysql_fetch_array($resu)):
  ?>
   <center><h4><u>Descargar Incapacidad</u></h4></center>
          <form action="grabardescarga.php" method="post" width="200" id="matdescarga">
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
               <td colspan="1"><input type="text" name="fechat" value="<? echo $filas["fechater"];?>" class="cajas"size="11" maxlenght="11" readonly></td>
             </tr>
             <tr>
               <td><b>Descripción:</b></td>
               <td ><input type="text" name="concepto" value="<? echo $filas["concepto"];?>" class="cajas"size="30" maxlenght="30" readonly></td>
               <td><b>Dias:</b></td>
               <td colspan="1"><input type="text" name="dia" value="<? echo $filas["dias"];?>" class="cajas" size="3" maxlenght="3" readonly></td>
             </tr>
             <tr>
               <td><b>Documento:</b></td>
               <td ><input type="text" name="documento" value="" class="cajas"size="11" maxlenght="11"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="documento"></td>
                <td><b>Fecha_Proceso:</b></td>
               <td colspan="1"><input type="text" name="fechap" value="<? echo date("Y-m-d");?>" class="cajas" size="11" maxlenght="11"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechap"></td>
             </tr>
             <tr>
               <td><b>Dias_Pagado:</b></td>
               <td ><input type="text" name="diaspagado" value="" class="cajas"size="4" maxlenght="4"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="diaspagado"></td>
                <td><b>Vlr_Pagado:</b></td>
               <td colspan="1" ><input type="text" name="valor" value="" class="cajas" size="11" maxlenght="11"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="valor"></td>
             </tr>
             <tr>
                <td><b>Tipo_Pago:</b></td>
               <td><select name="tipo" class="cajasletra">
                  <option value="0">Seleccion en tipo de pago
                  <option value="CANCELADA">CANCELADA
                  <option value="POR COBRAR">POR COBRAR
                  </select></td>

             </tr>
             <tr>
              <td><b>Nota:</b></td>
               <td colspan="5"><textarea  name="nota" cols="59" rows="5" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"></textarea></td>
              </tr>
             <tr><td><br></td></tr>
             <tr>
               <td colspan="5">
                  <input type="button" value="Guardar Dato" class="boton" onclick="chequearcampos()"></td>
             </tr>
           </table>
         </form>
         <?
endwhile;
?>
</body>
</html>
