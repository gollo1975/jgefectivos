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
       $conF="select detalladoparametroexamenzona.* from detalladoparametroexamenzona
                where detalladoparametroexamenzona.codigo='$Codigo'";
        $resF=mysql_query($conF) or die ("Error al buscar examen");
        $regF=mysql_num_rows($resF);
            ?>
               <center><h4><u>Editar Item</u></h4></center>
                         <?
                        while ($filas_s=mysql_fetch_array($resF)):
                              ?>
                            <form action="GrabarEdicionConfiguracion.php" method="post" id="f1">
                                  <table border="0" align="center">
                                  <input type="hidden" value="<?echo $IdZona;?>" name="IdZona" >
                             <tr>
                               <td><b>Cód_Examen:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["codigo"];?>" size="6"name="Codigo" class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Descripción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["concepto"];?>"class="cajas" name="descripcion" size="60" maxlength="55 " class="cajas" ></td>
                             </tr>
                              <tr>
                               <td><b>Estado:</b></td>
                                 <td> <select  name="Estado" class="cajas" id="Estado">
                                           <option value="<?echo $filas_s["estado"];?>"selected><?echo $filas_s["estado"];?></option>
                                           <option value="ACTIVO">ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>  

                                      </select>
                                  </td>
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
