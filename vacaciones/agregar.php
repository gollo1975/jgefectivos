<html>
<head>
<title>Generando Vacaciones</title>
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
                    function calcular()
                    {
                        xibc = 0;
                        xdia = 0;
                        totaldia = 0;
                        totalvaca = 0;
                        xibc = document.getElementById("salario").value;
                        xdia = document.getElementById("dias").value;
                        totaldia = (xdia * 15)/360;
                        totalvaca = (xibc / 30)* totaldia;
                         document.getElementById("valor").value = totalvaca.toFixed(0);
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
 ?>
   <center><h4>Crear Vacaciones </h4></center>
   <form action="guardar.php" method="post" id="matvaca">
     <table border="0" align="center" width="300">
     <tr><td><br></td></tr>
         <tr>
         <td><b>Cedula:</b></td>
         <td><input type="text" name="cedula" value="<? echo $cedula;?>"class="cajas" size="13" maxlength="13"></td>
         <td><b>Salario:</b></td>
         <td colspan="1"><input type="text" name="salario" value="<? echo $salario;?>"  class="cajas" size="13" maxlength="13"></td>
       </tr>
       <tr>
         <td><b>Empleado:</b></td>
         <td colspan="3"><input type="text" name="nombres" value="<? echo $nombre;?>&nbsp;<? echo $nombre1;?>&nbsp;<? echo $apellido;?>&nbsp;<? echo $apellido1;?>" class="cajas"size="45" maxlength="45"></td>
       </tr>
       <tr>
         <td><b>Fecha_Proceso:</b></td>
         <td colspan="1"><input type="text" name="fechap" value="<? echo date("Y-m-d");?>"class="cajas" size="13" maxlength="10" readonly></td>
         <td><b>Fecha_Inicio:</b></td>
         <td><input type="text" name="fechai" value="<? echo $fechai;?>"class="cajas" size="13" maxlength="10" readonly></td>
       </tr>
       <tr>
         <td><b>Fecha_Corte:</b></td>
         <td colspan="1"><input type="text" name="fechac" value="<? echo $fechac;?>" class="cajas" size="13" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechac"></td>
         <td><b>Dias:</b></td>
         <td><input type="text" name="dias" value="<? echo $dia;?>" class="cajas" size="13" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dias"></td>
       </tr>
       <tr>
         <td><b>Salario:</b></td>
         <td colspan="1"><input type="text" name="ibc" value="<? echo $ibc;?>" class="cajas" size="13" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="ibc"></td>
         <td><b>Vlr_Pagado:</b></td>
         <td><input type="text" name="valor" value="" class="cajas" size="13" maxlength="11"  onfocus="calcular()"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="valor"></td>
       </tr>
       <tr>
         <td><b>Observación:</b></td>
         <td colspan="5"><textarea  name="nota" cols="45" rows="4" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"></textarea></td>
        </tr>
       <tr><td><br></td></tr>
      <tr>
         <td><input type="button" value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" value="limpiar" class="boton"></td>
      </tr>
       </table>
   </form>
</body>
</html>
