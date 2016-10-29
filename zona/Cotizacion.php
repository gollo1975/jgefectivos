<html>

<head>
  <title>Cotizacion Comercial</title>
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
                         if (document.getElementById("Nit").value == 0)
                        {
                            alert ("Digite el Nit/Cedula de la Empresa cliente.!");
                            document.getElementById("Nit").focus();
                            return;
                        }
                          if (document.getElementById("Razon").value == 0)
                        {
                            alert ("Digite la Razon social de la Empresa.!");
                            document.getElementById("Razon").focus();
                            return;
                        }
                         if (document.getElementById("Salario").value == 0)
                        {
                            alert ("Digite el salario para generar la cotizacion.!");
                            document.getElementById("Salario").focus();
                            return;
                        }
                         if (document.getElementById("Admon").value == 0)
                        {
                            alert ("Digite el porcentaje de la administracion para generar el archivo.!");
                            document.getElementById("Admon").focus();
                            return;
                        }
                         document.getElementById("matlibra").submit();
                     }
                     function valide()
                      {
                       if (document.getElementById("Dirigida").value == 0)
                        {
                            alert ("Digite la persona a quien dirige la cotización.!");
                            document.getElementById("Dirigida").focus();
                            return;
                        }
                        if (document.getElementById("Cargo").value == 0)
                        {
                            alert ("Digite el cargo de la persona.!");
                            document.getElementById("Cargo").focus();
                            return;
                        }
                         if (document.getElementById("Nota").value == 0)
                        {
                            alert ("Digite la observacion para este cliente.!");
                            document.getElementById("Nota").focus();
                            return;
                        }
                         document.getElementById("matcon").submit();
                     }
   </script>
</head>

<body>

<?
if (!isset($Nit)){
?>
<center><h4><u>Cotizacion Comercial</u></h4></center>
  <form  action="" method="post" id="matlibra">
    <table border="0" align="center">
       <tr>
        <td><b>Nit/Cédula:&nbsp;</b></td>
         <td><input type="text" name="Nit" size="15" maxlength="13" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Nit"></td>
       </tr>
       <tr>
        <td><b>Razon Social:&nbsp;</b></td>
         <td><input type="text" name="Razon" size="65" maxlength="60" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Razon"></td>
       </tr>
       <tr>
        <td><b>Salario:&nbsp;</b></td>
         <td><input type="text" name="Salario" size="15" maxlength="13" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Salario"></td>
       </tr>
       <td><b>Auxilio_Trans.:&nbsp;</b></td>
         <td><input type="text" name="Auxilio" size="15" maxlength="13" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Auxilio"></td>
       </tr>
        <td><b>% Admon:&nbsp;</b></td>
         <td><input type="text" name="Admon" size="15" maxlength="13" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Admon"></td>
       </tr>
        <td><b>Tipo_Cotizacion.:&nbsp;</b></td>
        <td><input type="radio" value="FIJA"  name="TipoAdmon"><font color="red">Fija<input type="radio" value="RUBRO FACTURADO"  name="TipoAdmon">Facturado<input type="radio" value="SALARIO MAS AUXILIO"  name="TipoAdmon">Salario + Auxilio<input type="radio" value="FACTURADO DEL MINIMO"  name="TipoAdmon">Facturado Minimo</font></td>
       <tr><td><br></td></tr>
       <td colspan="30">----------------------------------------<b><font color="blue">Provisiones Semestrales y Anuales</font></b>------------------------------------</td>
       <tr><td><br></td></tr>
       <tr>
          <td><strong>Cesantias:&nbsp;</strong></td>
             <td><select name="PorCesantia" id="PorCesantia">
             <option value="8.33">8.33</option>
          </select>
          <strong>Interes:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
             <select name="PorInteres" id="PorInteres">
             <option value="1">1</option>
          </select></td>
       </tr>
       <tr>
          <td><strong>Prima:&nbsp;</strong></td>
             <td><select name="PorPrimas" id="PorPrimas">
             <option value="8.33">8.33</option>
          </select>
          <strong>Vacaciones:</strong>
             <select name="PorVacacion" id="PorVacacion">
             <option value="4.5">4.5</option>
          </select></td>
       </tr>
        <tr><td><br></td></tr>
       <td colspan="30">---------------------------------------------------------<b><font color="blue">Parafiscales</font></b>------------------------------------------------------</td>
       <tr><td><br></td></tr>
       <tr>
          <td><strong>Caja Comp.:&nbsp;</strong></td>
             <td><select name="PorCajaC" id="PorCajaC">
             <option value="4">4</option>
          </select>
          <strong>Icbf:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
             <select name="PorIcbf" id="PorIcbf">
              <option value="0">0</option>
             <option value="3">3</option>
          </select></td>
       </tr>
       <tr>
          <td><strong>Sena:&nbsp;</strong></td>
             <td><select name="PorSena" id="PorSena">
             <option value="0">0</option>
             <option value="2">2</option>
          </select>
       </tr>     <tr><td><br></td></tr>
       <td colspan="30">---------------------------------------------------<b><font color="blue">Seguridad Social</font></b>----------------------------------------------------</td>
       <tr><td><br></td></tr>
       <tr>
          <td><strong>Pension:&nbsp;</strong></td>
             <td><select name="PorPension" id="PorPension">
             <option value="12">12</option>
             <option value="22">22</option>
             <option value="16">16</option>
          </select>
          <strong>Eps:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
             <select name="PorEps" id="PorEps">
              <option value="0">0</option>
              <option value="4">4</option>
             <option value="8.5">8.5</option>
          </select></td>
       </tr>
       <tr>
          <td><strong>Arp:&nbsp;</strong></td>
             <td><select name="PorArl" id="PorArl">
             <option value="0.522">0.522</option>
             <option value="1.044">1.044</option>
             <option value="2.436">2.436</option>
             <option value="4.350">4.350</option>
             <option value="6.96">6.96</option>
             </select>
       </tr>

         <tr><td><br></td></tr>
    <tr>
         <td colspan="2">
           <input type="button" value="Generar Cotizacion" class="boton" onclick="chequearcampos()" name="cotizar"></td>
       </tr>

    </table>
    <br>
 </form>
  <?
}elseif(empty($TipoAdmon)){
     ?>
     <script language="javascript">
         alert("Seleccion el tipo de Cotizacion para esta Empresa.!")
         history.back()
     </script>
     <?
}else{
     $Razon=strtoupper($Razon);
     /*codigo para prestaciones*/
     $Cesantia = round((($Salario + $Auxilio)* 30)/360);
     $Interes = round(($Cesantia * 1)/100);
     $Primas = round((($Salario + $Auxilio)* 30)/360);
     $Vacacion = round(($Salario * $PorVacacion)/100);
     /*Codigo de Parafiscales*/
     $CajaCompensacion = round(($Salario * $PorCajaC)/100);
     $ValorIcbf = round(($Salario * $PorIcbf)/100);
     $ValorSena = round(($Salario * $PorSena)/100);
     /*Codigo para Seguridad social*/
     $ValorEps = round(($Salario * $PorEps)/100);
     $ValorPension = round(($Salario * $PorPension)/100);
     $ValorArl = round(($Salario * $PorArl)/100);
     /*codigo del resumen*/
     $TotalPrestaciones = round($Cesantia + $Interes + $Primas + $Vacacion);
     $TotalParafiscal = round($CajaCompensacion + $ValorIcbf + $ValorSena);
     $TotalSeguridad = round($ValorEps + $ValorPension + $ValorArl);
     /*codigo para validad la admon*/
     if ($TipoAdmon =='FIJA'){
          $TotalAdmon = round(($Salario * $Admon)/100);
     }else{
         if($TipoAdmon =='RUBRO FACTURADO'){
            $Aux=0;
            $Aux= round($TotalPrestaciones + $TotalParafiscal + $TotalSeguridad + $Salario + $Auxilio);
            $TotalAdmon = round(($Aux * $Admon)/100);
         }else{
              if($TipoAdmon =='SALARIO MAS AUXILIO'){
                  $Aux=0;
                  $Aux= round($Salario + $Auxilio);
                  $TotalAdmon = round(($Aux * $Admon)/100);
              }else{
                  $Aux=0;
                  $Aux= round($TotalPrestaciones + $TotalParafiscal + $TotalSeguridad + $Salario + $Auxilio);
                  $TotalAdmon = round(($Aux * $Admon)/100);
              }
         }
     }

     ?>
           <center><h4><u>Propuesta Comercial</u></h4></center>
           <form action="GrabarCotizacion.php" method="post" name="f1" id="matcon">
               <input type="hidden" name="PorCesantia" value="<?echo $PorCesantia;?>" size="15">
               <input type="hidden" name="PorInteres" value="<?echo $PorInteres;?>" size="15">
               <input type="hidden" name="PorPrimas" value="<?echo $PorPrimas;?>" size="15">
               <input type="hidden" name="PorVacacion" value="<?echo $PorVacacion;?>" size="15">
               <input type="hidden" name="PorCajaC" value="<?echo $PorCajaC;?>" size="15">
               <input type="hidden" name="PorIcbf" value="<?echo $PorIcbf;?>" size="15">
               <input type="hidden" name="PorSena" value="<?echo $PorSena;?>" size="15">
               <input type="hidden" name="PorEps" value="<?echo $PorEps;?>" size="15">
               <input type="hidden" name="PorPension" value="<?echo $PorPension;?>" size="15">
               <input type="hidden" name="PorArl" value="<?echo $PorArl;?>" size="15">
              <table border="0" align="center" width="500">
                  <tr><td><br></td></tr>
                  <tr>
                    <td><b>Nit/cédula:&nbsp;</b></td>
                    <td><input type="text" name="Nit" value="<?echo $Nit;?>" size="15" class="cajas" id="Nit" readonly>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><b>Razon Social:&nbsp;</b></td>
                    <td><input type="text" name="Razon" value="<?echo $Razon;?>" size="60" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Razon"></td>
                  </tr>
                  <tr>
	              <td><b>Salario:&nbsp;</b></td>
	              <td><input type="text" name="Salario" value="<?echo $Salario;?>" size="15" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Salario">
	              <b>Auxilio_Trans.:&nbsp;&nbsp;&nbsp;</b>
	              <input type="text" name="Auxilio" value="<?echo $Auxilio;?>" size="20" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Auxilio"></td>
	          </tr>
	              <td><b>% Admon:&nbsp;</b></td>
	              <td><input type="text" name="Admon" size="15" value="<?echo $Admon;?>" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Admon">
	              <b>Tipo_Cotizacion:&nbsp;</b>
	              <input type="text" name="TipoAdmon" size="20" value="<?echo $TipoAdmon;?>" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TipoAdmon"></td>
	          </tr>
                  <tr><td><br></td></tr>
                  <td colspan="30">------------------------------<b><font color="blue">Provisiones Semestrales y Anuales</font></b>----------------------------</td>
                  <tr><td><br></td></tr>
                  <tr>
                     <td><b>Cesantias:&nbsp;</b></td>
                     <td><input type="text" name="Cesantia" value="<?echo $Cesantia;?>" size="15" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Cesantia">
                     <b>Intereses:&nbsp;&nbsp;&nbsp;</b>
                     <input type="text" name="Interes" size="15" value="<?echo $Interes;?>" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Interes"></td>
                  </tr>
                   <tr>
                     <td><b>Primas:&nbsp;</b></td>
                     <td><input type="text" name="Primas" size="15" value="<?echo $Primas;?>" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Primas">
                     <b>Vacaciones:&nbsp;</b>
                     <input type="text" name="Vacacion" size="15" value="<?echo $Vacacion;?>" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Vacacion"></td>
                  </tr>
                   <tr><td><br></td></tr>
		   <td colspan="30">----------------------------------------------<b><font color="blue">Parafiscales</font></b>----------------------------------------------</td>
		   <tr><td><br></td></tr>
                   <tr>
                     <td><b>Caja_Comp.:&nbsp;</b></td>
                     <td><input type="text" name="CajaCompensacion" value="<?echo $CajaCompensacion;?>" size="15" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="CajaCompensacion">
                     <b>Icbf:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                     <input type="text" name="ValorIcbf" size="15" value="<?echo $ValorIcbf;?>" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="ValorIcbf"></td>
                  </tr>
                   <tr>
                     <td><b>Sena:&nbsp;</b></td>
                     <td><input type="text" name="ValorSena" size="15" value="<?echo $ValorSena;?>" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="ValorSena">
                  </tr>
                   <tr><td><br></td></tr>
		   <td colspan="30">------------------------------------------<b><font color="blue">Seguridad Social</font></b>------------------------------------------</td>
		   <tr><td><br></td></tr>
                   <tr>
                     <td><b>Eps:&nbsp;</b></td>
                     <td><input type="text" name="ValorEps" value="<?echo $ValorEps;?>" size="15" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="ValorEps">
                     <b>Pension:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                     <input type="text" name="ValorPension" size="15" value="<?echo $ValorPension;?>" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="ValorPension"></td>
                  </tr>
                   <tr>
                     <td><b>Arl:&nbsp;</b></td>
                     <td><input type="text" name="ValorArl" size="15" value="<?echo $ValorArl;?>" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="ValorArl">
                  </tr>
                   <tr><td><br></td></tr>
		   <td colspan="30">------------------------------------<b><font color="red">Resumen de Provisiones</font></b>--------------------------------------</td>
		   <tr><td><br></td></tr>
                   <tr>
                     <td><b>Prestaciones:&nbsp;</b></td>
                     <td><input type="text" name="TotalPrestaciones" size="15" value="<?echo $TotalPrestaciones;?>" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" style="text-align:right;font-size: 10.5pt;background-color:#0080FF" id="TotalPrestaciones">
                  </tr>
                    <tr>
                     <td><b>Parafiscales:&nbsp;</b></td>
                     <td><input type="text" name="TotalParafiscal" size="15" value="<?echo $TotalParafiscal;?>" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" style="text-align:right;font-size: 10.5pt;background-color:#0080FF" id="TotalParafiscal">
                  </tr>
                    <tr>
                     <td><b>Seguridad Soc.:&nbsp;</b></td>
                     <td><input type="text" name="TotalSeguridad" size="15" value="<?echo $TotalSeguridad;?>" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" style="text-align:right;font-size: 10.5pt;background-color:#0080FF" id="TotalSeguridad">
                  </tr>
                     <tr>
                     <td><b>Total Admon:&nbsp;</b></td>
                     <td><input type="text" name="TotalAdmon" size="15" value="<?echo $TotalAdmon;?>" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TotalAdmon" style="text-align:right;font-size: 10.5pt;background-color:#FF8040">
                  </tr>
                  </tr>
                     <tr>
                     <td><b>Dirigida:&nbsp;</b></td>
                     <td><input type="text" name="Dirigida" size="60" value=""  class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Dirigida">
                  </tr>
                  </tr>
                     <tr>
                     <td><b>Cargo:&nbsp;</b></td>
                     <td><input type="text" name="Cargo" size="60" value=""  class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Cargo">
                  </tr>
                  <tr>
                    <td><b>Nota:&nbsp;</b></td>
                    <td><textarea name="Nota" cols="60"  rows="4"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Nota" ></textarea></td>
                  </tr>
                  <tr><td><br></td></tr>
                  <tr>
                  <td colspan="2">
                    <input type="button" value="Grabar" class="boton" onclick="valide()" id="Generar"></td>
                  </tr>
              </table>
           </form>
          <?
}
?>

</body>

</html>
