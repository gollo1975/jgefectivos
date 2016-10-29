<?
 session_start();
?>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">
     function sumarTotal()
        {
               total = document.getElementById("vlrhora").value
               total1 = document.getElementById("nrohora").value
               subtotal = parseFloat (total) * parseFloat(total1);
               document.getElementById("salario").value =  parseFloat(subtotal);
         }
</script>
<?
 if(session_is_registered("xsession")):
   if(empty($datos)):
     ?>
      <script language="javascript">
        alert("Debe de Seleccionar un Item ?")
        history.back()
        </script>
     <?
   else:
        include("../conexion.php");
                $consulta="select decentro.* from centro,decentro where
                centro.codcentro=decentro.codcentro
                and decentro.conse='$conse'
                and decentro.codsala=$datos";
                $resultado=mysql_query($consulta) or die ("eliminacion incorrecta");
                $registros=mysql_affected_rows();
         if ($registros!=0):
              ?>
              <center><h4><u>Modificar Datos</u></h4></center>
                         <?
                        while ($filas_s=mysql_fetch_array($resultado)):
                         ?>
                            <form action="guardarm.php" method="post">
                            <input type="hidden" name="conse" value="<? echo $conse;?>">
                            <input type="hidden" name="datos" value="<? echo $datos;?>">
                            <input type="hidden" name="cedemple" value="<? echo $cedemple;?>">
                              <table border="0" align="center">
                             <tr>
                               <td><b>Código:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["codsala"];?>" size="6"name="codsala" class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Descripción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["descripcion"];?>"class="cajas" name="descripcion" size="50" maxlength="50 " class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Vlr_Hora:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["vlrhora"];?>" class="cajas"name="vlrhora"size="11" maxlength="11"></td>
                             </tr>
                              <tr>
                               <td><b>Nro_Hora:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["nrohora"];?>" class="cajas"name="nrohora"size="11" maxlength="11"></td>
                             </tr>
                              <tr>
                               <td><b>Salario:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["salario"];?>" class="cajas" name="salario" size="11" maxlength="11" onfocus="sumarTotal()"></td>
                             </tr>
                             <tr>
                                <td><b>Prestacion:</b></td>
                                <td><select name="prestacion" class="cajas">
                                  <option value="<?echo $filas_s["prestacion"];?>" selected><?echo $filas_s["prestacion"];?>
                                  <option value="NO">NO
                                  <option value="SI">SI
                                </select></td>
                             </tr>
                             <tr>
                                <td><b>Tipo_Variable:</b></td>
                                <td><select name="tipocon" class="cajas">
                                  <option value="<?echo $filas_s["variacion"];?>" selected><?echo $filas_s["variacion"];?>
                                  <option value="FIJO">FIJO
                                  <option value="VARIABLE">VARIABLE
                                </select></td>
                             </tr>
                             <tr>
                                <td><b>C.Cost_Vis.:</b></td>
                                <td><select name="Visible" class="cajas">
                                  <option value="<?echo $filas_s["estado"];?>" selected><?echo $filas_s["estado"];?>
                                  <option value="NO">NO
                                  <option value="SI">SI
                                </select></td>
                             </tr>
                             <tr>
                                <td><b>Control:</b></td>
                                <td><select name="Control" class="cajas">
                                  <option value="<?echo $filas_s["datos"];?>" selected><?echo $filas_s["datos"];?>
                                  <option value="NO">NO
                                  <option value="SI">SI
                                </select></td>
                             </tr>
                             <tr>
                               <td><b>Porcentaje:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["porcentaje"];?>"name="porcentaje" size="11" maxlength="11" class="cajas"></td>
                             </tr>
                             <tr>
                               <td><b>Deducción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["deduccion"];?>"name="deduccion" size="11" maxlength="11" class="cajas"></td>
                             </tr>
                             <tr>
                                <td><b>Activo.:</b></td>
                                <td><select name="Activo" class="cajas">
                                  <option value="<?echo $filas_s["activo"];?>" selected><?echo $filas_s["activo"];?>
                                  <option value="SI">SI
                                  <option value="NO">NO
                                </select></td>
                             </tr>
                              <tr>
                                <td><b>Permanente.:</b></td>
                                <td><select name="Permanente" class="cajas">
                                  <option value="<?echo $filas_s["permanente"];?>" selected><?echo $filas_s["permanente"];?>
                                  <option value="SI">SI
                                  <option value="NO">NO
                                </select></td>
                             </tr>
							  <tr>
                                <td><b>Agrupado:</b></td>
                                <td><select name="Agrupado" class="cajas" id="Agrupado">
                                  <option value="<?echo $filas_s["agrupado"];?>" selected><?echo $filas_s["agrupado"];?>
                                  <option value="SI">SI
                                  <option value="NO">NO
                                </select></td>
                             </tr>
                             <tr><td><br></td></tr>
                             <tr>
                                <td colspan="5"><input type="submit" value="Guardar" class="boton"></td>
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
