<html>

<head>
  <title>Ajuste de Parafiscales</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
   <script language="javascript">
             function imprimir()
                    {
                                window.print()
                    }
              function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
    </script>

 </head>

<?
if (!isset($CodZona)){
      include("../conexion.php");
      ?>
      <center><h4><u>Facturación del Servicio</u></h4></center>
     <form name="finicio" id="finicio" action="" method="post" width="200">
         <table border="0" align="center">
	     <tr><td><br></td></tr>
	     <tr>
	        <td><b>Desde:</b></td>
	        <td colspan="3"><input type="text" name="Desde" value="<? echo date("Y-m-d");?>" size="12" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Desde"></td>
	        <td><b>Hasta:</b></td>
	       <td colspan="3"><input type="text" name="Hasta" value="<? echo date("Y-m-d");?>" size="12" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Hasta"></td>
	    </tr>
            <tr>
                <td><b>Zona:</b></td>
                              <td colspan="12"><select name="CodZona" class="cajas" id="CodZona">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select * from zona where zona.nomina='SI' and zona.estado='ACTIVA' order by zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
           </tr>
           <tr>
              <td><b>Tipo_Consulta:</b></td>
              <td><input type="radio" value="Prestacion" name="Estado">Prestaciones<input type="radio" value="Vacacion" name="Estado">Vacaciones</td>
           </tr>
           <tr><td><br></td></tr>
           <tr>
	         <td colspan="5">
	            <input type="submit" value="Buscar" class="boton">
	            <input type="reset" value="Limpiar" class="boton">
	         </td>
           </tr>
       </table>
   </form>
<?
}elseif (empty($CodZona)){
?>
  <script language="javascript">
    alert ("Despliegue la zona de la vista.!")
    history.back()
  </script>
    <?
}elseif (empty($Estado)){
?>
  <script language="javascript">
    alert ("Seleccione el tipo de consulta a procesar.!")
    history.back()
  </script>
    <?
}else{
     if($Estado=='Prestacion'){
	       include("../conexion.php");
	       $Sql="SELECT prestacion.cedemple AS Documento, prestacion.nombres AS Empleado,prestacion.fechapro as F_Proceso, prestacion.vacacion AS Vlr_Vacacion, ROUND(prestacion.vacacion * 0.04) AS Vlr_Facturar, zona.zona AS Zona
		      FROM  zona, prestacion
		      WHERE
		      zona.codzona = prestacion.codzona AND
		      prestacion.vacacion > 0 AND
	 	      prestacion.fechapro BETWEEN '$Desde' AND '$Hasta' AND
		      zona.codzona='$CodZona' ORDER BY prestacion.nombres ASC";
	        $Ar=mysql_query($Sql)or die ("Error al buscar vacaciones en las prestaciones");
	        $ContP= mysql_num_rows($Ar);
	        if($ContP !=0 ){
	               ?> <body onload="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
	                 <center><h4>Ajuste de Parafiscales[Prestaciones]</h4></center>
	                 <table border="0" align="center">
	                     <tr class="cajas">
	                         <th>Registro</b></td>
	                         <th>Cédula</b></td>
	                         <th>Empleado</b></td>
                                 <th>F_Proceso</b></td>
	                         <th>Vlr_Vacacion</b></td>
	                         <th>Vlr_Ajuste</td>
	                     </tr>
	                     <?
	                     $a=1;
	                     $Suma=0;
	                       while ($Reg=mysql_fetch_array($Ar)){
	                           $Valor = number_format($Reg["Vlr_Vacacion"],0);
	                           $ValorAjuste = number_format($Reg["Vlr_Facturar"],0);
	                         ?>
	                         <tr class="cajas">
	                             <td><?echo $a;?></td>
	                            <td><?echo $Reg["Documento"];?></td>
	                            <td><?echo $Reg["Empleado"];?></td>
                                     <td><?echo $Reg["F_Proceso"];?></td>
	                            <td><div align="right"><?echo $Valor;?></div></td>
	                            <td><div align="right"><?echo $ValorAjuste;?></div></td>
	                         </tr>
	                         <?
	                         $Suma += $Reg["Vlr_Facturar"];
	                         $a=$a + 1;
	                     }
	                     $Suma = number_format($Suma,0);
	                     ?>
	                 </table>
	                 <div align="center"><b><h4>Total Ajuste:&nbsp;$<?echo $Suma;?></h4></b></div>
	                <?
	        }else{
	              ?>
	              <script language="javascript">
	                alert("En este rango de fechas no hay Prestaciones generadas a empleados de Esta Zona!!")
	                history.back()
	              </script>
	         <?
                }
         }else{
               include("../conexion.php");
	       $Sql="SELECT vacacion.cedemple AS Documento, vacacion.nombre AS Empleado,vacacion.fechap as F_Proceso, vacacion.subtotal AS Vlr_Vacacion, ROUND(vacacion.subtotal * 0.04) AS Vlr_Facturar, zona.zona AS Zona
		      FROM  zona, vacacion
		      WHERE
		      zona.codzona = vacacion.codzona AND
		      vacacion.subtotal > 0 AND
	 	      vacacion.fechap BETWEEN '$Desde' AND '$Hasta' AND
		      zona.codzona='$CodZona' ORDER BY vacacion.nombre ASC";
	        $Ar=mysql_query($Sql)or die ("Error al buscar vacaciones..");
	        $ContP= mysql_num_rows($Ar);
	        if($ContP !=0 ){
	               ?> <body onload="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
	                 <center><h4>Ajuste de Parafiscales[Vacaciones]</h4></center>
	                 <table border="0" align="center">
	                     <tr class="cajas">
	                         <th>Registro</b></td>
	                         <th>Cédula</b></td>
	                         <th>Empleado</b></td>
                                 <th>F_Proceso</b></td>
	                         <th>Vlr_Vacacion</b></td>
	                         <th>Vlr_Ajuste</td>
	                     </tr>
	                     <?
	                     $a=1;
	                     $Suma=0;
	                     while ($Reg=mysql_fetch_array($Ar)){
	                           $Valor = number_format($Reg["Vlr_Vacacion"],0);
	                           $ValorAjuste = number_format($Reg["Vlr_Facturar"],0);
	                         ?>
	                         <tr class="cajas">
	                             <td><?echo $a;?></td>
	                            <td><?echo $Reg["Documento"];?></td>
	                            <td><?echo $Reg["Empleado"];?></td>
                                    <td><?echo $Reg["F_Proceso"];?></td>
	                            <td><div align="right"><?echo $Valor;?></div></td>
	                            <td><div align="right"><?echo $ValorAjuste;?></div></td>
	                         </tr>
	                         <?
	                         $Suma += $Reg["Vlr_Facturar"];
	                         $a=$a + 1;
	                     }
	                     $Suma = number_format($Suma,0);
	                     ?>
	                 </table>
	                 <div align="center"><b><h4>Total Ajuste:&nbsp;$<?echo $Suma;?></h4></b></div>
	                <?
                }else{
                     ?>
	              <script language="javascript">
	                alert("En este rango de fechas no hay Vacaciones generadas a empleado de Esta Zona!")
	                history.back()
	              </script>
                      <?
                }
         }
}
?>
</body>
</html>

