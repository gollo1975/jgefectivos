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
        $conF="select examenglobal.* from examenglobal
                where examenglobal.conse='$Codigo'";
        $resF=mysql_query($conF) or die ("Error al buscar examen");
        $regF=mysql_num_rows($resF);
         ?>
               <center><h4><u>Agregar Item</u></h4></center>
                         <?
                        while ($filas_s=mysql_fetch_array($resF)):
                             ?>
                            <form action="GrabarEdicionZona.php" method="post">
                            <input type="hidden" name="IdZona" value="<? echo $IdZona;?>">

                              <table border="0" align="center">
                             <tr>
                               <td><b>Cód_Examen:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["conse"];?>" size="6"name="Codigo" class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Descripción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["descripcion"];?>"class="cajas" name="descripcion" size="50" maxlength="50 " class="cajas" readonly></td>
                             </tr>
                             <tr><td><br></td></tr>
                             <tr>
                                <td colspan="5"><input type="submit" value="Agregar" class="boton"></td>
                             </tr>
                         </table>
                       </form>
              <?
             endwhile;

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
