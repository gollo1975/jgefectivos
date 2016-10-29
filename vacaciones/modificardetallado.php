<html>
<head>
<title>Generando Prestaciones</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

</head>
<body>
<?
include("../conexion.php");
$consulta="select prestacion.* from prestacion
        where prestacion.nropresta='$nropresta'";
$res=mysql_query($consulta)or die ("Error al buscar prestaciones");
$reg=mysql_num_rows($res);
$filas=mysql_fetch_array($res);
$ConT="select prestacion.* from prestacion,comprobante
        where prestacion.cedemple=comprobante.nitprove and
              comprobante.nrofactura='$nropresta' and
              prestacion.cedemple='$Cedula'";
$resT=mysql_query($ConT)or die ("Error al buscar validaciones");
$regT=mysql_num_rows($resT);
if($regT ==0 ):
  ?>

    <center><h4><u>Editar Prestaciones </u></h4></center>
    <form action="grabarmodificadocesantia.php" name="primero" method="post" id="primero">
    <input type="hidden" name="nropresta" value="<? echo $nropresta;?>">
     <input type="hidden" name="Cedula" value="<? echo $Cedula;?>">  
       <table border="0" align="center" width="380">
         <tr>
         <td><b>Cedula:</b></td>
         <td colspan="1"><input type="text" name="Cedula" value="<? echo $Cedula;?>"class="cajas" size="13" readonly></td>
          <td><b>S_Base:</b></td>
         <td><input type="text" name="SalarioB" value="<? echo $SalarioB;?>"class="cajas" size="13" maxlength="10" ></td>
       </tr>
       <tr>
         <td><b>Empleado:</b></td>
         <td colspan="3"><input type="text" name="nombres" value="<? echo $filas["nombres"];?>" class="cajas"size="46" readonly></td>
       </tr>
       <tr>
         <td><b>F_Proceso:</b></td>
         <td colspan="1"><input type="text" name="fechap" value="<? echo $filas["fechapro"];?>"class="cajas" size="13" maxlength="10" readonly></td>
         <td><b>F_Inicio:</b></td>
         <td><input type="text" name="fechainic" value="<? echo $filas["fechaini"];?>"class="cajas" size="13" maxlength="10"></td>
       </tr>
       <tr>
         <td><b>F_Retiro:</b></td>
         <td colspan="1"><input type="text" name="fechacorte" value="<? echo $filas["fechacor"];?>" class="cajas" size="13" maxlength="10" ></td>
         <td><b>Ibc:</b></td>
         <td colspan="1"><input type="text" name="ibc" value="<? echo $filas["ibc"];?>" class="cajas" size="13" maxlength="10" ></td>
       </tr>
        <tr>
         <td><b>Dias:</b></td>
         <td colspan="1"><input type="text" name="dias" value="<? echo $filas["dias"];?>" class="cajas" size="13" maxlength="10"></td>
          <td><b>Dias_Prima:</b></td>
         <td colspan="1"><input type="text" name="DiasP" value="<? echo $filas["diasprima"];?>" class="cajas" size="13" maxlength="10"></td>
       </tr>
         <td><b>Auxilio:</b></td>
         <td colspan="1"><input type="text" name="auxilio" value="<? echo $filas["auxilio"];?>" class="cajas" size="13" maxlength="10" ></td>
         <td><b>Deducción:</b></td>
         <td colspan="1"><input type="text" name="TotalD" value="<? echo $filas["totald"];?>" class="cajas" size="13" maxlength="10" readonly></td>
        </tr>
        </tr>
         <td><b>Total_Pagar:</b></td>
         <td colspan="1"><input type="text" value="<? echo $filas["total"];?>" class="cajas" size="13" maxlength="10" readonly></td>
        </tr>
        <tr>
          <td><b>Tipo_Pago:</b></td>
          <td colspan="8"><input type="checkbox" name="ValidarPago[]" value="XCesantia" id="ValidarPago[]">Cesantia<input type="checkbox" name="ValidarPago[]" value="XInteres" id="ValidarPago[]">Interes<input type="checkbox" name="ValidarPago[]" value="XPrima" id="ValidarPago[]">Prima<input type="checkbox" name="ValidarPago[]" value="XVacacion" id="ValidarPago[]">Vacaciones</td>
       </tr>
         <tr>
           <td><b>Tipo Prestación:</b></td>
           <td colspan="10"><input type="radio" value="Normal" name="Validar"><font color="red">Normal</font><input type="radio" value="Incluido" name="Validar"><font color="blue">Todo Incluido</font></td>
       </tr>
        <tr>
           <td><b>Deducciones:</b></td>
           <td colspan="10"><input type="radio" value="Si" name="ValD"><font color="#FF8080"><b>Si</b></font><input type="radio" value="No" name="ValD"><font color="#8000FF"><b>No</b></font></td>
       </tr>
         <table border="0" align="center" width="380">
              <tr>
              <td><b>Cesantias:&nbsp;</b></td>
               <td><input type="text" name="cesantia" value="<? echo $filas["cesantia"];?>" size="11" readonly ></td>
             </tr>
             <tr>
             <td><b>Interes:&nbsp;</b></td>
              <td><input type="text" name="interes" value="<? echo $filas["interes"];?>" size="11" readonly></td>
             </tr>
             <tr>
             <td><b>Prima:&nbsp;</b></td>
              <td><input type="text" name="prima" value="<? echo $filas["prima"];?>" size="11" readonly></td>
            </tr>
            <tr>
            <td><b>Vacaciones:&nbsp;</b></td>
              <td><input type="text" name="vacacion" value="<? echo $filas["vacacion"];?>" size="11"></td>
            </tr>
            <tr>
              <td colspan="5"><textarea name="nota" cols="69" rows="5"  class="cajas"><? echo $filas["nota"];?></textarea></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
         <td><input type="submit" value="Guardar" class="boton"></td>
      </tr>
      </table>
        </table>
   </form>
   <?
 else:
   ?>
   <script language="javascript">
      alert("Esta Nro de Prestacion no se puede Modificar en sistemas.! ")
      history.back()
   </script>
   <?
 endif;
 ?>
</body>
</html>
