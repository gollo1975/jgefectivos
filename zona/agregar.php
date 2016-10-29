<?
 session_start();
?>
<html>
<head>
<title>Ingreso de contratos</title>
<LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
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
                        if (document.getElementById("zona").value.length <=0)
                        {
                            alert ("El campo Zona no puede estar vacío");
                            document.getElementById("zona").focus();
                            return;
                        }
                        if (document.getElementById("dirzona").value.length <=0)
                        {
                            alert ("El campo Dirección no puede estar vacío");
                            document.getElementById("dirzona").focus();
                            return;
                        }
                        if (document.getElementById("telzona").value.length <=0)
                        {
                            alert ("El campo Teléfono no puede estar vacío");
                            document.getElementById("telzona").focus();
                            return;
                        }
                        if (document.getElementById("nitzona").value.length <=0)
                        {
                            alert ("El campo Nit Contratante no puede estar vacío");
                            document.getElementById("nitzona").focus();
                            return;
                        }
                        if (document.getElementById("nomina").value.length <=0)
                        {
                            alert ("El campo Nomina no puede estar vacío");
                            document.getElementById("nomina").focus();
                            return;
                        }
                         if (document.getElementById("iva").value.length <=0)
                        {
                            alert ("El campo Iva no puede estar vacío");
                            document.getElementById("iva").focus();
                            return;
                        }
                        document.getElementById("matzona").submit();
                    }
</script>
</head>
<body>
<?
if(session_is_registered("xsession")):
if (empty($zona)):
  include("../conexion.php");
?>
    <center><h4><u>Matricular Zona</u></h4></center>
  <form action="" method="post" id="matzona" >
    <table border="0" align="center" width="320">
     <tr><td><br></td></tr>
     <tr >
       <td><b>Zona:</b></td>
       <td colspan=3><input type="text" name="zona" value="" size="60" maxlength="60" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona"></td>
     </tr>
     <tr>
       <td><b>Dirección:</b></td>
       <td colspan=3><input type="text" name="dirzona" value="" size="60" maxlength="60"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dirzona"></td>
     </tr>
     <tr>
       <td><b>Teléfono:</b></td>
       <td colspan=3><input type="text" name="telzona" value="" size="12" maxlength="7" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telzona"></td>
     </tr>
     <tr>
       <td><b>Fax:</b></td>
       <td colspan=3><input type="text" name="faxzona" value="" size="12" maxlength="7" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="faxzona"></td>
       </tr>
       <tr>
          <td><b>Municipio:</b></td>
          <td colspan="10"><select name="municipio" class="cajas">
             <option value="0">Seleccion el municipio
             <?
             $consulta_z="select codmuni,municipio from municipio";
             $resultado_z=mysql_query($consulta_z) or die("Error al buscar el municipio");
             while ($filas_z=mysql_fetch_array($resultado_z)):
                 ?>
                <option value="<?echo $filas_z["codmuni"];?>"><?echo $filas_z["municipio"];?>
                 <?
             endwhile;
             ?>
           </select></td>
        </tr>

       <tr>
         <td><b>email:</b></td>
         <td colspan=3><input type="text" name="emailzona" value="" size="60" maxlength="50" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="emailzona"></td>
       </tr>
       <tr>
       <td><b>Sucursal:</b></td>
          <td colspan=3><select name="codsucursal" class="cajas">
          <option value="0">Seleccione la Sucursal
          <?
            $consulta_s="select * from sucursal";
            $resultado_s=mysql_query($consulta_s)or die ("Consulta de sucursal incorrecta");
            while($filas_s=mysql_fetch_array($resultado_s)):
              ?>
              <option value="<?echo $filas_s["codsucursal"];?>"> <?echo $filas_s["sucursal"];?>
              <?
              endwhile;
              ?></select></td>
       </tr>
       <tr>
         <td><b>Nit_Contratante:</b></td>
         <td><input type="text" name="nitzona" value="" size="15" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nitzona"></td>
         <td><b>Dv:</b></td>
         <td><input type="text" name="dvzona" value="" size="4" maxlength="1" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dvzona"></td>
       </tr>
        <tr>
                <td>&nbsp;</td>
                <td colspan=3><table width="100%">
                                <tr>
                                        <td><b>Día</b></td>
                                        <td><b>Mes</b></td>
                                        <td><b>Año</b></td>
                                </tr>
                        </table>
                </td>
       </tr>
       <tr>
                <td><b>Fecha Matricula:</b></td>
                <td colspan=3><table width="100%">
                                <tr>
                                        <td><select name="d">
                                                <option value="01">01
                                                <option value="02">02
                                                <option value="03">03
                                                <option value="04">04
                                                <option value="05">05
                                                <option value="06">06
                                                <option value="07">07
                                                <option value="08">08
                                                <option value="09">09
                                                <option value="10">10
                                                <option value="11">11
                                                <option value="12">12
                                                <option value="13">13
                                                <option value="14">14
                                                <option value="15">15
                                                <option value="16">16
                                                <option value="17">17
                                                <option value="18">18
                                                <option value="19">19
                                                <option value="20">20
                                                <option value="21">21
                                                <option value="22">22
                                                <option value="23">23
                                                <option value="24">24
                                                <option value="25">25
                                                <option value="26">26
                                                <option value="27">27
                                                <option value="28">28
                                                <option value="29">29
                                                <option value="30">30
                                                <option value="31">31
                                        </td>
                                        <td><select name="m">
                                                <option value="01">Enero
                                                <option value="02">Febrero
                                                <option value="03">Marzo
                                                <option value="04">Abril
                                                <option value="05">Mayo
                                                <option value="06">Junio
                                                <option value="07">Julio
                                                <option value="08">Agosto
                                                <option value="09">Septiembre
                                                <option value="10">Octubre
                                                <option value="11">Noviembre
                                                <option value="12">Diciembre
                                        </td>
                                        <td><select name="a">
                                               <option value="2000">2000
                                              <option value="2001">2001
                                              <option value="2002">2002
                                              <option value="2003">2003
                                              <option value="2004">2004
                                              <option value="2005">2005
                                              <option value="2006">2006
                                              <option value="2007">2007
                                              <option value="2008">2008
                                              <option value="2009">2009
                                              <option value="2010">2010
                                              <option value="2011">2011
                                              <option value="2012">2012
                                              <option value="2013">2013
                                              <option value="2014">2014
                                              <option value="2015">2015
                                              <option value="2016">2016
                                              <option value="2017">2017
                                              <option value="2018">2018
                                              <option value="2019">2019
                                              <option value="2020">2020
                                        </td>
                                </tr>
                        </table>
                </td>
       </tr>
       <tr>
         <td><b>Nomina:</b></td>
         <td colspan="1"><input type="text" name="nomina" value="" size="10" maxlength="2" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nomina"></td>
            <td><b>Caja_Comp.:</b></td>
         <td colspan="1"><input type="text" name="caja" value="" size="10" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="caja"></td>
       </tr>
       <tr>
         <td><b>Sena:</b></td>
         <td colspan="1" ><input type="text" name="sena" value="" size="10" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="sena"></td>
            <td><b>Icbf.:</b></td>
         <td colspan="1"><input type="text" name="icbf" value="" size="10" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="icbf"></td>
       </tr>
       <tr>
         <td><b>Cesa/Prima:</b></td>
         <td colspan="1"><input type="text" name="prestacion" value="" size="10" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="prestacion"></td>
           <td><b>Vacación:</b></td>
         <td colspan="1"><input type="text" name="vacacion" value="" size="10" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="vacacion"></td>
        </tr>
        <tr>
         <td><b>Admon:</b></td>
         <td colspan="1"><input type="text" name="admon" value="" size="10" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="admon"></td>
         <td><b>Iva:</b></td>
         <td><input type="text" name="iva" value="" size="10" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="iva"></td>
        </tr>
       <tr>
         <td><b>Estado:</b></td>
           <td>
              <select name="estado" class="cajasletra">
              <option value="ACTIVA">ACTIVA
              <option value="INACTIVA">INACTIVA
             </select>
           </td>
           <td><b>F_Prestación:</b></td>
           <td>
              <select name="factura" class="cajasletra">
              <option value="NO">NO
              <option value="SI">SI
             </select>
           </td>
          </tr>
          <tr>
            <td><b>% Admon:</b></td>
         <td><input type="text" name="datos" value="" size="4" maxlength="4" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="datos"></td>
          <td><b>Vendedor:</b></td>
          <td colspan="1"><select name="vendedor" class="cajas">
             <option value="0">Seleccion el Vendedor
             <?
             $consulta_z="select cedulaven,nombreven from vendedor";
             $resultado_z=mysql_query($consulta_z) or die("Error al buscar el vendedor");
             while ($filas_z=mysql_fetch_array($resultado_z)):
                 ?>
                <option value="<?echo $filas_z["cedulaven"];?>"><?echo $filas_z["nombreven"];?>
                 <?
             endwhile;
             ?>
           </select></td>
        </tr>
		 <tr>
         <td><b>Tipo_Negociacion:</b></td>
           <td colspan="10">
              <select name="TipoNegociacion" class="cajasletra" id="TipoNegociacion">
              <option value="MISIONAL">PERSONAL MISIONAL
              <option value="MIXTA">MISIONAL Y OTROS
			  <option value="OTROS">OTROS SERVICIOS
             </select>
           </td>
       <tr><td><br></td></tr>
       <tr>
         <td colspan="5"><div align="center">-------------------------------------<b>Datos de la Factura</b>---------------------------------------</div></td>
       </tr>
       <tr><td><br></td></tr>
        <tr>
       <td><b>Retefuente:
              <td colspan="5"><select name="retefuente" class="cajasletra">
              <option value="SI">SI
              <option value="NO">NO
             </select>
             <b>&nbsp;%Porc.:</b>
              <input type="text" name="vlrfte"  size="10" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="vlrfte">
           <b>Rete_Iva:</b>
              <select name="reteiva" class="cajasletra">
              <option value="SI">SI
              <option value="NO">NO
             </select>
           <b>&nbsp;%Porc.:</b>
              <input type="text" name="vlriva"  size="5" maxlength="5" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="vlriva"></td>
         </tr>
         <tr>
           <td><b>Resolución:</b></td>
           <td><input type="text" name="resolucion"  size="15" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="resolucion"></td>
           <td><b>Cree:</b>
            <select name="cree" class="cajas" >
               <option value="NO">NO
               <option value="SI">SI
              </select>
             <td><b>Porce.:</b>
             <input type="text" name="porcre" value="" size="6" maxlength="6"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="porcre">
         </tr>
          <tr>
           <td><b>Aplica ReteIca:</b></td>
            <td><select name="ReteIca" class="cajas" id="ReteIca">
               <option value="NO">NO
               <option value="SI">SI
              </select>
             <td><b>Dcto_Comercial:</b>
			  <td><select name="Dcto" class="cajas" id="Dcto">
               <option value="NO">NO
               <option value="SI">SI
              </select>
			  <b>% Dcto:</b>
             <input type="text" name="pordcto" value="" size="10" maxlength="10"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="pordcto"></td>
         </tr>
          <tr><td><br></td></tr>
         <tr>
         <td colspan="4">
           <input type="button" value="Guardar" class="boton" onclick="chequearcampos()">
           <input type="reset" value="Limpiar" class="boton">
         </td>
       </tr>
       <tr><td><br></td></tr>
      </table>
     </form>
    <?
else:
    include("../conexion.php");
    $zona = strtoupper($zona);
    $fechaini=$a."/".$m."/".$d;
    $nomina = strtoupper($nomina);
    $barzona = strtoupper($barzona);
    $dirzona = strtoupper($dirzona);
        $emailzona=strtoupper($emailzona);
                        $tipo='NO';
		       $consulta = "select count(*) from zona";
		              $result = mysql_query ($consulta);
		              $sw = mysql_fetch_row($result);
		       if ($sw[0]>0):
		          $consulta = "select max(cast(codzona as unsigned)) + 1 from zona";
		          $result = mysql_query($consulta);
		          $codz = mysql_fetch_row($result);
		          $codz = str_pad($codz[0], 3,"0", STR_PAD_LEFT);
		       else:
		         $codz='001';
		       endif;

		        $consulta="insert into zona(codzona,zona,telzona,faxzona,dirzona,codmuni,emailzona,codsucursal,nitzona,dvzona,fechaini,nomina,caja,sena,icbf,prestacion,vacacion,admon,iva,estado,factura,datos,cedulaven,tiponegociacion,retefuente,vlrfte,reteiva,vlriva,resolucion,cree,porcre,tipoempresa,reteica,dcto,pordcto)
		         values('$codz','$zona','$telzona','$faxzona','$dirzona','$municipio','$emailzona','$codsucursal','$nitzona','$dvzona','$fechaini','$nomina','$caja','$sena','$icbf','$prestacion','$vacacion','$admon','$iva','$estado','$factura','$datos','$vendedor','$TipoNegociacion','$retefuente','$vlrfte','$reteiva','$vlriva','$resolucion','$cree','$porcre','$tipo','$ReteIca','$Dcto','$pordcto')";
		         $resultado=mysql_query($consulta)or die("inserección incorrecta de la zona");
		          $registro=mysql_affected_rows();
		         echo "<script language=\"javascript\">";
		         echo "open (\"../pie.php?msg=Se Grabo $registro Registro, de la Zona : $zona\",\"pie\");";
		         echo ("open (\"agregar.php\",\"_self\");");
		         echo "</script>";
   endif;
 else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
  ?>
 </body>
</html>
