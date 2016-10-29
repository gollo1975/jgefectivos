<html>

<head>
<title>Modificar Novedades de Nomina</title>
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
                         if (document.getElementById("cedula").value <= 0)
                        {
                            alert ("Digite el Documento del Empleado ?");
                            document.getElementById("cedula").focus();
                            return;
                        }

                       document.getElementById("matnove").submit();
                    }
                   </script>
</head>
<body>

<?
if (empty($cedula)):
?>
<center><h4><u>Novedades de Nómina</u></h4></center>
 <form  action="" method="post" id="matnove">
    <input type="hidden" name="codigo" value="<? echo $codigo;?>">
    <table border="0" align="center">
             <tr><td><br></td></tr>
        <tr>
                <td><b>Desde:</b></td>
                <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="11" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde" class ="cajas">
                <td colspan="1"><b>Hasta:</b></td>
                <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="11" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta" class ="cajas">
            </tr>
       <tr>
        <td><b>Documento:</b></td>
         <td><input type="text" name="cedula" value="" size="15" maxlength="15" onFocus="ColorFoco(this.id)" onlblur="QuitarFoco(this.id)" id="cedula"></td>
       </tr>
              <tr><td><br></td></tr>
    <tr>
         <td colspan="2">
           <input type="button" value="Buscar" class="boton" onclick="chequearcampos()">
           <input type="reset" value="Limpiar"class="boton"> </td>
       </tr>

    </table>
    <br>

  </form>
  <?
else:
  include("../conexion.php");
  $dato="select novedadnomina.* from novedadnomina,empleado
  where empleado.cedemple=novedadnomina.cedemple and
       novedadnomina.desde='$desde' and novedadnomina.hasta='$hasta' and
       empleado.cedemple='$cedula'";
  $resu = mysql_query ($dato) or die ("Error de Busqueda de Novedades");
  $reg = mysql_num_rows($resu);
  $filas=mysql_fetch_array($resu);
  $codnovedad=$filas["codnovedad"];
  if($reg==0):
      ?>
       <script language="javascript">
         alert("Este documento no tienes novedades en sistema?")
         history.back()
       </script>
      <?
  else:
         ?>
         <center><h4><u>Novedades de Nómina</u></h4></center>
         <form action=""  method="post">
            <table border="0" align="center">
                 <tr>
                  <td><br></td>
                 </tr>
                 <tr>
                <td><b>Documento</b></td>
                <input type="hidden" name="codnovedad" value="<?echo $filas["codnovedad"];?>" size="10">
                <td><input type="text" name="cedula" value="<?echo $cedula?>" readonly="yes" size="12" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula" class ="cajas"></td>
                <td><b>Fecha_Proceso:</b></td>
                <td ><input type="text" name="fechap" value="<?echo $filas["fechap"];?>" readonly="yes" size="11" class ="cajas"></td>
               </tr>
                <tr>
                <td><b>Empleado:</b></td>
                <td colspan="5"> <input type="text" name="nombre" value="<?echo $filas["nombre"];?>" readonly="yes" size="48" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre" class="cajas" ></td>
                </tr>
                <tr>
                <td><b>Cod_Zona:</b></td>
                <td colspan="5"><input type="text" name="codzona" value="<?echo $filas["codzona"];?>" size="3" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codzona" readonly=yes class ="cajas">
                <input type="text" name="zona" value="<?echo $filas["zona"];?>" size="42" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona" readonly=yes class ="cajas">
                </tr>
                <tr>
                <td><b>Desde</b></td>
                <td><input type="text" name="desde" value="<?echo $filas["desde"];?>" size="11" readonly="yes" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde" class ="cajas">
                <td colspan="1"><b>Hasta:</b></td>
                <td><input type="text" name="hasta" value="<?echo $filas["hasta"];?>" size="11" readonly="yes" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta" class ="cajas">
               </tr>
                <tr>
                <td><b>Observación:</b></td>
                <td colspan="5"><textarea   name="observacion"  cols="60" rows="5"  class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="observacion"><?echo $filas["nota"];?></textarea></td>
             <tr>
             <table>
              <?
               $dato2="select denovedanomina.* from novedadnomina,denovedanomina
	       where   novedadnomina.codnovedad=denovedanomina.codnovedad and
		       novedadnomina.codnovedad='$codnovedad'";
	       $resu2 = mysql_query ($dato2) or die ("Error de Busqueda de detalles");
	       $reg2 = mysql_num_rows($resu2);
               if($reg2==0):
                  ?>
	          <script language="javascript">
	             alert("No hay detalles de novedad para este empleado?")
	             history.back()
	           </script>
	         <?
               else:
                  ?>
                   <table border="0" align="center">
                  <tr class="cajas">
                <td><b><u>Nro Cuenta</u></b></td><td><b>&nbsp;<u>Descripción</u></b></td><td><b><u>Vlr_Hora</u></b></td><td><b><u>Nro_Hora</u></b></td><td><b><u>Salario</u></b></td><td><b><u>Prest.</b></b></td><td><b><u>%Porc.</u></b></td><td><b><u>Deducción</u></b></td>
                   </tr>
                   <tr><td><br></td></tr>
                   <?
                   while ($filas_s = mysql_fetch_array($resu2)):
                      $cambio=$filas_s["salario"];
                      $conel=$filas_s["deduccion"];
                      $xcambio1= number_format($conel,2);
                      $xcambio= number_format($cambio,2);
                      ?>
                      <tr class="cajas">
	                      <td><? echo $filas_s["codsala"];?></td>
	                      <td>&nbsp;&nbsp;<?echo $filas_s["concepto"];?></td>
	                      <td><input type="text" value="<?echo $filas_s["vlrhora"];?>" size="9"  readonly></td>
                               <td><input type="text" value="<?echo $filas_s["nrohora"];?>" size="5" readonly></td>
	                      <td><input type="text" value="<?echo $xcambio;?>" size="11"readonly></td>
	                      <td><input type="text" value="<?echo $filas_s["prestacion"];?>" size="3" readonly></td>
	                      <td><input type="text" value="<?echo $filas_s["porcentaje"];?>" size="5" readonly></td>
	                      <td><input type="text" value="<?echo $xcambio1;?>" size="11" readonly></td>
                      </tr>
                      <?
                   endwhile;
                endif;
               ?>
               <tr><td><br></td></tr>
            </table>
            <tr>
          <td><a href="conindividual.php?codigo=<?echo $codigo;?>"><b><u>Regresar</u></b></td>
         </tr>
         </form>
         <?
 endif;

endif;

?>
