<?
 session_start();
?>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
 if(session_is_registered("xsession")):
   if(empty($Codigo)):
     ?>
      <script language="javascript">
        alert("Debe de Seleccionar un Item ?")
        history.back()
        </script>
     <?
   else:
        include("../conexion.php");
        $conF="select detalladoexamen.* from detalladoexamen
                where detalladoexamen.conse='$Codigo' and detalladoexamen.nro='$Nro'";
        $resF=mysql_query($conF) or die ("Error al buscar examen");
        $regF=mysql_num_rows($resF);
        if ($regF==0):
                $consulta="select examenglobal.* from examenglobal
                where examenglobal.conse=$Codigo";
                $resultado=mysql_query($consulta) or die ("Error al buscar datos del examen");
                $registros=mysql_affected_rows();
               ?>
               <center><h4><u>Agregar Item</u></h4></center>
                         <?
                        while ($filas_s=mysql_fetch_array($resultado)):
                         $VlrInd=$filas_s["vlrexamen"];
                         ?>
                            <form action="GrabarEdicion.php" method="post">
                            <input type="hidden" name="Nro" value="<? echo $Nro;?>">
                            <input type="hidden" name="CostoE" value="<? echo $CostoE;?>">
                              <table border="0" align="center">
                             <tr>
                               <td><b>Cód_Examen:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["conse"];?>" size="6"name="Codigo" class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Descripción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["descripcion"];?>"class="cajas" name="descripcion" size="50" maxlength="50 " class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Vlr_Examen:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["valor"];?>" class="cajas"name="vlrexamen"size="11" readonly></td>
                             </tr>
                             <tr><td><br></td></tr>
                             <tr>
                                <td colspan="5"><input type="submit" value="Agregar" class="boton"></td>
                             </tr>
                         </table>
                       </form>
              <?
             endwhile;
         else:
             ?>
             <script language="javascript">
                alert("Este item ya esta cargado a este Empleado ?")
               history.back()
             </script>
             <?
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
