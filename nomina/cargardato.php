<?
 session_start();
?>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
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

                $consulta="select decentro.* from decentro,centro
                 where centro.codcentro=decentro.codcentro and centro.cedemple='$cedula' and decentro.codsala=$datos";
                $resultado=mysql_query($consulta) or die ("eliminacion incorrecta");
                $registros=mysql_affected_rows();
                if ($registros!=0):

?>
        <center><h4><u>Agregar Item</u></h4></center>
                         <?
                        while ($filas=mysql_fetch_array($resultado)):
                         ?>
                            <form action="guardaranexo.php" method="post">
                            <input type="hidden" name="codigo" value="<? echo $codnomina;?>">
                            <input type="hidden" name="datos" value="<? echo $datos;?>">
                            <input type="hidden" name="cedula" value="<? echo $cedula;?>">
                            <input type="hidden" name="desde" value="<? echo $desde;?>">
                            <input type="hidden" name="hasta" value="<? echo $hasta;?>">
                              <table border="0" align="center">
                              <tr><td><br></td></tr>
                             <tr>
                               <td><b>Cod_Sala:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas["codsala"];?>"name="codsala"  size="10"class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Descripción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas["descripcion"];?>" name="descripcion" size="50" maxlength="50 " class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Vlr_Hora:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas["vlrhora"];?>" name="vlrhora"size="11" maxlength="11" class="cajas"></td>
                             </tr>
                              <tr>
                               <td><b>Nro_Hora:</b></td>
                               <td colspan=3><input type="text" value="" name="nrohora"size="11" maxlength="11" class="cajas"></td>
                             </tr>
                              <tr>
                               <td><b>Salario:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas["salario"];?>"name="salario" size="11" maxlength="11" class="cajas"></td>
                             </tr>
                             <tr>
                              <td colspan=3><input type="hidden" value="<?echo $filas["prestacion"];?>"name="prestacion" size="2" maxlength="2" class="cajas"></td>
                             </tr>
                             <tr>
                               <td><b>Porcentaje:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas["porcentaje"];?>"name="porcentaje" size="11" maxlength="11" class="cajas"></td>
                             </tr>
                             <tr>
                               <td><b>Deducción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas["deduccion"];?>"name="deduccion" size="11" maxlength="11" class="cajas"></td>
                             </tr>
                             <tr>
                               <td colspan=3><input type="hidden" value="<?echo $filas["prestacion"];?>"name="prestacion" size="11" maxlength="11" class="cajas"></td>
                             </tr>
                              <tr><td><br></td></tr>
                              <tr>
                                <td colspan="5"><input type="submit" value="Enviar" class="boton"></td>
                             </tr>
                        </table>
                        <tr><td><br></td></tr>
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
