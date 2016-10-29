<html>
        <head>
                <title>Crear Nonima</title>
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
                    function chequeo()
                      {
                      if(document.getElementById("firma").value.length <=0)
                        {
                        alert ("Digite la cédula del administrador de las novedades?");
                        document.getElementById("firma").focus();
                        return;
                        }
                        document.getElementById("matfirma").submit();
                      }
               </script>
        </head>
        <body>
        <?
  include("../conexion.php");
    $consulta="select zona.codzona,zona.zona from zona where codzona='$codzona'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
     ?>
     <script language="javascript">
       alert("No existe el registro en la bd ?")
       history.back()
     </script>
    <?
     else:
             ?><center><h4>Crear Periodo de Novedades</h4></center><?
             while($filas=mysql_fetch_array($resultado)):
               ?>

                 <form action="guardarperiodo.php" method="post" id="matfirma">
                   <td><input type="hidden" name="codigo" value="<? echo $codigo;?>"></td>
                   <td><input type="hidden" name="codzona" value="<? echo $codzona;?>"></td>  
                   <table border="0" align="center">
                     <tr>
                       <td><b>Cod_Zona:</b></td>
                       <td colspan=3><input type="text" value="<?echo $filas["codzona"];?>" name="codzona" readonly class="cajas"></td>
                     </tr>
                     <tr>
                       <td><b>Zona:</b></td>
                       <td colspan=3><input type="text" value="<?echo $filas["zona"];?>"name="zona" size="50" class="cajas" maxlength="50" class="cajas" readonly></td>
                     </tr>
                     <tr>
                       <td><b>Desde:</b></td>
                       <td> <input type="text" value="<? echo date("Y-m-d");?>" name="desde"size="10"  class="cajas" maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde"></td>
                       <td><b>Hasta:</b></td>
                       <td><input type="text" value="<? echo date("Y-m-d");?>"name="hasta" size="10"  class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta"></td>
                     </tr>
                       <tr>
                       <td><b>Estado:</b></td>
                           <td><select name="estado" class="cajas">
                               <option value="falta">FALTA
                               <option value="listo">LISTO
                          </select></td>
                       </td>
                      </tr>
                    <tr>
                       <td><b>Nota:</b></td>
                      <td colspan="5"><textarea  name="nota" cols="55" rows="6" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"></textarea></td>
                    </tr>
                    <tr>
                       <td><b>Cédula Admon:</b></td>
                       <td colspan=3><input type="text" name="firma" value="" size="15" class="cajas" maxlength="13" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="firma"></td>
                     </tr>
                     <tr><td><br></td></tr>
                    <tr>
                     <td colspan="2"><input type="button" value="Guardar" class="boton" onclick="chequeo()"></td>
                  </tr>
            </table>
          </form>
        <?
     endwhile;
 endif;

        ?>
              </body>
</html>
