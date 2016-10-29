<html>
<body>
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
         function enviar()
        {
               if (document.getElementById("Valor").value.length <=0)
           {
                alert ("Digite el valor del examen medico.!");
                document.getElementById("Valor").focus();
                return;
           }
             document.getElementById("f1").submit();
        }

</script>
<?
include("../conexion.php");
$conE="select examen.*,zona.zona,provedor.nomprove from examen,zona,provedor
where  zona.codzona=examen.codzona and
       provedor.nitprove=provedor.nitprove and
       examen.Nro='$Nro'";
$resuE=mysql_query($conE)or die ("Error al buscar examen");
$regE=mysql_num_rows($resuE);
$filas=mysql_fetch_array($resuE);
if(!isset($NroE)){
   ?>
    <div align="center"><h4><u>Modificar Provedores</u></h4></div>
    <form action="" method="post" name="f1" id="f1">
     <input type="hidden" name="CodUsuario" value="<?echo $CodUsuario?>" size="15">
    <table border="0" align="center">
       <tr>
          <td><b>Nro_Examen:</b>&nbsp;</td>
           <td><input type="text" name="NroE" value="<?echo $Nro;?>" size="13" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="NroE"></td>
       </tr>
       <tr>
          <td><b>Documento:</b>&nbsp;</td>
           <td><input type="text" name="Documento" value="<?echo $filas["cedula"];?>" size="13" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Documento"></td>
       </tr>
        <tr>
          <td><b>Empleado:</b>&nbsp;</td>
           <td><input type="text" name="Empleado" value="<?echo $filas["nombre"];?>" size="45" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Nombre"></td>
       </tr>
        <tr>
            <td><b>Zona:</b></td>
            <td colspan="10">    <select name="CodZona" class="cajas">
            <?
                 $Aux=$filas["codzona"];
                 $consulta_z="select codzona,zona from zona where zona.estado='ACTIVA' order by zona ";
                 $resultado_z=mysql_query($consulta_z) or die("consulta de Zona Incorrecta");
                 while ($filas_z=mysql_fetch_array($resultado_z))
                       {
                       if ($Aux==$filas_z["codzona"])
                       {
                       ?>
                       <option value="<?echo $filas_z["codzona"];?>" selected><?echo $filas_z["zona"];?>
                       <?
                       }
                       else
                       {
                       ?>
                       <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
                       <?
                       }
                       }
                       ?>
                       </select></td>
        </tr>
         <tr>
            <td><b>Proveedor:</b></td>
            <td colspan="10"><select name="Proveedor" class="cajas">
            <?
                 $AuxP=$filas["nitprove"];
                 $conP="select nomprove,nitprove from provedor where provedor.estado='ACTIVO' and provedor.alianzaexamen='SI' order by nomprove";
                 $resP=mysql_query($conP) or die("error de la busqueda de proveedor");
                 while ($filasP=mysql_fetch_array($resP))
                       {
                       if ($AuxP==$filasP["nitprove"])
                       {
                       ?>
                       <option value="<?echo $filasP["nitprove"];?>" selected><?echo $filasP["nomprove"];?>
                       <?
                       }
                       else
                       {
                       ?>
                       <option value="<?echo $filasP["nitprove"];?>"><?echo $filasP["nomprove"];?>
                       <?
                       }
                       }
                       ?>
                       </select></td>
        </tr>
         <tr>
          <td><b>Otro_Valor:</b>&nbsp;</td>
           <td><input type="text" name="Valor" value="<?echo $filas["costoe"];?>" size="13" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Valor"></td>
       </tr>
       <tr><td><br></td></tr>
        <tr>
          <td colspan="2"><input type="button" Value="Guardar" class="boton" name="grabar" id="grabar" onclick="enviar()"></th>
       </tr>
    </table>
</form>
<td><a href="ModificarProveedor.php"><b><u><h5><font color="red">Regresar</font></h5></u></b></td>
<?
}else{
     $FechaM=date('Y-m-d');
     include("../conexion.php");
     $conG="update examen set codzona='$CodZona',nitprove='$Proveedor',costoe='$Valor',otrousuario='$CodUsuario',fecham='$FechaM' where examen.nro='$NroE'";
     $resG=mysql_query($conG)or die ("Error al actualizar examenes");
     $registros=mysql_affected_rows();
     echo "<script language=\"javascript\">";
     echo "alert (\"Se actualizó el examen con exito en el sistema.!\");";
     echo "open (\"ModificarProveedor.php?CodUsuario=$CodUsuario\",\"_self\");";
     echo "</script>";
}
?>
</body>
</html>
