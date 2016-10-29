<html>
<head>
                <title>Modificar Datos</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
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
               if (document.getElementById("observacion").value.length <=0)
           {
                alert ("Digite la observacion del examen ");
                document.getElementById("observacion").focus();
                return;
           }
             document.getElementById("f1").submit();
        }
function volver()// para declara funcion
        {
                pagina='individual.php'
                tiempo=50
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                      function chequearcampos()
                    {
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento de Identidad ?");
                            document.getElementById("cedula").focus();
                            return;
                        }
						if (document.getElementById("Cargo").value.length == "")
                        {
                            alert ("Favor digite el cargo que va a tener el empleado..");
                            document.getElementById("Cargo").focus();
                            return;
                        }
						
                        document.getElementById("matcrea").submit();

                    }
                    function validar()
                    {
                        if (document.getElementById("nombre").value.length <=0)
                        {
                            alert ("Digite el nombre del empleado ?");
                            document.getElementById("nombre").focus();
                            return;
                        }
                        document.getElementById("matgra").submit();

                    }
					function tick(){
					var hours, minutes, seconds, ap;
					var intHours, intMinutes, intSeconds;
					var today;
					today = new Date();
					intHours = today.getHours();
					intMinutes = today.getMinutes();
					intSeconds = today.getSeconds();
					switch(intHours){
						case 0:
							intHours = 12;
							hours = intHours+":";
							ap = "A.M.";
							break;
						case 12:
							hours = intHours+":";
							ap = "P.M.";
							break;
						case 24:
							intHours = 12;
							hours = intHours + ":";
							ap = "A.M.";
							break;
							default:
						if (intHours > 12)
							{
							intHours = intHours - 12;
							hours = intHours + ":";
							ap = "P.M.";
							break;
						    }
						if(intHours < 12)
							{
							hours = intHours + ":";
							ap = "A.M.";
							}
					}
					if (intMinutes < 10){
					minutes = "0"+intMinutes+":";
					}else{
					minutes = intMinutes+":";
					}
					if (intSeconds < 10) {
					seconds = "0"+intSeconds+" ";
					} else {
					seconds = intSeconds+" ";
					}
					timeString = hours+minutes+seconds+ap;
					f1.FechaHora.value = timeString;
					//Clock.innerHTML = timeString;

					window.setTimeout("tick();", 100);
			}
		    window.onload = tick;			 
</script>
<?
if (!isset($Validar)):
    ?>
    <center><h4><u>Validar Examen</u></h4></center>
    <form action="" method="post" id ="f1" name="f1">
    <input type="hidden" name="CodUsuario" value="<?echo $CodUsuario;?>">
	<input type="hidden" name="FechaHora" value="" id="FechaHora">
          <table border="0" align="center"
          <tr><td><br></td></tr>
          <tr>
          <td><b>Nro_Examen:</b></td>
          <td><input type="text" name="NroExamen" value="<?echo $NroExamen?>" size="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" readonly id="NroExamen"></td>
          </tr>
          <td><b>Validar:</b></td>
                <td><select name="Validar" class="cajas"id="Validar">
                <option value="<?echo $Estado;?>" selected><?echo $Estado;?>
                <option value="SI">SI
                <option value="NO">NO
             </select></td>
          </tr>
		  <td><b>Cobrar_Examen:</b></td>
                <td><select name="Cobrar" class="cajas"id="Cobrar">
                <option value="SI">SI
                <option value="NO">NO
             </select></td>
          </tr>
          <tr>
          <td colspan="1"><b>Observación:</b></td>
           <td><textarea name="observacion" cols="45" rows="4" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="observacion"></textarea></td></tr>
          <tr><td><br></td></tr>
          <tr><td ><input type="button" Value="Buscar" class="boton" onclick="enviar()"></td></tr>
       </table>
   </form>
<?
else:
   include("../conexion.php");
   $observacion=strtoupper($observacion);
   $HoraF = date('Y-m-d');
   $Sql="update examen set validadoso='$Validar', usuariovalidador='$CodUsuario' ,nota='$observacion',cobrarexamen='$Cobrar',horaexamenvalidado='$FechaHora',fechavalidado='$HoraF' where examen.nro='$NroExamen'";
   $Rs=mysql_query($Sql)or die("Error al validar");
   ?>
       <script language="javascript">
          alert("Registro validado con exito en sistema.!")
          open("ValidarExamen.php?CodUsuario=<?echo $CodUsuario;?>","_self")
       </script>
      <?
endif;
?>
</body>
</html>
