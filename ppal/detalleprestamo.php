<html>
<head>
  <title>Editar prestamo</title>
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
 <?
   include("../conexion.php");
   $cons="select prestamoempresa.* from prestamoempresa
         where prestamoempresa.nroprestamo='$nroprestamo' and
               prestamoempresa.estado='ACTIVO'";
   $resu=mysql_query($cons)or die ("Error al buscar informacion");
   $reg=mysql_num_rows($resu);
   if($reg!=0):
    while($filas=mysql_fetch_array($resu)):
     ?>
          <center><h4><u>Editar Prestamo</u></h4></center>
          <form action="grabarmodificareditar.php" method="post" width="400">
           <table border="0" align="center">
           <input type="hidden" name="nroprestamo" value="<? echo $nroprestamo;?>">
           <input type="hidden" name="codigo" value="<? echo $codigo;?>">

             <tr><td><br></td></tr>
             <tr>
                <td><b>Documento:</b></td>
               <td><input type="text" name="cedula" value="<? echo $filas["cedemple"];?>"class="cajas" size="15" maxlength="15" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
             </tr>
             <tr>
                <td><b>Empleado:</b></td>
               <td colspan="5"><input type="text" name="nombre" value="<? echo $filas["nombres"];?>" class="cajas" size="55"  readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre"></td>
             </tr>
              <tr>
                <td><b>Zona:</b></td>
               <td colspan="5"><input type="text" name="zona" value="<? echo $filas["zona"];?>" class="cajas"size="55" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona"></td>
             </tr>
             <tr>
               <td><b>F_Proceso:</b></td>
               <td ><input type="text" name="fechaP" value="<? echo $filas["fechap"];?>" class="cajas"size="13" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechaP"></td>
               <td><b>F_Desembolso:</b></td>
               <td><input type="text" name="fechaD" value="<? echo $filas["fechad"];?>" class="cajas"size="13" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechaD"></td>
             </tr>
             <tr>
                <td><b>Forma_Pago:</b></td>
                   <td><select name="formapago" class="cajas">
                   <option value="<?echo $filas["formapago"];?>" selected><?echo $filas["formapago"];?>
                   <option value="SEMANAL">SEMANAL
                  <option value="DECADAL">DECADAL
                  <option value="QUINCENAL">QUINCENAL
                  <option value="MENSUAL">MENSUAL
               </select></td>
                <td><b>Cuota:</b></td>
               <td ><input type="text" name="cuota" value="<? echo $filas["cuota"];?>" class="cajas"size="13" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cuota"></td>
            </tr>
             <tr>
               <td><b>Vlr_Prestamo:</b></td>
               <td ><input type="text" name="valor" value="<? echo $filas["vlrprestamo"];?>" class="cajas"size="13" maxlenght="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="valor"></td>
               <td><b>Dias:</b></td>
               <td ><input type="text" name="dias" value="<? echo $filas["dias"];?>" class="cajas"size="13" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dias"></td>
             </tr>
             <tr>
               <td><b>Responsable:</b></td>
               <td colspan="4"><input type="text" name="responsable" value="<? echo $filas["responsable"];?>" class="cajas"size="55" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="resposanble"></td>

             </tr>
              <tr>
                 <td><b>Observación:</b></td>
                            <td colspan="9"><textarea name="observacion" cols="60" rows="4" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="observacion"><? echo $filas["nota"];?></textarea></td></tr>
                 <tr>
             <tr><td><br></td></tr>
             <tr>
               <td colspan="5">
                  <input type="submit" value="Guardar Dato" class="boton"></td>
             </tr>
           </table>
         </form>
         <?
      endwhile;
   else:
     ?>
     <script language="javascript">
      alert("El registro no se puede modificar por que no esta disponible ?..")
      history.back()
     </script>
     <?
   endif;
 ?>
</body>
</html>
