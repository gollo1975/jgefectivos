<html>
        <head>
                <title>Modificacion de Zona</title>
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
               </script>
        </head>
        <body>
        <?
               if (!isset($codigo)):
                        include("../conexion.php");
                       
    $consulta="select zona.* from zona  where zona.codzona='$cod'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    $con="select zona.* from zona,detalladozona
    where detalladozona.codzona=zona.codzona and
          zona.codzona='$cod'";
    $resu=mysql_query($con)or die("Consulta incorrecta");
    $reg=mysql_num_rows($resu);
    if ($reg!=0):
          ?>
     <script language="javascript">
       alert("Este Registro ya fue ingresado en sistema ?")
       history.back()
     </script>
    <?
     else:
     ?><center><h4><u>Datos a Modificar</u></h4></center><?
     while($filas=mysql_fetch_array($resultado)):
       ?>

         <form action="guardardetalle.php" method="post" width="300">
           <table border="0" align="center">
           <tr><td><br></td></tr>  
             <tr>
               <td><b>Cod_Zona:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["codzona"];?>" name="codzona" size="3" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codzona"></td>
             </tr>
             <tr>
               <td><b>Zona:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["zona"];?>"name="zona" size="60" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona"></td>
             </tr>
             <tr>
               <td><b>R_Legal:</b></td>
               <td colspan=3><input type="text" value="" name="rl"size="60" maxlength="60" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="rl"></td>
             </tr>
              <tr>
               <td><b>Celular:</b></td>
               <td colspan=3><input type="text" value="" name="celular" size="15" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="celular"></td>
             </tr>
            <tr>
               <td><b>Contacto_Nom.:</b></td>
               <td colspan=3><input type="text" value=""name="contacto" size="60" maxlength="60" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="contacto"></td>
             </tr>
              <tr>
               <td><b>Cargo:</b></td>
               <td colspan=3><input type="text" value="" name="cargo" size="35" maxlength="35" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cargo"></td>
             </tr>
              <tr>
               <td><b>Teléfono:</b></td>
               <td colspan=0><input type="text" value="" name="telefonoN" size="8" maxlength="7" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telefonoN"></td>
               <td><b>Ext:</b></td>
               <td colspan=0><input type="text" value="" name="ext" size="8" maxlength="7" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="ext"></td>
             </tr>
             <tr>
               <td><b>P_Pagos:</b></td>
               <td colspan=3><input type="text" value="" name="pagos" size="60" maxlength="60" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="pagos"></td>
             </tr>
               <tr>
               <td><b>Teléfono:</b></td>
               <td colspan=0><input type="text" value="" name="telefono" size="8" maxlength="7" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telefono"></td>
               <td><b>Ext:</b></td>
               <td colspan=0><input type="text" value="" name="extension" size="8" maxlength="7" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="extension"></td>
             </tr>
             <tr>
              <td><b>Pago_Nómina:</b></td>
               <td colspan="3"><select name="pagonomina" class="cajas">
               <option value="0">Seleccione la forma
                  <option value="SEMANAL">SEMANAL
				  <option value="DECADAL">DECADAL
                  <option value="CATORCENAL">CATORCENAL
                  <option value="QUINCENAL">QUINCENAL
                  <option value="MENSUAL">MENSUAL
                  </select>
                </td>
               </tr>
             <tr>
              <td><b>Cartera:</b></td>
               <td colspan="3"><select name="pago" class="cajas">
               <option value="0">Seleccione el periodo
                  <option value="7">7-DIAS
                  <option value="10">10-DIAS
                   <option value="14">14-DIAS
                   <option value="15">15-DIAS
				   <option value="20">20-DIAS
                  <option value="30">30-DIAS
				  <option value="45">45-DIAS
				  <option value="60">60-DIAS
                  <option value="1">1-DIAS
                  </select>
                </td>
               </tr>
              <tr>
               <td><b>Observación:</b></td>
               <td colspan="3"><textarea name="nota" cols="60" rows="6" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"></textarea></td>
             </tr>
             <tr><td><br></td></tr>
             <tr>
               <td colspan="2"><input type="submit" value="Guardar" class="boton"></th>
             </tr>
             <tr><td><br></td></tr>

        <?
                   endwhile;
                 endif;
          endif;

        ?>
                                </table>
                </form>


        </body>
</html>
