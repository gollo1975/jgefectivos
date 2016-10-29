<?
 session_start();
?>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
if(session_is_registered("xsession")){
include("../conexion.php");
$consulta="select listadodocumentoempleado.* from listadodocumentoempleado
          where listadodocumentoempleado.iddocumento=$Id";
$resultado=mysql_query($consulta) or die ("Error al buscar los documentos");
$filas_s=mysql_fetch_array($resultado);
?>
<center><h4><u>Editar Registro</u></h4></center>
<form action="GrabarDetalleRequisito.php" method="post">
    <table border="0" align="center">
        <tr>
            <td><b>Id:</b></td>
            <td colspan=3><input type="text" value="<?echo $Id;?>" size="6" name="Id" class="cajas" size="5" readonly id="Id"></td>
        </tr>
        <tr>
            <td><b>Descripción:</b></td>
            <td colspan=3><input type="text" value="<?echo $filas_s["concepto"];?>"class="cajas" name="Concepto" size="90" maxlength="90 " class="cajas" id="Concepto"></td>
        </tr>
        <tr>
            <td><b>Sugerido:</b></td>
            <td colspan=3><input type="text" value="<?echo $filas_s["sugerido"];?>"class="cajas" name="CantidadReal" size="4" maxlength="4 " class="cajas" id="CantidadReal"></td>
        </tr>
        <tr>
            <td><b>Estado:</b></td>
            <td><select name="Estado" id="Estado" class="cajas">
             <option value="<?echo $filas_s["estado"];?>"selected><?echo $filas_s["estado"];?>
            <option value="ACTIVO">ACTIVO
             <option value="INACTIVO">INACTIVO
           </selected></td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
             <td colspan="5"><input type="submit" value="Guardar" class="boton"></td>
        </tr>
    </table>
</form>
<?

}else{
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección.")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
}
?>
