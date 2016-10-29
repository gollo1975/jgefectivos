<html>
<head>
<title>Generando Prestaciones</title>
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
                    //    document.getElementById("matvaca").submit();


</script>
</head>
<body>
<?
include("../conexion.php");
$xbusca="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,contrato.fechainic,contrato.salario,zona.codzona from empleado,contrato,zona
        where empleado.codzona=zona.codzona and
		      empleado.codemple=contrato.codemple and
              contrato.fechater='0000-00-00' and
              contrato.contrato='$codigo'";
$resul=mysql_query($xbusca)or die("Error de Consulta ..");
$reg=mysql_num_rows($resul);
if($reg!=0):
  while($filas=mysql_fetch_array($resul)):
   ?>
   <center><h4><u>Crear Vacaciones </u></h4></center>
   <form action="generarvaca.php" method="post" name="vacacion" id="vacacion">
   <td><input type="hidden" name="salario" value="<?echo $salario;?>"><td>
   <td><input type="hidden" name="CodZona" value="<?echo $filas["codzona"];?>" id="CodZona"><td>
   <table border="0" align="center" width="300">

         <tr>
         <td><b>Cedula:</b></td>
         <td colspan="1"><input type="text" name="Cedula" value="<? echo $filas["cedemple"];?>"class="cajas" size="13"readonly></td>
          <td><b>Salario:</b></td>
         <td><input type="text" name="Salario" value="<? echo $filas["salario"];?>"class="cajas" size="13" readonly></td>
       </tr>
       <tr>
         <td><b>Empleado:</b></td>
         <td colspan="3"><input type="text" name="Nombre" value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>" class="cajas"size="44" maxlength="44" readonly></td>
       </tr>
       <tr>
         <td><b>F_Proceso:</b></td>
         <td colspan="1"><input type="text" name="fechap" value="<? echo date("Y-m-d");?>"class="cajas" size="13" maxlength="10" readonly></td>
         <td><b>F_Inicio:</b></td>
         <td><input type="text" name="fechai" value="<? echo $filas["fechainic"];?>"class="cajas" size="13" maxlength="10" id="fechai"></td>
       </tr>
       <tr>
         <td><b>F_Retiro:</b></td>
         <td colspan="1"><input type="text" name="fechac" value="<? echo date("Y-m-d");?>" class="cajas" size="13" maxlength="10" id="fechac"></td>
         <td><b>F_Inic_Nómina:</b></td>
         <td><input type="text" name="inicion" value="<? echo $filas["fechainic"];?>"class="cajas" size="13" maxlength="10" id="inicion" ></td>
       </tr>
       <tr>
         <td><b>F_Final_Nomina:</b></td>
         <td colspan="1"><input type="text" name="FinalNomina" value="<? echo date("Y-m-d");?>"class="cajas" size="13" maxlength="10"></td>
       </tr>
       <tr>
         <td><b>Tipo_Proceso:</b></td>
         <td colspan="10"><input type="radio" value="Normal"  name="EstadoVal">Normal<input type="radio" value="Especial"  name="EstadoVal">Especial</td>
       </tr>
       <tr>
         <td><b>G_Deduccion:</b></td>
         <td colspan="10"><input type="radio" value="NO"  name="G_Deduccion">NO<input type="radio" value="SI"  name="G_Deduccion">SI</td>
       </tr>
       <tr><td><br></td></tr>
      <tr>
         <td><input type="submit" value="Generar" class="boton"></td>
      </tr>
       </table>
   </form>
   <?
  endwhile;
else:
  ?>
   <script language="javascript">
     alert("El contrato esta Cerrado en Sistema ?")
     history.back()
     </script>
  <?
endif;

?>
</body>
</html>
