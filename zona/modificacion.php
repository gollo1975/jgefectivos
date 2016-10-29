<?
 session_start();
?>
<html>
        <head>
                <title>Modificacion de Zona</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?  if(session_is_registered("xsession")):
               if (!isset($codigo)):
                        include("../conexion.php");
                       
    $consulta="select * from zona where codzona='$cod'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
     ?>
     <script language="javascript">
       alert("No existe el registro en la bd ?")
       history.back()
     </script>
    <?
     else:
     ?><center><h4><u>Datos a Modificar</u></h4></center><?
     while($filas=mysql_fetch_array($resultado)):
       ?>

         <form action="guardar1.php" method="post" >
           <table border="0" align="center"width="310">
             <tr>
               <td><b>Cod_Zona:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["codzona"];?>" name="codzona" size="3" readonly class="cajas"></td>
             </tr>
             <tr>
               <td><b>Zona:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["zona"];?>"name="zona" size="60" maxlength="60" class="cajas"></td>
             </tr>
             <tr>
               <td><b>Teléfono:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["telzona"];?>" name="telzona"size="10" maxlength="7" class="cajas"></td>
             </tr>
              <tr>
               <td><b>Fax:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["faxzona"];?>"name="faxzona" size="10" maxlength="7" class="cajas"></td>
             </tr>
            <tr>
               <td><b>Dirección:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["dirzona"];?>"name="dirzona" size="60" maxlength="60" class="cajas"></td>
             </tr>

             <tr>
	        <td><b>Municipio:</b></td>
	       <td colspan="20"><select name="codigo"class="cajas">
		    <?
		    $aux=$filas["codmuni"];
		    $consulta_c="select codmuni,municipio from municipio order by municipio";
		    $resultado_c=mysql_query($consulta_c) or die("consulta de Costo Incorrecta");
		    while ($filas_c=mysql_fetch_array($resultado_c))
		      {
		      if($aux==$filas_c["codmuni"])
		      {
		      ?>
		      <option value="<?echo $filas_c["codmuni"];?>" selected><?echo $filas_c["municipio"];?>
		      <?
		      }
		      else
		       {
		       ?>
		        <option value="<?echo $filas_c["codmuni"];?>"><?echo $filas_c["municipio"];?>
		      <?
		     }
		     }
		     ?>
		     </select></td>
		 </tr>
             <tr>
               <td><b>Email:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["emailzona"];?>" name="emailzona" size="35" maxlength="35" class="cajas"></td>
             </tr>

             <tr>
               <td><b>Sucursal:</b></td>
               <td colspan=3><select name="sucursal" class="cajasletra">
                 <?
                 $sucaux=$filas["codsucursal"];
                 $consulta_s="select sucursal.codsucursal,sucursal,sucursal from sucursal";
                 $resultado_s=mysql_query($consulta_s)or die("Consulta de sucursal incorrecta");
                 while($filas_s=mysql_fetch_array($resultado_s)):
                   if ($sucaux==$filas_s["codsucursal"]):
                 ?>
                 <option value="<?echo $filas_s["codsucursal"];?>" selected><?echo $filas_s["sucursal"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_s["codsucursal"];?>"><?echo $filas_s["sucursal"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
             <tr>
               <td><b>PILA:</b></td>
               <td colspan=3><select name="ssosucursal" class="cajasletra">
                 <?
                 $sucsso=$filas["codigo_sso_sucursal_fk"];
                 $consulta_s="select codigo_sucursal_pk, nombre from sso_sucursal";
                 $resultado_s=mysql_query($consulta_s)or die("Consulta de sucursal pila incorrecta");
                 while($filas_s=mysql_fetch_array($resultado_s)):
                   if ($sucsso==$filas_s["codigo_sucursal_pk"]):
                 ?>
                 <option value="<?echo $filas_s["codigo_sucursal_pk"];?>" selected><?echo $filas_s["nombre"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_s["codigo_sucursal_pk"];?>"><?echo $filas_s["nombre"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>			 
             <tr>
               <td colspan="1"><b>Nit_Zona:</b></td>
               <td><input type="text" value="<?echo $filas["nitzona"];?>" name="nitzona" size="15" maxlength="15" class="cajas"></td>
               <td><b>Dv:</b></td>
               <td><input type="text" value="<?echo $filas["dvzona"];?>" name="dvzona" size="3" maxlength="1" class="cajas"></td>
             </tr>
               <tr>
                <td>&nbsp;</td>
                <td colspan=1><table width="100%">
                    <tr>
                       <td><b>Dia</b></td>
                       <td><b>Mes</b></td>
                       <td><b>Año</b></td>
                    </tr>
                   </table>
                </td>
               </tr>
               <tr>
                <td><b>Fecha Inicio</b></td>
                <td colspan="1" class="cajas"><table width="100%">
                <?
                    $fechaini=$filas["fechaini"];
                    $d=substr($fechaini,8,2);
                    $m=substr($fechaini,5,2);
                    $a=substr($fechaini,0,4);
                ?>
                   <tr>
                      <td><select name="d" class="cajas">
                        <option value="<?echo $d;?>" selected><?echo $d;?>
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
                      <td class="cajas"><select name="m">
                                                <?
                         switch ($m)
                          {
                            case 1:
                              $mes="Enero";
                               break;
                            case 2:
                              $mes="Febrero";
                               break;
                            case 3:
                               $mes="Marzo";
                                break;
                            case 4:
                               $mes="Abril";
                                break;
                            case 5:
                               $mes="Mayo";
                               break;
                            case 6:
                               $mes="Junio";
                               break;
                            case 7:
                              $mes="Julio";
                              break;
                            case 8:
                              $mes="Agosto";
                               break;
                            case 9:
                              $mes="Septiembre";
                               break;
                            case 10:
                              $mes="Octubre";
                              break;
                            case 11:
                             $mes="Noviembre";
                             break;
                            case 12:
                              $mes="Dicimebre";
                            break;
                             }
                            ?>
                            <option value="<?echo $m;?>" selected class="cajas"><?echo $mes;?>
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
                              <td><select name="a" class="cajas">
                                  <option value="<?echo $a;?>" selected><?echo $a;?>
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
                                                <option value="2021">2021
                                                <option value="2022">2022
                                                <option value="2023">2023
                                                <option value="2024">2024
                                                <option value="2025">2025

                               </td>
                             </tr>
                        </table>
                </td>
       </tr>

             <tr>
               <td><b>Nomina:</b></td>
               <td><input type="text" value="<?echo $filas["nomina"];?>" name="nomina" size="10" maxlength="2" class="cajas"></td>
               <td><b>Caja_Comp.:</b></td>
               <td colspan="10"><input type="text" value="<?echo $filas["caja"];?>" name="caja" size="10" maxlength="10" class="cajas"></td>
             </tr>
             <tr>
               <td><b>Sena:</b></td>
               <td colspan="1"><input type="text" value="<?echo $filas["sena"];?>" name="sena" size="10" maxlength="10" class="cajas"></td>
               <td><b>Icbf:</b></td>
               <td colspan="1"><input type="text" value="<?echo $filas["icbf"];?>" name="icbf" size="10" maxlength="10" class="cajas"></td>
             </tr>
              <tr>
               <td><b>Cesa/Prima:</b></td>
               <td colspan="1"><input type="text" value="<?echo $filas["prestacion"];?>" name="prestacion" size="10" maxlength="10" class="cajas"></td>
               <td><b>Vacación</b></td>
               <td colspan="1"><input type="text" value="<?echo $filas["vacacion"];?>" name="vacacion" size="10" maxlength="10" class="cajas"></td>
               </tr>
               <tr>
               <td><b>Admon Fija:</b></td>
               <td colspan="1"><input type="text" value="<?echo $filas["admon"];?>" name="admon" size="10" maxlength="10" class="cajas"></td>
               <td><b>Iva:</b></td>
                 <td><input type="text" value="<?echo $filas["iva"];?>" name="iva" size="4" maxlength="4" class="cajas"></td>
               </tr>
               <tr>
               <td><b>Estado:</b></td>
               <td><select name="estado" class="cajasletra">
                  <option value="<?echo $filas["estado"];?>"selected><?echo $filas["estado"];?>
                  <option value="ACTIVA">ACTIVA
                  <option value="INACTIVA">INACTIVA
                  </select>
                </td>
               <td><b>Provisiona:</b></td>
               <td><select name="factura" class="cajasletra">
                  <option value="<?echo $filas["factura"];?>"selected><?echo $filas["factura"];?>
                  <option value="NO">NO
                  <option value="SI">SI
                  </select>
                </td>
                </tr>
                <tr>
                <td><b>% Admon :</b></td>
                 <td><input type="text" value="<?echo $filas["datos"];?>" name="datos" size="4" maxlength="4" class="cajas"></td>
               <td><b>Vendedor:</b></td>
               <td colspan="1"><select name="vendedor" class="cajasletra">
                 <?
                 $sucaux=$filas["cedulaven"];
                 $consulta_s="select cedulaven,nombreven from vendedor order by nombreven";
                 $resultado_s=mysql_query($consulta_s)or die("Error al buscar eñ vendedor");
                 while($filas_s=mysql_fetch_array($resultado_s)):
                   if ($sucaux==$filas_s["cedulaven"]):
                 ?>
                 <option value="<?echo $filas_s["cedulaven"];?>" selected><?echo $filas_s["nombreven"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_s["cedulaven"];?>"><?echo $filas_s["nombreven"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
			   <tr>
                   <td><b>Tipo_Negociacion:</b></td>
					<td colspan="5"><select name="TipoNegociacion" class="cajasletra" id="TipoNegociacion">
					<option value="<?echo $filas["tiponegociacion"];?>"selected><?echo $filas["tiponegociacion"];?>
					<option value="MISIONAL">PERSONAL MISIONAL
					<option value="MIXTA">MISIONAL Y OTROS
					<option value="OTROS">OTROS SERVICIOS
					 </select></td>
			 </tr>
                <tr><td><br></td></tr>
       <tr>
         <td colspan="5"><div align="center">---------------------------------<b>Datos de la Factura</b>-------------------------------------</div></td>
       </tr>
       <tr><td><br></td></tr>
        <tr>
       <td><b>Retefuente:</b>
            <td colspan="5"><select name="retefuente" class="cajasletra">
            <option value="<?echo $filas["retefuente"];?>"selected><?echo $filas["retefuente"];?>
            <option value="SI">SI
              <option value="NO">NO
             </select>
           <b>&nbsp;%Porc.:</b>
           <input type="text" name="vlrfte"  value="<?echo $filas["vlrfte"];?>"size="5" maxlength="5" class="cajas" >
           <b>Rete_Iva:</b>
              <select name="reteiva" class="cajasletra">
              <option value="<?echo $filas["reteiva"];?>"selected><?echo $filas["reteiva"];?>
              <option value="SI">SI
              <option value="NO">NO
             </select>
             <b>&nbsp;%Porc.:</b>
           <input type="text" name="vlriva"  value="<?echo $filas["vlriva"];?>"size="5" maxlength="5" class="cajas" >
         </tr>
         <tr>
           <td><b>Resolución:</b></td><td><input type="text" name="resolucion"  value="<?echo $filas["resolucion"];?>"size="15" maxlength="15" class="cajas"></td>
           <td colspan="10"><b>Cree:</b>
              <select name="cree" class="cajasletra">
              <option value="<?echo $filas["cree"];?>"selected><?echo $filas["cree"];?>
              <option value="SI">SI
              <option value="NO">NO
             </select>
             <b>%Porc.:</b>
           <input type="text" name="porcre"  value="<?echo $filas["porcre"];?>"size="6" maxlength="6" class="cajas" >
          <b>Principal:</b>
              <select name="ppal" class="cajasletra">
              <option value="<?echo $filas["tipoempresa"];?>"selected><?echo $filas["tipoempresa"];?>
              <option value="NO">NO
              <option value="SI">SI
             </select>
        </tr>
        <tr>
            <td><b>Rete_Ica:</b></td>
              <td><select name="ReteIca" class="cajasletra" id="ReteIca">
              <option value="<?echo $filas["reteica"];?>"selected><?echo $filas["reteica"];?>
              <option value="NO">NO
              <option value="SI">SI
             </select></td>
			 <td><b>Dcto:</b></td>
              <td><select name="Dcto" class="cajasletra" id="Dcto">
              <option value="<?echo $filas["dcto"];?>"selected><?echo $filas["dcto"];?>
              <option value="NO">NO
              <option value="SI">SI
             </select>
             <b>% Dcto:</b>
             <input type="text" name="pordcto"  value="<?echo $filas["pordcto"];?>"size="10" maxlength="10" class="cajas" id="pordcto"></td>
        </tr>
         <tr><td><br></td></tr>
            <td colspan="2"><input type="submit" value="Guardar" class="boton">&nbsp;<input type="reset" value="Limpiar" class="boton"></td> 
        </tr>
</table>

  </form>

        <?
                   endwhile;
                 endif;
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
