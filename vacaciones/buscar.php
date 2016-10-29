<html>
<head>
<title>Generando Prestaciones</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 <script type="text/javascript"> 
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
$xbusca="select zona.zona,zona.codzona,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,contrato.fechainic from empleado,contrato,zona
        where  zona.codzona=empleado.codzona and
               empleado.codemple=contrato.codemple and
              contrato.contrato='$codigo' and
			  contrato.tiposalario='NORMAL'";
$resul=mysql_query($xbusca)or die("Error de Consulta ..");
$reg=mysql_num_rows($resul);
$filas=mysql_fetch_array($resul);
$CodZona=$filas["codzona"];
if($reg !=0 ):
   ?>
   <center><h4><u>Crear Prestaciones</u> </h4></center>
   <form action="generar.php" name="primero" method="post" id="primero">
   <td><input type="hidden" name="nombres" value="<? echo $nombre;?>"></td>
    <td><input type="hidden" name="Salario" value="<? echo $salario;?>"></td>
	<td><input type="hidden" name="CodZona" value="<? echo $CodZona;?>"></td>
     <table border="0" align="center" width="300">
         <tr>
         <td><b>Cedula:</b></td>
         <td colspan="3"><input type="text" name="Cedula" value="<? echo $filas["cedemple"];?>"class="cajas" size="13" maxlength="13" readonly id="Cedula"></td>
       </tr>
       <tr>
         <td><b>Empleado:</b></td>
         <td colspan="3"><input type="text" name="Nombre" value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>" class="cajas"size="50"  readonly></td>
       </tr>
         <tr>
         <td><b>Zona:</b></td>
         <td colspan="3"><input type="text" name="Zona" value="<? echo $filas["zona"];?>"class="cajas" size="50" readonly></td>
       </tr>
       <tr>
         <td><b>F_Inicio_Liq.:</b></td>
         <td><input type="text" name="FechaInicio" value="<? echo $filas["fechainic"];?>"class="cajas" size="13" maxlength="10" id="FechaInicio"></td>
         <td><b>F_Retiro:</b></td>
         <td colspan="1"><input type="text" name="FechaRetiro" value="<? echo date("Y-m-d");?>" class="cajas" size="13" maxlength="10" id="FechaRetiro"></td>
       </tr>
       </tr>
         <td><b>Inicio_Nómina:</b></td>
         <td><input type="text" name="InicioN" value="<? echo $filas["fechainic"];?>"class="cajas" size="13" maxlength="10" id="InicioN"></td>
         <td><b>Final_Nómina:</b></td>
         <td colspan="1"><input type="text" name="FinalNomina" value="<? echo date("Y-m-d");?>" class="cajas" size="13" maxlength="10" id="FinalNomina"></td>
       </tr>
       <tr>
         <td><b>F_Inicio_Vac.:</b></td>
         <td><input type="text" name="FechaVaca" value="<? echo $filas["fechainic"];?>" class="cajas" size="13" maxlength="10" id="FechaVaca"></td>
          <td><b>F_Prima:</b></td>
         <td colspan="1"><input type="text" name="FechaPrima" value="<? echo date("Y-m-d");?>"class="cajas" size="13" maxlength="10" id="FechaPrima"></td>
       </tr>
          <tr>
		  <td><b>Tipo_Pago:</b></td>
	          <td><select name="TipoPago" class="cajas" id="TipoPago">
                   <option value="0">Seleccione
		  <option value="COMPLETO">COMPLETO
	          <option value="AJUSTAR">AJUSTAR DIAS
		  </select></td>
         <td><b>Nro_Dias:</b></td>
         <td><input type="text" name="NroDias" value="" class="cajas" size="13" maxlength="10" id="NroDias"></td>
       </tr>
        <tr><td><br></td></tr>
       <tr>
          <td colspan="20">-------------------------------------<b>Tipo de Pago</b>------------------------------------</td>
       </tr>
        <tr><td><br></td></tr>
       <tr>
           <td><b>Tipo_Pago:</b></td>
           <td colspan="10"><input type="checkbox" name="ValidarPago[]" value="XCesantia" id="ValidarPago[]">Cesantia<input type="checkbox" name="ValidarPago[]" value="XInteres" id="ValidarPago[]">Interes<input type="checkbox" name="ValidarPago[]" value="XPrima" id="ValidarPago[]">Prima<input type="checkbox" name="ValidarPago[]" value="XVacacion" id="ValidarPago[]">Vacaciones</td>
       </tr>
       <tr><td><br></td></tr>
        <tr>
          <td colspan="20">---------------------------------<b>Tipo de Prestación</b>--------------------------------</td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
           <td><b>Tipo Prestación:</b></td>
           <td colspan="10"><input type="radio" value="Normal" name="Validar"><font color="red">Normal</font><input type="radio" value="Incluido" name="Validar"><font color="blue">Todo Incluido</font></td>
       </tr>
       <tr><td><br></td></tr>
        <tr>
          <td colspan="20">---------------------------------------<b>Deducciones</b>-----------------------------------</td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
           <td><b>Crear_Deducción:</b></td>
           <td colspan="10"><input type="radio" value="No" name="Activar"><font color="green"><b>No</b></font><input type="radio" value="Si" name="Activar"><font color="#8000FF"><b>Si</b></font></td>
       </tr>
        <table border="0" align="center" width="300">
	       <tr class="cajas">
		      <th><b>Item</b></td><th>&nbsp;</th><th><b>Codigo</b></th><th><b>Descripción</b></th>
		    </tr>
	       <?
	       $i=1;
	       $Sql="select parametrolicenciapermiso.* from parametrolicenciapermiso where parametrolicenciapermiso.estado='ACTIVO'";
	       $Rs=mysql_query($Sql)or die("Error la validar salario");
               $TotalRegistro = mysql_num_rows($Rs);
	       while ($fila = mysql_fetch_array($Rs)):
	              ?>
	              <tr class="cajas">
	                  <th><?echo $i;?></th>
	                  <?
	                  echo ("<td><input type=\"checkbox\" id=\"Dato[" . $i . "]\" name=\"Dato[" . $i . "]\" value=\"" . $filas_s['codsala'] ."\" checked \"></td>");?>
	                  <td><input type="text" value="<?echo $fila["codsala"];?>" name="CodSalario[<? echo $i;?>]"id="CodSalario[<? echo $i;?>]" size="4" readonly class="cajas"></td>
	                  <td><input type="text" value="<?echo $fila["concepto"];?>" name="Concepto[<? echo $i;?>]"id="Concepto[<? echo $i;?>]" size="40" readonly class="cajas"></td>
	              <tr>
	                 <?
	                 $i=$i+1;
	       endwhile;
	       ?>
              <td><input type="hidden" value="<?echo $TotalRegistro;?>" name="TotalR" id="TotalR" size="40" class="cajas" readonly></td>
       <tr><td><br></td></tr>
      <tr>
         <td colspan="5"><input type="submit" value="Liquidar" class="boton"></td>
      </tr>
       </table>
   </form>
 <?
 else:
  ?>
    <script language="javascript">
    alert ("No tiene información en este contrato de trabajo o presenta salario integral.!")
    history.back()
    </script>
   <?
 endif;
 ?>
</body>
</html>
