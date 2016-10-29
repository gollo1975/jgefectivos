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
                     function chequearcampos()	{

                        if (document.getElementById("CodSala").value.length <=0)	{

                            alert ("Digite el Codigo del salario a actualizar");
                            document.getElementById("CodSala").focus();
                            return;
                        }

                        	document.getElementById("matAct").submit();
		         }
</script>
<?
include("../conexion.php");
$consulta="select zona.* from zona where
zona.codzona='$CodZona'";
$resultado=mysql_query($consulta)or die ("Consulta incorrecta");
$registro=mysql_num_rows($resultado);
$filas=mysql_fetch_array($resultado);
?>
<center><h5><u>Actualizar Items</u></h5></center>
<form action="GrabarItem.php" method="post" id="matAct">
     <table border="0" align="center">
         <tr>
           <td><b>Cod_Zona:</b></td>
           <td><input type="text" name="CodZona" value="<?echo $CodZona;?>" size="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" readonly id="CodZona"></td>
        </tr>
          <tr>
           <td><b>Cod_Zona:</b></td>
           <td><input type="text" name="Zona" value="<?echo $filas["zona"];?>" size="50" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" readonly id="Zona"></td>
        </tr>
        <tr>
            <td><b>Cod_Salario:<b></td>
            <td><input type="text" name="CodSala" value="" size="10" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="CodSala"></td>
        </tr>
        <tr>
           <td><b>Estado:</b></td>
           <td><select name="Estado" class="cajasletra">
               <option value="SI">SI
               <option value="NO">NO
               </select></td>
           </tr>
           <tr>
           <td><b>Tipo_Actulización:</b></td>
               <td><input type="radio" value="Activo" name="Variable">Activo<input type="radio" value="Permanente" name="Variable">Permanente</td>
           </tr>
            <tr><td><br></td></tr>
           <tr>
               <td colspan="9"><input type="button" Value="Actualizar" class="boton" onclick="chequearcampos()"></td>
           </tr>
     </table>
</form>
<?

