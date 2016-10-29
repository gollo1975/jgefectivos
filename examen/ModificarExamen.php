<?
 session_start();
?>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
 if(session_is_registered("xsession")):
   if(empty($CodProceso)):
     ?>
      <script language="javascript">
        alert("Debe de Seleccionar un Item ?")
        history.back()
        </script>
     <?
   else:
        include("../conexion.php");
                $consulta="select detalladoexamen.*,examenglobal.descripcion from detalladoexamen,examenglobal
                where detalladoexamen.conse=examenglobal.conse and
                      detalladoexamen.codigo=$CodProceso";
                $resultado=mysql_query($consulta) or die ("Error al buscar datos del examen");
                $registros=mysql_affected_rows();
         if ($registros!=0):

?>
        <center><h4><u>Modificar Datos</u></h4></center>
                         <?
                        while ($filas_s=mysql_fetch_array($resultado)):
                         $VlrInd=$filas_s["vlrexamen"];
                         ?>
                            <form action="GrabarE.php" method="post">
                            <input type="hidden" name="Nro" value="<? echo $Nro;?>">
                            <input type="hidden" name="CodProceso" value="<? echo $CodProceso;?>">
                            <input type="hidden" name="CostoE" value="<? echo $CostoE;?>">
                            <input type="hidden" name="VlrInd" value="<? echo $VlrInd;?>">
                              <table border="0" align="center">
                             <tr>
                               <td><b>Código:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["codigo"];?>" size="6"name="CodProceso" class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Descripción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["descripcion"];?>"class="cajas" name="descripcion" size="50" maxlength="50 " class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Vlr_Examen:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["vlrexamen"];?>" class="cajas"name="vlrexamen"size="11" maxlength="11"></td>
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
