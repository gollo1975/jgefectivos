<html>

<head>
  <title></title>
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
                     function Valide()
                      {
                         if (document.getElementById("Empresa").value == 0)
                          {
                            alert ("Digite el nombre de la Empresa a contratar.!");
                            document.getElementById("Empresa").focus();
                            return;
                          }
                          if (document.getElementById("Direccion").value == 0)
                          {
                            alert ("Digite la dirección de la Empresa a contratar.!");
                            document.getElementById("Direccion").focus();
                            return;
                          }
                          if (document.getElementById("RepresentanteLegal").value == 0)
                          {
                            alert ("Digite el Representante Legal de la Empresa a contratar.!");
                            document.getElementById("RepresentanteLegal").focus();
                            return;
                          }
                           if (document.getElementById("Proceso").value == 0)
                          {
                            alert ("Digite el proceso a contratar con la Empresa.!");
                            document.getElementById("Proceso").focus();
                            return;
                          }
                           if (document.getElementById("CotizacionLetra").value == 0)
                          {
                            alert ("Digite el Número de la cotización que se negoció con la Empresa.!");
                            document.getElementById("CotizacionLetra").focus();
                            return;
                          }
                           if (document.getElementById("Documento").value == 0)
                          {
                            alert ("Digite el Documento del Representante Legal de la Empresa.!");
                            document.getElementById("Documento").focus();
                            return;
                          }
                            if (document.getElementById("NroC").value == 0)
                          {
                            alert ("Digite el Número de cotización que se negoció con la Empresa.!");
                            document.getElementById("NroC").focus();
                            return;
                          }
                            if (document.getElementById("CotizacionNro").value == 0)
                          {
                            alert ("Digite el Número de cotización que se negoció con la Empresa en Numeros.!");
                            document.getElementById("CotizacionNro").focus();
                            return;
                          }
                         document.getElementById("Matrix").submit();
                     }
   </script>
</head>

<body>
<?php
include("../conexion.php");
$con1="select contratocomercial.* from contratocomercial where nroc='$NroC'";
$resu1=mysql_query($con1)or die("Error en la busqueda del contrato");
$reg1=mysql_affected_rows();
while($filas=mysql_fetch_array($resu1)):
          ?>
           <center><h4><u>Contrato Comercial</u></h4></center>
            <form action="GrabarEditadoC.php" method="post" name="Matrix" id="Matrix">
              <table border="0" align="center">
                 <tr><td><br></td></tr>
                  <tr>
                    <td><b>Nro_Contrato:&nbsp;</b></td>
                    <td><input type="text" name="NroC" value="<?echo $NroC;?>" size="15" class="cajas"  readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="NroC"></td>
                 </tr>
                 <tr>
                    <td><b>Nit/cédula:&nbsp;</b></td>
                    <td><input type="text" name="Nit" value="<?echo $filas["nit"];?>" size="15" class="cajas" id="Nit"><b>Dv:</b>&nbsp;<input type="text" name="Dv" size="2"  value="<?echo $filas["dv"];?>" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Dv"></td>
                 </tr>
                 <tr>
                    <td><b>Empresa:&nbsp;</b></td>
                    <td><input type="text" name="Empresa" value="<?echo $filas["cliente"];?>" size="60" class="cajas" maxlength="55" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Empresa"></td>
                 </tr>
                 <tr>
                    <td><b>Dir_Empresa:&nbsp;</b></td>
                    <td><input type="text" name="Direccion" value="<?echo $filas["direccion"];?>" size="60" class="cajas" maxlength="55" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Direccion"></td>
                 </tr>
                 <tr>
                     <td><b>Municipio:</b></td>
                     <td colspan="10"><select name="CodMuni"class="cajas" style="width: 380px" id="CodMuni">
                              <?
                               $aux=$filas["codmuni"];
                               $consulta_c="select codmuni,municipio from municipio order by municipio";
                               $resultado_c=mysql_query($consulta_c) or die("Error al buscar municipios de la Empresa.!");
                               while ($filas_c=mysql_fetch_array($resultado_c)){
                                    if($aux==$filas_c["codmuni"])
                                        {
                                        ?>
                                         <option value="<?echo $filas_c["codmuni"];?>" selected><?echo $filas_c["municipio"];?>
                                        <?
                                   }else{
                                        ?>
                                         <option value="<?echo $filas_c["codmuni"];?>"><?echo $filas_c["municipio"];?>
                                        <?
                                   }
                               }
                                     ?>
                             </select></td>
		 </tr>
                  <tr>
                    <td><b>R_Legal:&nbsp;</b></td>
                    <td><input type="text" name="RepresentanteLegal" value="<?echo $filas["representantelegal"];?>" size="60" class="cajas" maxlength="55" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="RepresentanteLegal"></td>
                 </tr>
                 <tr>
                    <td><b>Proceso:&nbsp;</b></td>
                    <td><textarea name="Proceso" cols="60"  rows="4"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Proceso" ><?echo $filas["proceso"];?></textarea></td>
                 </tr>
                 <tr>
                    <td><b>Cotización_Letra:&nbsp;</b></td>
                    <td><input type="text" name="CotizacionLetra" value="<?echo $filas["cotizacionletra"];?>" size="60" class="cajas" maxlength="55" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="CotizacionLetra"></td>
                 </tr>
                 <tr>
                    <td><b>Texto:&nbsp;</b></td>
                    <td><textarea name="TextoAdecuado" cols="60"  rows="4"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TextoAdecuado"><?echo $filas["textoadecuado"];?> </textarea></td>
                 </tr>
                  <tr>
                     <td><b>Municipio_Expedición:</b></td>
                     <td colspan="10"><select name="CodMuniExpedicion"class="cajas" style="width: 380px" id="CodMuniExpedicion">
                              <?
                               $auxM=$filas["codmuniexpedicion"];
                               $Con="select codmuni,municipio from municipio order by municipio";
                               $Res=mysql_query($Con) or die("Error al buscar municipios de la Empresa.!");
                               while ($fila=mysql_fetch_array($Res)){
                                    if($auxM==$fila["codmuni"])
                                        {
                                        ?>
                                         <option value="<?echo $fila["codmuni"];?>" selected><?echo $fila["municipio"];?>
                                        <?
                                   }else{
                                        ?>
                                         <option value="<?echo $fila["codmuni"];?>"><?echo $fila["municipio"];?>
                                        <?
                                   }
                               }
                                     ?>
                             </select></td>
		 </tr>
                 <tr>
                    <td><b>Documento:&nbsp;</b></td>
                    <td><input type="text" name="Documento" value="<?echo $filas["documento"];?>" size="15" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Documento"></td>
                 </tr>
                  <tr>
                    <td><b>Nro_Cotización:&nbsp;</b></td>
                    <td><input type="text" name="NroCotizacion" value="<?echo $filas["nrocotizacion"];?>" size="15" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="NroCotizacion"></td>
                 </tr>
                 <tr>
                    <td><b>Cotización_Nro:&nbsp;</b></td>
                    <td><input type="text" name="CotizacionNro" value="<?echo $filas["cotizacionnro"];?>" size="15" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="CotizacionNro"></td>
                 </tr>
                 <tr>
                    <td><b>Fecha_Contrato:&nbsp;</b></td>
                    <td><input type="text" name="FechaContrato" value="<?echo $filas["fechap"];?>" size="15" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaContrato"></td>
                 </tr>
                  <tr><td><br></td></tr>
                 <tr>
                  <td colspan="2">
                    <input type="button" value="Grabar Dato" class="boton" onclick="Valide()"></td>
                  </tr>
               </table>
            </form>
          <?
endwhile;
?>
</body>

</html>
