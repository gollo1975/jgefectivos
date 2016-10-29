<html>
<head>
<title>Generando Vacaciones</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">
     function calcular()
                    {
                        var xibc = 0;
                        var xdia = 0;
                        var totaldia = 0;
                        var totalvaca = 0;
                        xibc = document.getElementById("ibc").value;
                        xdia = document.getElementById("dias").value;
                        totaldia = (xdia * 15)/360;
                        totalvaca = (xibc / 30)* totaldia;
                        document.getElementById("valor").value = totalvaca.toFixed(0);
                    }
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
                        if (document.getElementById("dias").value.length <=0)
                        {
                            alert ("El campo DIAS no puede estar vacio");
                            document.getElementById("dias").focus();
                            return;
                        }
                        if (document.getElementById("ibc").value.length <=0)
                        {
                            alert ("El campo SALARIO no puede Estar Vacio ?");
                            document.getElementById("ibc").focus();
                            return;
                        }
                         if (document.getElementById("valor").value.length <=0)
                        {
                            alert ("El campo VRL PAGADO no puede Estar Vacio ?");
                            document.getElementById("valor").focus();
                            return;
                        }
                         document.getElementById("matvaca").submit();

         }
</script>
</head>
<body>
<?
include("../conexion.php");
$xbusca="select vacacion.*, empleado.basico from vacacion inner join empleado on vacacion.cedemple = empleado.cedemple where vacacion.codvaca='$codvaca'";
$resul=mysql_query($xbusca)or die("Error de Consulta ..");
$reg=mysql_num_rows($resul);
$filas=mysql_fetch_array($resul);
 ?>
   <center>
     <h4><u>Modificar Vacaciones</u> </h4>
   </center>
   <form action="guardarmodificacion.php" method="post" name"primero" id="matvaca">
     <table border="0" align="center" width="300">
     <tr><td><br></td></tr>
         <tr>
         <td><b>Cedula:</b></td>
         <td><input type="text" name="cedula" value="<? echo $filas["cedemple"];?>" class="cajas" size="13" maxlength="13">
		 <input type="hidden" name="codvaca" value="<? echo $codvaca;?>" id="codvaca"class="cajas" size="13" maxlength="13"></td>
         <td><b>Sal_Actual:</b></td>
         <td colspan="1"><input type="text" name="salario" id = "salario" value="<? echo $filas["basico"];?>"  class="cajas" size="13" maxlength="13"></td>
       </tr>
       <tr>
         <td><b>Empleado:</b></td>
         <td colspan="3"><input type="text" name="nombres" value="<? echo $filas["nombre"];?>" class="cajas"size="47"></td>
       </tr>
       <tr>
         <td><b>Fecha_Proceso:</b></td>
         <td colspan="1"><input type="text" name="fechap" value="<? echo $filas["fechap"];?>"class="cajas" size="13" maxlength="10" readonly></td>
         <td><b>Fecha_Inicio:</b></td>
         <td><input type="text" name="fechai" value="<? echo $filas["fechai"];?>"class="cajas" size="13" maxlength="10"></td>
       </tr>
       <tr>
         <td><b>Fecha_Corte:</b></td>
         <td colspan="1"><input type="text" name="fechac" value="<? echo $filas["fechac"];?>" class="cajas" size="13" maxlength="10" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="fechac"></td>
         <td><b>Dias:</b></td>
         <td><input type="text" name="dias" value="<? echo $filas["dias"];?>" class="cajas" size="13" maxlength="11" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="dias"></td>
       </tr>
       <tr>
         <td><b>Ibc_Pago:</b></td>
         <td colspan="1"><input type="text" name="ibc" value="<? echo $filas["ibc"];?>" class="cajas" size="13" maxlength="11" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="ibc"></td>
         <td><b>Vlr_Pagado:</b></td>
         <td><input type="text" name="valor" value="<? echo $filas["valor"];?>" class="cajas" size="13" maxlength="11"  onfocus="calcular()"  onblur="QuitarFoco(this.id)" id="valor"></td>
       </tr>
      <tr>
         <td><b>Deducción:</b></td>
          <td><input type="radio" value="NO"  name="Deduccion"><font color="red">NO</font><input type="radio" value="SI"  name="Deduccion"><font color="blue">SI</font></td>
      </tr>
       <tr>
         <td><b>Observación:</b></td>
         <td colspan="5"><textarea  name="nota" cols="45" rows="4" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nota"><? echo $filas["nota"];?></textarea></td>
        </tr>
       <tr><td><br></td></tr>
      <tr>
         <td><input type="button" value="Guardar" class="boton" onClick="chequearcampos()"></td>
      </tr>
       </table>
   </form>
</body>
</html>
